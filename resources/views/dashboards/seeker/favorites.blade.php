@extends('dashboards.seeker.layouts.app')
@section('title', 'Seeker | Favorites')

@section('content')
    @include('dashboards.seeker.styles.style')
    @include('dashboards.seeker.layouts.searchbar')
    <div class="container mt-4">
        <div class="container pt-4" id="agents">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @forelse ($favorites as $favorite)
                <div class="card-deck">
                    <div class="card">
                      <h2 class="card-header text-center text-danger text-capitalize">{{ $favorite->property->category.' for '.$favorite->property->type }}</h2>
                      <img class="allprop" src="{{ asset('storage/properties/' .$favorite->property->featured_image) }}" alt="...">
                      <h3 class="card-header text-center text-danger text-capitalize">&#8369; {{ number_format($favorite->property->price,2) }}</h3>
                        <div class="card-body">
                                <h5 class="card-title text-success">{{ $favorite->property->title }}</h5>
                                <p class="card-text text-secondary"><i class="fas fa-map-marker-alt text-danger"></i>&nbsp;{{ $favorite->property->street_brgy.','.$favorite->property->city.','.$favorite->property->province }}</p>
                                      
                                <p class="card-text float-right">
                                    <small class="text-muted">{{ date('Fd\\,Y',strtotime($favorite->property->created_at)) }}</small>
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
                                    <small>{{ $favorite->property->bathroom }}</small>
                                </span>
                                <span 
                                    class="d-inline-block h5 " 
                                    tabindex="0" 
                                    data-bs-toggle="tooltip" 
                                    title="Bedroom"> 
                                    <i class="fas fa-bed text-secondary"></i>
                                    <small>{{ $favorite->property->bedroom }}</small>
                                    
                                </span>
                            </div>
                            <a href="{{ route('seeker.my-favorites-with-remove-btn',$favorite->id) }}" class="btn btn-primary btn-sm">View More Details</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="container text-center">
                    <h3 class="text-secondary">--No favorites added--</h3>
                </div>
            @endforelse
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('removed'))
		<script>
			swal({
				text: "{{ session('removed') }}",
				icon: "error",
			});
		</script>
	@endif
@endsection