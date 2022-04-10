@extends('dashboards.admin.layouts.app')
@section('title', 'Admin | Dashboard')

@section('content')
    @include('dashboards.admin.styles.styles')
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right text-muted">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item">Dashboard</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row card">
            <div class="col-md-6 offset-md-3">
                <canvas id="users"></canvas>
            </div>
        </div>
        <div class="row card">
            <div class="col-md-8 offset-md-2">
                {{ $monthlyAgentUserChart->renderHtml() }}
            </div>
            
        </div>
        <div class="row card">
            <div class="col-md-8 offset-md-2">
                {{ $monthlySeekerUserChart->renderHtml() }}
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const data = {
        labels: [
            'Registered',
            'Declined',
            'Total Agents',
            'Total Seekers',
            'Approved',
            'Need Approval',
        ],
        datasets: [{
            data: [
                {{ $users->count() }}, 
                {{ $declinedUsers->count() }}, 
                {{ $agentUsers->count() }}, 
                {{ $seekerUsers->count() }}, 
                {{ $approvedUsers->count() }}, 
                {{ $needApprovalUsers->count() }}
            ],
            backgroundColor: [
                'rgb(54, 162, 235)',
                'rgb(142, 142, 142)',
                'rgb(254, 57, 57)',
                'rgb(176, 81, 81)',
                'rgb(0, 113, 82)',
                'rgb(249, 166, 2)'
            ],
            hoverOffset: 6
        }]
    };
  
    const config = {
        type: 'doughnut',
        data: data,
        options: {}
    };
    
    const users = new Chart(
        document.getElementById('users'),
        config
    );
    
  </script>
  {{ $monthlyAgentUserChart->renderChartJsLibrary() }}
  {{ $monthlyAgentUserChart->renderJs() }}

  {{ $monthlySeekerUserChart->renderChartJsLibrary() }}
  {{ $monthlySeekerUserChart->renderJs() }}
@endsection
