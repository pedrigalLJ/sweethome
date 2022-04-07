@extends('dashboards.agent.layouts.app')
@section('title', 'Agent | Documents')

@section('content')
    @include('dashboards.agent.styles.style')
    <div class="page-title mb-4 mt-n4" style="background-image: url('{{ asset('storage/images/condoImage.jpg')}}'); " data-overlay="5">
        <div class="container">
            <div class="row">
                <div class="col-md-9 text-white">
                    <div class="breadcrumbs" style="margin-bottom: 2rem;">
                        <ol class="breadcrumb-title">
                            <li class="breadcrumb-item">Documents</li>
                        </ol>
                        <h2 class="breadcrumb-title text-capitalize">
                            My Documents
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-n4">
                <div class="card card-primary">
                    <div class="card-header card-title h5"><strong>Upload New Document</strong></div>
                    <div class="card-body box-profile">
                        <form 
                            method="POST" 
                            action="{{ route('agent.documents.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                                
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label 
                                        for="title" 
                                        class="col-md-6 col-form-label text-muted">
                                        {{ __('Notes') }}
                                    </label>
                                    <input 
                                        id="notes" 
                                        type="text" 
                                        class="form-control @error('notes') is-invalid @enderror" 
                                        name="notes" 
                                        value="{{ old('notes') }}" 
                                        required
                                        autofocus>
                                    @error('notes')
                                        <span class="invalid-feedback" role="alert">
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
                                        for="file" 
                                        class="col-md-6 col-form-label text-muted">
                                        {{ __('Your File') }}
                                    </label>
                                    <input 
                                        id="file" 
                                        type="file" 
                                        class="form-control @error('file') is-invalid @enderror" 
                                        name="file" 
                                        value="{{ old('file') }}" 
                                        required
                                        autofocus>
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
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
                                        class="btn btn-warning ">
                                        {{ __('Upload') }}
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
