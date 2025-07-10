@extends('admin.layouts.app')
@section('content')
<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <p class="fw-semibold fs-18 mb-0">Welcome back, {{ $user->name }}!</p>
                <span class="fs-semibold text-muted">Track Inventory and other activities here.</span>
            </div>
        </div>
        <!-- End::page-header -->

       
          <!-- Start:: Booking Trends Chart -->
        @if(count($bookingChartData['datasets']) > 0)
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Booking Trends (Last 6 Months)</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.bookings.index') }}">View All Bookings</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="bookingChart" height="280"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- End:: Booking Trends Chart -->
 <!-- Start::row-1 -->
        <div class="row">
            @foreach ($dashboardStats as $card)
                <div class="col-xxl-3 col-lg-4 col-md-6 mb-4">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-body">
                            <div class="d-flex align-items-top justify-content-between">
                                <div>
                                    <span class="avatar avatar-md avatar-rounded bg-{{ $card['color'] }}">
                                        <i class="ti {{ $card['icon'] }} fs-16"></i>
                                    </span>
                                </div>
                                <div class="flex-fill ms-3">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                        <div>
                                            <p class="fw-semibold mb-0">{{ $card['title'] }}</p>
                                            <h4 class="fw-semibold mt-1">{{ $card['value'] }}</h4>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-1">
                                        <div>
                                            <a class="text-{{ $card['color'] }}" href="{{ $card['link'] }}">
                                                View All<i class="ti ti-arrow-narrow-right ms-2 fw-semibold d-inline-block"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- End::row-1 -->
      
    </div>
</div>
<!-- End::app-content -->

@endsection

@push('scripts')
@if(count($bookingChartData['datasets']) > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('bookingChart').getContext('2d');
        const chartData = @json($bookingChartData);
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: chartData.datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#4b5563',
                            font: {
                                size: 12,
                                family: 'Inter'
                            },
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: '500'
                        },
                        bodyFont: {
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.parsed.y} bookings`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(226, 232, 240, 0.5)'
                        },
                        ticks: {
                            color: '#64748b',
                            precision: 0
                        },
                        title: {
                            display: true,
                            text: 'Number of Bookings',
                            color: '#64748b'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#64748b'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                animation: {
                    duration: 800,
                    easing: 'easeOutQuart'
                }
            }
        });
    });
</script>
@endif
@endpush