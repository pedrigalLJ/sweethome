{{-- body of the mail --}}
<h4>Your Appointment was APPROVED.</h4>

<p>
    Date: {{ date('l\\, jS F Y', strtotime($data['date'])) }} <br>
    Time: {{ date('H:i A', strtotime($data['time'])) }} <br>
    Location: {{ $data['street_brgy'].', '.$data['city'].', '.$data['province'] }}
</p>
Please be on time. See you and Thank you!