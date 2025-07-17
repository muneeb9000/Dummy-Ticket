<x-app-layout>
    <div>
        <div class="my-container">
            <div class="grid grid-cols-1 md:grid-cols-2 h-auto md:h-[500px] gap-0 pt-14">
                <!-- Left Column with Cloud Background -->
                <div class="relative flex flex-col justify-center gap-3 px-4 md:px-0">
                    <!-- Cloud Background Image -->
                    <img src="{{ asset('assets/text-cloud.png') }}" alt="Cloud Background"
                        class="absolute -left-20 md:-left-40 w-[120%] md:w-full -z-10 max-w-none opacity-20" />

                    <!-- Text Content -->
                    <div class="relative z-10">
                        <!-- Added z-10 to ensure text stays above cloud -->
                        <h1 class="text-[36px] md:text-[46px] font-[700] text-primary leading-tight">
                            Looking For Flight <br>
                            Reservation Hotel <br>
                            Bookings
                        </h1>

                        <p class="text-[18px] font-[500] text-[#06202B]">
                            Flight reservation for visa without paying for the actual ticket <br
                                class="hidden md:block" />
                            and hotel bookings from us for your visa application process.
                        </p>

                        <p class="text-[18px] font-[500] text-[#06202B] mt-4">
                            2 Weeks Validity – Verifiable On Airlines Website – Fast Email <br
                                class="hidden md:block" />
                            Delivery – 24/7 Customer Support. We provide services for <br class="hidden md:block" />
                            all countries worldwide.
                        </p>
                        <!-- Buttons container with relative positioning -->
                        <div class="relative z-10 flex gap-9 flex-wrap mt-14">
                            <button
                                class="flex items-center justify-center gap-2 px-7 py-3 rounded-[5px] bg-[#F4BD0F] text-primary font-bold text-[16px]"
                                style="box-shadow: -5px 5px 0px 0px #00000099">
                                Flight Itinerary
                            </button>
                            <button
                                class="flex items-center justify-center gap-2 px-7 py-3 rounded-[5px] bg-white text-primary border-primary border-[1px] font-bold text-[16px]">
                                Hotel Booking
                            </button>
                        </div>

                        <div>
                            <img src="{{ asset('assets/Trust-pilot-logo.png') }}" alt="Trust Pilot Logo" class="mt-4" />
                        </div>
                    </div>
                </div>

                <!-- Right Column with Plane Image -->
                <div class="relative h-[300px] md:h-auto">
                    <img src="{{ asset('assets/Header-Plane.png') }}" alt="header plane"
                        class="absolute top-0 right-0 md:-right-20 h-full w-auto object-cover max-w-none" />
                </div>
            </div>
            <!-- cloud-2 image -->
        </div>
        <div>
            <img src="{{asset('assets/cloud-2.png')}}" alt=""
                class="absolute top-[350px] w-full -z-10 opacity-80 ">
        </div>

        <!-- <div class="my-container pt-24">
            <div>
                <h2 class="text-center text-[46px] font-[700] text-primary my-8">
                    Our Services
                </h2>
                <p class="text-center">
                    Added text-center -->
                    <!-- All our flight itineraries are verifiable and can be confirmed from airline <br />
                    websites through the unique reservation code we provide on the itinerary document. -->
                <!-- </p>
            </div>
        </div> --> 
    </div>
</x-app-layout>