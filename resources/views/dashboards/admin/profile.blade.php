@extends('dashboards.admin.layouts.app')
@section('title', 'Admin | Profile')

@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right text-muted">
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item">Admin Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <h3 class="profile-username text-center text-uppercase text-monospace">{{ Auth::guard('admin')->user()->username }}</h3>
                <p class="text-muted text-center">Software Engineer</p>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
    </div>
    <!-- /.content -->
@endsection