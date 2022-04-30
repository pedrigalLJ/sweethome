<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

		<script src="{{ asset('js/app.js') }}"></script>
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
		
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">
			<nav class="main-header navbar navbar-expand navbar-light">
				<ul class="navbar-nav">
					<li class="nav-item">
					  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link text-danger" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">{{ auth()->user()->free_trial_days_left }} Days of Free Trial left. Click to Subscribe.</a></strong>
						
					</li>
					<li class="nav-item dropdown">
					  <a class="nav-link" href="{{ route('messages') }}">
						<i class="far fa-comments"></i>
						@if ($msg->count() != 0)
							<small><span class="badge badge-danger ml-n1">{{ $msg->count() }}</span></small>
						@endif
					  </a>
					</li>
					<li class="nav-item mr-4">
						<a class="nav-link" href="{{ route('logout') }}"
						onclick="event.preventDefault();
										document.getElementById('logout-form').submit();"> <i class="nav-icon fas fa-sign-out-alt"></i>
							{{ __('Logout') }}
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</li>
				</ul>
			</nav>
			
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<a href="{{ route('agent.dashboard') }}" class="brand-link">
					<img src="{{ asset('/storage/images/sweethomeLogo.jpg') }}" alt="SweetHome Logo" class="brand-image img-circle elevation-3">
					<span class="brand-text font-weight-bold">{{ config('app.name', 'Laravel') }}</span>
				</a>
				<div class="sidebar">
					<div class="user-panel mt-3 pb-3 mb-3 d-flex">
						<div class="image">
						<img src="{{ asset('storage/images/'. Auth::user()->image) }}" class="img-circle elevation-2" alt="User Image">
						</div>
						<br>
						<div class="info">
							<a href="{{ route('agent.profile') }}" class="d-block text-warning">{{ Auth::user()->given_name.' '.Auth::user()->last_name }}</small>
							</a>
						</div>
					</div>
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<li class="nav-item">
								<a href="{{ route('agent.dashboard') }}" class="nav-link {{ (request()->is('agent/dashboard')) ? 'active' : '' }}">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>Dashboard</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link {{ (request()->is('agent/properties*')) ? 'active' : '' }}{{ (request()->is('agent/property*')) ? 'active' : '' }}">
									<i class="nav-icon fas fa-list-alt"></i>
									<p>Properties</p>
									<i class="right fas fa-angle-left"></i>
								</a>
								<ul class="nav nav-treeview text-sm ml-2">
									<li class="nav-item">
										<a href="{{ route('agent.properties.index') }}" class="nav-link {{ (request()->is('agent/properties')) ? 'active' : '' }}">
											<i class="nav-icon fas fa-list text-sm"></i>
											<p class="ml-n2">All</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="{{ route('agent.properties.create') }}" class="nav-link {{ (request()->is('agent/properties/create')) ? 'active' : '' }}">
											<i class="nav-icon fas fa-plus text-sm"></i> 
											<p class="ml-n2">New Listing</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item">
								<a href="{{ route('agent.documents.index') }}" class="nav-link {{ (request()->is('agent/documents*')) ? 'active' : '' }} {{ (request()->is('agent/documents/create')) ? 'active' : '' }}">
									<i class="nav-icon fa fa-folder-open"></i>
									<p>Documents</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link {{ (request()->is('agent/appointments*')) ? 'active' : '' }}">
									<i class="nav-icon fas fa-calendar-check "></i>
									<p>Appointments</p>
									<i class="right fas fa-angle-left"></i>
								</a>
								<ul class="nav nav-treeview text-sm ml-2">
									<li class="nav-item">
										<a href="{{ route('agent.appointments-calendar') }}" class="nav-link {{ (request()->is('agent/appointments-calendar')) ? 'active' : '' }}">
											<i class="nav-icon fas fa-calendar-alt text-sm"></i>
											<p class="ml-n2">Calendar</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="{{ route('agent.appointments-need-approval') }}" class="nav-link {{ (request()->is('agent/appointments-need-approval')) ? 'active' : '' }}">
											<i class="nav-icon fas fa-calendar-day text-sm"></i>
											<p class="ml-n2">Need Approval</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item">
								<a href="{{ route('agent.rate-and-comments') }}" class="nav-link {{ (request()->is('agent/rate-and-comments')) ? 'active' : '' }}">
									<i class="nav-icon fas fa-star"></i>
									<p>Rate & Comments</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('agent.change-password') }}" class="nav-link {{ (request()->is('agent/change-password')) ? 'active' : '' }}">
									<i class="nav-icon fas fa-unlock-alt"></i>
									<p>Change Password</p>
								</a>
							</li>
						</ul>
					</nav>
				</div>
			</aside>
			<div class="content-wrapper">
				@yield('content')
        
        		<div id='calendar'></div>
			</div>
		</div>
		<div class="container">
			<footer class="border-top p-4">
				<div class="float-right d-none d-sm-inline">
					<strong>SweetHome &copy;<small> VCAL</small></strong> 
	
				</div>
				All Right Reserved<small> 2021</small>
			</footer>
		</div>
		
		@if (auth()->check() && auth()->user()->free_trial_days_left < 0)
			<div class="modal" tabindex="-1" role="dialog" style="display: block">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h3 class="modal-title text-danger">Subscription!</h3>
							<a href="{{ route('logout') }}" class="btn btn-sm btn-secondary float-right" onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
							 	<i class="fas fa-sign-out-alt"></i> Logout
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</div>
						<div class="modal-body">
							<div class="alert alert-danger">
								Your Free Trial is over. Please subscribe to continue.
							</div>
							<div class="row">
								<div class="col-md-6 offset-md-3 text-center">
									<a href="" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#subscribe">
										Subscribe now!
									</a>
									<div class="modal fade" id="subscribe" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="subscribeLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg">
										  <div class="modal-content">
											<div class="modal-header">
											  <h5 class="modal-title text-danger" id="subscribeLabel">Subscribe</h5>
											</div>
											<div class="modal-body">
												<div id="paypal-button-container"></div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
											</div>
										  </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
		<div class="col-md-6 offset-md-3 text-center">
			<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title text-danger" id="subscribeLabel">Subscribe</h5>
					  </div>
					  <div class="modal-body">
						<div id="paypal-button-container"></div>
					  </div>
					  <div class="modal-footer">
						  <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
					  </div>
					</div>
				  </div>
			</div>
		</div>
		<script src="https://www.paypal.com/sdk/js?client-id=AdWQEehJ2UD4lhwpsunAC4Gdh_8_g9eFnEzYHNHSj93L0tI3qKUaHzXage3KkQvu2_89QD2KwaGiB7wG&currency=USD"></script>
		<script>
			paypal.Buttons({
			  // Sets up the transaction when a payment button is clicked
			  createOrder: (data, actions) => {
				return actions.order.create({
				  purchase_units: [{
					amount: {
					  value: '1.00'
					}
				  }]
				});
			  },
			  // Finalize the transaction after payer approval
			  onApprove: (data, actions) => {
				return actions.order.capture().then(function(orderData) {
				  // Successful capture! For dev/demo purposes:
				  console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
				  const transaction = orderData.purchase_units[0].payments.captures[0];
				  const element = document.getElementById('paypal-button-container');
				  element.innerHTML = '<h3>Already Subscribed. <br>Thank you for your payment!</h3>';
				});
			  }
			}).render('#paypal-button-container');
		  </script>
		@yield('javascripts')
	</body>
</html>