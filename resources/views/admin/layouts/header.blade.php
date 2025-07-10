<!-- app-header -->
<header class="app-header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="{{ route('admin.dashboard') }}" class="header-logo d-block">
                        <img src="{{ asset('assets/main-logo.webp') }}" alt="logo" class="desktop-logo">
                        <img src="{{ asset('assets/main-logo.webp') }}" alt="logo"
                            class="toggle-logo">
                        <img src="{{ asset('assets/main-logo.webp') }}" alt="logo" class="desktop-dark">
                        <img src="{{ asset('assets/main-logo.webp') }}" alt="logo"
                            class="toggle-dark">
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link -->
                <a aria-label="Hide Sidebar"
                    class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                    data-bs-toggle="sidebar" href="javascript:void(0);">
                    <span></span>
                </a>
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <div class="header-content-right">

            <!-- Start:: Notification Section -->
            @if (session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        iziToast.success({
                            message: @json(session('success')),
                            position: 'topRight',
                            timeout: 3000,
                            backgroundColor: '#5cd174',
                            color: '#fff',
                            titleColor: '#fff',
                            messageColor: '#fff',
                            icon: 'fa fa-check-circle',
                            transitionIn: 'fadeInDown',
                            transitionOut: 'fadeOutUp',
                            class: 'custom-toast',
                        });
                    });
                </script>
            @endif

            @if (session('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        iziToast.error({
                            message: {
                                !!json_encode(session('error')) !!
                            },
                            position: 'topRight',
                            timeout: 3000,
                            backgroundColor: '#e55353',
                            color: '#fff',
                            icon: 'fa fa-times-circle',
                            transitionIn: 'fadeInDown',
                            transitionOut: 'fadeOutUp',
                            class: 'custom-toast',
                        });
                    });
                </script>
            @endif


        </div>
        <!-- End::header-content-right -->
        <!-- Start::header-content-right -->
        <div class="header-content-right">

            <!-- Start::header-element -->
            <div class="header-element header-theme-mode">
                <!-- Start::header-link|layout-setting -->
                <a href="javascript:void(0);" class="header-link layout-setting">
                    <span class="light-layout">
                        <!-- Start::header-link-icon -->
                        <i class="bx bx-moon header-link-icon"></i>
                        <!-- End::header-link-icon -->
                    </span>
                    <span class="dark-layout">
                        <!-- Start::header-link-icon -->
                        <i class="bx bx-sun header-link-icon"></i>
                        <!-- End::header-link-icon -->
                    </span>
                </a>
                <!-- End::header-link|layout-setting -->
            </div>
            <!-- End::header-element -->

        
            <!-- Start::header-element -->
            <div class="header-element header-fullscreen">
                <!-- Start::header-link -->
                <a onclick="openFull();" href="#" class="header-link">
                    <i class="bx bx-fullscreen full-screen-open header-link-icon"></i>
                    <i class="bx bx-exit-fullscreen full-screen-close header-link-icon d-none"></i>
                </a>
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->
            @php
                $user = Auth::user();
            @endphp
            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="#" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div class="me-sm-2 me-0">
                            <img src="{{ $user->getProfileImage() }}" alt="img" width="32" height="32"
                                class="rounded-circle">
                        </div>
                        <div class="d-sm-block d-none">
                            <p class="fw-semibold mb-0 lh-1">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                </a>
                <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                    aria-labelledby="mainHeaderProfile">

                    <li><a class="dropdown-item d-flex" href="{{ route('admin.profile.show') }}"><i
                                class="ti ti-user-circle fs-18 me-2 op-7"></i>Profile</a>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ti ti-logout fs-18 me-2 op-7"></i>Log Out
                        </a>

                        <!-- Hidden logout form -->
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            <!-- End::header-element -->
        </div>
        <!-- End::header-content-right -->
    </div>
    <!-- End::main-header-container -->
