@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <img src="storage/images/sweethomeLogo.png" class="imagelogo" width="300px;" alt="" />
                <h1 class="text-capitalize">S w e e t h o m e</h1>
            </div>
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        {{ __('Register') }}
                    </div>
                    <div class="card-body">
                        <form 
                            method="POST" 
                            action="{{ route('register') }}"
                            enctype="multipart/form-data">
                                @csrf
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
                                            value="{{ old('given_name') }}" 
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
                                            class="col-md-6 col-form-label">
                                            {{ __('Last Name') }}
                                        </label>
                                        <input 
                                            id="last_name" 
                                            type="text" 
                                            class="form-control @error('last_name') is-invalid @enderror" 
                                            name="last_name" 
                                            value="{{ old('last_name') }}" 
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
                                            value="{{ old('city') }}" 
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
                                            value="{{ old('province') }}" 
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
                                            value="{{ old('email') }}" 
                                            required 
                                            autocomplete="email">
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
                                            type="phone_no" 
                                            class="form-control @error('phone_no') is-invalid @enderror" 
                                            name="phone_no" 
                                            value="{{ old('phone_no') }}" 
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
                                    <div class="col-md-6">
                                        <label 
                                            for="username" 
                                            class="col-md-6 col-form-label">
                                            {{ __('Username') }}
                                        </label>
                                        <input 
                                            id="username" 
                                            type="username" 
                                            class="form-control @error('username') is-invalid @enderror" 
                                            name="username" 
                                            value="{{ old('username') }}" 
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
                                    <div class="col-md-6">
                                        <label 
                                            for="password" 
                                            class="col-md-6 col-form-label">
                                            {{ __('Password') }}
                                        </label>
                                        <input 
                                            id="password" 
                                            type="password" 
                                            class="form-control @error('password') is-invalid @enderror" 
                                            name="password" 
                                            required 
                                            autocomplete="new-password">
                                        @error('password')
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
                                            for="password-confirm" 
                                            class="col-md-6 col-form-label">
                                            {{ __('Confirm Password') }}
                                        </label>
                                        <input 
                                            id="password-confirm" 
                                            type="password" 
                                            class="form-control" 
                                            name="password_confirmation" 
                                            required 
                                            autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6 col-form-label">
                                        <input 
                                            type="checkbox" 
                                            name="agent" 
                                            class="filled-in" 
                                            id="isChecked"/>
                                        <span class="text-danger">
                                            {{ __('Register as Agent') }}
                                        </span>
                                    </label>
                                </div>
                                <div id="appear">
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
                                            value="{{ old('birthdate') }}" 
                                            autocomplete="birthdate" 
                                            autofocus>
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
                                            value="{{ old('license_no') }}" >
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
                                        <div class="col-md-12">
                                            <label 
                                                for="id_picture" 
                                                class="col-md-6 col-form-label">
                                                {{ __('Photo ID Upload') }}
                                            </label>
                                            <input 
                                                type="file" 
                                                class="form-control @error('id_picture') is-invalid @enderror" 
                                                name="id_picture" >
                                            @error('id_picture')
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
                                </div> 
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-5">
                                        <button 
                                            type="submit" 
                                            class="btn btn-primary">
                                            {{ __('Register') }}
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



