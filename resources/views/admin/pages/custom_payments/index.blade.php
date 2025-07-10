@extends('admin.layouts.app')

@section('content')
<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Custom Payments</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Custom Payments</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Custom Payments List -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">Custom Payment Requests</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable-basic" class="table text-nowrap table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr</th>
                                        <th scope="col">Customer Details</th>
                                        <th scope="col">Order No</th>
                                        <th scope="col">Service Type</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customPayments as $payment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span>{{ $payment->first_name }}</span>
                                                <small class="text-muted">{{ $payment->email }}</small>
                                                <small class="text-muted">{{ $payment->phone }}</small>
                                            </div>
                                        </td>
                                        <td>{{ $payment->order_number }}</td>
                                        <td>{{ Str::headline($payment->service_type) }}</td>
                                        <td>${{ number_format($payment->custom_amount, 2) }}</td>
                                        <td>
                                           <span class="badge bg-{{ $payment->status == 'Completed' ? 'success' : ($payment->status == 'Pending' ? 'warning' : 'danger') }}">
                                                    {{ $payment->status ?? 'N/A' }}
                                            </span>
                                        </td>

                                        <td>{{ $payment->created_at->format('d M Y, h:i A') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Custom Payments List -->
    </div>
</div>
@endsection