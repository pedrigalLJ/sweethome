@extends('dashboards.seeker.layouts.app')
@section('title', 'Seeker | Profile')

@section('content')
    @include('dashboards.seeker.styles.style')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-primary">My Account</h5>
                <div class="row">
                    <div class="col-sm-4 p-3">
                        <img class="img-fluid mx-auto d-block rounded-circle profileUpdate" src="{{ asset('/storage/images/'.Auth::user()->image) }}" alt="First slide">
                        <p>
                            <h4 class="text-center">{{ Auth::user()->given_name.' '.Auth::user()->last_name }}</h4>
                            <h5 class="text-center text-muted">{{ Auth::user()->username }}</h5>
                            <hr>
                            <h6 class="text-secondary text-capitalize"><i class="fas fa-map-marker-alt text-danger"></i>&nbsp;{{ Auth::user()->city.', '.Auth::user()->province }}</h6>
                            <h6 class="text-secondary"><i class="fas fa-mobile-alt text-danger"></i>&nbsp;{{ Auth::user()->phone_no }}</h6>
                            <h6 class="text-secondary"><i class="fas fa-at text-danger"></i>&nbsp;{{ Auth::user()->email }}</h6>
                            <hr>
                            <h5 class="text-secondary">About</h5>
                            <p class="text-justify text-secondary">
                                {{ Auth::user()->about }}
                            </p>
                        </p>
                    </div>
                    <div class="col-sm-8 border-left">
                        <form 
                        method="POST" 
                        action="{{ route('seeker.update-profile') }}"
                        enctype="multipart/form-data">
                        @csrf
                            
                        <div class="form-group row">
                            <img  id="preview_img" class="float-left prev_img rounded-circle" width="100px" height="100px" src="{{ asset('storage/images/noImage.png') }}">
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
                                    class="col-md-6 col-form-label text-muted">
                                    {{ __('Given Name') }}
                                </label>
                                <input 
                                    id="name" 
                                    type="text" 
                                    class="form-control @error('given_name') is-invalid @enderror" 
                                    name="given_name" 
                                    value="{{ Auth::user()->given_name }}" 
                                    required 
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
                                    class="col-md-6 col-form-label text-muted">
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
                            <div class="col-md-12">
                                <label 
                                    for="email" 
                                    class="col-md-6 col-form-label text-muted">
                                    {{ __('Email') }}
                                </label>
                                <input 
                                    id="email" 
                                    type="text" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    name="email" 
                                    value="{{ Auth::user()->email }}" >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
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
                                    for="username" 
                                    class="col-md-6 col-form-label text-muted">
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
                            <div class="col-md-6">
                                <label 
                                    for="phone_no" 
                                    class="col-md-6 col-form-label text-muted">
                                    {{ __('Phone Number') }}
                                </label>
                                <input 
                                    id="phone_no" 
                                    type="text" 
                                    class="form-control @error('phone_no') is-invalid @enderror" 
                                    name="phone_no" 
                                    value="{{ Auth::user()->phone_no }}" 
                                    required 
                                    autocomplete="phone_no">
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
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
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
                                    value="{{ Auth::user()->city }}" 
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
                            <div class="col-md-6">
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
                                    value="{{ Auth::user()->province }}" 
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
                                    for="about" 
                                    class="col-md-6 col-form-label text-muted">
                                    {{ __('About') }}
                                </label>
                                <input 
                                    class="form-control" 
                                    id="about" 
                                    type="text" 
                                    class="form-control" 
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
                           
                        <button 
                            type="submit" 
                            class="btn btn-danger float-right">
                            {{ __('Save Changes') }}
                        </button>
                           
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
                            .width(100)
                            .height(100);
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