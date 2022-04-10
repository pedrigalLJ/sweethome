@extends('dashboards.admin.layouts.app')
@section('title', 'Admin | Approval')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="card-tools">
                       <form action="{{ route('admin.user-lists-declined') }}" method="GET">
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
                </div>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right text-muted">
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item">Need Approval</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check"></i> {{ session('message') }}
                    </div>
                @endif
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="nav-both-tab" data-toggle="tab" href="#nav-both" role="tab" aria-controls="nav-both" aria-selected="true">Seeker</a>
                        <a class="nav-link" id="nav-agent-tab" data-toggle="tab" href="#nav-agent" role="tab" aria-controls="nav-agent" aria-selected="false">Agent</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-both" role="tabpanel" aria-labelledby="nav-both-tab">
                        <table class="table table-hover text-center">
                            <tr class="text-secondary">
                                @if ($seekers->count() != 0)
                                    <th>Information</th>
                                    <th></th>
                                    <th>Date Registered</th>
                                @endif
                            </tr>
                            @forelse ($seekers as $user) 
                                <tr>
                                    <td> 
                                        <img class="rounded-lg" src="{{ asset('storage/images/'. $user->image) }}" alt="" width="100px" height="100px">
                                    </td>
                                    <td>
                                        <p class="text-justify">
                                            <a href="#" data-toggle="modal" data-target="#seekerProfile{{ $user->id }}" class="text-danger font-weight-bold">{{ $user->given_name.' '.$user->last_name }}</a>
                                            <br><small class="text-secondary">Username: </small>{{ $user->username }}
                                            <br><small class="text-secondary">Email: </small>{{ $user->email }}
                                        </p>
                                    </td>
                                    <td>{{ date('d M Y', strtotime($user->created_at)); }}</td>
                                </tr>
                                <div class="modal fade" id="seekerProfile{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title text-danger" id="myModalLabel">{{ $user->given_name.' '.$user->last_name }}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="card">
                                                        <img src="{{ asset('storage/images/'.$user->image) }}" class="card-img rounded" alt="..." width="400px;" height="400px;">
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <p class="card-text text-sm text-danger">
                                                                <i class="fas fa-map-marker-alt text-danger"></i> {{$user->city.', '.$user->province}} <br> 
                                                                <span class="text-secondary">Location</span>
                                                            </p>
                                                            <hr>
                                                            <p class="card-text text-sm text-danger">
                                                                <i class="fas fa-user text-danger"></i> {{$user->username}} <br>
                                                                <span class="text-secondary">Username</span>
                                                            </p>
                                                            <hr>
                                                            <p class="card-text text-sm text-danger">
                                                                <i class="fas fa-envelope text-danger"></i> {{$user->email}} <br>
                                                                <span class="text-secondary">Email</span>
                                                            <hr>
                                                            <p class="card-text text-sm text-danger">
                                                                <i class="fas fa-mobile text-danger"></i> {{$user->phone_no}} <br>
                                                                <span class="text-secondary">Contact</span>
                                                            </p>
                                                            <p class="card-text">
                                                                <small class="text-secondary">Registered at {{ $user->created_at  }}</small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="container text-center mt-5">
                                    <p class="text-muted text-md"> No Record/s. </p>
                                </div> 
                            @endforelse
                        </table>
                        {{ $seekers->appends(['agents' => $agents->currentPage()])->links() }}   
                    </div>
                    <div class="tab-pane fade" id="nav-agent" role="tabpanel" aria-labelledby="nav-agent-tab">
                        <table class="table table-hover text-center">
                            <tr class="text-secondary">
                                @if ($agents->count() != 0)
                                    <th>Information</th>
                                    <th></th>
                                    <th>Date Registered</th>
                                    <th>Free Trial Until</th>
                                @endif
                            </tr>
                            @forelse ($agents as $user) 
                                <tr>
                                    <td> 
                                        <img class="rounded-lg" src="{{ asset('storage/images/'. $user->image) }}" alt="" width="100px" height="100px">
                                    </td>
                                    <td>
                                        <p class="text-justify">
                                            <a href="#" data-toggle="modal" data-target="#seekerProfile{{ $user->id }}" class="text-danger font-weight-bold">{{ $user->given_name.' '.$user->last_name }}</a>
                                            <br><small class="text-secondary">Username: </small>{{ $user->username }}
                                            <br><small class="text-secondary">Email: </small>{{ $user->email }}
                                        </p>
                                    </td>
                                    <td>
                                        {{ date('Y-m-d', strtotime($user->created_at)); }}
                                    </td>
                                    <td>
                                        {{ date('d M Y', strtotime($user->trial_until)); }}
                                    </td>
                                </tr>
                                <div class="modal fade" id="seekerProfile{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title text-danger" id="myModalLabel">{{$user->given_name.' '.$user->last_name}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="card">
                                                        <img src="{{ asset('storage/images/'.$user->image) }}" class="card-img rounded" alt="..." width="400px;" height="400px;">
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <p class="card-text text-sm text-danger">
                                                                <i class="fas fa-map-marker-alt text-danger"></i> {{$user->city.', '.$user->province}} <br>
                                                                <span class="text-secondary">Location</span>
                                                            </p>
                                                            <hr>
                                                            <p class="card-text text-sm text-danger">
                                                                <i class="fas fa-user text-danger"></i> {{$user->username}} <br>
                                                                <span class="text-secondary">Username</span>
                                                            </p>
                                                            <hr>
                                                            <p class="card-text text-sm text-danger">
                                                                <i class="fas fa-envelope text-danger"></i> {{$user->email}} <br>
                                                                <span class="text-secondary">Email</span>
                                                            </p>
                                                            <hr>
                                                            <p class="card-text text-sm text-danger">
                                                                <i class="fas fa-mobile text-danger"></i> {{$user->phone_no}} <br>
                                                                <span class="text-secondary">Contact</span>
                                                            </p>
                                                            <p class="card-text">
                                                                <small class="text-secondary">Registered at {{ $user->created_at  }}</small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                @if ($user->role_id == 1)
                                                    <div class="container">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="card-title text-secondary">
                                                                    <h5>Verification </h5>
                                                                    <hr>
                                                                </div>
                                                                <br>
                                                                <p class="card-text text-sm text-danger">
                                                                    <i class="fas fa-birthday-cake text-danger"></i> {{ date('F j, Y', strtotime($user->agent_verification->birthdate)) }} <br>
                                                                    <span class="text-secondary">Birthdate</span>
                                                                </p>
                                                                <hr>
                                                                <p class="card-text text-sm text-danger">
                                                                    <i class="fas fa-barcode text-danger"></i> {{$user->agent_verification->license_no}} <br>
                                                                    <span class="text-secondary">License No.</span>
                                                                </p>
                                                                <hr>
                                                                <p class="card-text text-sm text-danger">
                                                                    <i class="fas fa-id-badge text-danger"></i> {{ $user->agent_verification->id_picture }} <br>
                                                                    <span class="text-secondary">Professional ID Card</span>
                                                                </p>
                                                                <img src="{{ asset('storage/agent-id-pictures/'.$user->agent_verification->id_picture) }}" class="card-img rounded" alt="..." width="400px;" height="400px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <p class="text-center">{{-- $listing->description --}}</p> 
                
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="container text-center mt-5">
                                    <p class="text-muted text-md"> No Record/s. </p>
                                </div> 
                            @endforelse
                        </table>
                        {{ $agents->appends(['seekers' => $seekers->currentPage()])->links() }} 
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection