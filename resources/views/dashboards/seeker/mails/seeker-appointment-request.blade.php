{{-- body of the mail --}}
<h4>Good Day! <small style="color:darkcyan">{{ $data['seeker'] }}</small> requested an appointment.</h4>

<p>
   Date: {{ date('l\\, jS F Y', strtotime($data['date'])) }}  <br>
   Time: {{ date('h:i a', strtotime($data['time'])) }}
</p>

Please check your <a href="{{ route('agent.appointments-need-approval') }}">account</a> for more info. Thank you!
