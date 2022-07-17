@extends('dashboards.agent.layouts.app')
@section('title', 'Agent | Appointments')

@section('content')
    @include('dashboards.agent.styles.style')
    <div class="page-title mb-4 mt-n4" style="background-image: url('{{ asset('storage/images/condoImage.jpg')}}'); " data-overlay="5">
        <div class="container">
            <div class="row">
                <div class="col-md-9 text-white">
                    <div class="breadcrumbs" style="margin-bottom: 2rem;">
                        <ol class="breadcrumb-title">
                            <li class="breadcrumb-item">Appointments</li>
                        </ol>
                        <h2 class="breadcrumb-title text-capitalize">
                            All Appointments
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary mt-n4">
                    <div class="card-header">
                        <h3 class="card-title text-sm">
                            <i class="fas fa-calendar-check"></i> Calendar
                        </h3>
                    </div>
                    
                    <div class="card-body bg-white shadow border rounded-lg">
                            <div class="col-md-12">
                                <div id="calendar"></div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function() {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // weekends: true
                events : [
                    @foreach ($appointments as $appointment)
                    {
                        title : '{{ $appointment->user->given_name.' '. $appointment->user->last_name.' - '. $appointment->status }}',
                        start : '{{ $appointment->date }}',
                        description : '{{ $appointment->status }}',
                        url : '{{ route("agent.appointment-view", $appointment->id) }}'
                    },
                    @endforeach
                ],
            });
        });
    </script> 
    
@endsection