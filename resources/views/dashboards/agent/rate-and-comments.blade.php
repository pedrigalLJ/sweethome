@extends('dashboards.agent.layouts.app')
@section('title', 'Agent | Rate & Comments')

@section('content')
    @include('dashboards.agent.styles.style')
    <div class="page-title mb-4 mt-n4" style="background-image: url('{{ asset('storage/images/condoImage.jpg')}}'); " data-overlay="5">
        <div class="container">
            <div class="row">
                <div class="col-md-9 text-white">
                    <div class="breadcrumbs" style="margin-bottom: 2rem;">
                        <ol class="breadcrumb-title">
                            <li class="breadcrumb-item">R & C</li>
                        </ol>
                        <h2 class="breadcrumb-title text-capitalize">
                            Rates & Comments
                        </h2>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (session('message'))
                    <div class="alert alert-success mb-5 ml-5 mr-5" role="alert">
                        <i class="fas fa-check"></i> {{ session('message') }}
                    </div>
                @endif
                <div class="card card-primary  mt-n4">
                    <div class="card-title container text-danger">
                        @if ($average_of_ratings != 0)
                            <span class="text-secondary text-sm">Your Rating:</span>
                            @php $rating = $average_of_ratings; @endphp  
                            
                            @foreach(range(1,5) as $i)
                            <span class="fa-stack" style="width:1em">
                                <i class="far fa-star fa-stack-1x"></i>
                                
                                @if($rating > 0)
                                @if($rating > 0.5)
                                <i class="fas fa-star fa-stack-1x"></i>
                                @else
                                <i class="fas fa-star-half fa-stack-1x"></i>
                                @endif
                                @endif
                                @php $rating--; @endphp
                            </span>
                            @endforeach
                        @endif
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-borderless text-center">
                            @if ($ratings->count() != 0)
                                <thead class="bg-warning">
                                    <tr>
                                        <th>Seeker Username</th>
                                        <th>Rate</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                            @endif
                            <tbody>
                                @forelse ($ratings as $rating)
                                    <tr>
                                        <td>{{ $rating->user->username }}</td>
                                        <td>
                                            @php $stars = $rating->star_rate; @endphp  
                                
                                            @foreach(range(1,5) as $i)
                                                <span class="fa-stack text-danger" style="width:1em">
                                                    <i class="far fa-star fa-stack-1x"></i>
                                
                                                    @if($stars > 0)
                                                        @if($stars > 0.5)
                                                            <i class="fas fa-star fa-stack-1x"></i>
                                                        @else
                                                            <i class="fas fa-star-half fa-stack-1x"></i>
                                                        @endif
                                                    @endif
                                                    @php $stars--; @endphp
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>{{ $rating->comment }}</td>
                                    </tr>
                                @empty
                                    <div class="container text-center mt-5">
                                        <p class="text-muted text-md"> No Rating/s. </p>
                                    </div> 
                                @endforelse
                            </tbody>
                        </table>
                       
                        {{ $ratings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection