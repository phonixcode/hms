@component('mail::message')
# Welcome, {{ $employee['name'] }}

We are excited to have you on our team as a {{ $employee['position'] }}.

@component('mail::button', ['url' => 'http://hms.test'])
Visit Our Website
@endcomponent

Best regards,<br>
HMS

@endcomponent
