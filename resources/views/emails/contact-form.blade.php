@component('mail::message')
# Nieuw Contact Bericht

**Van:** {{ $contact->name }}  
**Email:** {{ $contact->email }}  
**Onderwerp:** {{ $contact->subject }}

**Bericht:**  
{{ $contact->message }}

@component('mail::button', ['url' => route('contact.index')])
Bekijk in Admin Panel
@endcomponent

@endcomponent