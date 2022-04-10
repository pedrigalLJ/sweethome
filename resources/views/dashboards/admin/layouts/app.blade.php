<!DOCTYPE html>
<html lang="en">
    <head>

		<meta charset="utf-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>
		<!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>


        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
	<body class="hold-transition sidebar-mini">
		@include('dashboards.admin.styles.styles')
		<div class="wrapper">
			<nav class="main-header navbar navbar-expand navbar-dark">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown mr-5">
						<a class="nav-link" data-toggle="dropdown" href="#">
							<i class="far fa-bell mr-3 mt-2"></i>
							<small><span class="badge badge-warning navbar-badge">{{ auth()->user()->unreadNotifications->count() }}</span></small>
						</a>
						@forelse($notifications as $notification)
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
								<span class="dropdown-header">{{ auth()->user()->unreadNotifications->count() }} Notification/s</span>
								<div class="dropdown-divider"></div>
								<div class="dropdown-item">
									<strong class="dropdown-item-title text-danger">
										{{ $notification->data['username'] }}
									</strong>
									<small class="text-sm">has just registered.</small>
									<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{ $notification->created_at }}</p>
								</div>
								<div class="dropdown-divider"></div>
								<a href="{{ route('admin.notifications') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
							</div>
						@empty
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
								<div class="dropdown-item text-secondary">
									There are no new notification/s.
								</div>
							</div>
						@endforelse
					</li>
				</ul>
			</nav>

			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<a href="{{ route('admin.dashboard') }}" class="brand-link">
					<img src="{{ asset('/storage/images/sweethomeLogo.jpg') }}" alt="SweetHome Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
					<span class="brand-text font-weight-bold">{{ config('app.name', 'Laravel') }}</span>
				</a>
				<div class="sidebar">
					<div class="user-panel mt-3 pb-3 mb-3 d-flex">
						<div class="image">
						<img src="{{ asset('/storage/images/admin.jpg') }}" class="img-circle elevation-2" alt="User Image">
						</div>
						<div class="info">
						<a href="{{ route('admin.profile') }}" class="d-block">{{ Auth::guard('admin')->user()->username }}</a>
						</div>
					</div>
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<li class="nav-item">
								<a href="{{ route('admin.dashboard') }}" class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>Dashboard</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link {{ (request()->is('admin/user-lists')) ? 'active' : '' }} {{ (request()->is('admin/user-lists-declined')) ? 'active' : '' }} {{ (request()->is('admin/need-approval')) ? 'active' : '' }}">
									<i class="nav-icon fa fa-users"></i>
									<p>Users</p>
									<i class="right fas fa-angle-left"></i>
								</a>
								<ul class="nav nav-treeview text-sm ml-2">
									<li class="nav-item">
										<a href="{{ route('admin.user-lists') }}" class="nav-link {{ (request()->is('admin/user-lists')) ? 'active' : '' }} ">
											<i class="fas fa-user-check text-success nav-icon text-sm"></i>
											<p class="ml-n2">Approved</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="{{ route('admin.user-lists-declined') }}" class="nav-link {{ (request()->is('admin/user-lists-declined')) ? 'active' : '' }}">
											<i class="fas fa-user-times text-danger nav-icon text-sm"></i>
											<p class="ml-n2">Declined</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="{{ route('admin.need-approval') }}" class="nav-link {{ (request()->is('admin/need-approval')) ? 'active' : '' }}">
											<i class="fas fa-user-edit text-warning nav-icon text-sm"></i>
											<p class="ml-n2">Need Approval</p>
										</a>
									</li>
									
								</ul>
							</li>
							<li class="nav-item">
								<a href="{{ route('admin.logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a>
								<form action="{{ route('admin.logout') }}" id="logout-form" method="post">@csrf</form>
							</li>
						</ul>
					</nav>
				</div>
			</aside>
			<div class="content-wrapper">
				@yield('content')
			</div>
			
			<footer class="main-footer">
				<div class="float-right d-none d-sm-inline">
				All Right Reserved<small> 2021</small>
				</div>
				<strong>SweetHome &copy;<small> VCAL</small></strong> 
			</footer>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
		@yield('js')
  </body>
</html>
