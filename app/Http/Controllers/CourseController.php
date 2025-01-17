<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_published', true)
                        ->latest()
                        ->paginate(12);
        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        if (!$course->is_published && !auth()->user()?->is_admin) {
            abort(404);
        }
        return view('courses.show', compact('course'));
    }

    public function myCourses()
    {
        $courses = auth()->user()->courses()->latest()->paginate(12);
        return view('courses.my-courses', compact('courses'));
    }

    // Admin methods
    public function create()
    {
        $this->authorize('admin');
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $this->authorize('admin');
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'duration_weeks' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_published' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($validated);

        return redirect()->route('admin.courses.index')
                        ->with('success', 'Cursus succesvol aangemaakt.');
    }

    public function edit(Course $course)
    {
        $this->authorize('admin');
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize('admin');
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'duration_weeks' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_published' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($validated);

        return redirect()->route('admin.courses.index')
                        ->with('success', 'Cursus succesvol bijgewerkt.');
    }

    public function destroy(Course $course)
    {
        $this->authorize('admin');
        
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        
        $course->delete();

        return redirect()->route('admin.courses.index')
                        ->with('success', 'Cursus succesvol verwijderd.');
    }

    // Student methods
    public function enroll(Course $course)
    {
        $this->middleware('auth');
        
        if (!$course->is_published) {
            abort(404);
        }

        if (!auth()->user()->courses->contains($course)) {
            auth()->user()->courses()->attach($course);
            return back()->with('success', 'Je bent succesvol ingeschreven voor deze cursus.');
        }

        return back()->with('info', 'Je bent al ingeschreven voor deze cursus.');
    }

    public function unenroll(Course $course)
    {
        $this->middleware('auth');
        
        auth()->user()->courses()->detach($course);
        return back()->with('success', 'Uitschrijving succesvol.');
    }

    public function track(Course $course)
    {
        $this->middleware('auth');
        
        if (!auth()->user()->courses->contains($course)) {
            abort(403);
        }

        $progress = $course->getProgressForUser(auth()->user());
        return view('courses.track', compact('course', 'progress'));
    }

    // Admin dashboard method
    public function adminIndex()
    {
        $this->authorize('admin');
        $courses = Course::withCount('students')
                        ->latest()
                        ->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }
}