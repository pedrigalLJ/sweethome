@extends('dashboards.agent.layouts.app')
@section('title', 'Agent | Approval Appointments')

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
                            Need Approval
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('dashboards.agent.errors')
                {{-- @if (session('approve'))
                    <div class="alert alert-success mb-5 ml-5 mr-5" role="alert">
                        <i class="fas fa-check"></i> {{ session('approve') }}
                    </div>
                @endif
                @if (session('decline'))
                    <div class="alert alert-danger mb-5 ml-5 mr-5" role="alert">
                        <i class="fas fa-times"></i> {{ session('decline') }}
                    </div>
                @endif --}}
                <div class="card card-primary mt-n4">
                    <div class="card-header">
                        <h3 class="card-title text-sm">
                            <i class="fas fa-calendar-check"></i> Need Approval
                        </h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover text-center">
                            @if ($appointments->count() != 0)
                                <thead>
                                    <tr>
                                        <th>Seeker</th>
                                        <th>Property</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            @endif
                            <tbody>
                                @forelse ($appointments as $appointment)
                                    <tr>
                                        <td>
                                            <a 
                                                href="#" 
                                                class="text-capitalize font-weight-bold" 
                                                data-toggle="modal" 
                                                data-target="#seekerProfile{{ $appointment->user_id }}">
                                                {{ $appointment->user->given_name.' '.$appointment->user->last_name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a 
                                                href="#" 
                                                class="text-uppercase font-weight-bold" 
                                                data-toggle="modal" 
                                                data-target="#propertyDetails{{ $appointment->property_id }}">{{ $appointment->property->title }}
                                            </a>
                                        </td>
                                        <td class="text-sm">
                                            {{ date('l\\, jS F Y', strtotime($appointment->date)) }}
                                        </td>
                                        <td class="text-sm">
                                            {{ date('H:i', strtotime($appointment->time)) }}
                                        </td>
                                        <td class="text-sm">
                                            <a 
                                                href="{{ route('agent.appointment-approve', $appointment->agent_id.$appointment->user_id.$appointment->property_id) }}" 
                                                class="btn btn-success"
                                                data-toggle="modal"
                                                data-target="#confirmApproval{{ $appointment->agent_id.$appointment->user_id.$appointment->property_id }}">
                                                <i class="fas fa-check"></i> Approve
                                            </a>
                                            <a 
                                                href="#" 
                                                class="btn btn-danger" 
                                                data-toggle="modal" 
                                                data-target="#reasonDecline{{ $appointment->agent_id.$appointment->user_id.$appointment->property_id }}">
                                                <i class="fas fa-times"></i> Decline
                                            </a>
                                        </td>
                                        <div class="modal fade" id="propertyDetails{{ $appointment->property_id }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-danger text-capitalize" id="myModalLabel">
                                                            {{$appointment->property->category.' for '.$appointment->property->type}}
                                                            
                                                            
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <div class="card">
                                                                <img src="{{ asset('storage/properties/'.$appointment->property->featured_image) }}" class="card-img rounded" alt="..." width="400px;" height="400px;">
                                                            </div>
                                                            <div class="card  text-primary">
                                                                <div class="card-body">
                                                                <h5 class="card-title">{{$appointment->property->title }}</h5>
                                                                <p class="card-text text-sm text-dark"><i class="fas fa-map-marker-alt text-danger"></i> {{ $appointment->property->street_brgy.', '.$appointment->property->city.', '.$appointment->property->province}}</p>
                                                                <hr>
                                                                <p class="card-text text-danger">
                                                                    &#8369;{{ number_format($appointment->property->price, 2) }}</small>
                                                                    @if ($appointment->property->type == 'rent')
                                                                        <small>per month</small>
                                                                    @endif
                                                                </p>
                                                                <hr>
                                                                <p class="card-text text-secondary">
                                                                    {{ $appointment->property->description }}
                                                                </p>
                                                                <p class="card-text border-top">
                                                                    <div class="row">
                                                                        <div class="col-sm-2  text-dark">
                                                                            <i class="text-secondary fas fa-bed"></i> {{ $appointment->property->bedroom }}
                                                                        </div>
                                                                        <div class="col-sm-2  text-dark">
                                                                            <i class="text-secondary fas fa-bath"></i> {{ $appointment->property->bathroom }}
                                                                        </div>
                                                                    </div>
                                                                </p>
                                                               
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                            
                        
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="seekerProfile{{ $appointment->user_id }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-primary" id="myModalLabel">{{$appointment->user->given_name.' '.$appointment->user->last_name}}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <div class="card">
                                                                <img src="{{ asset('storage/images/'.$appointment->user->image) }}" class="card-img rounded" alt="..." width="400px;" height="400px;">
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <p class="card-text text-sm text-primary"><i class="fas fa-map-marker-alt text-danger"></i> 
                                                                        {{ $appointment->user->city.', '.$appointment->user->province}} <br>
                                                                        <span class="text-secondary">Location</span>
                                                                    </p>
                                                                <hr>
                                                                <p class="card-text">
                                                                    <p class="card-text text-sm text-primary"><i class="fas fa-user text-danger"></i> 
                                                                        {{ $appointment->user->username }} <br>
                                                                        <span class="text-secondary">Username</span>
                                                                    </p>
                                                                </p>
                                                                <hr>
                                                                <p class="card-text">
                                                                    <p class="card-text text-sm text-primary"><i class="fas fa-envelope text-danger"></i> 
                                                                        {{ $appointment->user->email }} <br>
                                                                        <span class="text-secondary">Email</span>
                                                                    </p>
                                                                </p>
                                                                <hr>
                                                                <p class="card-text">
                                                                    <p class="card-text text-sm text-primary"><i class="fas fa-mobile text-danger"></i> 
                                                                        {{ $appointment->user->phone_no }} <br>
                                                                        <span class="text-secondary">Phone No</span>
                                                                    </p>
                                                                </p>
                                                                <p class="card-text"><small class="text-secondary">
                                                                    Joined {{ date('F Y', strtotime($appointment->user->created_at))  }}</small>
                                                                </p>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                            
                        
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="reasonDecline{{ $appointment->agent_id.$appointment->user_id.$appointment->property_id }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('agent.appointment-decline') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h6 class="text-danger">State Your Reason</h6>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-justify">
                                                                <small class="text-muted">Request by:</small> {{ $appointment->user->given_name.' '.$appointment->user->last_name }} <br>
                                                                <small class="text-muted">Property Name:</small> {{ $appointment->property->title }} <br>
                                                                <small class="text-muted">Time:</small> {{ date('H:i', strtotime($appointment->time)) }} <br>
                                                                <small class="text-muted">Date:</small> {{ date('l\\, jS F Y', strtotime($appointment->date)) }}
                                                            </p>
                                                           <input type="hidden" name="user_id" value="{{ $appointment->user_id }}"> 
                                                           <input type="hidden" name="agent_id" value="{{ $appointment->agent_id }}">
                                                           <input type="hidden" name="property_id" value="{{ $appointment->property_id }}">
                                                            <textarea class="form-control mt-4" name="reason" id="exampleFormControlTextarea1" rows="3" placeholder="Write a reason..."></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Decline</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                         </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="confirmApproval{{ $appointment->agent_id.$appointment->user_id.$appointment->property_id }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('agent.appointment-approve') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h6 class="text-success">Confirm Approval</h6>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-justify">
                                                                <small class="text-muted">Request by:</small> {{ $appointment->user->given_name.' '.$appointment->user->last_name }} <br>
                                                                <small class="text-muted">Property Name:</small> {{ $appointment->property->title }} <br>
                                                                <small class="text-muted">Time:</small> {{ date('H:i', strtotime($appointment->time)) }} <br>
                                                                <small class="text-muted">Date:</small> {{ date('l\\, jS F Y', strtotime($appointment->date)) }}
                                                            </p>
                                                           <input type="hidden" name="user_id" value="{{ $appointment->user_id }}"> 
                                                           <input type="hidden" name="agent_id" value="{{ $appointment->agent_id }}">
                                                           <input type="hidden" name="property_id" value="{{ $appointment->property_id }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Confirm</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                         </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @empty
                                    <div class="container text-center mt-5">
                                        <p class="text-muted text-md"> No Record/s. </p>
                                    </div> 
                                @endforelse
                            </tbody>
                        </table>
                        {{ $appointments->links() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	@if (session('approve'))
		<script>
			swal({
				text: "{{ session('approve') }}",
				icon: "success",
			});
		</script>
    @elseif (session('decline'))
        <script>
            swal({
                text: "{{ session('decline') }}",
                icon: "error",
            });
        </script>
	@endif
@endsection
