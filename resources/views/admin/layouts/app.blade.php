<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark" data-toggled="close">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Dummy Ticket') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
          <meta name="robots" content="noindex,nofollow">
    <meta name="description"
        content="Dummy Ticket - Your trusted platform for accurate and affordable flight reservation details for visa applications and travel planning.">
    <meta name="author" content="Dummy Ticket">
    <meta name="keywords"
        content="flight itinerary, visa support, flight reservation, travel itinerary, dummy ticket, visa application support, flight booking, travel proof">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/fifv-admin-hide.webp') }}" type="image/x-icon">

    <!-- Stylesheets -->
    <link id="style" href="{{ asset('admin/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- cdn -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('admin/css/styles.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/libs/node-waves/waves.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
    <link rel="stylesheet" href="{{ asset('admin/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/libs/@simonwep/pickr/themes/nano.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/libs/choices.js/public/assets/styles/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/libs/jsvectormap/css/jsvectormap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/libs/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <!-- toast css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
                document.documentElement.setAttribute('data-theme-mode', 'dark');
                document.documentElement.setAttribute('data-header-styles', 'dark');
                document.documentElement.setAttribute('data-menu-styles', 'dark');
            }
        })();
    </script>

    @stack('styles')
</head>

<body>
    <div class="page">
        <!-- Include Header -->
        @include('admin.layouts.header')

        <div class="main-content">
            <!-- Include Sidebar -->
            @include('admin.layouts.sidebar')

            <main class="py-4">
                <!-- Main Content Area -->
                @yield('content')
            </main>

            <!-- Include Footer -->
            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- Scroll to Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>

    <!-- Scripts -->

    <script src="{{ asset('admin/libs/@popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/defaultmenu.min.js') }}"></script>
    <script src="{{ asset('admin/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin/js/sticky.js') }}"></script>
    <script src="{{ asset('admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/js/simplebar.js') }}"></script>
    <script src="{{ asset('admin/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
    <script src="{{ asset('admin/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('admin/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('admin/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/libs/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('admin/js/crm-dashboard.js') }}"></script>
    <script src="{{ asset('admin/js/custom-switcher.min.js') }}"></script>
    <script src="{{ asset('admin/js/custom.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="{{ asset('admin/js/datatables.js') }}"></script>
    <!-- toastify cdn -->
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

    @stack('scripts')
</body>

</html>
