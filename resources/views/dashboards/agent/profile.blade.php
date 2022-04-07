@extends('dashboards.agent.layouts.app')
@section('title', 'Agent | Profile')

@section('content')
    @include('dashboards.agent.styles.style')
    <div class="page-title mb-4 mt-n4" style="background-image: url('{{ asset('storage/images/condoImage.jpg')}}'); " data-overlay="5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9 text-white">
                    <div class="breadcrumbs" style="margin-bottom: 2rem;">
                        <ol class="breadcrumb-title">
                            <li class="breadcrumb-item">Profile</li>
                        </ol>
                        <h2 class="breadcrumb-title text-capitalize">
                            Account & Profile
                        </h2>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary mt-n4">
                    <div class="card-header card-title"><strong>My Account</strong>
                        
                    </div>
                    <div class="card-body box-profile">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ asset('storage/images/'. Auth::user()->image) }}" class="elevation-2" alt="User Image" width="450" height="360">
                            </div>
                            <div class="col-md-6">
                                <img id="preview_img" class="elevation-2 img-fluid" width="500" height="400" src="{{ asset('storage/images/noImage.png') }}">
                            </div>
                        </div>
                        <form 
                            method="POST" 
                            action="{{ route('agent.update-profile') }}"
                            enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label 
                                            for="image" 
                                            class="col-md-6 col-form-label text-muted">
                                            {{ __('Profile Image') }}
                                        </label>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input 
                                                    type="file" 
                                                    class="custom-file-input" 
                                                    id="image" 
                                                    name="image"
                                                    onchange="loadPreview(this);" 
                                                >
                                                <label class="custom-file-label" for="image" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label 
                                        for="given_name" 
                                        class="col-md-6 col-form-label">
                                        {{ __('Given Name') }}
                                    </label>
                                    <input 
                                        id="name" 
                                        type="text" 
                                        class="form-control @error('given_name') is-invalid @enderror" 
                                        name="given_name" 
                                        value="{{ Auth::user()->given_name }}" 
                                        autocomplete="given_name" 
                                        autofocus>
                                    @error('given_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label 
                                        for="last_name" 
                                        class="col-md-6 col-form-label">
                                        {{ __('Last Name') }}
                                    </label>
                                    <input 
                                        id="last_name" 
                                        type="text" 
                                        class="form-control @error('last_name') is-invalid @enderror" 
                                        name="last_name" 
                                        value="{{ Auth::user()->last_name }}" 
                                        required 
                                        autocomplete="last_name" 
                                        autofocus>
                                    @error('last_name')
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
                                        for="city" 
                                        class="col-md-6 col-form-label">
                                        {{ __('City') }}
                                    </label>
                                    <input 
                                        id="city" 
                                        type="text" 
                                        class="form-control @error('city') is-invalid @enderror" 
                                        name="city" 
                                        value="{{ Auth::user()->city }}" 
                                        required 
                                        autocomplete="city">
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
                                <div class="col-md-6">
                                    <label 
                                        for="province" 
                                        class="col-md-6 col-form-label">
                                        {{ __('Province') }}
                                    </label>
                                    <input 
                                        id="province" 
                                        type="text" 
                                        class="form-control @error('province') is-invalid @enderror" 
                                        name="province" 
                                        value="{{ Auth::user()->province }}" 
                                        required 
                                        autocomplete="province">
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
                                        for="email" 
                                        class="col-md-6 col-form-label">
                                        {{ __('Email') }}
                                    </label>
                                    <input 
                                        id="email" 
                                        type="email" 
                                        class="form-control @error('email') is-invalid @enderror" 
                                        name="email" 
                                        value="{{ Auth::user()->email }}" >
                                    @error('email')
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
                                        for="phone_no" 
                                        class="col-md-6 col-form-label">
                                        {{ __('Phone Number') }}
                                    </label>
                                    <input 
                                        id="phone_no" 
                                        type="text" 
                                        class="form-control @error('phone_no') is-invalid @enderror" 
                                        name="phone_no" 
                                        value="{{ Auth::user()->phone_no }}">
                                    @error('phone_no')
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
                                        for="username" 
                                        class="col-md-6 col-form-label">
                                        {{ __('Username') }}
                                    </label>
                                    <input 
                                        id="username" 
                                        type="text" 
                                        class="form-control @error('username') is-invalid @enderror" 
                                        name="username" 
                                        value="{{ Auth::user()->username }}" 
                                        required 
                                        autocomplete="username">
                                    @error('username')
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
                                        for="about" 
                                        class="col-md-6 col-form-label">
                                        {{ __('About') }}
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('about') is-invalid @enderror" 
                                        name="about" 
                                        value="{{ Auth::user()->about }}">
                                        
                                    @error('about')
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
                            <p class="col-md-left text-danger">
                                Additional Information:
                            </p>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label 
                                        for="birthdate" 
                                        class="col-md-6 col-form-label">
                                        {{ __('Birthdate') }}
                                    </label>
                                    <input 
                                        id="birthdate" 
                                        type="date" 
                                        class="form-control @error('birthdate') is-invalid @enderror" 
                                        name="birthdate" 
                                        value="{{ Auth::user()->agent_verification->birthdate }}" 
                                        autocomplete="birthdate" 
                                        autofocus
                                        readonly>
                                    @error('birthdate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label 
                                        for="license_no" 
                                        class="col-md-6 col-form-label">
                                        {{ __('License No') }}
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('license_no') is-invalid @enderror" 
                                        name="license_no" 
                                        value="{{ Auth::user()->agent_verification->license_no }}"
                                        readonly >
                                    @error('license_no')
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
                                <div class="col-sm-6">
                                    {{ Auth::user()->id_picture }}
                                    <img src="{{ asset('storage/agent-id-pictures/'. Auth::user()->agent_verification->id_picture) }}" class="elevation-2" alt="User Image" width="500" height="400">
                                </div>
                               
                            </div>
                            <div class="float-right">
                                <button 
                                    type="submit" 
                                    class="btn btn-warning">
                                    {{ __('Save Changes') }}
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
                            .width(500)
                            .height(400);
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
    </script>
@endif
@endsection