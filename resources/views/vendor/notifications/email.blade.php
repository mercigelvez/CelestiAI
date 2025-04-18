<!-- resources/views/vendor/notifications/email.blade.php -->
@component('mail::message')
# Reset Your Celestial Key

You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => $actionUrl, 'color' => 'primary'])
Reset Password
@endcomponent

This password reset link will expire in {{ config('auth.passwords.users.expire', 60) }} minutes.

If you did not request a password reset, no further action is required.

Safe travels through the cosmos,<br>
{{ config('app.name') }}

@component('mail::subcopy')
If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endcomponent
