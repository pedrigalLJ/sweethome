@extends('dashboards.seeker.layouts.app')
@section('title', 'Seeker | Agents')

@section('content')
    @include('dashboards.seeker.styles.style')    
    {{-- <div class="row container-fluid"> --}}
       {{-- <div class="col-md-8"> --}}
       

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
            <div class="container col-md-6 offset-col-md-3">
                {!! $agentRatingsChart->renderHtml() !!}
            </div>
            <div class="container mt-4">
            <div class="row">
                    @forelse ($agents as $agent)
                        <div class="col-sm-4">
                            <div class="card">
                                <img src="{{ asset('storage/images/'.$agent->image) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text"><i class="fas fa-user-tie text-success"></i> {{ $agent->given_name.' '.$agent->last_name }} <br>
                                    Joined {{ date('Y',strtotime($agent->created_at)) }}
                                    </p>
                                    <a href="{{ route('seeker.agent-profile',$agent->id) }}" class="btn btn-danger"><i class="fas fa-address-card"></i> More Info</a>
                                </div>
                            </div>
                            
                        </div>
                    @empty
                    <div class="container text-center mt-5">
                        <h3 class="text-secondary"> --Agent cannot be found-- </h3>
                    </div>
                    @endforelse
                </div>
            </div>
            
@endsection
@section('javascripts')
{!! $agentRatingsChart->renderChartJsLibrary() !!}

{!! $agentRatingsChart->renderJs() !!}


@endsection