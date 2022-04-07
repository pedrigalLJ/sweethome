{{-- body of the mail --}}

Hello, {{ $data['given_name'].' '.$data['last_name'] }}! 

Welcome to SweetHome websites,

your account has been approved. 
You can <a href="{{ route('login') }}">login here</a>!

Thank you for trusting.