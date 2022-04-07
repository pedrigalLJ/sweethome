@if (session('message'))
    <div class="alert alert-success mb-5 ml-5 mr-5" role="alert">
        <i class="fas fa-check"></i> {{ session('message') }}
    </div>
@endif