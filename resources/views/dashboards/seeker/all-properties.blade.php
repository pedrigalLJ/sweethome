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
    <div class="container pt-4" id="agents">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse ($listings as $listing)
            @if ($listing->user->free_trial_days_left > 0)
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
            @endif
            @empty
            <div class="container text-center mt-5">
                <h3 class="text-muted">--Properties cannot be found-- </h3>
            </div>
             @endforelse
        </div>
    </div>
    
@endsection