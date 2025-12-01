@component('mail::message')

# Welcome to DTFA, {{ $student->first_name }}!

We’re excited to confirm your registration.

@component('mail::panel')
**Student:** {{ $student->first_name }} {{ $student->second_name }}
**Group:** {{ optional($student->group)->name ?? '—' }}
**Branch:** {{ optional($student->branch)->name ?? '—' }}
**Status:** {{ ucfirst($student->status ?? 'active') }}
@endcomponent

@component('mail::button', ['url' => config('app.url')])
Visit DTFA Portal
@endcomponent

If you have any questions, just reply to this email.

Thanks,
{{ config('app.name') }} Team

@slot('subcopy')
If you’re having trouble clicking the "Visit DTFA Portal" button, copy and paste the URL below into your web browser: {{ config('app.url') }}
@endslot

@endcomponent
