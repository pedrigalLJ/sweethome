@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger mb-5 ml-5 mr-5" role="alert"><i class="fas fa-times-circle"></i>&nbsp;{{$error}}</div>
    @endforeach
@endif