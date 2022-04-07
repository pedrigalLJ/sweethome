@extends('dashboards.admin.layouts.app')
@section('title', 'Admin | Subscribers')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <div class="card-tools">
                        <form action="#" method="GET">
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
                    </div> --}}
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right text-muted">
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item">Subscribers</li>
                </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Stripe ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th>Date of Payment</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($payments as $payment)
                        <td>{{ $payment->stripe_id }}</td>
                        <td>{{ $payment->name }}</td>
                        <td>{{ $payment->email }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->created_at }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
@endsection