@extends('dashboards.seeker.layouts.app')
@section('title', 'Seeker | View Property')

@section('content')
@include('dashboards.seeker.styles.style')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle"></i>&nbsp;{{ session('message') }}
                    </div>
                @endif
                @if (session('exist'))
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-times-circle"></i>&nbsp;{{ session('exist') }}
                    </div>
                @endif
                <h5 class="card-title text-capitalize text-danger">{{ $favorite->property->category }} for {{ $favorite->property->type }}</h5>
                <div class="row">
                    <div class="col-sm-7 p-3">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="img-fluid mx-auto d-block" src="{{ asset('/storage/properties/' .$favorite->property->featured_image) }}" alt="First slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-5 border-left">
                        <h5 class="card-title text-uppercase text-success">{{ $favorite->property->title }}</h5>
                        <p class="mt-n2 text-muted"><i class="fas fa-map-marker-alt text-danger"></i>&nbsp;{{ $favorite->property->street_brgy.', '.$favorite->property->city.', '.$favorite->property->city }}
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
                                                action="{{ route('seeker.appointment-store') }}" 
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
                                                <br>
                                                <div class="modal-footer">
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
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-capitalize text-danger">Agent</h5>
                <div class="row">
                    <div class="col-sm-6">
                        <img class="img-fluid mx-auto d-block rounded-circle profile" src="{{ asset('/storage/images/' .$favorite->property->user->image) }}" alt="First slide">
                    </div>
                    <div class="col-sm-6 border-left">
                        <h5 class="card-title text-capitalize text-primary">{{ $favorite->property->user->given_name.' '.$favorite->property->user->last_name }}</h5>
                        <p class="mt-n2 text-muted"><i class="fas fa-map-marker-alt text-danger"></i>&nbsp;{{ $favorite->property->user->city.', '.$favorite->property->user->province }}
                        </p>
                        <p class="card-text"><h6 class="text-secondary">About</h6><hr class="mt-n1">{{ $favorite->property->user->about }}</p>
                        <hr>
                        <div class="buttons">
                            <a href="{{ route('user.agent-profile', $favorite->property->user->id) }}" class="btn btn-danger"><i class="fas fa-user-tie"></i> Visit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection