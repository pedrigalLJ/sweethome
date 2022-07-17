@extends('dashboards.seeker.layouts.app')
@section('title', 'Seeker | View Property')

@section('content')
@include('dashboards.seeker.styles.style')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @include('dashboards.agent.errors')
                <h5 class="card-title text-capitalize text-danger">{{ $favorite->property->category }} for {{ $favorite->property->type }}</h5>
                <div class="row mt-5">
                    <div class="col-md-7">
                        <img 
                            class="img-fluid image"
                            src="{{ asset('/storage/properties/' .$favorite->property->featured_image) }}"
                            alt="{{ $favorite->property->title.' featured image' }}">
                        <div class="middle">
                            <a href="" data-toggle="modal" data-target="#viewMorePhotos"><div class="text">View More Photos</div></a>
                        </div>
                        <div class="modal fade" id="viewMorePhotos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        {{ $favorite->property->title.' > More Photos' }}
                                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @forelse($images as $image)
                                            @foreach (json_decode($image->url) as $picture)
                                                <img class="img-fluid shadow-lg mr-3 hover-photo"  src="{{ asset('storage/properties/'.$picture) }}" style="height:200px; width:200px"/>
                                            @endforeach
                                    
                                        @empty
                                            <div class="container text-center mt-5">
                                                <p class="text-muted text-md"> Nothing to show. </p>
                                            </div> 
                                        @endforelse
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <h5 class="card-header text-uppercase text-success bg-white">{{ $favorite->property->title }}</h5>
                        <p class="text-muted mt-2"><i class="fas fa-map-marker-alt text-danger"></i>&nbsp;{{ $favorite->property->street_brgy.', '.$favorite->property->city.', '.$favorite->property->city }}
                        </p>
                        <p class="card-text"><h6 class="text-secondary">Descriptions</h6><hr class="mt-n1">{{ $favorite->property->description }}</p>
                        <hr>
                        <div class="text-muted">
                            <span 
                                class="d-inline-block h5 mr-2" 
                                tabindex="0" 
                                data-bs-toggle="tooltip" 
                                title="Bathroom"> 
                                <i class="fas fa-sink"></i>
                                <small>{{ $favorite->property->bathroom }}</small>
                            </span>
                            <span 
                                class="d-inline-block h5 " 
                                tabindex="0" 
                                data-bs-toggle="tooltip" 
                                title="Bedroom"> 
                                <i class="fas fa-bed"></i>
                                <small>{{ $favorite->property->bedroom }}</small>
                            </span>
                        </div>
                        <hr>
                        <h4 class="text-danger font-weight-bold">&#8369; {{ number_format( $favorite->property->price, 2) }}</h4>
                        <hr>
                        <div class="buttons">
                            <a href="{{ route('seeker.remove-to-favorites', $favorite->id) }}" class="btn btn-danger" >
                                <i class="fas fa-minus-circle"></i>&nbsp;Remove To Favorites
                            </a>
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#setAppointmentRequest"><i class="fas fa-paper-plane"></i> Request An Appointment</a>
                            <div class="modal fade" id="setAppointmentRequest" tabindex="-1" role="dialog" aria-labelledby="setAppoinmentRequestLabel">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-success">
                                            Set An Appointment Request
                                        </div>
                                        <div class="modal-body">
                                            <form 
                                                method="post" 
                                                action="{{ route('seeker.appointment-request') }}" 
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input 
                                                    type="number" 
                                                    class="form-control" 
                                                    id="agent_id" 
                                                    name="agent_id" 
                                                    value="{{ $favorite->property->user->id }}" readonly hidden>
                                                <label for="agent" class="col-form-label">Agent</label>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input 
                                                            type="text" 
                                                            class="form-control @error('agent') is-invalid @enderror" 
                                                            id="agent" 
                                                            name="date" 
                                                            value="{{ $favorite->property->user->given_name.' '.$favorite->property->user->last_name }}" readonly>
                                                        @error('agent')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>
                                                                    {{ $message }}
                                                                </strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <input 
                                                    type="number" 
                                                    class="form-control" 
                                                    id="property_id" 
                                                    name="property_id" 
                                                    value="{{ $favorite->property->id }}" readonly hidden>
                                                <label for="property" class="col-form-label">Property</label>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input 
                                                            type="text" 
                                                            class="form-control @error('property') is-invalid @enderror" 
                                                            id="property" 
                                                            name="property" 
                                                            value="{{ $favorite->property->title }}" readonly>
                                                        @error('property')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>
                                                                    {{ $message }}
                                                                </strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <label for="date" class="col-form-label">Availability (Days & Time(24H Format))</label>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                       
                                                        @foreach(json_decode($favorite->property->avail_days) as $days)
                                                            <span class="bg-danger h6">&nbsp;{{ $days }}&nbsp;</span>
                                                        @endforeach
                                                        <input 
                                                            type="text" 
                                                            class=" bg-success text-capitalize form-control @error('day') is-invalid @enderror" 
                                                            id="day" 
                                                            name="day"
                                                            readonly
                                                            value="{{ $favorite->property->avail_days }}"
                                                            hidden>
                                                        @error('day')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>
                                                                    {{ $message }}
                                                                </strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        @foreach(json_decode($favorite->property->avail_times) as $times)
                                                            <span class="bg-danger h6">&nbsp;{{ $times }}&nbsp;</span>
                                                        @endforeach
                                                        <input 
                                                            type="text" 
                                                            class=" bg-success form-control @error('avail_times') is-invalid @enderror" 
                                                            id="avail_times" 
                                                            name="avail_times"
                                                            readonly
                                                            value="{{ $favorite->property->avail_times }}"
                                                            hidden>
                                                            @error('avail_times')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>
                                                                        {{ $message }}
                                                                    </strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <label for="date" class="col-form-label">Date</label>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input 
                                                            type="date" 
                                                            class="form-control @error('date') is-invalid @enderror" 
                                                            id="date" 
                                                            name="date" 
                                                            required>
                                                        @error('date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>
                                                                    {{ $message }}
                                                                </strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <label for="input_time" class="col-form-label">Time</label>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input 
                                                            type="text" 
                                                            class="form-control @error('input_time') is-invalid @enderror" 
                                                            id="input_time" 
                                                            name="input_time" 
                                                            required>
                                                        @error('input_time')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>
                                                                    {{ $message }}
                                                                </strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="modal-footer bg-white">
                                                    <button type="submit" class="btn btn-success">{{ __('Request') }}</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                            
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="card-title text-capitalize text-danger">Agent</h5>
                <div class="row">
                    <div class="col-sm-6">
                        <img class="img-fluid mx-auto d-block rounded-circle profile" src="{{ asset('/storage/images/' .$favorite->property->user->image) }}" alt="First slide">
                    </div>
                    <div class="col-sm-6 border-left">
                        <h5 class="card-header bg-white text-capitalize text-primary">{{ $favorite->property->user->given_name.' '.$favorite->property->user->last_name }}</h5>
                        <p class="text-muted mt-2"><i class="fas fa-map-marker-alt text-danger"></i>&nbsp;{{ $favorite->property->user->city.', '.$favorite->property->user->province }}
                        </p>
                        <p class="card-text"><h6 class="text-secondary">About</h6><hr class="mt-n1">{{ $favorite->property->user->about }}</p>
                        <hr>
                        <div class="buttons">
                            <a href="{{ route('seeker.agent-profile', $favorite->property->user->id) }}" class="btn btn-danger"><i class="fas fa-user-tie"></i> Visit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	@if (session('message'))
		<script>
			swal({
				text: "{{ session('message') }}",
				icon: "success",
			});
		</script>
	@endif
    @if (session('warning'))
		<script>
			swal({
				text: "{{ session('warning') }}",
				icon: "warning",
			});
		</script>
	@endif
    @if (session('exist'))
		<script>
			swal({
				text: "{{ session('exist') }}",
				icon: "error",
			});
		</script>
	@endif
@endsection