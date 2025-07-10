@extends('admin.layouts.app')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Flight Itinerary</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Flight Itinerary</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->

        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card custom-card shadow-sm">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/fifv.webp') }}" alt="Flight Itinerary Logo" class="img-fluid" style="max-width: 180px;">
                        </div>

                        <!-- Booking Information -->
                        <div class="mb-4">
                            <h3>{{ preg_replace('/(?<!^)[A-Z]/', ' $0', $booking->type) }} Form</h3>
                            <h5 class="my-3">General Information</h5>
                            <div class="table-responsive border rounded">
                                <table class="table table-sm table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <th class="w-50">Order Number</th>
                                            <td>{{ $booking->order_no ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Title</th>
                                            <td>{{ $booking->title ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>First Name</th>
                                            <td>{{ $booking->first_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Name</th>
                                            <td>{{ $booking->last_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email Address</th>
                                            <td>{{ $booking->email ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone Number</th>
                                            <td>{{ $booking->phone ?? 'N/A' }}</td>
                                        </tr>
                                         @if ($booking->type !== 'TravelGuides')
                                        <tr>
                                            <th>Number of Travelers</th>
                                            <td>{{ $booking->no_of_travelers ?? 'N/A' }}</td>
                                        </tr>
                                       @endif

                                        <tr>
                                            <th>Interview Documents Required</th>
                                            <td>{{ $booking->interview_documents }}</td>
                                        </tr>
                                        <tr>
                                            <th>Future Delivery Date</th>
                                            <td>{{ $booking->future_delivery_date ? \Carbon\Carbon::parse($booking->future_delivery_date)->format('d/m/Y') : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Referral Source</th>
                                            <td>{{ $booking->referral_source ?? 'N/A' }}</td>
                                        </tr>

                                       <tr>
                                            <th>Urgent Reservation</th>
                                            <td>
                                                @php
                                                    $urgentText = 'No';
                                                    if ($booking->urgent_reservation == 1) {
                                                        $urgentText = '6–8 Hours ($30 Extra)';
                                                    } elseif ($booking->urgent_reservation == 2) {
                                                        $urgentText = '8–10 Hours ($15 Extra)';
                                                    }
                                                @endphp
                                                {{ $urgentText }}
                                            </td>
                                        </tr>
                                        @if($booking->type == 'FlightAndHotelBooking')
                                        <tr>
                                            <th>Price</th>
                                            <td>
                                                {{ $booking->total_price }} $
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Traveler Details -->
                        @if($booking->travelers && $booking->travelers->count() > 0)
                        <div class="mb-4">
                            <h5 class="mb-3">Traveler Details</h5>
                            @foreach($booking->travelers as $index => $traveler)
                            <div class="mb-3">
                                <h6 class="text-primary">Traveler {{ $index + 2 }}</h6>
                                <div class="table-responsive border rounded">
                                    <table class="table table-sm table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <th class="w-50">Title</th>
                                                <td>{{ $traveler->title ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>First Name</th>
                                                <td>{{ $traveler->first_name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Last Name</th>
                                                <td>{{ $traveler->last_name ?? 'N/A' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                         <!-- Travel Insurance Details -->
                        @if($booking->travelInsurances)
                        <div class="mb-4">
                            <h5 class="mb-3">Travel Insurance Details</h5>
                            <div class="table-responsive border rounded">
                                <table class="table table-sm table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <th class="w-50">Title</th>
                                            <td>{{ $booking->travelInsurances->title ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>First Name</th>
                                            <td>{{ $booking->travelInsurances->first_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Name</th>
                                            <td>{{ $booking->travelInsurances->last_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Number of Travelers</th>
                                            <td>{{ $booking->travelInsurances->no_of_travelers ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Start Date</th>
                                            <td>{{ $booking->travelInsurances->start_date ? $booking->travelInsurances->start_date->format('d/m/Y') : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>End Date</th>
                                            <td>{{ $booking->travelInsurances->end_date ? $booking->travelInsurances->end_date->format('d/m/Y') : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Travelling From</th>
                                            <td>{{ $booking->travelInsurances->travelling_from ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Travelling To</th>
                                            <td>{{ $booking->travelInsurances->travelling_to ?? 'N/A' }}</td>
                                        </tr>

                                        <tr>
                                            <th>Insurance Purpose</th>

                                              <td>

                                                        @if($booking->travelInsurances->insurance_purpose == 1)
                                                           Just For Visa Purpose
                                                        @elseif($booking->travelInsurances->insurance_purpose == 2)
                                                            Visa + Actual Journey Useable
                                                        @else
                                                            N/A
                                                        @endif

                                                </td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td>${{ number_format($booking->travelInsurances->price ?? 0, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Insurance Traveler Details -->
                            @if($booking->travelInsurances->insuranceTravelerDetails && $booking->travelInsurances->insuranceTravelerDetails->count() > 0)
                            <div class="mt-3">
                                <h6 class="text-info">Insurance Traveler Details</h6>
                                @foreach($booking->travelInsurances->insuranceTravelerDetails as $index => $insuranceTraveler)
                                <div class="mb-3">
                                    <h6 class="text-secondary">Insurance Traveler {{ $index + 1 }}</h6>
                                    <div class="table-responsive border rounded">
                                        <table class="table table-sm table-bordered mb-0">
                                            <tbody>
                                                <tr>
                                                    <th class="w-50">First Name</th>
                                                    <td>{{ $insuranceTraveler->first_name ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Last Name</th>
                                                    <td>{{ $insuranceTraveler->last_name ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>US Citizen</th>
                                                    <td>{{ $insuranceTraveler->is_us_citizen ? 'Yes' : 'No' }}</td>
                                                </tr>
                                               @php
                                                    $ageRanges = [
                                                        '1'  => '0-21',
                                                        '2'  => '22-29',
                                                        '3'  => '30-39',
                                                        '5'  => '40-49',
                                                        '10' => '50-59',
                                                        '15' => '60-69',
                                                        '20' => '70-79',
                                                        '25' => '90-99',
                                                        '30' => '100-109',
                                                    ];
                                                @endphp

                                                <tr>
                                                    <th>Age</th>
                                                    <td>{{ $ageRanges[$insuranceTraveler->age] ?? 'Unknown' }}</td>
                                                </tr>

                                                <tr>
                                                    <th>Date of Birth</th>
                                                    <td>{{ $insuranceTraveler->date_of_birth ? \Carbon\Carbon::parse($insuranceTraveler->date_of_birth)->format('d/m/Y') : 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Gender</th>
                                                    <td>{{ ucfirst($insuranceTraveler->gender ?? 'N/A') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Citizenship</th>
                                                    <td>{{ $insuranceTraveler->citizen_ship ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Passport Number</th>
                                                    <td>{{ $insuranceTraveler->passport_number ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Country</th>
                                                    <td>{{ $insuranceTraveler->country ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Address</th>
                                                    <td>{{ $insuranceTraveler->address ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>State</th>
                                                    <td>{{ $insuranceTraveler->state ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>City</th>
                                                    <td>{{ $insuranceTraveler->city ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Postal Code</th>
                                                    <td>{{ $insuranceTraveler->postal_code ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone Number</th>
                                                    <td>{{ $insuranceTraveler->phone_no ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Beneficiary Name</th>
                                                    <td>{{ $insuranceTraveler->beneficiary_name ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Beneficiary Relationship</th>
                                                    <td>{{ $insuranceTraveler->beneficiary_relationship ?? 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Flight Reservation Details -->
                        @if($booking->flightReservations)
                        <div class="mb-4">
                            <h5 class="mb-3">Flight Reservation Details</h5>
                            <div class="table-responsive border rounded">
                                <table class="table table-sm table-bordered mb-0">
                                    <tbody>
                                        @if($booking->type !== 'FlightAndHotelBooking')
                                        <tr>
                                            <th class="w-50">Number of Travelers</th>
                                            <td>{{ $booking->flightReservations->no_of_travelers ?? 'N/A' }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th>Number of Flights</th>
                                            <td>{{ $booking->flightReservations->no_of_flights ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Additional Details</th>
                                            <td>{{ $booking->flightReservations->additional_details ?? 'N/A' }}</td>
                                        </tr>
                                         @if($booking->type !== 'FlightAndHotelBooking')
                                        <tr>
                                            <th>Price</th>
                                            <td>${{ number_format($booking->flightReservations->price ?? 0, 2) }}</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- Flight Details -->
                            @if($booking->flightReservations->flightDetails && $booking->flightReservations->flightDetails->count() > 0)
                            <div class="mt-3">
                                <h6 class="text-info">Flight Details</h6>
                                @foreach($booking->flightReservations->flightDetails as $index => $flightDetail)
                                <div class="mb-2">
                                    <div class="table-responsive border rounded">
                                        <table class="table table-sm table-bordered mb-0">
                                            <tbody>
                                                <tr>
                                                    <th class="w-50">Flight {{ $index + 1 }}</th>
                                                    <td>{{ $flightDetail->flight ?? 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Hotel Booking Details -->
                        @if($booking->hotelBookings)
                        <div class="mb-4">
                            <h5 class="mb-3">Hotel Booking Details</h5>
                            <div class="table-responsive border rounded">
                                <table class="table table-sm table-bordered mb-0">
                                    <tbody>
                                          @if($booking->type !== 'FlightAndHotelBooking')
                                        <tr>
                                            <th class="w-50">Number of Travelers</th>
                                            <td>{{ $booking->hotelBookings->no_of_travelers ?? 'N/A' }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th>Number of Hotels</th>
                                            <td>{{ $booking->hotelBookings->no_of_hotels ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Additional Details</th>
                                            <td>{{ $booking->hotelBookings->additional_details ?? 'N/A' }}</td>
                                        </tr>
                                          @if($booking->type !== 'FlightAndHotelBooking')
                                        <tr>
                                            <th>Price</th>
                                            <td>${{ number_format($booking->hotelBookings->price ?? 0, 2) }}</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- Hotel Details -->
                            @if($booking->hotelBookings->hotelDetails && $booking->hotelBookings->hotelDetails->count() > 0)
                            <div class="mt-3">
                                <h6 class="text-info">Hotel Details</h6>
                                @foreach($booking->hotelBookings->hotelDetails as $index => $hotelDetail)
                                <div class="mb-2">
                                    <div class="table-responsive border rounded">
                                        <table class="table table-sm table-bordered mb-0">
                                            <tbody>
                                                <tr>
                                                    <th class="w-50">Hotel {{ $index + 1 }}</th>
                                                    <td>{{ $hotelDetail->hotel ?? 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endif

                       
                        <!-- Travel Guide Details -->
                        @if($booking->travelGuides)
                        <div class="mb-4">
                            <h5 class="mb-3">Travel Guide Details</h5>
                            <div class="table-responsive border rounded">
                                <table class="table table-sm table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <th class="w-50">Number of Cities</th>
                                            <td>{{ $booking->travelGuides->no_of_cities ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td>${{ number_format($booking->travelGuides->price ?? 0, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Travel Guide Details -->
                            @if($booking->travelGuides->travelGuideDetails && $booking->travelGuides->travelGuideDetails->count() > 0)
                            <div class="mt-3">
                                <h6 class="text-info">Guide Details</h6>
                                @foreach($booking->travelGuides->travelGuideDetails as $index => $guideDetail)
                                <div class="mb-2">
                                    <div class="table-responsive border rounded">
                                        <table class="table table-sm table-bordered mb-0">
                                            <tbody>
                                                <tr>
                                                    <th class="w-50">Guide {{ $index + 1 }}</th>
                                                    <td>{{ $guideDetail->guide ?? 'N/A' }}</td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Services Summary -->
                        <div class="mb-4">
                            <h5 class="mb-3">Services Summary</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm text-nowrap mb-0">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>Service</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-end">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <tr>
                                            <td class="text-primary fw-semibold">Travel Insurance</td>
                                            <td class="text-center">
                                                <span class="badge bg-{{ $booking->travel_insurance ? 'success' : 'secondary' }}">
                                                    {{ $booking->travel_insurance ? 'Included' : 'Not Included' }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                @if($booking->travel_insurance && $booking->travelInsurances)
                                                    ${{ number_format($booking->travelInsurances->price ?? 0, 2) }}
                                                @else
                                                    $0.00
                                                @endif
                                            </td>
                                        </tr>
                                    @if($booking->type == 'FlightAndHotelBooking')
                                        <tr>
                                            <td class="text-primary fw-semibold">Flight & Hotel Reservation</td>
                                            <td class="text-center">
                                                <span class="badge bg-{{ $booking->flight_reservation ? 'success' : 'secondary' }}">
                                                    {{ $booking->flight_reservation ? 'Included' : 'Not Included' }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                @if($booking->flight_reservation && $booking->flightReservations)
                                                    ${{ number_format($booking->flightReservations->price ?? 0, 2) }}
                                                @else
                                                    $0.00
                                                @endif
                                            </td>
                                        </tr>
                                    @else
                                         <tr>
                                            <td class="text-primary fw-semibold">Flight Reservation</td>
                                            <td class="text-center">
                                                <span class="badge bg-{{ $booking->flight_reservation ? 'success' : 'secondary' }}">
                                                    {{ $booking->flight_reservation ? 'Included' : 'Not Included' }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                @if($booking->flight_reservation && $booking->flightReservations)
                                                    ${{ number_format($booking->flightReservations->price ?? 0, 2) }}
                                                @else
                                                    $0.00
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-primary fw-semibold">Hotel Booking</td>
                                            <td class="text-center">
                                                <span class="badge bg-{{ $booking->hotel_booking ? 'success' : 'secondary' }}">
                                                    {{ $booking->hotel_booking ? 'Included' : 'Not Included' }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                @if($booking->hotel_booking && $booking->hotelBookings)
                                                    ${{ number_format($booking->hotelBookings->price ?? 0, 2) }}
                                                @else
                                                    $0.00
                                                @endif
                                            </td>
                                        </tr>

                                    @endif

                                       
                                        <tr>
                                            <td class="text-primary fw-semibold">Travel Guide</td>
                                            <td class="text-center">
                                                <span class="badge bg-{{ $booking->travel_guide ? 'success' : 'secondary' }}">
                                                    {{ $booking->travel_guide ? 'Included' : 'Not Included' }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                @if($booking->travel_guide && $booking->travelGuides)
                                                    ${{ number_format($booking->travelGuides->price ?? 0, 2) }}
                                                @else
                                                    $0.00
                                                @endif
                                            </td>
                                        </tr>
                                        @if($booking->urgent_reservation)
                                        <tr>
                                            <td class="text-primary fw-semibold">Urgent Processing</td>
                                            <td class="text-center">
                                                <span class="badge bg-warning">Urgent</span>
                                            </td>
                                            <td class="text-end">
                                                ${{ number_format($booking->urgent_reservation == 1 ? 30 : ($booking->urgent_reservation == 2 ? 15 : 0), 2) }}
                                            </td>

                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="mt-4">
                            <h5 class="mb-3">Order Summary</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm text-nowrap mb-0">
                                    <tbody>
                                        @php
                                            $subtotal = 0;
                                            if($booking->flight_reservation && $booking->flightReservations) {
                                                $subtotal += $booking->flightReservations->price ?? 0;
                                            }
                                            if($booking->hotel_booking && $booking->hotelBookings) {
                                                $subtotal += $booking->hotelBookings->price ?? 0;
                                            }
                                            if($booking->travel_insurance && $booking->travelInsurances) {
                                                $subtotal += $booking->travelInsurances->price ?? 0;
                                            }
                                            if($booking->travel_guide && $booking->travelGuides) {
                                                $subtotal += $booking->travelGuides->price ?? 0;
                                            }
                                            $urgentFee = 0;

                                            if ($booking->urgent_reservation == 1) {
                                                $urgentFee = 30;
                                            } elseif ($booking->urgent_reservation == 2) {
                                                $urgentFee = 15;
                                            } else {
                                                $urgentFee = 0;
                                            }

                                            $subtotal += $urgentFee;


                                            $discount = $booking->discount ?? 0;
                                            $total = $subtotal - $discount;
                                        @endphp

                                        <tr>
                                            <td colspan="2" class="text-end fw-semibold">Subtotal:</td>
                                            <td class="text-end">${{ number_format($subtotal, 2) }}</td>
                                        </tr>
                                        @if($discount > 0)
                                        <tr>
                                            <td colspan="2" class="text-end fw-semibold text-success">Discount:</td>
                                            <td class="text-end text-success">-${{ number_format($discount, 2) }}</td>
                                        </tr>
                                        @endif
                                        <tr class="table-warning">
                                            <td colspan="2" class="text-end fw-bold fs-5">Total:</td>
                                            <td class="text-end fw-bold fs-5">${{ number_format($total, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- container-fluid -->
</div> <!-- main-content -->
@endsection