</header>
<script>
    // Apply theme immediately to prevent flash
    (function() {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark');
            document.documentElement.setAttribute('data-theme-mode', 'dark');
            document.documentElement.setAttribute('data-header-styles', 'dark');
            document.documentElement.setAttribute('data-menu-styles', 'dark');
        }
    })();

    // Dark mode toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggle = document.querySelector('.header-theme-mode .layout-setting');
        const body = document.body;
        const html = document.documentElement;

        // Check for saved theme preference and update icons
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            enableDarkMode();
        } else {
            enableLightMode();
        }

        // Theme toggle click handler
        if (themeToggle) {
            themeToggle.addEventListener('click', function(e) {
                e.preventDefault();

                if (html.getAttribute('data-theme-mode') === 'dark' || body.classList.contains(
                    'dark')) {
                    // Switch to light mode
                    enableLightMode();
                    localStorage.setItem('theme', 'light');
                } else {
                    // Switch to dark mode
                    enableDarkMode();
                    localStorage.setItem('theme', 'dark');
                }
            });
        }

        function enableDarkMode() {
            // Add dark classes that your CSS framework expects
            body.classList.add('dark');
            html.classList.add('dark');
            html.setAttribute('data-theme-mode', 'dark');
            html.setAttribute('data-header-styles', 'dark');
            html.setAttribute('data-menu-styles', 'dark');

            // Show sun icon (for switching back to light)
            const lightLayout = document.querySelector('.light-layout');
            const darkLayout = document.querySelector('.dark-layout');
            if (lightLayout) lightLayout.style.display = 'none';
            if (darkLayout) darkLayout.style.display = 'block';
        }

        function enableLightMode() {
            // Remove dark classes
            body.classList.remove('dark');
            html.classList.remove('dark');
            html.setAttribute('data-theme-mode', 'light');
            html.setAttribute('data-header-styles', 'light');
            html.setAttribute('data-menu-styles', 'dark');

            // Show moon icon (for switching to dark)
            const lightLayout = document.querySelector('.light-layout');
            const darkLayout = document.querySelector('.dark-layout');
            if (lightLayout) lightLayout.style.display = 'block';
            if (darkLayout) darkLayout.style.display = 'none';
        }
    });

    // Fullscreen functionality
    function openFull() {
        const elem = document.documentElement;
        const fullScreenOpenIcon = document.querySelector('.full-screen-open');
        const fullScreenCloseIcon = document.querySelector('.full-screen-close');

        if (!document.fullscreenElement && !document.webkitFullscreenElement &&
            !document.mozFullScreenElement && !document.msFullscreenElement) {
            // Enter fullscreen
            if (elem.requestFullscreen) {
                elem.requestFullscreen().catch(err => {
                    console.log(`Error attempting to enable fullscreen: ${err.message}`);
                });
            } else if (elem.webkitRequestFullscreen) {
                /* Safari */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                /* IE11 */
                elem.msRequestFullscreen();
            } else if (elem.mozRequestFullScreen) {
                /* Firefox */
                elem.mozRequestFullScreen();
            }

            // Toggle icons
            if (fullScreenOpenIcon) fullScreenOpenIcon.classList.add('d-none');
            if (fullScreenCloseIcon) fullScreenCloseIcon.classList.remove('d-none');
        } else {
            // Exit fullscreen
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                /* Safari */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                /* IE11 */
                document.msExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                /* Firefox */
                document.mozCancelFullScreen();
            }

            // Toggle icons
            if (fullScreenOpenIcon) fullScreenOpenIcon.classList.remove('d-none');
            if (fullScreenCloseIcon) fullScreenCloseIcon.classList.add('d-none');
        }
    }

    // Listen for fullscreen changes to update icons accordingly
    document.addEventListener('fullscreenchange', handleFullscreenChange);
    document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
    document.addEventListener('mozfullscreenchange', handleFullscreenChange);
    document.addEventListener('MSFullscreenChange', handleFullscreenChange);

    function handleFullscreenChange() {
        const fullScreenOpenIcon = document.querySelector('.full-screen-open');
        const fullScreenCloseIcon = document.querySelector('.full-screen-close');

        if (!document.fullscreenElement && !document.webkitFullscreenElement &&
            !document.mozFullScreenElement && !document.msFullscreenElement) {
            // Exited fullscreen
            fullScreenOpenIcon.classList.remove('d-none');
            fullScreenCloseIcon.classList.add('d-none');
        } else {
            // Entered fullscreen
            fullScreenOpenIcon.classList.add('d-none');
            fullScreenCloseIcon.classList.remove('d-none');
        }
    }
</script>
