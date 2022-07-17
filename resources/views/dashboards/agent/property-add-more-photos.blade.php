@extends('dashboards.agent.layouts.app')
@section('title', 'Agent | More Photos')

@section('content')
    @include('dashboards.agent.styles.style')
    <style>
        .images-preview-div img
        {
            padding: 10px;
            height: 200px;
            width: 200px;
        }
        img[alt]
        {
            color: red;
        }
    </style>
    <div class="page-title mb-4 mt-n4" style="background-image: url('{{ asset('storage/images/condoImage.jpg')}}'); " data-overlay="5">
        <div class="container">
            <div class="row">
                <div class="col-md-9 text-white">
                    <div class="breadcrumbs" style="margin-bottom: 2rem;">
                        <ol class="breadcrumb-title">
                            <li class="breadcrumb-item">Property</li>
                        </ol>
                        <h2 class="breadcrumb-title text-capitalize">
                           Images
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            {{-- @include('dashboards.errors') --}}
            <div class="col-md-12 mt-n4">
                <div class="card card-primary">
                    <div class="card-header">
                        <strong class="h5">{{ $listing->title }}</strong>
                        <a href="#" class="float-right text-light" data-toggle="modal" data-target="#addMorePhotos"><i class="fas fa-plus-circle"></i> Add More Photos</a>
                    </div>
                    <div class="modal fade" id="addMorePhotos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p class="modal-title text-primary" id="exampleModalLongTitle">Add More Photos</p>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('agent.property-store-photos') }}" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="modal-body">
                                        <div >
                                            <input name="property_id" value="{{ $listing->id }}" hidden>
                                            <input type="file" accept="image/*" id="images" onchange="validateFileType()"  name="photos[]" multiple required>
                                           
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mt-1">
                                                <div class="images-preview-div"> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary" value="reset">Reset</button>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body box-profile">
                        <div class="container-fluid">
                            @forelse($images as $image)
                                @foreach (json_decode($image->url) as $picture)
                                    <img class="img-fluid shadow-lg mr-3 hover-photo" src="{{ asset('storage/properties/'.$picture) }}" style="height:200px; width:200px"/>
                                @endforeach
                                        
                            @empty
                                <div class="container text-center mt-5">
                                    <p class="text-muted text-md"> Nothing to show. </p>
                                </div> 
                            @endforelse
                        </div>
                    </div>
                </div>
        </div>
    </div>
    
@endsection
@section('javascripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        
        $(function() {
        // Multiple images preview with JavaScript
            var previewImages = function(input, imgPreviewPlaceholder) 
            {
                if (input.files) 
                {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) 
                    {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('alt', 'Unsupported format. JPG, JPEG, PNG are allowed.').attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#images').on('change', function() {
                previewImages(this, 'div.images-preview-div');
            });
        });
    </script>
    @if (session('message'))
        <script>
            swal({
                text: "{{ session('message') }}",
                icon: "success",
            });
        </script>
    @endif
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            swal({
                text: "{{ $error }}",
                icon: "error",
            });
        </script>
        @endforeach
    @endif
@endsection