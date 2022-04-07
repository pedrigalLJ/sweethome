@extends('dashboards.seeker.layouts.app')
@section('title', 'Seeker | About Us')

@section('content')
    <div class="container">
        <h1 class="text-center"><span class="text-danger">O</span>ur <span class="text-danger">T</span>eam</h1><hr>
        <h5 class="text-center">Bachelor of Science in Information Technology</h5>
        <div class="card-deck">
            <div class="card">
            <img src="{{ asset('storage/images/cha.png') }}" class="card-img-top" height="260px;" alt="...">
            <div class="card-body">
                <h5 class="text-center text-danger">Charina R. Dejos</h5><hr>
                <p class="card-text mt-n3 text-secondary text-center">Project Manager/Hustler</p>
            </div>
            <div class="card-footer">
                <a href="https://www.facebook.com/charina.dejos.9/" target="_blank">
                    <i class="fab fa-facebook-square text-primary"></i> <small>Facebook</small>
                </a>
                <a href="https://www.youtube.com/channel/UCjOn6Og_9aL7wyA_43gETJg" target="_blank">
                    <i class="fab fa-youtube text-danger"></i> <small>Youtube</small>
                </a>
            </div>
            </div>
            <div class="card">
            <img src="{{ asset('storage/images/khaye.png') }}" class="card-img-top" height="260px;" alt="...">
            <div class="card-body">
                <h5 class="text-center text-danger">Verjyll Khaye B. Magbago</h5><hr>
                <p class="card-text mt-n3 text-secondary text-center">UI Designer/Hipster</p>
            </div>
            <div class="card-footer">
                <a href="https://www.facebook.com/verjyllkhaye.bargamentomagbago.5" target="_blank">
                <i class="fab fa-facebook-square text-primary"></i> <small>Facebook</small>
                </a>
                <a href="https://www.youtube.com/channel/UCjOn6Og_9aL7wyA_43gETJg" target="_blank">
                <i class="fab fa-youtube text-danger"></i> <small>Youtube</small>
                </a>
            </div>
            </div>
            <div class="card">
                <img src="{{ asset('storage/images/lara.jpg') }}" class="card-img-top" height="260px;" alt="...">
                <div class="card-body">
                    <h5 class="text-center text-danger">Lara Jane R. Pedrigal</h5><hr>
                    <p class="card-text mt-n3 text-secondary text-center">Programmer/Hacker</p>
                </div>
                <div class="card-footer">
                    <a href="https://www.facebook.com/pedrigalLara" target="_blank">
                    <i class="fab fa-facebook-square text-primary"></i> <small>Facebook</small>
                    </a>
                    <a href="https://www.youtube.com/channel/UCjOn6Og_9aL7wyA_43gETJg" target="_blank">
                    <i class="fab fa-youtube text-danger"></i> <small>Youtube</small>
                    </a>
                </div>
            </div>
            <div class="card">
            <img src="{{ asset('storage/images/abe.png') }}" class="card-img-top" height="260px;"  alt="...">
            <div class="card-body">
                <h5 class="text-center text-danger">Abegail S. Romano</h5><hr>
                <p class="card-text mt-n3 text-secondary text-center">Programmer/Hacker</p>
            </div>
            <div class="card-footer">
                <a href="https://www.facebook.com/AbbyAbiAbe" target="_blank">
                <i class="fab fa-facebook-square text-primary"></i> <small>Facebook</small>
                </a>
                <a href="https://www.youtube.com/channel/UCjOn6Og_9aL7wyA_43gETJg" target="_blank">
                <i class="fab fa-youtube text-danger"></i> <small>Youtube</small>
                </a>
            </div>
            </div>
        </div>
        
    </div>
    
    <div class="container">
        <br><hr>
        <div class="card text-white">
            <img src="{{ asset('storage/images/us.jpg') }}" class="card-img" alt="...">
            <div class="card-img-overlay">
                <p class="card-title h1"><span class="text-danger">VCAL</span> Developers <br>
                    <small>making</small> <span class="text-danger">IT</span> <small>happen</small>
                </p><br><br>
                <h3></h3>
            </div>
        </div>
    </div>
@endsection