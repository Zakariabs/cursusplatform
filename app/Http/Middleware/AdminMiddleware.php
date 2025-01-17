<?php
   namespace App\Http\Middleware;

   use Closure;
   use Illuminate\Http\Request;

   class AdminMiddleware
   {
       public function handle(Request $request, Closure $next)
       {
           if (!auth()->check() || !\Auth::user()->is_admin) {
               return redirect()->route('dashboard')
                   ->with('error', 'Geen toegang. Admin rechten vereist.');
           }
           return $next($request);
       }
   }