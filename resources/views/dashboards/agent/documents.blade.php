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
            <div class="col-md-12">
                <div class="card card-primary mt-n4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="{{ route('agent.documents.create') }}" class="text-sm"> <i class="fas fa-file-upload"></i> Upload New Document</a>
                        </h3>
                        <div class="card-tools">
                            {{-- <div class="input-group input-group-sm"> --}}
                               <form action="{{ route('agent.documents.index') }}" method="GET">
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
                            {{-- </div> --}}
                        </div>
                    </div>
                   
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-center">
                            @if ($documents->count() != 0)
                                <thead>
                                    <tr>
                                        <th>Notes</th>
                                        <th>File</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                            @endif
                            <tbody>
                                @forelse ($documents as $document )
                                    <tr>
                                        <td>{{ $document->notes }}</td>
                                        <td><a data-toggle="modal" data-target="#viewDocument{{ $document->id }}" href="#">{{ $document->file }}</a></td>
                                        <td><a href="{{ route('agent.documents.download', $document->file) }}" class="btn btn-success"><i class="fas fa-file-download"></i> <small>Download</small></a>
                                            <a href="{{ route('agent.documents.edit', $document->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> <small>Edit</small></a>
                                        </td>
                                    </tr>
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
                                @empty
                                    <div class="container text-center mt-5">
                                        <p class="text-muted text-md"> No Record/s. </p>
                                    </div> 
                                @endforelse
                            </tbody>
                        </table>
                        {{ $documents->links() }}
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