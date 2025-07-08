<x-app-layout>
    <div>
        <div class="my-container">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
                <div class="md:col-span-3">
                    <h1 class="text-[32px] md:text-[46px] font-[700] my-4">
                        Flight Reservation
                    </h1>
                    <p class="text-[#121212] text-[16px] font-[500] leading-relaxed">
                        Need a flight itinerary for your visa application? You're in the
                        right place! Fill out the form below to place your order. Standard
                        delivery is 12–24 hours (including weekends), with an urgent
                        option available.
                    </p>

                    <div class="flex flex-col items-center">
                        <div class="flex items-center justify-center gap-16 mt-6">
                            <div class="flex flex-col items-center">
                                <img src="{{ asset('assets/Frame1.png') }}" alt="Fill Form"
                                    class="w-24 h-24 object-contain" />
                            </div>

                            <img src="{{ asset('assets/Arrow 3.png')}}" alt="Arrow" class="w-8 h-4 object-contain" />

                            <div class="flex flex-col items-center">
                                <img src="{{ asset('assets/Frame1.png')}}" alt="Pay Invoice"
                                    class="w-24 h-24 object-contain" />
                            </div>

                            <img src="{{ asset('assets/Arrow 3.png')}}" alt="Arrow" class="w-8 h-4 object-contain" />

                            <div class="flex flex-col items-center">
                                <img src="{{ asset('assets/Frame1.png')}}" alt="Receive Docs"
                                    class="w-24 h-24 object-contain" />
                            </div>
                        </div>

                        <div class="w-full mt-6">
                            <div class="h-[12px] bg-[#F4BD0F] rounded-xl relative overflow-hidden">
                                <div class="bg-[#1960A9] h-full w-[30%] rounded-xl"></div>
                            </div>
                            <div class="flex justify-between mt-2 text-sm font-semibold text-primary">
                                <span>Fill the Form</span>
                                <span>Pay Invoice</span>
                                <span>Receive Docs</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 flex justify-end items-center">
                    <img src="{{ asset('assets/cuate.png')}}" alt="Illustration" class="max-w-full object-contain" />
                </div>
            </div>
        </div>

        <div class="bg-[#D3F5FFBF] w-full min-h-screen pt-4 mt-12 pb-12">
            <div class="my-container">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <div class="lg:col-span-8">
                        <div class="bg-white shadow-md">
                            <form>
                                <div class="bg-primary h-[60px] w-full">
                                    <div class="flex items-center justify-center w-full max-w-4xl mx-auto md:p-3 gap-4">
                                        <img src="{{ asset('assets/person.png')}}" alt="" />
                                        <h2 class="text-[24px] text-white font-[500]">
                                            Personal Details
                                        </h2>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 text-sm p-4">
                                    <div>
                                        <label class="block mb-1 font-quicksand font-medium text-sm text-secondary">
                                            Choose Your Title *
                                        </label>
                                        <select
                                            class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                                            name="title">
                                            <option value="">Title</option>
                                            <option value="Mr">Mr.</option>
                                            <option value="Ms">Ms.</option>
                                            <option value="Mrs">Mrs.</option>
                                            <option value="Master">Master.</option>
                                        </select>
                                        <span x-show="errors.title" x-text="errors.title"
                                            class="text-red-500 text-xs mt-1 block"></span>
                                    </div>

                                    <div class="relative">
                                        <label
                                            class="block mb-1 font-quicksand font-medium w-fit text-secondary flex items-center gap-1">
                                            First Name *
                                            <div class="relative inline-flex group">
                                                <i
                                                    class="fas fa-question-circle text-gray-400 text-[12px] cursor-pointer hover:text-gray-600 transition-colors"></i>
                                                <div
                                                    class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-[90vw] sm:max-w-md px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361] before:z-[60]">
                                                    Should match from passport.
                                                </div>
                                            </div>
                                        </label>
                                        <input type="text" placeholder="First Name"
                                            class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                                            name="first_name" />
                                        <span x-show="errors.first_name" x-text="errors.first_name"
                                            class="text-red-500 text-xs mt-1 block"></span>
                                    </div>

                                    <div class="relative">
                                        <label
                                            class="block mb-1 font-quicksand font-medium w-fit text-secondary flex items-center gap-1">
                                            Last Name *
                                            <div class="relative inline-flex group">
                                                <i
                                                    class="fas fa-question-circle text-gray-400 text-[12px] cursor-pointer"></i>
                                                <div
                                                    class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-[90vw] sm:max-w-md px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361] before:z-[60]">
                                                    Should match from passport.
                                                </div>
                                            </div>
                                        </label>
                                        <input type="text" placeholder="Last Name"
                                            class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                                            name="last_name" />
                                        <span x-show="errors.last_name" x-text="errors.last_name"
                                            class="text-red-500 text-xs mt-1 block"></span>
                                    </div>

                                    <div>
                                        <label class="block mb-1 font-quicksand font-medium text-sm text-secondary">
                                            Your Email Address *
                                        </label>
                                        <input type="email" placeholder="Ex: jackson@gmail.com"
                                            class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                                            name="email" />
                                        <span x-show="errors.email" x-text="errors.email"
                                            class="text-red-500 text-xs mt-1 block"></span>
                                    </div>

                                    <div>
                                        <label
                                            class="block mb-1 font-quicksand font-medium w-fit text-secondary flex items-center gap-1">
                                            Your Phone Number *
                                            <div class="relative flex items-center group">
                                                <i
                                                    class="fas fa-question-circle text-gray-400 text-xs cursor-pointer"></i>
                                                <div
                                                    class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-[90vw] sm:max-w-md px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none sm:left-full sm:bottom-auto sm:top-1/2 sm:-translate-y-1/2 sm:ml-2 sm:-translate-x-0 before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361] sm:before:top-1/2 sm:before:left-0 sm:before:-translate-y-1/2 sm:before:-translate-x-full sm:before:border-r-[#495361] sm:before:border-t-transparent">
                                                    Write With Country Code.
                                                </div>
                                            </div>
                                        </label>
                                        <input type="number" placeholder="1 646 555 2671"
                                            class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                                            name="phone" />
                                        <span x-show="errors.phone" x-text="errors.phone"
                                            class="text-red-500 text-xs mt-1 block"></span>
                                    </div>

                                    <div>
                                        <label
                                            class="block mb-1 font-quicksand font-medium w-fit text-secondary flex items-center gap-1 relative group">
                                            Enter Your Passport Number * <br />
                                            <div class="relative flex items-center group">
                                                <i
                                                    class="fas fa-question-circle text-gray-400 text-xs cursor-pointer"></i>
                                                <div
                                                    class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-[90vw] sm:max-w-md px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none sm:left-full sm:bottom-auto sm:top-1/2 sm:-translate-y-1/2 sm:ml-2 sm:-translate-x-0 before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361] sm:before:top-1/2 sm:before:left-0 sm:before:-translate-y-1/2 sm:before:-translate-x-full sm:before:border-r-[#495361] sm:before:border-t-transparent">
                                                    30% discount if more than 1 Traveller.
                                                </div>
                                            </div>
                                        </label>
                                        <input type="number" placeholder="1 646 555 2671"
                                            class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                                            name="phone" />

                                        <span x-show="errors.num_of_travelers" x-text="errors.num_of_travelers"
                                            class="text-red-500 text-xs mt-1 block"></span>
                                    </div>

                                    <div class="flex flex-col gap-4">
                                        <div>
                                            <label class="block mb-1 font-quicksand font-medium text-sm text-secondary">
                                                Did you get visa interview date? *
                                            </label>
                                            <select
                                                class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                                                name="title">
                                                <option value="yes">Please Select</option>
                                                <option value="yes">Yes.</option>
                                                <option value="not-yet">Not Yet.</option>
                                            </select>
                                            <span x-show="errors.title" x-text="errors.title"
                                                class="text-red-500 text-xs mt-1 block"></span>
                                        </div>

                                        <div>
                                            <label class="block mb-1 font-quicksand font-medium text-sm text-secondary">
                                                Select document delivery date?*
                                            </label>
                                            <select
                                                class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                                                name="title">
                                                <option value="">Please Select</option>
                                                <option value="Master">Master.</option>
                                            </select>
                                            <span x-show="errors.title" x-text="errors.title"
                                                class="text-red-500 text-xs mt-1 block"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="bg-primary h-[60px] w-full">
                                        <div
                                            class="flex items-center justify-center w-full max-w-4xl mx-auto md:p-3 gap-4">
                                            <img src="{{ asset('assets/plane.png')}}" alt="" />
                                            <h2 class="text-[24px] text-white font-[500]">
                                                Flight Reservation
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-4 p-4">
                                    <div class="w-[32%] mt-3">
                                        <label
                                            class="block mb-1 font-quicksand font-medium w-fit text-tealDeep flex items-center gap-1 relative group">
                                            No Of Travelers *
                                            <div class="relative flex items-center group">
                                                <i
                                                    class="fas fa-question-circle text-gray-400 text-xs cursor-pointer"></i>
                                                <div
                                                    class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-[90vw] sm:max-w-md px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none
                            sm:left-full sm:bottom-auto sm:top-1/2 sm:-translate-y-1/2 sm:ml-2 sm:-translate-x-0
                            before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361]
                            sm:before:top-1/2 sm:before:left-0 sm:before:-translate-y-1/2 sm:before:-translate-x-full sm:before:border-r-[#495361] sm:before:border-t-transparent">
                                                    30% discount if more than 1 Traveller.
                                                </div>
                                            </div>
                                        </label>
                                        <select name="total_flight_reservation_travelers"
                                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                            <option value="1">1 Traveler $20 USD</option>
                                            <option value="2">2 Travelers $28 USD (30% OFF)</option>
                                            <option value="3">3 Travelers $42 USD (30% OFF)</option>
                                            <option value="4">4 Travelers $56 USD (30% OFF)</option>
                                            <option value="5">5 Travelers $70 USD (30% OFF)</option>
                                            <option value="6">6 Travelers $84 USD (30% OFF)</option>
                                            <option value="7">7 Travelers $98 USD (30% OFF)</option>
                                            <option value="8">
                                                8 Travelers $112 USD (30% OFF)
                                            </option>
                                        </select>
                                    </div>

                                    <div class="w-[32%]">
                                        <label
                                            class="block mb-1 font-quicksand font-medium w-fit text-tealDeep flex items-center gap-1 relative group">
                                            No Of Flights *
                                            <div class="relative flex items-center group">
                                                <i
                                                    class="fas fa-question-circle text-gray-400 text-xs cursor-pointer"></i>
                                                <div
                                                    class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-[90vw] sm:max-w-md px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none
                            sm:left-full sm:bottom-auto sm:top-1/2 sm:-translate-y-1/2 sm:ml-2 sm:-translate-x-0
                            before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361]
                            sm:before:top-1/2 sm:before:left-0 sm:before:-translate-y-1/2 sm:before:-translate-x-full sm:before:border-r-[#495361] sm:before:border-t-transparent">
                                                    30% discount if more than 1 Flight.
                                                </div>
                                            </div>
                                        </label>
                                        <select name="total_flights" x-model="total_flights"
                                            class="w-full border border-gray-300 rounded-md px-3 py-2  text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                            <option value="1">1 Flight $20 USD</option>
                                            <option value="2">2 Flights $28 USD (30% OFF)</option>
                                            <option value="3">3 Flights $42 USD (30% OFF)</option>
                                            <option value="4">4 Flights $56 USD (30% OFF)</option>
                                        </select>
                                        <span x-show="errors.num_of_flights" x-text="errors.num_of_flights"
                                            class="text-red-500 text-xs mt-1 block"></span>
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-quicksand font-medium text-sm text-secondary">
                                            Flight 1 *
                                        </label>
                                        <input type="text"
                                            placeholder="Example: Flight 1 Departure From New York (10 May 2025) to Paris, Returning (20 May 2025) From Paris to New York."
                                            class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                                            name="flight-1" />
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-quicksand font-medium text-sm text-secondary">
                                            Flight 2 *
                                        </label>
                                        <input type="text"
                                            placeholder="Example: Flight 2 Departure From New York (10 May 2025) to Paris, Returning (20 May 2025) From Paris to New York."
                                            class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                                            name="flight-2" />
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-quicksand font-medium text-sm text-secondary">
                                            Flight 3 *
                                        </label>
                                        <input type="text"
                                            placeholder="Example: Flight 3 Departure From New York (10 May 2025) to Paris, Returning (20 May 2025) From Paris to New York."
                                            class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                                            name="flight-3" />
                                    </div>
                                    <div>
                                        <label class="block mb-1 font-quicksand font-medium text-sm text-secondary">
                                            Flight 4 *
                                        </label>
                                        <input type="text"
                                            placeholder="Example: Flight 1 Departure From New York (10 May 2025) to Paris, Returning (20 May 2025) From Paris to New York.   "
                                            class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                                            name="flight-4" />
                                    </div>
                                    <div class="mt-4">
                                        <button
                                            class="flex items-center justify-center gap-2 px-4 py-2 rounded-[5px] bg-[#F4BD0F] text-primary font-semibold text-[16px]">
                                            Add More Flight
                                        </button>
                                        <p class="mt-3 text-secondary text-[16px] font-[600]">
                                            Mention that, if you have any intended arrival date in
                                            departure or returning.
                                        </p>
                                        <p class="text-[#077A7D] text-[14px]">
                                            Ex: Your departure is 10 Oct 2024 and you want to arrive
                                            on 11 Oct the next day or maybe the same day then
                                            mention <br /> the date of arrival below.
                                        </p>
                                        <div class="mt-3">
                                            <input type="text"
                                                placeholder="Example: I want departure at 10 Oct and need arrival next day but not before."
                                                class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                                                name="flight-1" />
                                        </div>
                                        <p class="mt-3 text-secondary text-[16px] font-[600]">
                                            Mention that, if you want or avoid any specific country
                                            layover/stop/transit.
                                        </p>
                                        <p class="text-[#077A7D] text-[14px]">
                                            Ex: If you want to avoid or add any country as a stop
                                            before you arrive at your destination then mention below
                                            so <br /> we will consider while making your bookings.
                                        </p>
                                        <div class="mt-3">
                                            <input type="text"
                                                placeholder="Example: Please avoid UK and US stops/layovers because i don't have their transit visas."
                                                class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                                                name="flight-1" />
                                        </div>
                                    </div>
                                    <p class="mt-3 text-secondary text-[16px] font-[600]">
                                        Any extra detail or instruction?
                                    </p>
                                    <div class="mt-3">
                                        <textarea rows="3" type="text"
                                            placeholder="Write any extra details or instructions like if you have any preferred airline"
                                            class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                                            name="flight-1"></textarea>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="bg-primary h-[60px] w-full">
                                        <div
                                            class="flex items-center justify-center w-full max-w-4xl mx-auto md:p-3 gap-4">
                                            <img src="{{ asset('assets/hotel.png')}}" alt="" />
                                            <h2 class="text-[24px] text-white font-[500]">
                                                Hotel Booking
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="p-4 space-y-4 mt-10">
                                        <h3 class="text-[16px] font-[600] text-secondary">
                                            Do You Need Hotel Booking for each traveller?
                                        </h3>
                                        <div class="flex items-center gap-6">
                                            <label class="flex items-center gap-2">
                                                <input type="radio" name="hotelBooking" value="yes" />
                                                Yes
                                            </label>
                                            <label class="flex items-center gap-2">
                                                <input type="radio" name="hotelBooking" value="no" />
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="bg-primary h-[60px] w-full">
                                        <div
                                            class="flex items-center justify-center w-full max-w-4xl mx-auto md:p-3 gap-4">
                                            <img src="{{ asset('assets/hotel.png')}}" alt="" />
                                            <h2 class="text-[24px] text-white font-[500]">
                                                Travel insurance
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="p-4 space-y-4 mt-10">
                                        <h3 class="text-[16px] font-[600] text-secondary">
                                            Do You Need Travel Insurance?
                                        </h3>
                                        <div class="flex items-center gap-6">
                                            <label class="flex items-center gap-2">
                                                <input type="radio" name="travel-insurence" value="yes" />
                                                Yes
                                            </label>
                                            <label class="flex items-center gap-2">
                                                <input type="radio" name="travel-insurence" value="no" />
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="bg-primary h-[60px] w-full">
                                        <div
                                            class="flex items-center justify-center w-full max-w-4xl mx-auto md:p-3 gap-4">
                                            <img src="{{ asset('assets/hotel.png')}}" alt="" />
                                            <h2 class="text-[24px] text-white font-[500]">
                                                Travel Guides
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="p-4 space-y-4 mt-10">
                                        <h3 class="text-[16px] font-[600] text-secondary">
                                            Do You Need Travel Guides to create a impressing cover
                                            story for visa?
                                        </h3>
                                        <div class="flex items-center gap-6">
                                            <label class="flex items-center gap-2">
                                                <input type="radio" name="travel-guide" value="yes" />
                                                Yes
                                            </label>
                                            <label class="flex items-center gap-2">
                                                <input type="radio" name="travel-guide" value="no" />
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="bg-primary h-[60px] w-full">
                                        <div
                                            class="flex items-center justify-center w-full max-w-4xl mx-auto md:p-3 gap-4">
                                            <img src="{{ asset('assets/hotel.png')}}" alt="" />
                                            <h2 class="text-[24px] text-white font-[500]">
                                                Interview Questions
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="p-4 space-y-4 mt-10">
                                        <h3 class="text-[16px] font-[600] text-secondary">
                                            Would you like a schengen visa interview guide to help
                                            you feel more prepared for your <br /> embassy
                                            interview?
                                        </h3>
                                        <div class="flex items-center gap-6">
                                            <label class="flex items-center gap-2">
                                                <input type="radio" name="travel-guide" value="yes" />
                                                Yes
                                            </label>
                                            <label class="flex items-center gap-2">
                                                <input type="radio" name="travel-guide" value="no" />
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="bg-primary h-[60px] w-full">
                                        <div
                                            class="flex items-center justify-center w-full max-w-4xl mx-auto md:p-3 gap-4">
                                            <img src="{{ asset('assets/hotel.png')}}" alt="" />
                                            <h2 class="text-[24px] text-white font-[500]">
                                                Urgent Reservation
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="p-4 space-y-4 mt-10">
                                        <h3 class="text-[16px] font-[600] text-secondary">
                                            Do You Want Your Reservation URGENT?
                                        </h3>
                                        <p class="text-[#077A7D] text-[14px]">
                                            Typically URGENT Email Delivery Time Period is 6–8
                                            Hours!
                                        </p>
                                        <select name="total_flight_reservation_travelers"
                                            class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                            <option value="">Please Select</option>
                                            <option value="1">
                                                6 Hours ($30 Extra for urgent)
                                            </option>
                                            <option value="2">
                                                8 Hours ($15 Extra for urgent)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="lg:col-span-4">
                        <div class="border p-3 sm:p-4 rounded-lg shadow-sm sm:shadow-md sticky top-4 sm:top-6 bg-white">
                            <div>
                                <h3 class="font-semibold text-lg sm:text-xl text-primary mb-3 sm:mb-4">
                                    Order Summary
                                </h3>

                                <div x-show="form.service_type"
                                    class="text-xs sm:text-sm flex justify-between border-b py-2">
                                    <span class="font-medium text-secondary" x-text="getServiceDisplayName()"></span>
                                    <span class="font-medium" x-text="'$' + getServicePrice().toFixed(2)"></span>
                                </div>

                                <div class="text-lg sm:text-xl font-bold flex justify-between py-3 sm:py-4">
                                    <span class="text-secondary">Total</span>
                                    <span class="text-secondary" x-text="'$' + getServicePrice().toFixed(2)"></span>
                                </div>

                                <button
                                    class="text-white w-full py-2 rounded font-semibold mb-3 sm:mb-4 text-sm sm:text-base transition-colors bg-primary">
                                    Pay Your Bill
                                </button>

                                <ul class="text-xs sm:text-sm space-y-1 sm:space-y-2">
                                    <li class="flex items-start gap-2">
                                        <i
                                            class="fas fa-check-circle text-green-500 mt-0.5 sm:mt-1 text-xs sm:text-sm"></i>
                                        100% money back guarantee if not satisfied
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i
                                            class="fas fa-check-circle text-green-500 mt-0.5 sm:mt-1 text-xs sm:text-sm"></i>
                                        Confirmed and verifiable itinerary
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i
                                            class="fas fa-check-circle text-green-500 mt-0.5 sm:mt-1 text-xs sm:text-sm"></i>
                                        Pay via debit/credit card & PayPal
                                    </li>
                                </ul>

                                <div class="mt-3 sm:mt-4 grid grid-cols-12 gap-2">
                                    <div class="col-span-6">
                                        <img src="{{ asset('assets/comodo-secure.webp')}}" alt="comodo secure"
                                            class="w-[80px] sm:w-[100px]" />
                                    </div>
                                    <div class="col-span-6">
                                        <img src="{{ asset('assets/buyer_protection_badge.png') }}"
                                            alt="buyer protection" class="w-full" />
                                    </div>
                                </div>

                                <div
                                    class="mt-3 sm:mt-4 flex flex-row flex-wrap justify-center sm:justify-between gap-2 sm:gap-3 items-center">
                                    <img src="{{ asset('assets/visa.svg')}}" alt="visa"
                                        class="w-12 sm:w-[65px] h-8 sm:h-[45px]" />
                                    <img src="{{ asset('assets/card.png')}}" alt="mastercard"
                                        class="w-12 sm:w-[65px] h-8 sm:h-[45px]" />
                                    <img src="{{ asset('assets/american-express.png')}}" alt="american express"
                                        class="w-12 sm:w-[65px] h-8 sm:h-[45px]" />
                                    <img src="{{ asset('assets/discover.png')}}" alt="discover"
                                        class="w-12 sm:w-[65px] h-8 sm:h-[45px]" />
                                    <img src="{{ asset('assets/JCB.png')}}" alt="jcb"
                                        class="w-12 sm:w-[65px] h-8 sm:h-[45px]" />
                                    <img src="{{ asset('assets/Diner-Club.png')}}" alt="dinner club"
                                        class="w-12 sm:w-[65px] h-8 sm:h-[45px]" />
                                    <img src="{{ asset('assets/mastero.svg') }}" alt="mastero"
                                        class="w-12 sm:w-[65px] h-8 sm:h-[45px]" />
                                    <img src="{{ asset('assets/union-pay.svg') }}" alt="union pay"
                                        class="w-12 sm:w-[65px] h-6 sm:h-[34px]" />
                                    <img src="{{ asset('assets/wechat.svg') }}" alt="wechat"
                                        class="w-12 sm:w-[65px] h-6 sm:h-[34px]" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>