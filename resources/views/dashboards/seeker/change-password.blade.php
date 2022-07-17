@extends('dashboards.seeker.layouts.app')
@section('title', 'Seeker | Change Password')

@section('content')
    @include('dashboards.seeker.styles.style')
    <div class="container">
        <div class="card">
            <h5 class="card-header text-primary">Change Password</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('seeker.update-password') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label 
                                for="current_password" 
                                class="col-md-12 col-form-label text-muted">
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
                        <div class="col-md-12">
                            <label 
                                for="new_password" 
                                class="col-md-12 col-form-label text-muted">
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
                    </div>
                    <div class="form-group-row">
                        <div class="col-md-12">
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
                    <button 
                        type="submit" 
                        class="btn btn-danger mt-2 float-right">
                        {{ __('Save Changes') }}
                    </button>
                </form>
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