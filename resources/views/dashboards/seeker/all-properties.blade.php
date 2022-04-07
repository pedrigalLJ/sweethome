@extends('dashboards.seeker.layouts.app')
@section('title', 'Seeker | Properties')

@section('content')
    @if (session('status'))
        <div 
            class="alert alert-success" 
            role="alert">
            {{ session('status') }}
        </div>
    @endif
    
    @include('dashboards.seeker.styles.style')
    @include('dashboards.seeker.layouts.searchbar')
    {{-- <div class="container mt-4">
        @foreach ($listings as $listing)
            <div class="card mb-3">
                <div class="row ">

                    <div class="col-md-4">
                        <img class="allprop" src="{{ asset('storage/properties/' .$listing->featured_image) }}" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize text-success">{{ $listing->title }}</h5>
                            <p class="card-text"><i class="fas fa-map-marker-alt text-danger"></i>&nbsp;{{ $listing->location }}</p>
                            <p class="card-text ">{{ $listing->description }}</p>
                            <p class="card-text"><small class="text-muted">{{ $listing->created_at }}</small></p>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div> --}}

    {{-- <div class="container">
        <div class="row row-cols-1 row-cols-md-2">
        @foreach ($listings as $listing)
            <div class="col mb-4">
            <div class="card">
                <img src="{{ asset('storage/properties/' .$listing->featured_image) }}" class="card-img-top allprop" alt="...">
                <div class="card-body">
                <h5 class="card-title text-success">{{ $listing->title }}</h5>
                <p class="card-text text-muted"><i class="fas fa-map-marker-alt text-danger"></i>&nbsp;{{ $listing->location }}</p>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <span 
                            class="d-inline-block h5 mr-2" 
                            tabindex="0" 
                            data-bs-toggle="tooltip" 
                            title="Bathroom"> 
                            <i class="fas fa-sink text-secondary"></i>
                            <small>{{ $listing->bathroom }}</small>
                        </span>
                        <span 
                            class="d-inline-block h5 " 
                            tabindex="0" 
                            data-bs-toggle="tooltip" 
                            title="Bedroom"> 
                            <i class="fas fa-bed text-secondary"></i>
                            <small>{{ $listing->bedroom }}</small>
                            
                        </span>
                    </div>
                    <a href="{{ route('user.view-property', $listing->id) }}" class="btn btn-primary btn-sm">View More Details</a>
                </div>
            </div>
            </div>
        @endforeach
        </div>
    </div> --}}
    {{-- <div class="container mt-4">
        <div class="row">
            @foreach ($listings as $listing)
            <div class="col-md-6">
                
                <div class="card mb-3 shadow-lg">
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <img class="img-fluid allprop" src="{{ asset('storage/properties/'.$listing->featured_image) }}" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-header text-capitalize text-danger">{{ $listing->category.' for '.$listing->type }}</div>
                            <div class="card-body mt-n3">
                                <h5 class="card-title text-capitalize text-success">{{ $listing->title }}</h5>
                                <p class="card-text text-muted mt-n2">
                                    <i class="fas fa-map-marker-alt text-danger"></i>&nbsp;{{ $listing->street_brgy.','.$listing->city.','.$listing->province }}
                                    <h5 class="text-danger">&#8369; {{ number_format($listing->price,2) }}</h5>
                                    <small class="text-muted">{{ date('Fd\\,Y',strtotime($listing->created_at)) }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
               
                    <div class="card-footer">
                        <div class="float-right">
                            <span 
                                class="d-inline-block h6 mr-2" 
                                tabindex="0" 
                                data-bs-toggle="tooltip" 
                                title="Bathroom"> 
                                <i class="fas fa-sink text-secondary"></i>
                                <small>{{ $listing->bathroom }}</small>
                            </span>
                            <span 
                                class="d-inline-block h6 " 
                                tabindex="0" 
                                data-bs-toggle="tooltip" 
                                title="Bedroom"> 
                                <i class="fas fa-bed text-secondary"></i>
                                <small>{{ $listing->bedroom }}</small>
                                
                            </span>
                            
                        </div>
                        <a href="{{ route('seeker.view-property',$listing->id) }}" class="btn btn-primary btn-sm">View More Details</a>
                    </div>
                </div>
                
            </div>
            @endforeach

        </div>
       
    </div> --}}
    <div class="container pt-4" id="agents">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse ($listings as $listing)
            <div class="card-deck">
                <div class="card">
                  <h2 class="card-header text-center text-danger text-capitalize">{{ $listing->category.' for '.$listing->type }}</h2>
                  <img src="{{ asset('storage/properties/'.$listing->featured_image) }}" class="card-img-top allprop" alt="...">
                  <h3 class="card-header text-center text-danger text-capitalize">&#8369; {{ number_format($listing->price,2) }}</h3>
                    <div class="card-body">
                            <h5 class="card-title text-success">{{ $listing->title }}</h5>
                            <p class="card-text text-secondary"><i class="fas fa-map-marker-alt text-danger"></i>&nbsp;{{ $listing->street_brgy.','.$listing->city.','.$listing->province }}</p>
                                  
                            <p class="card-text float-right">
                                <small class="text-muted">{{ date('F d\\, Y',strtotime($listing->created_at)) }}</small>
                            </p>
                        
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <span 
                                class="d-inline-block h5 mr-2" 
                                tabindex="0" 
                                data-bs-toggle="tooltip" 
                                title="Bathroom"> 
                                <i class="fas fa-sink text-secondary"></i>
                                <small>{{ $listing->bathroom }}</small>
                            </span>
                            <span 
                                class="d-inline-block h5 " 
                                tabindex="0" 
                                data-bs-toggle="tooltip" 
                                title="Bedroom"> 
                                <i class="fas fa-bed text-secondary"></i>
                                <small>{{ $listing->bedroom }}</small>
                                
                            </span>
                        </div>
                        <a href="{{ route('seeker.view-property',$listing->id) }}" class="btn btn-primary btn-sm">View More Details</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="container text-center mt-5">
                <h3 class="text-white">--Properties cannot be found-- </h3>
            </div>
             @endforelse
        </div>
    </div>
    
@endsection