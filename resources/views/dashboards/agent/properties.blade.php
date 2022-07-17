@extends('dashboards.agent.layouts.app')
@section('title', 'Agent | Properties')

@section('content')
    @include('dashboards.agent.styles.style')
    <div class="page-title mb-4 mt-n4" style="background-image: url('{{ asset('storage/images/condoImage.jpg')}}'); " data-overlay="5">
        <div class="container">
            <div class="row">
                <div class="col-md-9 text-white">
                    <div class="breadcrumbs" style="margin-bottom: 2rem;">
                        <ol class="breadcrumb-title">
                            <li class="breadcrumb-item">My Properties</li>
                        </ol>
                        <h2 class="breadcrumb-title text-capitalize">
                            All Properties
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary  mt-n4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="{{ route('agent.properties.create') }}" class="text-sm"> <i class="fa fa-plus-circle"></i> Add New Listing</a>
                        </h3>
        
                        <div class="card-tools">
                            <form action="{{ route('agent.properties.index') }}" method="GET">
                            @csrf
                                <div class="input-group is-invalid">
                                    <div class="custom-file">
                                        <input type="text" name="search" class="form-control float-right" value="{{ request()->input('search') }}" placeholder="Search">
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            @if ($listings->count() != 0)
                                <thead>
                                    <tr>
                                        <th>Property</th>
                                        <th></th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            @endif
                            <tbody>
                                @forelse ($listings as $listing)
                                    @if (isset(Auth::user()->id) && Auth::user()->id == $listing->agent_id)
                                        <tr>
                                            <td>
                                                <img class="rounded-lg" src="{{ asset('storage/properties/'. $listing->featured_image) }}" alt="" width="100px" height="100px">
                                            </td>
                                            <td class="font-weight-bold">{{ $listing->title }} <br> 
                                                <small>{{ $listing->street_brgy.', '.$listing->city.', '.$listing->province }}</small><br> 
                                                <strong class="text-danger">&#8369; {{ number_format($listing->price, 2) }}</strong>
                                            </td>
                                            <td>{{ Str::limit($listing->description, 50, '...')  }}</td>
                                           @if ($listing->status === 1)
                                               <td class="text-success">Available</td>
                                            @endif
                                           <td class="text-lg"><a href="#" data-toggle="modal" data-target="#viewProperty{{ $listing->id }}" class="mr-2"><i class="fas fa-eye"></i></a><a href="{{ route('agent.properties.edit', $listing->id) }}" class="text-warning"><i class="fas fa-edit"></i></a></td>
                                        </tr>
                                        <div class="modal fade" id="viewProperty{{ $listing->id }}" tabindex="-1" role="dialog" aria-labelledby="viewPropertyLabel">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="card-title text-uppercase text-success">{{ $listing->title }}</h5>
                                                    </div>
                                                    <div class="modal-body bg-light">
                                                        <div class="row">
                                                            <div class="col-sm-7 p-3">
                                                                <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                                                    <div class="carousel-inner">
                                                                        <div class="carousel-item active">
                                                                            <img class="img-fluid d-block w-100" src="{{ asset('storage/properties/' .$listing->featured_image) }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-5 border-left">
                                                                <p class="text-muted  mt-2"><i class="fas fa-map-marker-alt text-danger"></i>&nbsp;{{ $listing->street_brgy.', '.$listing->city.', '.$listing->province }}
                                                                </p>
                                                                
                                                                <p class="card-text"><h6 class="text-secondary">Descriptions</h6><hr class="mt-n1">{{ $listing->description }}</p>
                                                                <hr>
                                                                <div class="text-muted">
                                                                    <span 
                                                                        class="d-inline-block h5 mr-2" 
                                                                        tabindex="0" 
                                                                        data-bs-toggle="tooltip" 
                                                                        title="Bathroom"> 
                                                                        <i class="fas fa-sink"></i>
                                                                        <small>{{ $listing->bathroom }}</small>
                                                                    </span>
                                                                    <span 
                                                                        class="d-inline-block h5 " 
                                                                        tabindex="0" 
                                                                        data-bs-toggle="tooltip" 
                                                                        title="Bedroom"> 
                                                                        <i class="fas fa-bed"></i>
                                                                        <small>{{ $listing->bedroom }}</small>
                                                                    </span>
                                                                </div>
                                                                <hr>
                                                                <h4 class="text-danger font-weight-bold">&#8369; {{ number_format($listing->price, 2) }}</h4>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('agent.property-add-more-photos', $listing->id) }}" class="btn btn-primary" >More Photos</a>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <div class="container text-center mt-5">
                                        <p class="text-muted text-md"> No Record/s. </p>
                                    </div> 
                                @endforelse
                            </tbody>
                        </table> 
                        {{ $listings->links() }}
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
@endsection  
