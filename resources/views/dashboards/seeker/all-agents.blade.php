@extends('dashboards.seeker.layouts.app')
@section('title', 'Seeker | Agents')

@section('content')
    @include('dashboards.seeker.styles.style')    
    
    <div class="container">
        <form action="{{ route('seeker.all-agents') }}" method="GET" role="search">
            @csrf
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-10">
                        <!-- text input -->
                        <div class="form-group">
                            <input type="text" class="form-control" name="agent" value="{{ request()->input('agent') }}" placeholder="Who are you looking for? ">
                        </div>
                        </div>
                    
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><b><i class="fas fa-search"></i>&nbsp;S E A R C H</b></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container mt-4">
        <div class="row">
            <p class="m-2 card-header bg-warning bg-gradient font-weight-bold text-uppercase text-center">With Ratings</p>
            @if ($ratings->count() > 0)
            @forelse ($ratings as $rating)
            @if ($rating->agent->free_trial_days_left > 0)
                <div class="col-sm-4">
                    <div class="card">
                        <img src="{{ asset('storage/images/'.$rating->agent->image) }}" class="card-img-top allprop" alt="...">
                        <div class="card-body">
                            <p class="card-text"><i class="fas fa-user-tie text-success"></i> {{ $rating->agent->given_name.' '.$rating->agent->last_name }} <br>
                            Joined {{ date('Y',strtotime($rating->created_at)) }}
                            </p>
                            <a href="{{ route('seeker.agent-profile',$rating->agent->id) }}" class="btn btn-danger"><i class="fas fa-address-card"></i> More Info</a>
                            <p class="float-right text-danger">
                                {{ $rate = round($rating->ratings_average) }}
                                @foreach(range(1,5) as $i)
                                <span class="fa-stack" style="width:1em">
                                    <i class="far fa-star fa-stack-1x"></i>
                                    
                                    @if($rate > 0)
                                        @if($rate > 0.5)
                                        <i class="fas fa-star fa-stack-1x"></i>
                                        @else
                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                        @endif
                                    @endif
                                    @php $rate--; @endphp
                                </span>
                                @endforeach
                            </p>
                        </div>
                        
                    </div>
                    
                </div>
                {{ $ratings->links() }}
            @endif
            @empty
            <div class="container text-center mt-5">
                <p class="text-muted"> Agent cannot be found. </p>
            </div>
            @endforelse
            @else
            <div class="container text-center mt-5">
                <p class="text-muted"> No record/s.</p>
            </div>
            @endif

        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <p class="m-2 card-header text-uppercase font-weight-bold text-center bg-secondary bg-gradient">No Ratings Yet</p>
            @if ($agents->count() > 0)
            @forelse ($agents as $agent)
            @if ($agent->free_trial_days_left > 0)
                <div class="col-sm-4">
                    <div class="card">
                        <img src="{{ asset('storage/images/'.$agent->image) }}" class="card-img-top allprop" alt="...">
                        <div class="card-body">
                            <p class="card-text"><i class="fas fa-user-tie text-success"></i> {{ $agent->given_name.' '.$agent->last_name }} <br>
                            Joined {{ date('Y',strtotime($agent->created_at)) }}
                            </p>
                            <a href="{{ route('seeker.agent-profile',$agent->id) }}" class="btn btn-danger"><i class="fas fa-address-card"></i> More Info</a>
                        </div>
                    </div>
                    
                </div>
            @endif
            @empty
            <div class="container text-center mt-5">
                <p class="text-muted"> Agent cannot be found. </p>
            </div>
            @endforelse
            @else
            <div class="container text-center mt-5">
                <p class="text-muted"> No record/s.</p>
            </div>  
            @endif
            
        </div>
    </div>
@endsection