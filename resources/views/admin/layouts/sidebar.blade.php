<aside class="app-sidebar sticky" id="sidebar">
    <div class="main-sidebar-header text-center">
        <a href="{{ route('admin.dashboard') }}/" class="header-logo d-block">
            <img src="{{ asset('assets/main-logo.webp') }}" alt="logo" class="desktop-logo"
                style="background-color: white; padding: 4px; border-radius: 4px;">
            <img src="{{ asset('assets/flightreservationservices.webp') }}" alt="logo" class="toggle-logo">
            <img src="{{ asset('assets/main-logo.webp') }}" alt="logo" class="desktop-dark"
                style="background-color: white; padding: 4px; border-radius: 4px;">
            <img src="{{ asset('assets/flightreservationservices.webp') }}" alt="logo" class="toggle-dark">
        </a>
    </div>

    <div class="main-sidebar" id="sidebar-scroll">
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">...</div>
            <ul class="main-menu">

                @can('dashboard.view')
                <li class="slide has-sub">
                    <a href="{{ route('admin.dashboard') }}/" class="side-menu__item">
                        <i class="bx bxs-dashboard side-menu__icon"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="{{ route('admin.dashboard') }}/">Dashboard</a>
                        </li>
                    </ul>
                </li>
                @endcan

                @can('faqs-categories.view')
                <li class="slide">
                    <a href="{{ route('admin.faqs.categories.index') }}/" class="side-menu__item">
                        <i class="bx bx-category side-menu__icon"></i>
                        <span class="side-menu__label">FAQ Categories</span>
                    </a>
                </li>
                @endcan

                @can('faqs.view')
                <li class="slide">
                    <a href="{{ route('admin.faqs.index') }}/" class="side-menu__item">
                        <i class="bx bx-help-circle side-menu__icon"></i>
                        <span class="side-menu__label">FAQs</span>
                    </a>
                </li>
                @endcan

                @can('blog-categories.view')
                <li class="slide">
                    <a href="{{ route('admin.blog-categories.index') }}/" class="side-menu__item">
                        <i class="bx bx-category side-menu__icon"></i>
                        <span class="side-menu__label">Blogs Categories</span>
                    </a>
                </li>
                @endcan

                @can('blogs.view')
                <li class="slide">
                    <a href="{{ route('admin.blogs.index') }}/" class="side-menu__item">
                        <i class="bx bx-news side-menu__icon"></i>
                        <span class="side-menu__label">Blogs</span>
                    </a>
                </li>
                @endcan
                @can('seo.view') 
                <li class="slide">
                    <a href="{{ route('admin.pages.index') }}/" class="side-menu__item">
                        <i class="bx bx-file side-menu__icon"></i>
                        <span class="side-menu__label">SEO Pages</span>
                    </a>
                </li>
                 @endcan 

                @can('reviews.view')
                <li class="slide">
                    <a href="{{ route('admin.reviews.index') }}/" class="side-menu__item">
                        <i class="bx bx-star side-menu__icon"></i>
                        <span class="side-menu__label">Reviews</span>
                    </a>
                </li>
                @endcan

                @can('coupons.view')
                <li class="slide">
                    <a href="{{ route('admin.coupons.index') }}/" class="side-menu__item">
                        <i class="bi bi-ticket-perforated side-menu__icon"></i>
                        <span class="side-menu__label">Coupons</span>
                    </a>
                </li>
                @endcan

                @can('media.view')
                <li class="slide">
                    <a href="{{ route('admin.media.index') }}/" class="side-menu__item">
                        <i class="bx bx-photo-album side-menu__icon"></i>
                        <span class="side-menu__label">Media Library</span>
                    </a>
                </li>
                @endcan

                @can('visa-flags.view')
                <li class="slide">
                    <a href="{{ route('admin.flags.index') }}/" class="side-menu__item">
                        <i class="bx bx-flag side-menu__icon"></i>
                        <span class="side-menu__label">Visa Flags</span>
                    </a>
                </li>
                @endcan

                @can('bookings.view')
                <li class="slide">
                    <a href="{{ route('admin.bookings.index') }}/" class="side-menu__item">
                        <i class="bx bx-calendar side-menu__icon"></i>
                        <span class="side-menu__label">Bookings</span>
                    </a>
                </li>
                @endcan

            @can('custom-payment.view')
                <li class="slide">
                    <a href="{{ route('admin.custom.payments.index') }}/" class="side-menu__item">
                        <i class="bx bx-credit-card side-menu__icon"></i>
                        <span class="side-menu__label">Custom Payment</span>
                    </a>
                </li>
            @endcan

                @can('inquiries.view')
                <li class="slide">
                    <a href="{{ route('admin.inquiries.index') }}/" class="side-menu__item">
                        <i class="bx bx-help-circle side-menu__icon"></i>
                        <span class="side-menu__label">Inquiries</span>
                    </a>
                </li>
                @endcan

                @can('roles.view')
                <li class="slide">
                    <a href="{{ route('admin.roles.index') }}/" class="side-menu__item">
                        <i class="bx bx-lock-alt side-menu__icon"></i>
                        <span class="side-menu__label">Roles & Permission</span>
                    </a>
                </li>
                @endcan
                 @can('snippets.view')
                <li class="slide">
                    <a href="{{ route('admin.snippets.index') }}/" class="side-menu__item">
                        <i class="bx bx-code side-menu__icon"></i>
                        <span class="side-menu__label">Snippets</span>
                    </a>
                </li>
                @endcan
               @can('redirector.view')
                <li class="slide">
                    <a href="{{ route('admin.redirector.index') }}/" class="side-menu__item">
                        <i class="bx bx-redo side-menu__icon"></i>
                        <span class="side-menu__label">Redirector</span>
                    </a>
                </li>
            @endcan


                @can('admin.view')
                {{-- Admins route without permission as it's not seeded --}}
                <li class="slide">
                    <a href="{{ route('admin.users.index') }}/" class="side-menu__item">
                        <i class="bx bx-user-circle side-menu__icon"></i>
                        <span class="side-menu__label">Admins</span>
                    </a>
                </li>
                @endcan
                <!-- settings -->
                @can('settings.view')
                <li class="slide">
                    <a href="{{ route('admin.settings.edit') }}/" class="side-menu__item">
                        <i class="bx bx-cog side-menu__icon"></i>
                        <span class="side-menu__label">Settings</span>
                    </a>
                </li>
                @endcan

            </ul>
            <div class="slide-right" id="slide-right">...</div>
        </nav>
    </div>
</aside>
