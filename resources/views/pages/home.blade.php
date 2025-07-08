<x-app-layout>
    <div>
        <div class="mx-auto my-container">
            <div class="grid grid-cols-1 md:grid-cols-2 h-auto md:h-[500px] gap-8 p-6">
                
                <div class="flex flex-col justify-center gap-4">
                    <h1 class="text-[36px] md:text-[46px] font-[700] text-primary">
                        Looking For Flight <br class="hidden md:block" /> Reservation Hotel <br class="hidden md:block" />
                        Bookings
                    </h1>

                    <p class="text-[18px] font-[500] text-[#06202B]">
                        Flight reservation for visa without paying for the actual ticket and
                        hotel bookings from us for your visa application process.
                    </p>

                    <p class="text-[18px] font-[500] text-[#06202B]">
                        2 Weeks Validity – Verifiable On Airlines Website – Fast Email
                        Delivery – 24/7 Customer Support. We provide services for all
                        countries worldwide.
                    </p>

                    <div class="flex gap-9">
                        <button
                            class="flex items-center justify-center gap-2 px-7 py-3 rounded-[5px] bg-[#F4BD0F] text-primary font-bold text-[16px]"
                            style="box-shadow: -5px 5px 0px 0px #00000099"
                        >
                            Flight Itinerary 
                        </button>
                        <button
                            class="flex items-center justify-center gap-2 px-7 py-3 rounded-[5px] bg-white text-primary border-primary border-1 font-bold text-[16px]"
                        >
                            Hotel Booking 
                        </button>
                    </div>
                    
                    <div>
                        <img
                            src="{{ asset('assets/Trust-pilot-logo.png') }}"
                            alt="Trust Pilot Logo"
                            class="mt-4"
                        />
                    </div>
                </div>

                <div class="flex items-center justify-center">
                    <img
                        src="{{ asset('assets/Header-Plane.png') }}"
                        alt="header plane"
                        class="max-w-full h-auto"
                    />
                </div>
            </div>
        </div>
        
        <div class="my-container mt-22">
            <div>
                <h2 class="text-center text-[46px] font-[700] text-primary my-8">
                    Our Services
                </h2>
                <p>
                    All our flight itineraries are verifiable and can be confirmed from airline <br />
                    websites through the unique reservation code we provide on the itinerary document.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
