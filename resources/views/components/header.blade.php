<div>
    <header class="my-container mt-8">
        <div class="flex items-center justify-between">
            <a href="{{ route('website.home') }}">
                <img src="{{ asset('assets/main-logo.webp') }}" alt="Logo image" />
            </a>

            <div class="sm:hidden">
                <button id="menu-toggle" class="text-primary text-2xl">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <ul class="hidden sm:flex gap-9 text-primary text-[16px] font-[500] mx-auto" id="nav-menu">
                <li>
                    <a href="#">Pricing</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="{{ route('website.faqs') }}">FAQs</a>
                </li>
                <li>
                    <a href="#">Blogs</a>
                </li>
                <li>
                    <a href="{{ route('website.reviews') }}">Reviews</a>
                </li>
                <li>
                    <a href="{{ route('website.contact') }}">Contact Us</a>
                </li>
            </ul>

            <div class="hidden sm:flex items-center gap-8">
                <i class="fa fa-magnifying-glass text-lg text-primary"></i>
                <button
                    class="flex items-center justify-center gap-2 px-4 py-2 rounded-[5px] bg-[#F4BD0F] text-primary font-[Quicksand] font-bold text-[16px]"
                    style='box-shadow: -5px 5px 0px 0px #00000099'>
                    +1 (302) 219-0076
                </button>
            </div>
        </div>
    </header>
</div>