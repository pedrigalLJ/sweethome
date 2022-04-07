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
					<div class="card-header">
						<h3 class="card-title">All Notifications</h3>
					</div>
					@forelse($notifications as $notification)
						<div class="row justify-content-center">
							<div class="alert alert-secondary col-11 mt-2" role="alert">
								<em class="text-warning">{{ $notification->data['username'] }}</em> has just registered. <small>[{{ $notification->created_at }}]</small> 
								<a href="{{ route('admin.notifications') }}" class="float-right mark-as-read" data-id="{{ $notification->id }}">
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
						<h4 class="text-muted text-center">There are no new notifications.</h4>
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



{{-- <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta 
            name="csrf-token" 
            content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{ __('Admin | Notifications') }}</title>
      <base href="{{ \URL::to('/') }}">

      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome Icons -->
      <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/adminlte.min.css">
    </head>
  <body class="hold-transition dark-mode sidebar-mini">
    <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </ul>

       
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
          <img src="{{ asset('/storage/images/sweethomeLogo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">SweetHome</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{ asset('/storage/images/default.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="{{ route('admin.profile') }}" class="d-block">{{ Auth::guard('admin')->user()->username }}</a>
            </div>
          </div>


          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                  with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user-lists') }}" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a>
                    <form action="{{ route('admin.logout') }}" id="logout-form" method="post">@csrf</form>
                </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right text-muted">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Notifications</li>
                    </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    
    
    
        <div class="row justify-content-center" >
            <div class="col-10">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">All Notifications</h3>
                </div>
                <!-- /.card-header -->
                
                @forelse($notifications as $notification)
                    <div class="row justify-content-center">
                        <div class="alert alert-secondary col-11 mt-2" role="alert">
                            <em class="text-warning">{{ $notification->data['username'] }}</em> has just registered. [{{ $notification->created_at }}] 
                             <a href="{{ route('admin.notifications') }}" class="float-right mark-as-read" data-id="{{ $notification->id }}">
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
                    <h4 class="text-muted text-center">There are no new notifications</h4>
                @endforelse
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
        </div>
      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            All rights reserved.
        </div>
        <!-- Default to the left -->
        <strong>&copy; 2021 SweetHome.</strong> 
      </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    
  </body>
</html> --}}