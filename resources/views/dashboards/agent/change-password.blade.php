@extends('dashboards.agent.layouts.app')
@section('title', 'Agent | Change Password')

@section('content')
    @include('dashboards.agent.styles.style')
    <div class="page-title mb-4 mt-n4" style="background-image: url('{{ asset('storage/images/condoImage.jpg')}}'); " data-overlay="5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9 text-white">
                    <div class="breadcrumbs" style="margin-bottom: 2rem;">
                        <ol class="breadcrumb-title">
                            <li class="breadcrumb-item">Change Password</li>
                        </ol>
                        <h2 class="breadcrumb-title text-capitalize">
                            Edit Or Change Password
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
                    <div class="card-header card-title h5">
                        <strong>Change My Password</strong>
                    </div>
                    <div class="card-body box-profile">
                        <form method="POST" action="{{ route('agent.update-password') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label 
                                        for="current_password" 
                                        class="col-md-6 col-form-label text-muted">
                                        {{ __('Current Password') }}
                                    </label>
                                    <input 
                                        id="current_password" 
                                        type="password" 
                                        class="form-control @error('current_password') is-invalid @enderror" 
                                        name="current_password" 
                                    >
                                    @error('current_password')
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
                                        for="new_password" 
                                        class="col-md-6 col-form-label text-muted">
                                        {{ __('New Password') }}
                                    </label>
                                    <input 
                                        id="new_password" 
                                        type="password" 
                                        class="form-control  @error('new_password') is-invalid @enderror" 
                                        name="new_password" 
                                    >
                                    @error('new_password')
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
                                        for="confirm_new_password" 
                                        class="col-md-6 col-form-label text-muted">
                                        {{ __('Confirm New Password') }}
                                    </label>
                                    <input 
                                        id="confirm_new_password" 
                                        type="password" 
                                        class="form-control @error('new_password') is-invalid @enderror" 
                                        name="confirm_new_password" 
                                    >
                                    @error('confirm_new_password')
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
                                    <button 
                                        type="submit" 
                                        class="btn btn-warning">
                                        {{ __('Save Changes') }}
                                    </button>
                                </div>
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
    @if (session('message'))
		<script>
			swal({
				text: "{{ session('message') }}",
				icon: "success",
			});
		</script>
	@endif
@endsection