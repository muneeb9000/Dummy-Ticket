<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Review;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); 
        if (!$user->can('dashboard.view')) {
            abort(403, 'Unauthorized Access');
        }

        $dashboardStats = [];

        if ($user->can('total-blogs.view')) {
            $dashboardStats[] = [
                'title' => 'Total Blogs',
                'value' => Blog::count(),
                'color' => 'primary',
                'icon' => 'ti-package',
                'link' => route('admin.blogs.index'),
            ];
        }

        if ($user->can('total-faqs.view')) {
            $dashboardStats[] = [
                'title' => 'Total Faqs',
                'value' => Faq::count(),
                'color' => 'secondary',
                'icon' => 'ti-tag',
                'link' => route('admin.faqs.index'),
            ];
        }

        if ($user->can('total-reviews.view')) {
            $dashboardStats[] = [
                'title' => 'Total Reviews',
                'value' => Review::count(),
                'color' => 'primary',
                'icon' => 'bx bx-star side-menu__icon',
                'link' => route('admin.reviews.index'),
            ];
        }

        if ($user->can('total-users.view')) {
            $dashboardStats[] = [
                'title' => 'Total Users',
                'value' => User::count(),
                'color' => 'secondary',
                'icon' => 'ti-user',
                'link' => route('admin.users.index'),
            ];
        }

        // Booking Cards
        if ($user->can('flight-reservation.view')) {
            $dashboardStats[] = [
                'title' => 'Flight Bookings',
                'value' => Booking::where('type', 'FlightReservation')->count(),
                'color' => 'info',
                'icon' => 'ti-airplane',
                'link' => route('admin.bookings.index'),
            ];
        }

        if ($user->can('hotel-booking.view')) {
            $dashboardStats[] = [
                'title' => 'Hotel Bookings',
                'value' => Booking::where('type', 'HotelBooking')->count(),
                'color' => 'warning',
                'icon' => 'ti-home',
                'link' => route('admin.bookings.index'),
            ];
        }

        if ($user->can('flight-hotel.view')) {
            $dashboardStats[] = [
                'title' => 'Flight & Hotel Bookings',
                'value' => Booking::where('type', 'FlightAndHotelBooking')->count(),
                'color' => 'success',
                'icon' => 'ti-briefcase',
                'link' => route('admin.bookings.index'),
            ];
        }

        if ($user->can('insurance.view')) {
            $dashboardStats[] = [
                'title' => 'Travel Insurances',
                'value' => Booking::where('type', 'TravelInsurance')->count(),
                'color' => 'danger',
                'icon' => 'ti-shield',
                'link' => route('admin.bookings.index'),
            ];
        }

        if ($user->can('guide.view')) {
            $dashboardStats[] = [
                'title' => 'Travel Guides',
                'value' => Booking::where('type', 'TravelGuides')->count(),
                'color' => 'dark',
                'icon' => 'ti-map',
                'link' => route('admin.bookings.index'),
            ];
        }
        $bookingChartData = $this->getBookingChartData($user);
        return view('admin.dashboard.index', compact('dashboardStats', 'user','bookingChartData'));
    }



    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048' 
        ]);

        $path = $request->file('file')->store('blog-images', 'public');
        $url = Storage::disk('public')->url($path);

        return response()->json([
            'url' => $url
        ]);
    }

     protected function getBookingChartData($user)
    {
        $chartData = [
            'labels' => [],
            'datasets' => []
        ];

        // Get last 6 months
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->push(now()->subMonths($i)->format('M Y'));
        }
        $chartData['labels'] = $months;

        // Booking types with permissions and colors
        $bookingTypes = [
            'FlightReservation' => [
                'permission' => 'flight-reservation.view',
                'label' => 'Flights',
                'color' => 'rgba(54, 162, 235, 0.7)',
                'border' => 'rgb(54, 162, 235)'
            ],
            'HotelBooking' => [
                'permission' => 'hotel-booking.view',
                'label' => 'Hotels',
                'color' => 'rgba(255, 99, 132, 0.7)',
                'border' => 'rgb(255, 99, 132)'
            ],
            'FlightAndHotelBooking' => [
                'permission' => 'flight-hotel.view',
                'label' => 'Flight+Hotel',
                'color' => 'rgba(75, 192, 192, 0.7)',
                'border' => 'rgb(75, 192, 192)'
            ],
            'TravelInsurance' => [
                'permission' => 'insurance.view',
                'label' => 'Insurance',
                'color' => 'rgba(153, 102, 255, 0.7)',
                'border' => 'rgb(153, 102, 255)'
            ],
            'TravelGuides' => [
                'permission' => 'guide.view',
                'label' => 'Guides',
                'color' => 'rgba(255, 159, 64, 0.7)',
                'border' => 'rgb(255, 159, 64)'
            ],
        ];

        foreach ($bookingTypes as $type => $config) {
            if ($user->can($config['permission'])) {
                $data = [];
                for ($i = 5; $i >= 0; $i--) {
                    $start = now()->subMonths($i)->startOfMonth();
                    $end = now()->subMonths($i)->endOfMonth();
                    
                    $data[] = Booking::where('type', $type)
                        ->whereBetween('created_at', [$start, $end])
                        ->count();
                }

                $chartData['datasets'][] = [
                    'label' => $config['label'],
                    'data' => $data,
                    'backgroundColor' => $config['color'],
                    'borderColor' => $config['border'],
                    'borderWidth' => 1,
                    'tension' => 0.4,
                    'fill' => true
                ];
            }
        }

        return $chartData;
    }
}
