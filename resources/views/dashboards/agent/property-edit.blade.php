@extends('dashboards.agent.layouts.app')
@section('title', 'Agent | Edit Listing')

@section('content')
    @include('dashboards.agent.styles.style')
    <div class="page-title mb-4 mt-n4" style="background-image: url('{{ asset('storage/images/condoImage.jpg')}}'); " data-overlay="5">
        <div class="container">
            <div class="row">
                <div class="col-md-9 text-white">
                    <div class="breadcrumbs" style="margin-bottom: 2rem;">
                        <ol class="breadcrumb-title">
                            <li class="breadcrumb-item">Properties</li>
                        </ol>
                        <h2 class="breadcrumb-title text-capitalize">
                            Edit Listing
                        </h2>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-md-12">
            {{-- @include('dashboards.agent.errors') --}}
            <div class="card card-primary mt-n4">
                <div class="card-header card-title h5"><strong>Edit Listing</strong></div>
                <div class="card-body box-profile">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="img-fluid mx-auto d-block" src="{{ asset('/storage/properties/' .$listings->featured_image) }}" alt="First slide">
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
                            <div class="col-md-6">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img id="preview_img" class="img-fluid mx-auto d-block" src="{{ asset('storage/images/noImage.png')}}" width="60%">
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
                        </div>
                    </div>
                    <form 
                        action="{{ route('agent.properties.update', $listings->id) }}"
                        method="POST" 
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')   
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label 
                                    for="title" 
                                    class="col-md-6 col-form-label text-muted">
                                    {{ __('Title') }}
                                </label>
                                <input 
                                    id="title" 
                                    type="text" 
                                    class="form-control @error('title') is-invalid @enderror" 
                                    name="title" 
                                    value="{{ $listings->title }}" 
                                    required
                                    autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label 
                                    for="featured_image" 
                                    class="col-md-6 col-form-label text-muted">
                                    {{ __('Featured Image') }}
                                </label>
                                <div class="input-group"> 
                                    <div class="custom-file">
                                        <input 
                                            type="file" 
                                            class="custom-file-input" 
                                            id="featured_image" 
                                            name="featured_image"
                                            onchange="loadPreview(this);"
                                        >
                                        <label class="custom-file-label" for="featured_image" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                        @error('featured_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label 
                                    for="category" 
                                    class="col-md-6 col-form-label text-muted">
                                    {{ __('Category') }}
                                </label>
                                <select name="category" class="browser-default custom-select" required>
                                    <option value="" disabled selected>Select...</option>
                                    <option value="apartment" {{ $listings->category == 'apartment' ? 'selected' : '' }}>Apartment</option>
                                    <option value="condo" {{ $listings->category == 'condo' ? 'selected' : '' }}>Condo</option>
                                    <option value="house" {{ $listings->category == 'house' ? 'selected' : '' }}>House</option>
                                </select>
                                @error('category')
                                    <span 
                                        class="invalid-feedback" 
                                        role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label 
                                    for="type" 
                                    class="col-md-6 col-form-label text-muted">
                                    {{ __('Type') }}
                                </label>
                                <select name="type" class="browser-default custom-select" required>
                                    <option value="" disabled selected>Select...</option>
                                    <option value="rent" {{ $listings->type == 'rent' ? 'selected' : '' }}>Rent</option>
                                    <option value="sale" {{ $listings->type == 'sale' ? 'selected' : '' }}>Sale</option>
                                </select>
                                @error('type')
                                    <span 
                                        class="invalid-feedback" 
                                        role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label 
                                    for="bathroom" 
                                    class="col-md-6 col-form-label text-muted">
                                    {{ __('Bathroom') }}
                                </label>
                                <input 
                                    id="bathroom" 
                                    type="number" 
                                    class="form-control @error('bathroom') is-invalid @enderror" 
                                    name="bathroom" 
                                    value="{{ $listings->bathroom }}" 
                                    required>
                                @error('bathroom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label 
                                    for="bedroom" 
                                    class="col-md-6 col-form-label text-muted">
                                    {{ __('Bedroom') }}
                                </label>
                                <input 
                                    id="bedroom" 
                                    type="number" 
                                    class="form-control @error('bedroom') is-invalid @enderror" 
                                    name="bedroom" 
                                    value="{{ $listings->bedroom }}" 
                                    required
                                >
                            </div>
                            <div class="col-md-4">
                                <label 
                                    for="price" 
                                    class="col-md-6 col-form-label text-muted">
                                    {{ __('Price') }}
                                </label>
                                <input 
                                    id="price" 
                                    type="text" 
                                    class="form-control @error('price') is-invalid @enderror" 
                                    name="price" 
                                    value="{{ $listings->price }}" 
                                    required
                                >
                                @error('price')
                                    <span 
                                        class="invalid-feedback" 
                                        role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label 
                                    for="street_brgy" 
                                    class="col-md-4 col-form-label text-muted">
                                    {{ __('ST/Brgy') }}
                                </label>
                                <input 
                                    id="street_brgy" 
                                    type="text" 
                                    class="form-control @error('street_brgy') is-invalid @enderror" 
                                    name="street_brgy" 
                                    value="{{ $listings->street_brgy }}" 
                                    required
                                >
                                @error('street_brgy')
                                    <span 
                                        class="invalid-feedback" 
                                        role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label 
                                    for="city" 
                                    class="col-md-4 col-form-label text-muted">
                                    {{ __('City') }}
                                </label>
                                <input 
                                    id="city" 
                                    type="text" 
                                    class="form-control @error('city') is-invalid @enderror" 
                                    name="city" 
                                    value="{{ $listings->city }}" 
                                    required
                                >
                                @error('city')
                                    <span 
                                        class="invalid-feedback" 
                                        role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label 
                                    for="province" 
                                    class="col-md-4 col-form-label text-muted">
                                    {{ __('Province') }}
                                </label>
                                <input 
                                    id="province" 
                                    type="text" 
                                    class="form-control @error('province') is-invalid @enderror" 
                                    name="province" 
                                    value="{{ $listings->province }}" 
                                    required
                                >
                                @error('province')
                                    <span 
                                        class="invalid-feedback" 
                                        role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label 
                                    for="description" 
                                    class="col-md-6 col-form-label text-muted">
                                    {{ __('Other Descriptions') }}
                                </label>
                                <input 
                                    class="form-control" 
                                    id="description" 
                                    type="text" 
                                    name="description"
                                    class="form-control" 
                                    value="{{ $listings->description }}"
                                    required
                                    >
                                @error('description')
                                    <span 
                                        class="invalid-feedback" 
                                        role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            
                            <div class="col-md-12">
                                <label 
                                    for="status" 
                                    class="col-md-12 col-form-label text-muted">
                                    {{ __('Status') }}
                                </label>
                                <select name="status" class="browser-default custom-select" required>
                                    <option value="" disabled selected>Select...</option>
                                    <option value="1" {{ $listings->status == '1' ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ $listings->status == '0' ? 'selected' : '' }}>Not Available</option>
                                    @if ($listings->type == 'sale')
                                        <option value="2" {{ $listings->status == '2' ? 'selected' : '' }}>Sold</option>
                                    @endif
                                    @if ($listings->status == 'rent') 
                                        <option value="3" {{ $listings->status == '3' ? 'selected' : '' }}>Rented</option>
                                    @endif
                                </select>
                                @error('status')
                                    <span 
                                        class="invalid-feedback" 
                                        role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label 
                                for="avail_days" 
                                class="col-md-12 col-form-label text-muted">
                                Available Days For Property On Site Viewing
                                <p class="text-sm font-weight-normal text-capitalize">Currently: 
                                    @foreach(json_decode($listings->avail_days) as $days)
                                        <span class="bg-danger h6">&nbsp;{{ $days }}&nbsp;</span>
                                    @endforeach    
                                </p>
                                </label>
                                <label class="text-sm"><input type="checkbox" class="days" name="avail_days[]" value="Sunday"/> Sunday</label>
                                <label class="text-sm"><input type="checkbox" class="days" name="avail_days[]" value="Monday"/> Monday</label>
                                <label class="text-sm"><input type="checkbox" class="days" name="avail_days[]" value="Tuesday"/> Tuesday</label>
                                <label class="text-sm"><input type="checkbox" class="days" name="avail_days[]" value="Wednesday"/> Wednesday</label>
                                <label class="text-sm"><input type="checkbox" class="days" name="avail_days[]" value="Thursday"/> Thursday</label>
                                <label class="text-sm"><input type="checkbox" class="days" name="avail_days[]" value="Friday"/> Friday</label>
                                <label class="text-sm"><input type="checkbox" class="days" name="avail_days[]" value="Saturday"/> Saturday</label>
                                @error('avail_days')
                                    <span 
                                        class="invalid-feedback" 
                                        role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label 
                                for="avail_times" 
                                class="col-md-12 col-form-label text-muted">
                                {{ __('Available Time/s For Property On Site Viewing') }}
                                <p class="text-sm font-weight-normal text-capitalize">Currently: 
                                    @foreach(json_decode($listings->avail_times) as $times)
                                        <span class="bg-danger h6">&nbsp;{{ $times }}&nbsp;</span>
                                    @endforeach    
                                </p>
                                </label><br>
                                <label class="text-sm"><input type="checkbox" name="avail_times[]" value="08:00"/> 08:00</label>
                                <label class="text-sm"><input type="checkbox" name="avail_times[]" value="08:30"/> 08:30</label>
                                <label class="text-sm"><input type="checkbox"  name="avail_times[]" value="09:00"/> 09:00</label>
                                <label class="text-sm"><input type="checkbox" name="avail_times[]" value="09:30"/> 09:30</label>
                                <label class="text-sm"><input type="checkbox" name="avail_times[]" value="10:00"/> 10:00</label>
                                <label class="text-sm"><input type="checkbox" name="avail_times[]" value="10:30"/> 10:30</label>
                                <label class="text-sm"><input type="checkbox" name="avail_times[]" value="11:00"/> 11:00</label>
                                <label class="text-sm"><input type="checkbox" name="avail_times[]" value="11:30"/> 11:30</label>
                                <label class="text-sm"><input type="checkbox" name="avail_times[]" value="13:00"/> 13:00</label>
                                <label class="text-sm"><input type="checkbox" name="avail_times[]" value="13:30"/> 13:30</label>
                                <label class="text-sm"><input type="checkbox" name="avail_times[]" value="14:00"/> 14:00</label>
                                <label class="text-sm"><input type="checkbox" name="avail_times[]" value="14:30"/> 14:30</label>
                                <label class="text-sm"><input type="checkbox" name="avail_times[]" value="15:00"/> 15:00</label>
                                <label class="text-sm"><input type="checkbox" name="avail_times[]" value="15:30"/> 15:30</label>
                                <label class="text-sm"><input type="checkbox" name="avail_times[]" value="16:00"/> 16:00</label>
                                <label class="text-sm"><input type="checkbox" name="avail_times[]" value="16:30"/> 16:30</label>
                                @error('avail_times')
                                    <span 
                                        class="invalid-feedback" 
                                        role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="float-right">
                            <button 
                                type="submit" 
                                class="btn btn-warning">
                                {{ __('Update Listing') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    </div>
@endsection
@section('javascripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        function loadPreview(input, id) 
        {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();
        
                reader.onload = function (e) {
                    $(id)
                            .attr('src', e.target.result)
                            .width(518)
                            .height(auto);
                };
        
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    @if (session('message'))
    <script>
        swal({
            text: "{{ session('message') }}",
            icon: "success",
        });
        swal({
            text: "{{ session('message') }}",
            icon: "error",
        });
    </script>
    @endif
@endsection