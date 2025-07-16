<x-app-layout>
    <style>
    body {
        background-color: #f2f2f2
    }
    </style>
    <div class=" font-poppins">
        <div class="bg-gradient-to-r from-[#F4D36B] to-[#D3F5FF] min-h-[382px] mt-8">
            <div class='my-container'>
                <div class="grid grid-cols-1 md:grid-cols-2 p-4 md:p-10">
                    <!-- Left Div -->
                    <div
                        class="justify-self-center p-4 md:p-6 rounded-lg w-full md:w-[690px] text-left h-auto space-y-4 mt-2 md:mt-2">
                        <h1 class="text-2xl font-[700] md:text-[32px] ">
                            Dummy Visa Ticket FAQs
                        </h1>
                        <p class="text-base md:text-lg font-[500] leading-loose">
                            Get quick answers about our flight itineraries, hotel bookings,
                            travel insurance, and other visa-related services. We've got you
                            covered for any country, anytime.
                        </p>

                        <div
                            class="flex flex-col sm:flex-row bg-amber-50 mt-4 rounded-md overflow-hidden h-auto sm:h-[60px]">
                            <input type="text" placeholder="Type your question"
                                class="w-full px-4 py-2 focus:outline-none border-none " />
                            <button
                                class="flex items-center justify-center px-8 m-[8px] rounded-[5px] bg-[#F4BD0F] cursor-pointer text-primary  font-bold text-[16px]"
                                style="box-shadow: -5px 5px 0px 0px #00000099">
                                <i class="fas fa-paper-plane mr-2 text-primary text-xl rotate-6">&nbsp
                                </i> Search
                            </button>
                        </div>
                    </div>

                    <!-- Right Div -->
                    <div class="flex justify-end p-4 md:p-6 rounded-lg w-full h-auto">
                        <img src="{{ asset('assets/FAQ.webp') }}" alt="FAQ Image" class="w-full h-auto max-w-[400px]" />
                    </div>

                </div>

            </div>
        </div>
        <div class='my-container'>
            <div class="flex justify-center w-full h-auto mt-16 py-6">
                <div
                    class="w-[90%] md:w-[80%] flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-2">
                    <!-- Icon / Logo -->
                    <span>
                        <img class="w-[40px] sm:w-[50px] h-[40px] sm:h-[50px]"
                            src="{{ asset('assets/general-question.webp') }}" alt="logo" />
                    </span>

                    <!-- Heading + Line -->
                    <span class="text-center">
                        <h1 style="font-family: Poppins" class="text-2xl sm:text-3xl font-semibold text-primary">
                            General Questions
                        </h1>
                        <hr class="mx-auto w-[100px] sm:w-[152px] border-[2px] border-[#F4BD0F] mt-2 rounded-full" />
                    </span>
                </div>
            </div>

            <div class="font-poppins">
                <!-- FAQ Items Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-4 sm:px-6 md:px-8 mt-8 max-w-6xl mx-auto">
                    <!-- Column 1 -->
                    <div class="space-y-4">
                        <!-- Question 1 -->
                        <div x-data="{ open: true }"
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 transition-all duration-300">
                            <div class="flex gap-4 items-start">
                                <!-- Toggle Button -->
                                <button @click="open = !open"
                                    class="mt-0.5 text-[#F4BD0F] focus:outline-none transition-transform duration-300"
                                    :class="{ 'rotate-0': open, 'rotate-90': !open }">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Content -->
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        What is the actual purpose of submitting flight reservation to embassy for visa?
                                    </h3>
                                    <div x-show="open" x-collapse class="mt-3 text-gray-600">
                                        <p>The actual purposes of submitting a flight reservation are for a diplomatic
                                            officer to understand the traveler's intent, route schedule,
                                            departure/return timing, and name printed on documents.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div x-data="{ open: false }"
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 transition-all duration-300">
                            <div class="flex gap-4 items-start">
                                <button @click="open = !open"
                                    class="mt-0.5 text-[#F4BD0F] focus:outline-none transition-transform duration-300"
                                    :class="{ 'rotate-0': open, 'rotate-90': !open }">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        WHERE WILL I RECEIVE MY ITINERARY DOCUMENTS?
                                    </h3>
                                    <div x-show="open" x-collapse class="mt-3 text-gray-600">
                                        <p>You'll receive your itinerary documents on your provided email within the
                                            promised timeframe.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2 -->
                    <div class="space-y-4">
                        <!-- Question 3 -->
                        <div x-data="{ open: false }"
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 transition-all duration-300">
                            <div class="flex gap-4 items-start">
                                <button @click="open = !open"
                                    class="mt-0.5 text-[#F4BD0F] focus:outline-none transition-transform duration-300"
                                    :class="{ 'rotate-0': open, 'rotate-90': !open }">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        Is your flight itinerary verifiable?
                                    </h3>
                                    <div x-show="open" x-collapse class="mt-3 text-gray-600">
                                        <p>Yes, our itineraries are verifiable directly through the airline's website or
                                            customer support.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Question 4 -->
                        <div x-data="{ open: false }"
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 transition-all duration-300">
                            <div class="flex gap-4 items-start">
                                <button @click="open = !open"
                                    class="mt-0.5 text-[#F4BD0F] focus:outline-none transition-transform duration-300"
                                    :class="{ 'rotate-0': open, 'rotate-90': !open }">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        How many times are changes/corrections allowed?
                                    </h3>
                                    <div x-show="open" x-collapse class="mt-3 text-gray-600">
                                        <p>We allow corrections within 24 hours of delivery. After that, a small service
                                            fee may apply.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Question 5 -->
                        <div x-data="{ open: false }"
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 transition-all duration-300">
                            <div class="flex gap-4 items-start">
                                <button @click="open = !open"
                                    class="mt-0.5 text-[#F4BD0F] focus:outline-none transition-transform duration-300"
                                    :class="{ 'rotate-0': open, 'rotate-90': !open }">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        How long will it take to get my itinerary document?
                                    </h3>
                                    <div x-show="open" x-collapse class="mt-3 text-gray-600">
                                        <p>Standard delivery time is 6-8 hours for normal orders and 2-3 hours for
                                            urgent ones.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Flight Reservation -->
            <div class="flex justify-center w-full h-auto py-6 mt-12">
                <div
                    class="w-[90%] md:w-[80%] flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-2">
                    <!-- Icon / Logo -->
                    <span>
                        <img class="w-[40px] sm:w-[50px] h-[40px] sm:h-[50px]"
                            src="{{ asset('assets/flight-reservation.webp') }}" alt="logo" />
                    </span>

                    <!-- Heading + Line -->
                    <span class="text-center">
                        <h1 style="font-family: Poppins" class="text-2xl sm:text-3xl mt-4 font-semibold text-primary">
                            Flight Reservation
                        </h1>
                        <hr class="mx-auto w-[100px] sm:w-[152px] border-[2px] border-[#F4BD0F] mt-2 rounded-full" />
                    </span>
                </div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-[80%] mx-auto mt-4 p-4">
                <!-- Column 1 -->
                <div class="grid grid-rows-3 gap-4  h-[340px]">
                    <!-- Row 1: Double Height -->
                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-black-600">
                                    HOW LONGER IT WILL TAKE TO GET MY ITINERARY DOCUMENT?
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="bg-white p-4  flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-black-600">
                                    WHERE I WILL RECEIVE MY ITINERARY DOCUMENTS?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 2 -->
                <div class="grid grid-rows-3 gap-4">
                    <!-- Row 1 -->
                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <p class="text-black-600">Is YOUR FLIGHT ITINERARY
                                    VERIFIABLE?</p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-black-600">
                                    How MANY TIMES CHANGES/CORRECTIONS ARE ALLOWED?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- hotel Booking -->

            <div class="flex justify-center w-full h-auto  ">
                <div
                    class="w-[90%] md:w-[80%] flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 ">
                    <!-- Icon / Logo -->
                    <span>
                        <img class="w-[40px] sm:w-[50px] h-[40px] sm:h-[50px]"
                            src="{{ asset('assets/hotel-booking.webp') }}" alt="logo" />
                    </span>

                    <!-- Heading + Line -->
                    <span class="text-center">
                        <h1 style="font-family: Poppins" class="text-2xl sm:text-3xl   font-semibold text-primary">
                            Hotel Booking
                        </h1>
                        <hr class="mx-auto w-[100px] sm:w-[152px] border-[2px] border-[#F4BD0F] mt-2 rounded-full" />
                    </span>
                </div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-[80%] mx-auto mt-8 p-4">
                <!-- Column 1 -->
                <div class="grid grid-rows-3 gap-4  h-[340px]">
                    <!-- Row 1: Double Height -->
                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-black-600">
                                    HOW LONGER IT WILL TAKE TO GET MY ITINERARY DOCUMENT?
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="bg-white p-4  flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-black-600">
                                    WHERE I WILL RECEIVE MY ITINERARY DOCUMENTS?
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- row 3 -->
                    <div class="bg-white p-4  flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-black-600">
                                    WHERE I WILL RECEIVE MY ITINERARY DOCUMENTS?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Column 2 -->
                <div class="grid grid-rows-3 gap-4">
                    <!-- Row 1 -->
                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <p class="text-black-600">Is YOUR FLIGHT ITINERARY
                                    VERIFIABLE?
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-black-600">
                                    How MANY TIMES CHANGES/CORRECTIONS ARE ALLOWED?
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3 -->

                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-black-600">
                                    HOW LONGER IT WILL TAKE TO GET MY ITINERARY DOCUMENT?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <!-- travel insurance -->
            <div class="flex justify-center w-full h-auto py-6 mt-12">
                <div
                    class="w-[90%] md:w-[80%] flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-8">
                    <!-- Icon / Logo -->
                    <span>
                        <img class="w-[40px] sm:w-[50px] h-[40px] sm:h-[50px]"
                            src="{{ asset('assets/travel-insurance.webp') }}" alt="logo" />
                    </span>

                    <!-- Heading + Line -->
                    <span class="text-center">
                        <h1 style="font-family: Poppins" class="text-2xl sm:text-3xl mt-4 font-semibold text-primary">
                            Travel Insursance
                        </h1>
                        <hr class="mx-auto w-[100px] sm:w-[152px] border-[2px] border-[#F4BD0F] mt-2 rounded-full" />
                    </span>
                </div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-[80%] mx-auto mt-4 p-4">
                <!-- Column 1 -->
                <div class="grid grid-rows-3 gap-4  h-[340px]">
                    <!-- Row 1: Double Height -->
                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-black-600">
                                    HOW LONGER IT WILL TAKE TO GET MY ITINERARY DOCUMENT?
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="bg-white p-4  flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-black-600">
                                    WHERE I WILL RECEIVE MY ITINERARY DOCUMENTS?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 2 -->
                <div class="grid grid-rows-3 gap-4">
                    <!-- Row 1 -->
                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <p style="font-family: 'Poppins'" class="text-black-600">Is YOUR FLIGHT ITINERARY
                                    VERIFIABLE?
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p style="font-family: 'Poppins'" class="text-black-600">
                                    How MANY TIMES CHANGES/CORRECTIONS ARE ALLOWED?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Travel Guide -->
            <div class="flex justify-center w-full h-auto py-6 ">
                <div
                    class="w-[90%] md:w-[80%] flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 ">
                    <!-- Icon / Logo -->
                    <span>
                        <img class="w-[40px] sm:w-[50px] h-[40px] sm:h-[50px]"
                            src="{{ asset('assets/travel-guides.webp') }}" alt="logo" />
                    </span>

                    <!-- Heading + Line -->
                    <span class="text-center">
                        <h1 style="font-family: Poppins" class="text-2xl sm:text-3xl  font-semibold text-primary">
                            Travel Guide
                        </h1>
                        <hr class="mx-auto w-[100px] sm:w-[152px] border-[2px] border-[#F4BD0F] mt-2 rounded-full" />
                    </span>
                </div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-[80%] mx-auto mt-4 p-4">
                <!-- Column 1 -->
                <div class="grid grid-rows-3 gap-4  h-[340px]">
                    <!-- Row 1: Double Height -->
                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p style="font-family: 'Poppins'" class="text-black-600">
                                    HOW LONGER IT WILL TAKE TO GET MY ITINERARY DOCUMENT?
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="bg-white p-4  flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p style="font-family: 'Poppins'" class="text-black-600">
                                    WHERE I WILL RECEIVE MY ITINERARY DOCUMENTS?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 2 -->
                <div class="grid grid-rows-3 gap-4">
                    <!-- Row 1 -->
                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <p style="font-family: 'Poppins'" class="text-black-600">Is YOUR FLIGHT ITINERARY
                                    VERIFIABLE?
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p style="font-family: 'Poppins'" class="text-black-600">
                                    How MANY TIMES CHANGES/CORRECTIONS ARE ALLOWED?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Interview Questions -->
            <div class="flex justify-center w-full h-auto  ">
                <div
                    class="w-[90%] md:w-[80%] flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 ">
                    <!-- Icon / Logo -->
                    <span>
                        <img class="w-[40px] sm:w-[50px] h-[40px] sm:h-[50px]"
                            src="{{ asset('assets/interview-questions.webp') }}" alt="logo" />
                    </span>

                    <!-- Heading + Line -->
                    <span class="text-center">
                        <h1 style="font-family: Poppins" class="text-2xl sm:text-3xl   font-semibold text-primary">
                            Interview Questions
                        </h1>
                        <hr class="mx-auto w-[100px] sm:w-[152px] border-[2px] border-[#F4BD0F] mt-2 rounded-full" />
                    </span>
                </div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-[80%] mx-auto mt-8 p-4">
                <!-- Column 1 -->
                <div class="grid grid-rows-3 gap-4  h-[340px]">
                    <!-- Row 1: Double Height -->
                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p style="font-family: 'Poppins'" class="text-black-600">
                                    HOW LONGER IT WILL TAKE TO GET MY ITINERARY DOCUMENT?
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="bg-white p-4  flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-black-600">
                                    WHERE I WILL RECEIVE MY ITINERARY DOCUMENTS?
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- row 3 -->
                    <div class="bg-white p-4  flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p style="font-family: 'Poppins'" class="text-black-600">
                                    WHERE I WILL RECEIVE MY ITINERARY DOCUMENTS?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Column 2 -->
                <div class="grid grid-rows-3 gap-4">
                    <!-- Row 1 -->
                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <p style="font-family: 'Poppins'" class="text-black-600"> Is YOUR FLIGHT ITINERARY
                                    VERIFIABLE?
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p style="font-family: 'Poppins'" class="text-black-600">
                                    How MANY TIMES CHANGES/CORRECTIONS ARE ALLOWED?
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3 -->

                    <div class="bg-white p-4 flex items-center rounded-lg shadow">
                        <div class="grid grid-cols-[50px_1fr] gap-x-4">
                            <div class="flex flex-col items-center mt-1">
                                <i class="fas fa-plus text-xl text-blue-600"></i>
                            </div>
                            <div class="flex flex-col">
                                <p style="font-family: 'Poppins'" class="text-black-600">
                                    HOW LONGER IT WILL TAKE TO GET MY ITINERARY DOCUMENT?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Still searching for an answer? Let us help! -->
            <div class="flex items-center text-center justify-center w-80% mx-auto h-full mt-16">

                <h3 class="font-bold text-3xl">Still searching for an answer? Let us help!</h3>

            </div>


            <div class="flex items-center text-center justify-center w-80% mx-auto h-full mt-2 mb-16">
                <button
                    class="flex items-center justify-center w-[175px] h-[44px] px-6 m-[8px] rounded-sm bg-[#F4BD0F] hover:cursor-pointer text-primary font-[Quicksand] font-bold text-[16px]"
                    style="box-shadow: -3px 3px 0px 0px #00000099">

                    Contact us »
                </button>
                <button
                    class="flex items-center justify-center w-[185px] h-[44px] px-6 m-[8px] rounded-sm bg-transparent hover:cursor-pointer border border-primary text-primary font-[Quicksand] font-bold text-[16px] ">

                    Call Our Support »
                </button>

            </div>
        </div>
    </div>
    </div>
</x-app-layout>