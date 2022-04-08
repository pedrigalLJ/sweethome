@extends('dashboards.seeker.layouts.app')
@section('title', 'Seeker | Properties')

@section('content')
    @include('dashboards.seeker.styles.style')
    <div class="container">
        <h2 class="text-secondary text-center">
            <i class="fas fa-calendar-check h4"></i> Appointments <i class="fas fa-calendar-check h4"></i>
        </h2><br>
        <div class="card">
            <ul class="nav nav-tabs nav-pills" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button 
                        class="nav-link active" 
                        id="waiting-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#waiting" 
                        type="button" 
                        role="tab" 
                        aria-controls="home" 
                        aria-selected="true">
                        <i class="fas fa-spinner"></i> Waiting
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button 
                        class="nav-link" 
                        id="approved-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#approved" 
                        type="button" 
                        role="tab" 
                        aria-controls="profile" 
                        aria-selected="false">
                        <i class="fas fa-calendar-check"></i> Approved
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button 
                        class="nav-link" 
                        id="declined-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#declined" 
                        type="button" 
                        role="tab" 
                        aria-controls="contact" 
                        aria-selected="false">
                        <i class="fas fa-calendar-times"></i> Declined
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button 
                        class="nav-link" 
                        id="history-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#history" 
                        type="button" 
                        role="tab" 
                        aria-controls="contact" 
                        aria-selected="false">
                        <i class="fas fa-history"></i> History
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="waiting" role="tabpanel" aria-labelledby="waiting-tab">
    
                    <table class="table table-hover table-borderless text-center">
                        @if( $waitings->count() != 0)
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Agent Username</th>
                                    <th>Property</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        @endif
                        <tbody>
                            @forelse ($waitings as $appointment)
                                <tr>
                                    <td>{{ $appointment->date }}</td>
                                    <td>
                                        {{ date('H:i', strtotime($appointment->time)) }}
                                    </td>
                                    <td>{{ $appointment->agent->username }}</td>
                                    <td>{{ $appointment->property->title }}</td>
                                    
                                    <td class="text-sm">
                                        <a href="{{ route('seeker.appointment-cancel', $appointment->id) }}" class="text-danger">
                                            <i class="fas fa-times"></i> Cancel
                                        </a>
                                    </td>
                                    
                                </tr>
                            @empty
                                <div class="container text-center mt-5">
                                    <p class="text-muted text-md"> No Record/s. </p>
                                </div> 
                            @endforelse
                        </tbody>
                    </table>
                    {{ $waitings->links() }}
    
                </div>
                <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                    <table class="table table-hover table-borderless text-center">
                        @if( $approves->count() != 0)
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Agent Username</th>
                                    <th>Property</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        @endif
                        <tbody>
                            @forelse ($approves as $appointment)
                                <tr>
                                    <td>{{ $appointment->date }}</td>
                                    
                                    <td>
                                        {{ date('H:i', strtotime($appointment->time)) }}
                                    </td>
                                    <td>{{ $appointment->agent->username }}</td>
                                    <td>{{ $appointment->property->title }}</td>
                                    
                                    <td class="text-sm">
                                        <a href="{{ route('seeker.appointment-done', $appointment->id) }}" class="text-warning"><i class="fas fa-check"></i> Done</a>
                                    </td>
                                    
                                </tr>
                            @empty
                                <div class="container text-center mt-5">
                                    <p class="text-muted text-md"> No Record/s. </p>
                                </div> 
                            @endforelse
                        </tbody>
                    </table>
                    {{ $approves->links() }}
                </div>
                <div class="tab-pane fade" id="declined" role="tabpanel" aria-labelledby="declined-tab">
                    <table class="table table-hover table-borderless text-center">
                        @if( $declines->count() != 0)
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Agent Username</th>
                                    <th>Property</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        @endif
                        <tbody>
                            @forelse ($declines as $appointment)
                                <tr>
                                    <td>
                                        {{ $appointment->date }}</td>
                                    <td>
                                        {{ date('H:i', strtotime($appointment->time)) }}
                                    </td>
                                    <td>{{ $appointment->agent->username }}</td>
                                    <td>{{ $appointment->property->title }}</td>
                                    <td><a href="{{ route('seeker.view-property', $appointment->property->id) }}" class="text-success"><i class="fas fa-calendar-day"></i> Resched</a></td>
                                </tr>
                            @empty
                                <div class="container text-center mt-5">
                                    <p class="text-muted text-md"> No Record/s. </p>
                                </div> 
                            @endforelse
                        </tbody>
                    </table>
                    {{ $declines->links() }}
    
                </div>
                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                    <table class="table table-hover table-borderless text-center">
                        @if( $histories->count() != 0)
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Agent Username</th>
                                    <th>Property</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        @endif
                        <tbody>
                            @forelse ($histories as $appointment)
                                <tr>
                                    <td>{{ $appointment->date }}</td>
                                    <td>
                                        {{ date('H:i', strtotime($appointment->time)) }}
                                    </td>
                                    <td>{{ $appointment->agent->username }}</td>
                                    <td>{{ $appointment->property->title }}</td>
                                    @if ( $appointment->status  == 'Cancelled' )
                                        <td class="text-danger font-weight-bold">{{ $appointment->status }}</td>
                                    @elseif ( $appointment->status  == 'Done' )
                                    <td class="text-success font-weight-bold">{{ $appointment->status }}</td>
                                    @endif
                                    
                                    
                                </tr>
                            @empty
                                <div class="container text-center mt-5">
                                    <p class="text-muted text-md"> No Record/s. </p>
                                </div> 
                            @endforelse
                        </tbody>
                    </table>
                    {{ $histories->links() }}
                </div>
            </div>     
        </div>  
    </div>
      
@endsection
@section('javascripts')
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	@if (session('cancel'))
		<script>
			swal({
				text: "{{ session('cancel') }}",
				icon: "error",
			});
		</script>
    @elseif (session('done'))
        <script>
            swal({
                text: "{{ session('done') }}",
                icon: "success",
            });
        </script>
	@endif
@endsection