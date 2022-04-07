@extends('dashboards.agent.layouts.app')
@section('title', 'Agent | New Listing')

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
                             New Listing
                        </h2>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger mb-5 ml-5 mr-5" role="alert">{{$error}}</div>
                    @endforeach
                @endif
                <div class="card card-primary mt-n4">
                    <div class="card-header card-title h5"><strong>Add New Listing</strong></div>
                    <div class="card-body box-profile">
                        
                        <form 
                            method="POST" 
                            action="{{ route('agent.properties.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                                
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
                                        placeholder="Relaxing Apartment"
                                        value="{{ old('title') }}" 
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
                                                required
                                                name="featured_image"
                                            >
                                            <label class="custom-file-label" for="featured_image" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                            @error('title')
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
                                        <option value="apartment">Apartment</option>
                                        <option value="condo">Condo</option>
                                        <option value="house">House</option>
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
                                        <option value="rent">Rent</option>
                                        <option value="sale">Sale</option>
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
                                        value="{{ old('bathroom') }}" 
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
                                        value="{{ old('bedroom') }}" 
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
                                        type="number" 
                                        class="form-control @error('price') is-invalid @enderror" 
                                        name="price" 
                                        placeholder="Php"
                                        value="{{ old('price') }}" 
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
                                        class="col-md-6 col-form-label text-muted">
                                        {{ __('Stree/Brgy') }}
                                    </label>
                                    <input 
                                        id="street_brgy" 
                                        type="text" 
                                        class="form-control @error('street_brgy') is-invalid @enderror" 
                                        name="street_brgy" 
                                        placeholder="Brgy Pinayagan"
                                        value="{{ old('street_brgy') }}" 
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
                                        class="col-md-6 col-form-label text-muted">
                                        {{ __('City') }}
                                    </label>
                                    <input 
                                        id="city" 
                                        type="text" 
                                        class="form-control @error('city') is-invalid @enderror" 
                                        name="city" 
                                        placeholder="Tubigon"
                                        value="{{ old('city') }}" 
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
                                        class="col-md-6 col-form-label text-muted">
                                        {{ __('Province') }}
                                    </label>
                                    <input 
                                        id="province" 
                                        type="text" 
                                        class="form-control @error('province') is-invalid @enderror" 
                                        name="province" 
                                        placeholder="Bohol"
                                        value="{{ old('province') }}" 
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
                                        class="form-control" 
                                        name="description" 
                                        value="{{ old('description') }}"
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
                                <div class="col-md-6">
                                    <label 
                                    for="avail_days" 
                                    class="col-md-12 col-form-label text-muted">
                                    {{ __('Available Days For Property On Site Viewing') }}
                                    </label><br>
                                    <label class="text-sm"><input type="checkbox" name="avail_days[]" value="Sunday"/> Sunday</label>
                                    <label class="text-sm"><input type="checkbox" name="avail_days[]" value="Monday"/> Monday</label>
                                    <label class="text-sm"><input type="checkbox"  name="avail_days[]" value="Tuesday"/> Tuesday</label>
                                    <label class="text-sm"><input type="checkbox" name="avail_days[]" value="Wednesday"/> Wednesday</label>
                                    <label class="text-sm"><input type="checkbox" name="avail_days[]" value="Thursday"/> Thursday</label>
                                    <label class="text-sm"><input type="checkbox" name="avail_days[]" value="Friday"/> Friday</label>
                                    <label class="text-sm"><input type="checkbox" name="avail_days[]" value="Saturday"/> Saturday</label>
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
                                    {{ __('Add Listing') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
