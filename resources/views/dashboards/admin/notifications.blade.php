@extends('dashboards.admin.layouts.app')
@section('title', 'Admin | Notifications')

@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right text-muted">
						<li class="breadcrumb-item"></li>
						<li class="breadcrumb-item">All Notifications</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<div class="container-fluid">
		<div class="row justify-content-center" >
			<div class="col-8">
				<div class="card">
					<div class="card-header bg-warning">
						All Notifications
					</div>
					@forelse($notifications as $notification)
						<div class="row justify-content-center">
							<div class="alert alert-secondary col-11 mt-2" role="alert">
								<strong class="text-danger">{{ $notification->data['username'] }}</strong> has just registered. <small>[{{ date('Y-m-d h:i a', strtotime($notification->created_at)) }}]</small> 
								<a href="{{ route('admin.notifications') }}" class="float-right mark-as-read text-primary" data-id="{{ $notification->id }}">
									Mark as read
								</a>
							</div>
						</div>
						@if($loop->last)
							<a href="{{ route('admin.notifications') }}" class="ml-2 mb-2" id="mark-all">
								Mark all as read
							</a>
						@endif
					@empty
						<div class="container text-center mt-5">
							<p class="text-muted text-md"> There are no new notification/s. </p>
						</div>
					@endforelse
				</div>
			</div>
		</div>
	</div>
	
@endsection
@section('js')
	<script>
		function sendMarkRequest(id = null) {
			return $.ajax("{{ route('admin.mark-as-read') }}", {
				method: 'POST',
				data: {
					"_token": "{{ csrf_token() }}",
					"id" : id
				}
				
			});
		}
		$(function() {
			$('.mark-as-read').click(function() {
				let request = sendMarkRequest($(this).data('id'));
				request.done(() => {
					$(this).parents('div.alert').remove();
				});

			});
			$('#mark-all').click(function() {
				let request = sendMarkRequest();
				request.done(() => {
					$('div.alert').remove();
				})
			});
		});
	</script>
@endsection
