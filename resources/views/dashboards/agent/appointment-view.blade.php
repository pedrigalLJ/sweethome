@extends('dashboards.agent.layouts.app')
@section('title', 'Agent | Update Appointment')

@section('content')
    @include('dashboards.agent.styles.style')
	<div class="container col-sm-6 p-3">
		<div class="card card-warning shadow-lg">
			
			<div class="card-header">{{ date('H:i', strtotime($appointment->time)) }}<h6 class="float-right">{{ date('l\\, jS F Y', strtotime($appointment->date)) }}</h6></div>
			<div class="card-body">
				<div class="card mb-3">
					<img src="{{ asset('storage/properties/'. $appointment->property->featured_image) }}" class="card-img-top" height="250px" alt="...">
					<div class="card-body">
                        <strong class="text-md">
                            <a href="#" data-toggle="modal" data-target="#propertyDetails{{ $appointment->property_id }}">
                                {{ $appointment->property->title }}
                            </a>
                        </strong>
                        <br>
                        <i class="fas fa-map-marker-alt text-danger"></i> <strong class="text-secondary">{{ $appointment->property->street_brgy.', '.$appointment->property->city.', '.$appointment->property->province }}</strong>
						<hr>
                        <p class="text-muted mt-n2 text-sm">
                            {{ _('Property') }}
                        </p>
						<strong class="text-md">
                            <a href="#" data-toggle="modal" data-target="#seekerProfile{{ $appointment->user_id }}">
								{{ $appointment->user->given_name.' '.$appointment->user->last_name }}
                            </a>
						</strong>
                        <br>
                        <i class="fas fa-map-marker-alt text-danger"></i> <strong class="text-secondary">{{ $appointment->user->city.', '.$appointment->user->province }}</strong>
						<hr>
                        <p class="text-muted text-sm mt-n2">
                            {{ _('Seeker') }}
                        </p>
						<div class="modal fade" id="propertyDetails{{ $appointment->property_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                    <h5 class="card-header text-uppercase text-center bg-transparent">{{ $appointment->property->title }}</h5><br>
                                                    <strong class="card-text text-secondary"><i class="fas fa-map-marker-alt text-danger"></i> {{ $appointment->property->street_brgy.', '.$appointment->property->city.', '.$appointment->property->province}}</strong>
                                                    <p class="text-muted">
                                                        {{ _('Location') }}
                                                    </p><hr>
                                                    {{-- <p class="card-text text-danger">
                                                        &#8369;{{ number_format($appointment->property->price, 2) }}</small>
                                                        @if ($appointment->property->type == 'rent')
                                                            <small>per month</small>
                                                        @endif
                                                    </p> --}}
                                                    <strong class="card-text text-danger"> &#8369; {{ number_format($appointment->property->price, 2) }}
                                                        @if ($appointment->property->type == 'rent')
                                                            <small>per month</small>
                                                        @endif
                                                    </strong>
                                                    <p class="text-muted">
                                                        {{ _('Price') }}
                                                    </p>
                                                    <hr>
                                                    <strong class="card-text text-secondary"> 
                                                        <i class="fas fa-align-center text-danger"></i> {{ $appointment->property->description }}
                                                    </strong>
                                                    <p class="text-muted">
                                                        {{ _('Description') }}
                                                    </p>
                                                    <hr>
                                                    <strong class="card-text border-top">
                                                        <div class="row">
                                                            <div class="col-sm-4  text-dark">
                                                                <i class="text-danger fas fa-bed"></i> {{ $appointment->property->bedroom }}
                                                                <p class="text-muted font-weight-normal">
                                                                    {{ _('Bedroom') }}
                                                                </p>
                                                            </div>
                                                            <div class="col-sm-4  text-dark">
                                                                <i class="text-danger fas fa-bath"></i> {{ $appointment->property->bathroom }}
                                                                <p class="text-muted font-weight-normal">
                                                                    {{ _('Bathroom') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </strong>
                                                    <hr>
												
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
						<div class="modal fade" id="seekerProfile{{ $appointment->user_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
								<div class="modal-content">
									
									<div class="modal-body">
										<div class="container">
											<div class="card">
												<img src="{{ asset('storage/images/'.$appointment->user->image) }}" class="card-img rounded" alt="..." width="400px;" height="400px;">
											</div>
											<div class="card">
												<div class="card-body">
                                                    <h5 class="card-header bg-transparent text-center text-uppercase text-primary">{{$appointment->user->given_name.' '.$appointment->user->last_name}}</h5><br>
                                                    <strong class="card-text text-secondary"><i class="fas fa-map-marker-alt text-danger"></i> 
                                                        {{ $appointment->user->city.', '.$appointment->user->province}}
                                                    </strong>
                                                    <p class="text-muted">
                                                        {{ _('Location') }}
                                                    </p>
                                                    <hr>
                                                    <strong class="card-text text-secondary"><i class="fas fa-user text-danger"></i> 
                                                        {{$appointment->user->username}}
                                                    </strong>
                                                    <p class="text-muted">
                                                        {{ _('Username') }}
                                                    </p>
                                                    <hr>
                                                    <strong class="card-text text-secondary"><i class="fas fa-envelope text-danger"></i> 
                                                        {{$appointment->user->email}}
                                                    </strong>
                                                    <p class="text-muted">
                                                        {{ _('Email') }}
                                                    </p>
                                                    <hr>
                                                    <strong class="card-text text-secondary"><i class="fas fa-mobile text-danger"></i> 
                                                        {{$appointment->user->phone_no}}
                                                    </strong>
                                                    <p class="text-muted">
                                                        {{ _('Phone Number') }}
                                                    </p>
                                                    <hr>
                                                    <strong class="card-text text-secondary"><i class="fas fa-calendar text-danger"></i> 
                                                        {{ date('F Y', strtotime($appointment->user->created_at))  }}
                                                    </strong>
                                                    <p class="text-muted">
                                                        {{ _('Joined') }}
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
					</div> 
                </div>
			</div>
            <div class="card-footer">
                <small>Status:</small>
                @if ($appointment->status == 'Waiting')
                    <small class="text-warning font-weight-bold font-italic">{{ $appointment->status  }}</small>
                @elseif($appointment->status == 'Approved')
                    <small class="text-success font-weight-bold">{{ $appointment->status  }}</small>
                @elseif($appointment->status == 'Cancelled')
                    <small class="text-warning font-weight-bold">{{ $appointment->status  }}</small>
                @elseif($appointment->status == 'Done')
                    <small class="text-success font-weight-bold font-italic">{{ $appointment->status  }}</small>
                @elseif($appointment->status == 'Declined')
                    <small class="text-danger font-weight-bold">{{ $appointment->status  }}</small>
                    
                @endif
            </div>
		</div>
	</div>
@endsection