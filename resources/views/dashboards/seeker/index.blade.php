@extends('dashboards.seeker.layouts.app')
@section('title', 'Seeker | Dashboard')

@section('content')
    @include('dashboards.seeker.layouts.partial')   
    @include('dashboards.seeker.layouts.searchbar')   
    <div class="container pt-4" id="agents">
        <hr class="bg-primary">
        <h4 class="text-center text-secondary mt-4">{{ __('Latest Listings') }}</h4>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
            @foreach ($listings as $listing)
            <div class="card-deck">
                <div class="card">
                  <img src="{{ asset('storage/properties/'.$listing->featured_image) }}" class="card-img-top allprop" alt="...">
                    <div class="card-body">
                            <h5 class="card-title text-success">{{ $listing->title }}</h5>
                            <p class="card-text">{{ Str::limit($listing->description,150,'...') }}</p>
                            <p class="card-text float-left">
                            <p class="card-text float-right">
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
             @endforeach
        </div>
    </div>
    <div class="container pt-4" id="agents">
        <hr class="bg-primary">
        <h4 class="text-center text-secondary mt-4">{{ __('Agents') }}</h4>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
             @foreach($agents as $agent)
            <div class="col">
                <div class="card" style="width: 20rem;">
                    <img src="{{ asset('storage/images/' .$agent->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-danger">{{ $agent->given_name . ' '. $agent->last_name }}</h5>
                        <p class="card-text">{{ Str::limit($agent->about, 35, '...') }}</p>
                        <a href="{{ route('seeker.agent-profile', $agent->id) }}" class="btn btn-primary">Profile</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

