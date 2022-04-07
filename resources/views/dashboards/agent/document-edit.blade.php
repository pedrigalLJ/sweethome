@extends('dashboards.agent.layouts.app')
@section('title', 'Agent | Editing Document')

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
                    <div class="card-header card-title h5"><strong>Updating Document</strong></div>
                    <div class="card-body box-profile">
                        <form 
                            method="POST" 
                            action="{{ route('agent.documents.update', $document->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')  
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
                                        value="{{ $document->notes }}" >
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
                                        {{ __('Your File') }} <br><a data-toggle="modal" data-target="#viewDocument{{ $document->id }}" href="#">{{ $document->file }}</a>
                                    </label>
                                    
                                    <div class="modal fade" id="viewDocument{{ $document->id }}" tabindex="-1" aria-labelledby="viewDocumentLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="viewDocumentLabel">{{ $document->notes }}</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                <iframe src="{{ asset('storage/documents/'. $document->file) }}" width="100%" height="900px"></iframe>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    <input 
                                        id="file" 
                                        type="file" 
                                        class="form-control @error('file') is-invalid @enderror" 
                                        name="file" 
                                        value="{{ $document->file }}">
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
                                        {{ __('Update') }}
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
    @if (session('message'))
		<script>
			swal({
				text: "{{ session('message') }}",
				icon: "success",
			});
		</script>
	@endif
@endsection