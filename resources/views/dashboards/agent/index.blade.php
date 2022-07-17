@extends('dashboards.agent.layouts.app')
@section('title', 'Agent | Dashboard')

@section('content')
    @include('dashboards.agent.styles.style')
    <div class="page-title mb-4 mt-n4" style="background-image: url('{{ asset('storage/images/condoImage.jpg')}}');" data-overlay="5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9 text-white">
                    <div class="breadcrumbs" style="margin-bottom: 2rem;">
                        <ol class="breadcrumb-title">
                            <li class="breadcrumb-item">Dashboard</li>
                        </ol>
                        <h2 class="breadcrumb-title text-capitalize">
                            Hello {{ Auth::user()->given_name }}, Welcome!
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row ml-2 mt-n1 mr-2">
        <div class="col-md-7">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-calendar-check"></i> Appointments
                    </h3>
                </div>
                
                <div class="card-body bg-white shadow border rounded-lg">
                        <div class="col-md-12">
                            <div id="calendar"></div>
                        </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="small-box bg-info shadow-lg">
                        <div class="inner">
                            <h3>&#8369; {{ number_format($sales, 2) }}</h3>
                            <p>Total Sales</p>
                        </div>
                        <div class="icon">
                            <i class="ion fas fa-coins"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="small-box bg-primary shadow-lg">
                        <div class="inner">
                            <h3>{{ $listings->count() }}</h3>
                            <p>Listed Properties</p>
                        </div>
                        <div class="icon">
                            <i class="ion fas fa-bars"></i>
                        </div>
                        <a href="{{ route('agent.properties.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    
                    </div>
                    <div class="small-box bg-success shadow-lg">
                        <div class="inner">
                            <h3>{{ $settingAppointment->count() }}</h3>
                            <p>Appointments</p>
                        </div>
                        <div class="icon">
                            <i class="ion fas fa-calendar-alt"></i>
                        </div>
                        <a href="{{ route('agent.appointments-calendar') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    
                    </div>
                    <div class="small-box bg-warning shadow-lg">
                        <div class="inner">
                            <h3>{{ $needApproval->count() }}</h3>
                            <p>Need Approval</p>
                        </div>
                        <div class="icon">
                            <i class="ion fas fa-thumbs-up"></i>
                        </div>
                        <a href="{{ route('agent.appointments-need-approval') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    
                    </div>
                    <div class="small-box bg-danger shadow-lg">
                        <div class="inner">
                            <h3>{{ $sold->count() }}</h3>
                            <p>Sold Properties</p>
                        </div>
                        <div class="icon">
                            <i class="ion fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="small-box bg-dark shadow-lg">
                        <div class="inner">
                            <h3>{{ $rented->count() }}</h3>
                            <p>Rented Properties</p>
                        </div>
                        <div class="icon">
                            <i class="ion far fa-money-bill-alt"></i>
                        </div>
                    </div>
                    <div class="small-box bg-secondary shadow-lg">
                        <div class="inner">
                            <h3>{{ $notAvailable->count() }}</h3>
                            <p>Not Available Properties</p>
                        </div>
                        <div class="icon">
                            <i class="ion fas fa-times"></i>
                        </div>
                        <a href="{{ route('agent.properties-not-available') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                defaultView: 'listWeek',
                events : [
                                    
                    @foreach ($appointments as $appointment)
                    {
                        title : '{{ $appointment->user->given_name.' '. $appointment->user->last_name }}',
                        start : '{{ $appointment->date.' '.$appointment->time }}',
                        url : '{{ route("agent.appointment-view", $appointment->id) }}',
                    },
                    @endforeach
                    
                ],
                
            })
        });
    </script> 
@endsection