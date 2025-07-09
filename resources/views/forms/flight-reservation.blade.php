<x-app-layout>

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        body {
            background-color: #f1f1f1;
        }
    </style>

    <div class="my-container px-4 md:px-12 font-quicksand">

   
        <div class="bg-white p-6 rounded-[8px] shadow-[0_0_8px_0_#0000001F] my-12">
            <form x-data="form" x-ref="form" x-init="Alpine.effect(() => {
                console.log('num of travelers for insurance:', insurance_num_of_travellers);
                console.log('form:', form);
            })" @submit.prevent="submitForm"
                action="#" method="POST">
             
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-10 border-t border-[#ddd]">

                    <div class="lg:col-span-8 space-y-6">

                        <div class="max-w-6xl mx-auto py-4 md:pt-8">
                            <!-- Form Title -->
                            <h1 class="text-xl md:text-2xl font-semibold text-primary">Flight Reservation Form</h1>
                            <!-- Info Box -->
                         
                            <!-- Section Header -->
                          


                            <x-forms-headings classes="mt-6" icon='fas fa-user'>User General Info</x-forms-headings>
                            <!-- Form Inputs -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 text-sm">
                                <!-- Title -->
                                <div>
                                    <label class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">Title
                                        *</label>
                                    <select class="form-input" name="title"
                                        @change="form.title = $event.target.value;validateField('title')"
                                        @blur="validateField('title')">
                                        <option value="">Title</option>
                                        <option value="Mr">Mr.</option>
                                        <option value="Ms">Ms.</option>
                                        <option value="Mrs">Mrs.</option>
                                        <option value="Master">Master.</option>
                                    </select>
                                    <span x-show="errors.title" x-text="errors.title"
                                        class="text-red-500 text-xs mt-1"></span>
                                </div>
                                <!-- First Name -->
                                <div class="relative">

                                    <label
                                        class="block mb-1 font-quicksand font-medium w-fit text-tealDeep flex items-center gap-1">
                                        First Name *
                                        <div class="relative inline-flex group">
                                            <!-- Question Icon -->
                                            <i
                                                class="fas fa-question-circle text-gray-400 text-[12px] cursor-pointer hover:text-gray-600 transition-colors"></i>

                                            <!-- Black Tooltip -->
                                            <div
                                                class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-[90vw] sm:max-w-md px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none
                                                before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361] before:z-[60]">
                                                Should match from passport.
                                            </div>
                                        </div>
                                    </label>
                                    <input @input="form.first_name = $event.target.value"
                                        @input.debounce.500ms="validateField('first_name')"
                                        @blur="validateField('first_name')" type="text" placeholder="First Name"
                                        class="form-input" name="first_name">
                                    <span x-show="errors.first_name" x-text="errors.first_name"
                                        class="text-red-500 text-xs mt-1"></span>
                                </div>
                                <!-- Last Name -->

                                <div class="relative">
                                    <label
                                        class="block mb-1 font-quicksand font-medium w-fit text-tealDeep flex items-center gap-1">
                                        Last Name *
                                        <div class="relative inline-flex group">
                                            <i
                                                class="fas fa-question-circle text-gray-400 text-[12px] cursor-pointer"></i>

                                            <!-- Enhanced Larger Tooltip -->
                                            <div
                                                class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-[90vw] sm:max-w-md px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none
                                                before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361] before:z-[60]">
                                                Should match from passport.
                                            </div>
                                        </div>

                                    </label>
                                    <input @input="form.last_name = $event.target.value"
                                        @input.debounce.500ms="validateField('last_name')"
                                        @blur="validateField('last_name')" type="text" placeholder="Last Name"
                                        class="form-input" name="last_name">
                                    <span x-show="errors.last_name" x-text="errors.last_name"
                                        class="text-red-500 text-xs mt-1"></span>

                                </div>
                                <!-- Email -->
                                <div>
                                    <label class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">Your
                                        Email Address *</label>
                                    <input @input="form.email = $event.target.value"
                                        @input.debounce.500ms="validateField('email')" @blur="validateField('email')"
                                        type="email" placeholder="Ex: jackson@gmail.com" class="form-input"
                                        name="email">
                                    <span x-show="errors.email" x-text="errors.email"
                                        class="text-red-500 text-xs mt-1"></span>

                                </div>
                                <!-- Phone -->
                                <div>
                                    <label
                                        class="block mb-1 font-quicksand font-medium w-fit text-tealDeep flex items-center gap-1">
                                        Your Phone Number *
                                        <div class="relative flex items-center group">
                                            <i class="fas fa-question-circle text-gray-400 text-xs cursor-pointer"></i>
                                            <!-- Responsive Tooltip -->
                                            <div
                                                class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-[90vw] sm:max-w-md px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none
                                                sm:left-full sm:bottom-auto sm:top-1/2 sm:-translate-y-1/2 sm:ml-2 sm:-translate-x-0
                                                before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361]
                                                sm:before:top-1/2 sm:before:left-0 sm:before:-translate-y-1/2 sm:before:-translate-x-full sm:before:border-r-[#495361] sm:before:border-t-transparent">
                                                Write With Country Code.
                                            </div>
                                        </div>
                                    </label>
                                    <input @input="form.phone = $event.target.value"
                                        @input.debounce.500ms="validateField('phone')" @blur="validateField('phone')"
                                        type="number" placeholder="1 646 555 2671" class="form-input" name="phone">
                                    <span x-show="errors.phone" x-text="errors.phone"
                                        class="text-red-500 text-xs mt-1"></span>
                                </div>
                                <!-- Travelers -->
                                <div>
                                    <label
                                        class="block mb-1 font-quicksand font-medium w-fit text-tealDeep flex items-center gap-1 relative group">
                                        No Of Travelers *
                                        <div class="relative flex items-center group">
                                            <i class="fas fa-question-circle text-gray-400 text-xs cursor-pointer"></i>

                                            <!-- Responsive Tooltip -->
                                            <div
                                                class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-[90vw] sm:max-w-md px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none
                                                sm:left-full sm:bottom-auto sm:top-1/2 sm:-translate-y-1/2 sm:ml-2 sm:-translate-x-0
                                                before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361]
                                                sm:before:top-1/2 sm:before:left-0 sm:before:-translate-y-1/2 sm:before:-translate-x-full sm:before:border-r-[#495361] sm:before:border-t-transparent">
                                                30% discount if more than 1 Traveller.
                                            </div>
                                        </div>
                                    </label>
                                    <select
                                        @change="form.num_of_travellers = $event.target.value;validateField('num_of_travellers');updateValidation('num_of_travellers');"
                                        @blur="validateField('num_of_travelers')" class="form-input"
                                        name="total_flight_reservation_travelers"
                                        x-model="total_flight_reservation_travelers">
                                        <option value="1">1 Traveler $20 USD</option>
                                        <option value="2">2 Travelers $28 USD (30% OFF)</option>
                                        <option value="3">3 Travelers $42 USD (30% OFF)</option>
                                        <option value="4">4 Travelers $56 USD (30% OFF)</option>
                                        <option value="5">5 Travelers $70 USD (30% OFF)</option>
                                        <option value="6">6 Travelers $84 USD (30% OFF)</option>
                                        <option value="7">7 Travelers $98 USD (30% OFF)</option>
                                        <option value="8">8 Travelers $112 USD (30% OFF)</option>
                                    </select>
                                    <span x-show="errors.num_of_travelers" x-text="errors.num_of_travelers"
                                        class="text-red-500 text-xs mt-1"></span>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm">
                                <!--  Select document delivery -->
                                <div class="max-sm:col-span-6 col-span-4">
                                    <label class="block mb-1 font-quicksand text-sm font-medium text-tealDeep mb-2">
                                        Select document delivery date? * </label>
                                    <select name="interview_documents" x-model="interview_documents"
                                        class="form-input"
                                        @change="form.interview_documents = $event.target.value;validateField('interview_documents')"
                                        @blur="validateField('interview_documents')">
                                        <option value="No, Delivery As Earliest" selected="selected">No, Delivery As
                                            Earliest</option>
                                        <option value="Schedule in Future Date">Schedule in Future Date</option>
                                    </select>
                                    <span x-show="errors.interview_documents" x-text="errors.interview_documents"
                                        class="text-red-500 text-xs mt-1"></span>
                                </div>
                                <!-- Select document delivery template -->
                                <template x-if="interview_documents === 'Schedule in Future Date'">
                                    <div class="col-span-4">
                                        <label
                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">Select
                                            Future Delivery Date *</label>
                                        <input name="future_delivery_date" type="date" class="form-input"
                                            @input="form.future_delivery_date = $event.target.value"
                                            @input.debounce.500ms="validateField('future_delivery_date')"
                                            @blur="validateField('future_delivery_date')" />
                                        <span x-show="errors.future_delivery_date"
                                            x-text="errors.future_delivery_date"
                                            class="text-red-500 text-xs mt-1"></span>
                                    </div>
                                </template>
                                <!-- Hear About Us -->
                                <div class="max-sm:col-span-6 md:col-span-4">
                                    <label class="block mb-2 font-quicksand font-medium text-sm text-tealDeep">How
                                        did you hear about us?</label>
                                    <select name="referral_source" class="form-input">
                                        <option value="" selected>Please Select</option>
                                        <option value="Google (Search Engine)">Google (Search Engine)</option>
                                        <option value="Social Media">Social Media</option>
                                        <option value="Quora">Quora</option>
                                        <option value="Other discussion forum">Other discussion forum</option>
                                        <option value="Family & Friends">Family & Friends</option>
                                        <option value="Word of mouth">Word of mouth</option>
                                    </select>
                                </div>
                            </div>
                            <div x-show="interview_documents == 'No, Delivery As Earliest'"
                                class="bg-blue-100 max-md:text-[12px] text-sm text-gray-700 border border-blue-300 p-4 mt-4 rounded">
                                <div class="font-semibold mb-2 flex items-center gap-1">
                                    <i class="fas fa-info-circle text-blue-500"></i> Note:
                                </div>
                                <ul class="list-disc pl-6 space-y-1">
                                    <li>You will receive your booking document in the next 12-24 hours including weekend
                                        days. If you need urgently then select the urgent delivery option at the bottom
                                        of this form</li>
                                    <li><strong class="text-tealDeep">Tip:</strong> Good for those who have visa
                                        appointments in the next 1 or 2 days later.</li>
                                </ul>
                            </div>

                            <div x-show="interview_documents == 'Schedule in Future Date'"
                                class="bg-blue-100 max-md:text-[12px] text-sm text-gray-700 border border-blue-300 p-4 mt-4 rounded">
                                <div class="font-semibold mb-2 flex items-center gap-1">
                                    <i class="fas fa-info-circle text-blue-500"></i> Schedule in Future Date:
                                </div>
                                <ul class="list-disc pl-6 space-y-1">
                                    <li>This option is added for our customer's convenience for those who have an
                                        appointment at a later date like a few days later from now so you can schedule
                                        your delivery date and you will receive the document on that exact scheduled
                                        date.</li>
                                    <li><strong class="text-tealDeep">Note: </strong> Bookings validity will start from
                                        the delivery date onwards next 2 weeks.</li>
                                </ul>
                            </div>
                            <div>
                                <template x-for="(_, index) in form.num_of_travellers_info || []"
                                    :key="index + 1">
                                    <div>
                                        <template x-if="index > 0 && form.num_of_travellers_info[index]">
                                            <div
                                                class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 text-sm border-t pt-4">

                                                <!-- Title -->
                                                <div>
                                                    <label
                                                        class="block mb-1 font-quicksand font-medium text-tealDeep">Traveler
                                                        <span x-text="index + 1"></span> Title *</label>
                                                    <select :name="`travellers[${index + 1}][title]`"
                                                        x-model="form.num_of_travellers_info[index].title"
                                                        @blur="validateField('num_of_travellers_info', index,'title')"
                                                        class="form-input">
                                                        <option value="">Select Title</option>
                                                        <option>Mr.</option>
                                                        <option>Ms.</option>
                                                        <option>Mrs.</option>
                                                        <option>Dr.</option>
                                                    </select>
                                                    <span x-show="errors.num_of_travellers_info[index].title"
                                                        x-text="errors.num_of_travellers_info[index].title"
                                                        class="text-red-500 text-xs mt-1"></span>
                                                </div>
                                                <!-- First Name -->
                                                <div>
                                                    <label
                                                        class="block mb-1 font-quicksand font-medium text-tealDeep mb-2">Traveler
                                                        <span x-text="index + 1"></span> First Name *</label>
                                                    <input type="text"
                                                        :name="`travellers[${index + 1}][first_name]`"
                                                        :placeholder="`First Name of Traveler ${index + 1}`"
                                                        x-model="form.num_of_travellers_info[index].first_name"
                                                        @blur="validateField('num_of_travellers_info', index,'first_name')"
                                                        class="form-input">
                                                    <span x-show="errors.num_of_travellers_info[index].first_name"
                                                        x-text="errors.num_of_travellers_info[index].first_name"
                                                        class="text-red-500 text-xs mt-1"></span>
                                                </div>
                                                <!-- Last Name -->
                                                <div>
                                                    <label
                                                        class="block mb-1 font-quicksand font-medium text-tealDeep mb-2">Traveler
                                                        <span x-text="index + 1"></span> Last Name *</label>
                                                    <input type="text" :name="`travellers[${index + 1}][last_name]`"
                                                        :placeholder="`Last Name of Traveler ${index + 1}`"
                                                        x-model="form.num_of_travellers_info[index].last_name"
                                                        @blur="validateField('num_of_travellers_info', index,'last_name')"
                                                        class="form-input">
                                                    <span x-show="errors.num_of_travellers_info[index].last_name"
                                                        x-text="errors.num_of_travellers_info[index].last_name"
                                                        class="text-red-500 text-xs mt-1"></span>
                                                </div>

                                            </div>
                                        </template>
                                        <div>
                                </template>
                            </div>
                        </div>
                        <!-- Flight Reservation -->
                        <div class="border p-4 rounded-md shadow transition-all duration-300">
                            <x-forms-headings icon='fas fa-plane'>Flight Reservation</x-forms-headings>
                            <p class="mt-6">Do You Need Flight Reservation?</p>
                            <div class="flex gap-6 mt-2">
                                <label class="flex items-center gap-1">
                                    <input type="radio" name="flightReservation" value="yes"
                                        :checked="showFlightForm === true" class="text-primary"
                                        @change="showFlightForm = true"> Yes </label>
                                <label class="flex items-center gap-1">
                                    <input type="radio" name="flightReservation" value="no"
                                        :checked="showFlightForm === false" class="text-primary"
                                        @change="showFlightForm = false;reset_flight_reservation_price"> No
                                </label>
                            </div>
                            <!-- Conditional Inputs -->
                            <div x-show="showFlightForm" x-transition.duration.200ms class="mt-4 space-y-4" x-cloak>
                                <!-- 1st Flight -->
                                <div>
                                    <label class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">1st
                                        Flight *</label>
                                    <input @input="form.first_flight = $event.target.value"
                                        @blur="validateField('first_flight')" type="text" name="flights[0]"
                                        class="form-input"
                                        placeholder="Departure from Amsterdam to Brussels on 16 Feb 2025">
                                    <span x-show="errors.first_flight" x-text="errors.first_flight"
                                        class="text-red-500 text-xs mt-1"></span>

                                </div>
                                <!-- 2nd Flight -->
                                <div>
                                    <label class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">2nd
                                        Flight</label>
                                    <input type="text" name="flights[1]" class="form-input"
                                        placeholder="Departure from Brussels to Paris on 22 Feb 2025">
                                </div>
                                <!-- Extra Flight Fields -->
                                <template x-for="i in extra_flights - 2" :key="i">
                                    <div>
                                        <label class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2"
                                            x-text="`${i+2}th Flight`"></label>
                                        <input type="text" :name="`flights[${i+1}]`" class="form-input"
                                            :placeholder="getFlightPlaceholder(i + 2)">
                                    </div>
                                </template>
                                <!-- Add Extra Flight -->
                                <div>
                                    <label class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">Add
                                        Extra Flight</label>
                                    <select class="form-input" x-model="extra_flights" name="extra_flights"
                                        @change="extra_flights = +$event.target.value">
                                        <option value="">Select Extra Flight</option>
                                        <option value="3">3rd - Flight $0/Free</option>
                                        <option value="4">4th - Flight $0/Free</option>
                                        <option value="5">5th - $10/Flight</option>
                                        <option value="6">6th - $10/Flight</option>
                                        <option value="7">7th - $10/Flight</option>
                                        <option value="8">8th - $10/Flight</option>
                                        <option value="9">9th - $10/Flight</option>
                                    </select>
                                </div>
                                <!-- Flight Additional details -->
                                <div>
                                    <label
                                        class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">Flight
                                        Additional details</label>
                                    <textarea rows="3" name="flight_additional_details" class="form-input min-h-[130px] text-sm"
                                        placeholder="Write your preferred airline name if you have, you can also let us know do you need direct flight or need stop or leave it on us."></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Hotel Booking -->
                        <div class="border p-4 rounded-md shadow transition-all duration-300">
                            <x-forms-headings icon='fas fa-hotel'>Hotel Booking</x-forms-headings>
                            <p class="mt-6">Do You Need Hotel Bookings?</p>
                            <!-- Toggle -->
                            <div class="flex gap-6 mt-2">
                                <label class="flex items-center gap-1">
                                    <input type="radio" name="hotelBooking" value="yes"
                                        :checked="showHotelBooking === true" @change="showHotelBooking = true"
                                        class="text-primary"> Yes </label>
                                <label class="flex items-center gap-1">
                                    <input type="radio" name="hotelBooking" value="no"
                                        :checked="showHotelBooking === false"
                                        @change="showHotelBooking = false; reset_hotel_booking_price"
                                        class="text-primary"> No </label>
                            </div>
                            <!-- Conditional Form -->
                            <div x-show="showHotelBooking" x-transition.duration.200ms class="mt-4 space-y-4" x-cloak>
                                <!-- Number of Travelers -->
                                <div>
                                    <label class="block mb-1 font-quicksand text-sm font-medium text-tealDeep">No
                                        of Travelers *</label>
                                    <select name="total_hotel_booking_travelers"
                                        @change="form.total_hotel_booking_travelers = $event.target.value"
                                        @blur="validateField('total_hotel_booking_travelers')" class="form-input"
                                        x-model="total_hotel_booking_travelers">
                                        <option selected value="1">1 Traveler $20 USD</option>
                                        <option value="2">2 Travelers $28 USD (30% OFF)</option>
                                        <option value="3">3 Travelers $42 USD (30% OFF)</option>
                                        <option value="4">4 Travelers $56 USD (30% OFF)</option>
                                        <option value="5">5 Travelers $70 USD (30% OFF)</option>
                                        <option value="6">6 Travelers $84 USD (30% OFF)</option>
                                        <option value="7">7 Travelers $98 USD (30% OFF)</option>
                                        <option value="8">8 Travelers $112 USD (30% OFF)</option>
                                    </select>
                                    <span x-show="errors.total_hotel_booking_travelers"
                                        x-text="errors.total_hotel_booking_travelers"
                                        class="text-red-500 text-xs mt-1"></span>
                                </div>
                                <!-- 1st Hotel -->
                                <div>
                                    <label class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">1st
                                        Hotel *</label>
                                    <input @input="form.first_hotel = $event.target.value"
                                        @blur="validateField('first_hotel')" name="hotels[0]" type="text"
                                        class="form-input"
                                        placeholder="Ex: Paris (Check-in 11 OCT 2025 - Checkout 15 OCT 2025)">
                                    <span x-show="errors.first_hotel" x-text="errors.first_hotel"
                                        class="text-red-500 text-xs mt-1"></span>
                                </div>
                                <!-- 2nd Hotel -->
                                <div>
                                    <label class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">2nd
                                        Hotel</label>
                                    <input type="text" name=hotels[1] class="form-input"
                                        placeholder="Ex: Rome (Check-in 15 OCT 2025 - Checkout 18 OCT 2025)">
                                </div>
                                <!-- Extra Hotel Fields -->
                                <template x-for="i in extra_hotels - 2" :key="i">
                                    <div>
                                        <label class="block mb-1 font-quicksand font-medium text-sm text-tealDeep"
                                            x-text="`${i+2}th Hotel`"></label>
                                        <input type="text" class="form-input" :name="`hotels[${i+1}]`"
                                            :placeholder="getHotelPlaceholder(i + 2)">
                                    </div>
                                </template>
                                <!-- Add Extra Hotel -->
                                <div>
                                    <label class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">Add
                                        Extra Hotel</label>
                                    <select class="form-input" x-model="extra_hotels" name="extra_hotels"
                                        @change="extra_hotels = +$event.target.value">
                                        <option selected value="">Select Extra Hotel</option>
                                        <option value="3">3rd Hotel - $0/Free</option>
                                        <option value="4">4th Hotel - $0/Free</option>
                                        <option value="5">5th Hotel - $10/Hotel</option>
                                        <option value="6">6th Hotel - $10/Hotel</option>
                                        <option value="7">7th Hotel - $10/Hotel</option>
                                        <option value="8">8th Hotel - $10/Hotel</option>
                                        <option value="9">9th Hotel - $10/Hotel</option>
                                    </select>
                                </div>
                                <!-- Hotel Additional Details -->
                                <div>
                                    <label class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">Hotel
                                        Additional details</label>

                                    <textarea name="hotel_additional_details" rows="3" class="form-input min-h-[130px] text-sm"
                                        placeholder="Write your preferences such as 3-star only, budget per night, or hotel name."></textarea>

                                </div>
                            </div>
                        </div>
                        <!-- Travel Insurance -->
                        <div class="border p-4 rounded-md shadow">
                            <x-forms-headings icon='fas fa-notes-medical'>Travel Insurance</x-forms-headings>
                            <p class="mt-6">Do You Need Travel Medical Insurance?</p>
                            <div class="flex gap-6 mt-2">
                                <label class="flex items-center gap-1">
                                    <input type="radio" name="travel_insurance" value="yes"
                                        :checked="showTravelInsurance === true"
                                        @change="showTravelInsurance = true;generateInsuranceTravelers"
                                        class="text-primary"> Yes </label>
                                <label class="flex items-center gap-1">
                                    <input type="radio" name="travel_insurance" value="no"
                                        :checked="showTravelInsurance === false"
                                        @change="showTravelInsurance = false ;reset_travel_insurance_price"
                                        class="text-primary"> No </label>
                            </div>
                            <template x-if="showTravelInsurance">
                                <div class="grid gap-3 grid-cols-12 mt-5 space-y-4">
                                    <!-- Title -->
                                    <div class="col-span-12 md:col-span-4">
                                        <label
                                            class="block mb-1 mt-4 font-quicksand text-sm font-medium text-tealDeep">Title
                                            *</label>
                                        <select @change="form.insurance_title = $event.target.value"
                                            @blur="validateField('insurance_title')" class="form-input"
                                            name="insurance_title">
                                            <option value="" selected>Select Title</option>

                                            <option value="Mr">Mr.</option>
                                            <option value="Ms">Ms.</option>
                                            <option value="Mrs">Mrs.</option>
                                        </select>
                                        <span x-show="errors.insurance_title" x-text="errors.insurance_title"
                                            class="text-red-500 text-xs mt-1"></span>

                                    </div>
                                    <!-- First Name -->
                                    <div class="col-span-12 md:col-span-4">
                                        <label
                                            class="block mb-1 font-quicksand text-sm font-medium text-tealDeep">First
                                            Name *</label>
                                        <input @input="form.insurance_first_name = $event.target.value"
                                            @blur="validateField('insurance_first_name')" type="text"
                                            class="form-input" placeholder="Enter your first name"
                                            name="insurance_first_name">
                                        <span x-show="errors.insurance_first_name"
                                            x-text="errors.insurance_first_name"
                                            class="text-red-500 text-xs mt-1"></span>
                                    </div>
                                    <!-- Last Name -->
                                    <div class="col-span-12 md:col-span-4">
                                        <label class="block mb-1 font-quicksand text-sm font-medium text-tealDeep">Last
                                            Name *</label>
                                        <input @input="form.insurance_last_name = $event.target.value"
                                            @blur="validateField('insurance_last_name')" type="text"
                                            class="form-input" placeholder="Enter your last name"
                                            name="insurance_last_name">
                                        <span x-show="errors.insurance_last_name" x-text="errors.insurance_last_name"
                                            class="text-red-500 text-xs mt-1"></span>
                                    </div>
                                    <!-- No. of Travellers -->
                                    <div class="col-span-12 md:col-span-8">
                                        <label class="block mb-1 font-quicksand text-sm font-medium text-tealDeep">No.
                                            of Travellers *</label>
                                        <select @blur="validateField('insurance_no_of_travelers')" class="form-input"
                                            x-model.number="insurance_num_of_travellers"
                                            @change="generateInsuranceTravelers" name="insurance_num_of_travelers">
                                            <option value='' selected>Select</option>
                                            <option value="1">1 Traveler</option>
                                            <option value="2">2 Travelers</option>
                                            <option value="3">3 Travelers</option>
                                            <option value="4">4 Travelers</option>
                                            <option value="5">5 Travelers</option>
                                            <option value="6">6 Travelers</option>
                                            <option value="7">7 Travelers</option>
                                            <option value="8">8 Travelers</option>
                                        </select>
                                        <span x-show="errors.insurance_no_of_travelers"
                                            x-text="errors.insurance_no_of_travelers"
                                            class="text-red-500 text-xs mt-1"></span>
                                    </div>
                                    <div x-init="initializeStartDate()" class="col-span-12 md:col-span-5">
                                        <label
                                            class="block mb-1 font-quicksand text-sm font-medium text-tealDeep">Start
                                            Date *</label>
                                        <input @input='form.inusrance_start_date = $event.target.value'
                                            @change='form.inusrance_start_date = $event.target.value'
                                            @blur="validateField('inusrance_start_date');form.inusrance_start_date = $event.target.value"
                                            type="text" x-ref="startDate" x-model="start_date" class="form-input"
                                            name="start_date">
                                        <span x-show="errors.inusrance_start_date"
                                            x-text="errors.inusrance_start_date"
                                            class="text-red-500 text-xs mt-1"></span>
                                    </div>
                                    <!-- End Date -->
                                    <div class="col-span-12 md:col-span-5">
                                        <label class="block mb-1 font-quicksand text-sm font-medium text-tealDeep">End
                                            Date *</label>
                                        <input @input='form.inusrance_end_date = $event.target.value'
                                            @change='form.inusrance_end_date = $event.target.value'
                                            @blur="validateField('inusrance_end_date');form.inusrance_end_date = $event.target.value"
                                            type="text" x-ref="endDate" x-model="end_date" class="form-input"
                                            name="end_date">
                                        <span x-show="errors.inusrance_end_date" x-text="errors.inusrance_end_date"
                                            class="text-red-500 text-xs mt-1"></span>
                                    </div>
                                    <div class="col-span-12 md:col-span-2 text-center self-end">
                                        <span x-html="calculateDays(start_date, end_date)"></span>
                                    </div>
                                    <input type="hidden" name="insurance_days" x-model="insurance_days" />


                                    <div class="col-span-12">
                                        <div
                                            class="bg-blue-100 max-md:text-[12px] text-sm text-gray-700 border border-blue-300 p-3 rounded">
                                            <div class="font-semibold flex items-center gap-1">
                                                <i class="fas fa-info-circle text-blue-500"></i>Please make sure
                                                your trip start and end date difference minimum should be 6
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Total Days -->
                                    <!-- Travelling From -->
                                    <div class="col-span-12 md:col-span-4">
                                        <label
                                            class="block mb-1 font-quicksand text-sm font-medium text-tealDeep">Travelling
                                            From *</label>
                                        <input @input="form.insurance_travelling_from = $event.target.value"
                                            @blur="validateField('insurance_travelling_from')" list="countries"
                                            class="form-input" placeholder="Type a country"
                                            name="insurance_travelling_from">
                                        <span x-show="errors.insurance_travelling_from"
                                            x-text="errors.insurance_travelling_from"
                                            class="text-red-500 text-xs mt-1"></span>
                                    </div>
                                    <!-- Travelling To -->
                                    <div class="col-span-12 md:col-span-4">
                                        <label
                                            class="block mb-1 font-quicksand text-sm font-medium text-tealDeep">Travelling
                                            To *</label>
                                        <input @input="form.insurance_travelling_to = $event.target.value"
                                            @blur="validateField('insurance_travelling_to')" list="countries"
                                            class="form-input" placeholder="Type a country"
                                            name="insurance_travelling_to">
                                        <span x-show="errors.insurance_travelling_to"
                                            x-text="errors.insurance_travelling_to"
                                            class="text-red-500 text-xs mt-1"></span>
                                    </div>
                                    <div class="col-span-12 md:col-span-6">
                                        <label
                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">What
                                            is the purpose of this insurance ? *</label>
                                        <select class="form-input" x-model.number="visa_purpose"
                                            name="insurance_purpose">
                                            <option selected value="1">Just For Visa Purposes</option>
                                            <option value="2">Visa + Actual Jouney Useable</option>
                                        </select>
                                    </div>
                                    <div class="col-span-12">
                                        <div x-show="visa_purpose == 2" x-cloak
                                            class="bg-blue-100 max-md:text-[12px] text-sm text-gray-700 border border-blue-300 p-4 rounded">
                                            <div class="font-semibold mb-2 flex items-center gap-1">
                                                <i class="fas fa-info-circle text-blue-500"></i> Visa + Actual
                                                Journey Purposes:
                                            </div>
                                            <ul class="list-disc pl-6 space-y-1">
                                                <li> These travel insurance documents will be useable for visa
                                                    purposes as well as for an actual journey. So it will be valid
                                                    starting from your trip start date until your trip end date. You
                                                    can carry your insurance document during your actual journey as
                                                    well so you will be covered.</li>
                                                <li>
                                                    <strong class="text-tealDeep">Note:</strong> You can ask for
                                                    insurance dates and location changes afterward and before the
                                                    insurance effective start date free of cost.
                                                </li>
                                            </ul>
                                        </div>
                                        <div x-show="visa_purpose == 1" x-cloak
                                            class="bg-blue-100 max-md:text-[12px] text-sm text-gray-700 border border-blue-300 p-4 rounded">
                                            <div class="font-semibold mb-2 flex items-center gap-1">
                                                <i class="fas fa-info-circle text-blue-500"></i> Visa Purposes
                                                Only:
                                            </div>
                                            <ul class="list-disc pl-6 space-y-1">
                                                <li>Good for visa doc submission and present during
                                                    interview/appointment.</li>
                                                <li>
                                                    <strong class="text-tealDeep">Note:</strong>You can ask for
                                                    insurance dates and location changes afterward and before the
                                                    insurance effective start date free of cost.
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Datalist for countries -->
                                    <x-countries />
                                    <div class="col-span-12">
                                        {{-- <template x-for="i in insurance_num_of_travellers || 0" :key="i"> --}}
                                        <template x-for="(traveler, i) in insurace_travellers_prices || 0"
                                            :key="i">
                                            <div class="traveler-form  p-4 my-3">
                                                <h2 class="text-lg text-primary font-bold mb-2">Traveler <span
                                                        x-text="get_ordinal(i + 1)"></span> Insurance Info </h2>
                                                <div class="grid grid-cols-12 gap-4">
                                                    <!-- First Name -->
                                                    <div class="col-span-12 md:col-span-6">
                                                        <label class="block mb-1 text-sm text-tealDeep">First Name
                                                            *</label>
                                                        <input type="text"
                                                            x-model="form.insurance_num_of_travellers_info[i].first_name"
                                                            @input.debounce.500ms="validateField('insurance_num_of_travellers_info', i, 'first_name')"
                                                            @blur="validateField('insurance_num_of_travellers_info', i, 'first_name')"
                                                            class="form-input" placeholder="First Name"
                                                            :name="`insurance_travelers[${i}][first_name]`">
                                                        <span
                                                            x-show="errors.insurance_num_of_travellers_info[i].first_name"
                                                            x-text="errors.insurance_num_of_travellers_info[i].first_name"
                                                            class="text-red-500 text-xs mt-1"></span>
                                                    </div>
                                                    <!-- Last Name -->
                                                    <div class="col-span-12 md:col-span-6">
                                                        <label
                                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">Last
                                                            Name *</label>
                                                        <input
                                                            x-model="form.insurance_num_of_travellers_info[i].last_name"
                                                            @input.debounce.500ms="validateField('insurance_num_of_travellers_info', i, 'last_name')"
                                                            @blur="validateField('insurance_num_of_travellers_info', i, 'last_name')"
                                                            type="text" class="form-input" placeholder="Last Name"
                                                            :name="`insurance_travelers[${i}][last_name]`">
                                                        <span
                                                            x-show="errors.insurance_num_of_travellers_info[i].last_name"
                                                            x-text="errors.insurance_num_of_travellers_info[i].last_name"
                                                            class="text-red-500 text-xs mt-1"></span>
                                                    </div>
                                                    <!-- Are you US citizen? -->
                                                    <div class="col-span-12 md:col-span-4">
                                                        <label
                                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">Are
                                                            you US citizen? *</label>
                                                        <select x-model.number="traveler.isUsCitizen"
                                                            class="form-input"
                                                            :name="`insurance_travelers[${i}][is_us_citizen]`">
                                                            <option selected value="1">No</option>
                                                            <option value="2">Yes</option>
                                                        </select>
                                                    </div>
                                                    <!-- Age Group -->
                                                    <div class="col-span-12 md:col-span-4">
                                                        <label
                                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">Traveler
                                                            Age *</label>
                                                        <select
                                                            @change="form.insurance_num_of_travellers_info[i].traveler_age=$event.target.value;validateField('insurance_num_of_travellers_info', i, 'traveler_age')"
                                                            @blur="validateField('insurance_num_of_travellers_info', i, 'traveler_age')"
                                                            class="form-input" x-model.number="traveler.ageGroup"
                                                            :name="`insurance_travelers[${i}][age_group]`">
                                                            <option value="" selected>Select</option>
                                                            <option value="1">0 - 21</option>
                                                            <option value="2">22 - 29</option>
                                                            <option value="3">30 - 39</option>
                                                            <option value="5">40 - 49</option>
                                                            <option value="10">50 - 59</option>
                                                            <option value="15">60 - 69</option>
                                                            <option value="20">70 - 79</option>
                                                            <option value="20">80 - 89</option>
                                                            <option value="25">90 - 99</option>
                                                            <option value="30">100 - 109</option>
                                                        </select>
                                                        <span
                                                            x-show="errors.insurance_num_of_travellers_info[i].traveler_age"
                                                            x-text="errors.insurance_num_of_travellers_info[i].traveler_age"
                                                            class="text-red-500 text-xs mt-1"></span>
                                                    </div>
                                                    <!-- Date of Birth -->
                                                    <div class="col-span-12 md:col-span-4">
                                                        <label
                                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">Date
                                                            of Birth *</label>
                                                        <input x-model="form.insurance_num_of_travellers_info[i].dob"
                                                            @input.debounce.500ms="validateField('insurance_num_of_travellers_info', i, 'dob')"
                                                            @blur="validateField('insurance_num_of_travellers_info', i, 'dob')"
                                                            type="date" class="form-input"
                                                            :name="`insurance_travelers[${i}][dob]`">
                                                        <span x-show="errors.insurance_num_of_travellers_info[i].dob"
                                                            x-text="errors.insurance_num_of_travellers_info[i].dob"
                                                            class="text-red-500 text-xs mt-1"></span>
                                                    </div>
                                                    <!-- Gender -->
                                                    <div class="col-span-12 md:col-span-4">
                                                        <label
                                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">Gender
                                                            *</label>
                                                        <select class="form-input"
                                                            :name="`insurance_travelers[${i}][gender]`">
                                                            <option>Male</option>
                                                            <option>Female</option>
                                                            <option>Other</option>
                                                        </select>

                                                    </div>
                                                    <!-- Country of Citizenship -->
                                                    <div class="col-span-12 md:col-span-4">
                                                        <label
                                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">Country
                                                            of Citizenship *</label>
                                                        <input
                                                            x-model="form.insurance_num_of_travellers_info[i].citizenship"
                                                            @input.debounce.500ms="validateField('insurance_num_of_travellers_info', i, 'citizenship')"
                                                            @blur="validateField('insurance_num_of_travellers_info', i, 'citizenship')"
                                                            list="countries" class="form-input" placeholder="Country"
                                                            :name="`insurance_travelers[${i}][citizenship]`">
                                                        <span
                                                            x-show="errors.insurance_num_of_travellers_info[i].citizenship"
                                                            x-text="errors.insurance_num_of_travellers_info[i].citizenship"
                                                            class="text-red-500 text-xs mt-1"></span>
                                                    </div>

                                                    <!-- Passport Number (Optional) -->
                                                    <div class="col-span-12 md:col-span-4">
                                                        <label
                                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">Passport
                                                            Number (Optional)</label>
                                                        <input type="text" class="form-input"
                                                            placeholder="Passport No."
                                                            :name="`insurance_travelers[${i}][passport]`">
                                                    </div>

                                                    <!-- Home Country -->
                                                    <div class="col-span-12 md:col-span-4">
                                                        <label
                                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">Home
                                                            Country *</label>
                                                        <input
                                                            x-model="form.insurance_num_of_travellers_info[i].homeCountry"
                                                            @input.debounce.500ms="validateField('insurance_num_of_travellers_info', i, 'homeCountry')"
                                                            @blur="validateField('insurance_num_of_travellers_info', i, 'homeCountry')"
                                                            list="countries" class="form-input"
                                                            placeholder="Home Country"
                                                            :name="`insurance_travelers[${i}][home_country]`">
                                                        <span
                                                            x-show="errors.insurance_num_of_travellers_info[i].homeCountry"
                                                            x-text="errors.insurance_num_of_travellers_info[i].homeCountry"
                                                            class="text-red-500 text-xs mt-1"></span>
                                                    </div>

                                                    <!-- Home Country Address -->
                                                    <div class="col-span-12 md:col-span-4">
                                                        <label
                                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">Home
                                                            Country Address *</label>
                                                        <input
                                                            x-model="form.insurance_num_of_travellers_info[i].homeCountryAddress"
                                                            @input.debounce.500ms="validateField('insurance_num_of_travellers_info', i, 'homeCountryAddress')"
                                                            @blur="validateField('insurance_num_of_travellers_info', i, 'homeCountryAddress')"
                                                            type="text" class="form-input" placeholder="Address"
                                                            :name="`insurance_travelers[${i}][home_country_address]`">
                                                        <span
                                                            x-show="errors.insurance_num_of_travellers_info[i].homeCountryAddress"
                                                            x-text="errors.insurance_num_of_travellers_info[i].homeCountryAddress"
                                                            class="text-red-500 text-xs mt-1"></span>
                                                    </div>

                                                    <!-- Home Country State -->
                                                    <div class="col-span-12 md:col-span-4">
                                                        <label
                                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">Home
                                                            Country State *</label>
                                                        <input
                                                            x-model="form.insurance_num_of_travellers_info[i].homeCountryState"
                                                            @input.debounce.500ms="validateField('insurance_num_of_travellers_info', i, 'homeCountryState')"
                                                            @blur="validateField('insurance_num_of_travellers_info', i, 'homeCountryState')"
                                                            type="text" class="form-input" placeholder="State"
                                                            :name="`insurance_travelers[${i}][home_country_state]`">
                                                        <span
                                                            x-show="errors.insurance_num_of_travellers_info[i].homeCountryState"
                                                            x-text="errors.insurance_num_of_travellers_info[i].homeCountryState"
                                                            class="text-red-500 text-xs mt-1"></span>
                                                    </div>

                                                    <!-- Home Country City -->
                                                    <div class="col-span-12 md:col-span-4">
                                                        <label
                                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">Home
                                                            Country City *</label>
                                                        <input
                                                            x-model="form.insurance_num_of_travellers_info[i].homeCountryCity"
                                                            @input.debounce.500ms="validateField('insurance_num_of_travellers_info', i, 'homeCountryCity')"
                                                            @blur="validateField('insurance_num_of_travellers_info', i, 'homeCountryCity')"
                                                            type="text" class="form-input" placeholder="City"
                                                            :name="`insurance_travelers[${i}][home_country_city]`">
                                                        <span
                                                            x-show="errors.insurance_num_of_travellers_info[i].homeCountryCity"
                                                            x-text="errors.insurance_num_of_travellers_info[i].homeCountryCity"
                                                            class="text-red-500 text-xs mt-1"></span>
                                                    </div>

                                                    <!-- Home Country Postal Code -->
                                                    <div class="col-span-12 md:col-span-4">
                                                        <label
                                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">Home
                                                            Country Postal Code *</label>
                                                        <input
                                                            x-model="form.insurance_num_of_travellers_info[i].homeCountryPostalCode"
                                                            @input.debounce.500ms="validateField('insurance_num_of_travellers_info', i, 'homeCountryPostalCode')"
                                                            @blur="validateField('insurance_num_of_travellers_info', i, 'homeCountryPostalCode')"
                                                            type="text" class="form-input"
                                                            placeholder="Postal Code"
                                                            :name="`insurance_travelers[${i}][home_country_postal_code]`">
                                                        <span
                                                            x-show="errors.insurance_num_of_travellers_info[i].homeCountryPostalCode"
                                                            x-text="errors.insurance_num_of_travellers_info[i].homeCountryPostalCode"
                                                            class="text-red-500 text-xs mt-1"></span>
                                                    </div>

                                                    <!-- Home Country Phone No -->
                                                    <div class="col-span-12 md:col-span-4">
                                                        <label
                                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">Home
                                                            Country Phone No *</label>
                                                        <input
                                                            x-model="form.insurance_num_of_travellers_info[i].homeCountryPhone"
                                                            @input.debounce.500ms="validateField('insurance_num_of_travellers_info', i, 'homeCountryPhone')"
                                                            @blur="validateField('insurance_num_of_travellers_info', i, 'homeCountryPhone')"
                                                            type="number" class="form-input" placeholder="Phone"
                                                            :name="`insurance_travelers[${i}][home_country_phone]`">
                                                        <span
                                                            x-show="errors.insurance_num_of_travellers_info[i].homeCountryPhone"
                                                            x-text="errors.insurance_num_of_travellers_info[i].homeCountryPhone"
                                                            class="text-red-500 text-xs mt-1"></span>
                                                    </div>

                                                    <!-- Beneficiary Name -->
                                                    <div class="col-span-12 md:col-span-6">
                                                        <label
                                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">Beneficiary
                                                            Name *</label>
                                                        <input
                                                            x-model="form.insurance_num_of_travellers_info[i].beneficaryName"
                                                            @input.debounce.500ms="validateField('insurance_num_of_travellers_info', i, 'beneficaryName')"
                                                            @blur="validateField('insurance_num_of_travellers_info', i, 'beneficaryName')"
                                                            type="text" class="form-input"
                                                            placeholder="Beneficiary Name"
                                                            :name="`insurance_travelers[${i}][beneficiary_name]`">
                                                        <span
                                                            x-show="errors.insurance_num_of_travellers_info[i].beneficaryName"
                                                            x-text="errors.insurance_num_of_travellers_info[i].beneficaryName"
                                                            class="text-red-500 text-xs mt-1"></span>
                                                    </div>

                                                    <!-- Beneficiary Relationship -->
                                                    <div class="col-span-12 md:col-span-6">
                                                        <label
                                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep">Beneficiary
                                                            Relationship *</label>
                                                        <select
                                                            x-model="form.insurance_num_of_travellers_info[i].beneficaryRelationShip"
                                                            @blur="validateField('insurance_num_of_travellers_info', i, 'beneficaryRelationShip')"
                                                            class="form-input"
                                                            :name="`insurance_travelers[${i}][beneficiary_relationship]`">
                                                            <option value="">Select</option>
                                                            <option>Spouse</option>
                                                            <option>Other</option>
                                                        </select>
                                                        <span
                                                            x-show="errors.insurance_num_of_travellers_info[i].beneficaryRelationShip"
                                                            x-text="errors.insurance_num_of_travellers_info[i].beneficaryRelationShip"
                                                            class="text-red-500 text-xs mt-1"></span>
                                                    </div>

                                                </div>
                                            </div>
                                        </template>













                                        <div x-show="insurace_travellers_prices.length > 7"
                                            class="bg-blue-100 max-md:text-[12px] text-sm text-gray-700 border my-2 border-blue-300 p-4 mt-4 rounded px-2 ml-3">
                                            <div class="font-semibold mb-2 flex items-center gap-1">
                                                <i class="fas fa-info-circle text-blue-500"></i> Just a Quick Note:
                                            </div>
                                            <ul class="list-disc pl-6 space-y-1">
                                                <li>If you're booking for more than 8 travelers, please fill out this
                                                    insurance form for the additional people. Thanks! </li>
                                            </ul>
                                        </div>














                                        <button type="button"
                                            @click="
                        if (insurance_num_of_travellers < 8) {
                          insurance_num_of_travellers++;
                          generateInsuranceTravelers();
                        }
                      "
                                            :class="insurance_num_of_travellers >= 8 ?
                                                'bg-gray-300 text-gray-600 cursor-not-allowed' :
                                                'bg-secondary hover:bg-secondary_hover text-white'"
                                            class="px-2 ml-3 py-1 rounded font-semibold transition-colors duration-150"
                                            :disabled="insurance_num_of_travellers >= 8"
                                            x-html="`<i class='fas fa-plus'></i> Add ${insurance_num_of_travellers > 7 ? '' : get_ordinal(insurance_num_of_travellers + 1)} Traveler`"></button>

                                    </div>
                                </div>
                            </template>
                        </div>
                        <!-- Travel Guides -->
                        <div class="border p-4 rounded-md shadow mt-6">
                            <x-forms-headings icon='fas fa-book'>Travel Guides</x-forms-headings>
                            <div class="flex flex-col md:flex-row gap-4 mt-4">
                                <img src="{{ asset('assets/travel-guide-sample.webp') }}" alt="Travel Guide"
                                    class="rounded border w-[100px]">
                                <div>
                                    <p>Do you require travel guide to create impressing cover story for visa?</p>
                                    <button type="button"
                                        class="bg-secondary text-white text-sm px-2 py-1 mt-2 rounded shadow">
                                        <a href="{{ asset('wp-content/uploads/2019/07/Amsterdam-3-Day-Travel-Guide-Sample.pdf') }}"
                                            target="_blank" rel="noopener noreferrer"> Download Sample </a>
                                    </button>
                                    <div class="flex gap-6 mt-2">
                                        <label class="flex items-center gap-1">
                                            <input type="radio" name="travel_guide"
                                                :checked="showTravelGuides === true"
                                                @change="showTravelGuides = true; " value="yes"
                                                class="text-primary">
                                            Yes </label>
                                        <label class="flex items-center gap-1">
                                            <input type="radio" name="travel_guide"
                                                :checked="showTravelGuides === false"
                                                @change="showTravelGuides = false; reset_travel_guides_price; "
                                                value="no" class="text-primary"> No </label>
                                    </div>
                                    <span x-show="errors.travelGuide" x-text="errors.travelGuide"
                                        class="text-red-500 text-xs mt-1"></span>
                                </div>
                            </div>
                            <template x-if="showTravelGuides">
                                <div class="grid grid-cols-12 space-y-4 mt-6 text-sm">
                                    <div class="col-span-12 md:col-span-6">
                                        <label
                                            class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">No
                                            of cities? *</label>
                                        <select
                                            @change="updatePrices;
                                        form.num_of_cities = $event.target.value;
                                        validateField('num_of_cities');
                                        updateValidation('num_of_cities')
                                        "
                                            @blur="validateField('num_of_cities')" x-model.number="num_of_cities"
                                            name="num_of_cities" class="form-input">
                                            <option value="">Select</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <span x-show="errors.num_of_cities" x-text="errors.num_of_cities"
                                            class="text-red-500 text-xs mt-1"></span>
                                    </div>
                                    <div class="col-span-12">
                                        <div class="grid grid-cols-12 gap-4 space-y-4">
                                            <template x-for="(price, index) in cities_prices || 0"
                                                :key="index">
                                                <div class="col-span-12 md:col-span-6">
                                                    <label
                                                        class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-1">
                                                        City <span x-text="index + 1"></span> *
                                                    </label>

                                                    <select :name="`cities[${index+1}]`"
                                                        x-model.number="cities_prices[index]"
                                                        @change="
                $nextTick(() => {
                    const selectedOption = $event.target.options[$event.target.selectedIndex];
                    const name = selectedOption?.dataset?.name || '';

                    // Get the sibling hidden input within this component
                    const hiddenInput = $el.parentElement.querySelector('input[type=hidden]');
                    if (hiddenInput) {
                        hiddenInput.value = name;
                        console.log(`✅ Set hidden input city_names[${index+1}] to:`, name);
                    } else {
                        console.warn(`❌ Hidden input for index ${index} not found`);
                    }

                    form.cities_prices[index + 1] = $event.target.value;
                    validateField('cities_prices', index + 1);
                })
            "
                                                        @blur="validateField('cities_prices', index+1)"
                                                        class="form-input">
                                                        <!-- Options should include data-name -->
                                                        <x-num-of-cities />
                                                    </select>

                                                    <!-- Plain hidden input, no dynamic ref or class needed -->
                                                    <input type="hidden" :name="`city_names[${index+1}]`" />

                                                    <span x-show="errors.cities_prices[index+1]"
                                                        x-text="errors.cities_prices[index+1]"
                                                        class="text-red-500 text-xs mt-1">
                                                    </span>
                                                </div>
                                            </template>

                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <!-- Urgent Order -->
                        <div class="border p-4 rounded-md shadow">
                            <x-forms-headings icon='fas fa-exclamation-circle'>Urgent Order</x-forms-headings>
                            <div class="w-full md:w-[60%]">
                                <p class="mt-3">Do You Want Your Reservation URGENT?</p>
                                <label class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mt-5 mb-2">
                                    Typically URGENT Email Delivery Time Period is 6-24 Hours </label>
                                <select name="urgent_reservation" x-model.number="urgent_reservation"
                                    class="form-input w-full">
                                    <option value="" selected>Please Select</option>
                                    <option value="1">6-8 Hours ($30 Extra For Urgent)</option>
                                    <option value="2">8-10 Hours ($15 Extra For Urgent)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Right Side: Order Summary -->
                    <div class="lg:col-span-4 mt-6">
                        <x-forms-order-summary-section />
                    </div>
                </div>

        </div>
        </form>
        <script>
            document.addEventListener("alpine:init", () => {
                Alpine.data("form", () => ({
                    showFlightForm: true,
                    showFlightHotel: false,
                    showHotelBooking: false,
                    showTravelInsurance: false,
                    showTravelGuides: false,
                    start_date: '',
                    end_date: '',
                    total_flight_reservation_travelers: 1,
                    total_hotel_booking_travelers: 1,
                    extra_flights: 0,
                    extra_hotels: 0,
                    insurance_num_of_travellers: 1,
                    insurace_travellers_prices: [],
                    insurance_days: 0,
                    insurance_base_price: 30,
                    insurance_purpose_useable: 30,
                    visa_purpose: 1,
                    num_of_cities: '',
                    cities_prices: [],
                    urgent_reservation: '',
                    interview_documents: 'No, Delivery As Earliest',
                    fieldConfig: {
                        title: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true
                            },
                            messages: {
                                required: 'Title is required.',

                            }
                        },
                        first_name: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true,

                            },
                            messages: {
                                required: 'First name is required.',

                            }
                        },
                        last_name: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true,

                            },
                            messages: {
                                required: 'Last name is required.',

                            }
                        },
                        email: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true,
                                email: true
                            },
                            messages: {
                                required: 'Email is required.',
                                email: 'Email is Invalid'
                            }
                        },
                        phone: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true,
                                phone: true,
                                min: 8,
                                max: 20
                            },
                            messages: {
                                required: 'Phone is required.',
                                phone: 'Invalid Format Only Number allowed',
                                min: "must be more than 8",
                                max: "must be less than 20"
                            }
                        },
                        interview_documents: {
                            initial: 'No, Delivery As Earliest',
                            error: '',
                            rules: {
                                required: true
                            },
                            messages: {
                                required: 'document delivery date is required.'
                            }
                        },
                        future_delivery_date: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true,
                                date: true
                            },
                            messages: {
                                required: 'future delivery date is required.',
                                date: 'Please enter a valid date.'
                            }
                        },
                        num_of_travellers: {
                            initial: 1, // Default to 1 traveler
                            error: '',
                            rules: {
                                required: true,
                                min: 1,
                                max: 8
                            },
                            messages: {
                                required: 'Number of travelers is required.',
                                min: 'At least {min} traveler is required.',
                                max: 'Cannot exceed {max} travelers.'
                            }
                        },
                        num_of_travellers_info: {
                            initial: [],
                            error: [],
                            rules: [],
                            messages: {
                                title: {
                                    required: "Title {index} is required"
                                },
                                first_name: {
                                    required: "First Name {index} is required"
                                },
                                last_name: {
                                    required: "Last Name {index} is required"
                                },
                            }
                        },


                        first_flight: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true
                            },
                            messages: {
                                required: 'First Flight is required.',
                            }
                        },



                        total_hotel_booking_travelers: {
                            initial: 1,
                            error: '',
                            rules: {
                                required: true,
                                min: 1
                            },
                            messages: {
                                required: 'No of Travelers is required.',
                                min: 'No of Travelers must be at least {min}.',

                            }
                        },
                        first_hotel: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true
                            },
                            messages: {
                                required: 'First Hotel is required.',
                            }
                        },




                        insurance_title: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true
                            },
                            messages: {
                                required: 'Title is required.',
                            }
                        },

                        insurance_first_name: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true
                            },
                            messages: {
                                required: 'First Name is required.',
                            }
                        },

                        insurance_last_name: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true
                            },
                            messages: {
                                required: 'Last Name is required.',
                            }
                        },

                        insurance_no_of_travelers: {
                            initial: '1',
                            error: '',
                            rules: {
                                required: true
                            },
                            messages: {
                                required: 'No of Travelers is required.',
                            }
                        },
                        inusrance_start_date: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true,
                                date: true
                            },
                            messages: {
                                required: 'start date is required.',
                                date: "Must be a valid Date"
                            }
                        },
                        inusrance_end_date: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true,
                                date: true
                            },
                            messages: {
                                required: 'End date is required.',
                                date: "Must be a valid Date"
                            }
                        },
                        insurance_travelling_from: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true
                            },
                            messages: {
                                required: 'Travelling From is required.',

                            }
                        },
                        insurance_travelling_to: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true
                            },
                            messages: {
                                required: 'Travelling To is required.',

                            }
                        },
                        insurance_num_of_travellers_info: {
                            initial: [],
                            error: [],
                            rules: [],
                            messages: {
                                first_name: {
                                    required: "First Name is required"
                                },
                                last_name: {
                                    required: "Last Name is required"
                                },
                                traveler_age: {
                                    required: "Age is required"
                                },
                                dob: {
                                    required: "Date Of Birth is required"
                                },
                                citizenship: {
                                    required: "Citizenship is required"
                                },
                                homeCountry: {
                                    required: "Home Country is required"
                                },
                                homeCountryAddress: {
                                    required: "Home Country Address is required"
                                },
                                homeCountryState: {
                                    required: "Home Country State is required"
                                },
                                homeCountryCity: {
                                    required: "Home Country City is required"
                                },
                                homeCountryPostalCode: {
                                    required: "Home Country Postal Code is required"
                                },
                                homeCountryPhone: {
                                    required: "Home Country Phone is required"
                                },
                                beneficaryName: {
                                    required: "Beneficiary Name is required"
                                },
                                beneficaryRelationShip: {
                                    required: "Beneficiary Relationship is required"
                                },
                            }
                        },

                        num_of_cities: {
                            initial: '',
                            error: '',
                            rules: {
                                required: true,
                                min: 1,
                                max: 5
                            },
                            messages: {
                                required: 'Number of cities is required.',
                                min: 'Number of cities must be at least {min}.',
                                max: 'Number of cities cannot exceed {max}.'
                            }
                        },
                        cities_prices: {
                            initial: [],
                            error: [],
                            rules: [],
                            messages: {
                                required: 'City {index} is required.'
                            }
                        }
                    },
                    updateValidation(field) {
                        if (field === 'num_of_cities') {
                            const numCities = Number(this.form.num_of_cities) || 0;
                            this.form.cities_prices = [];
                            this.errors.cities_prices = [];
                            this.rules.cities_prices = [];
                            Array(numCities).fill().forEach((_, index) => {
                                this.form.cities_prices[index + 1] = '';
                                this.errors.cities_prices[index + 1] = '';
                                this.rules.cities_prices[index + 1] = {
                                    required: true
                                };
                            });
                            console.log('Form cities_prices:', this.form.cities_prices);
                            console.log('Errors cities_prices:', this.errors.cities_prices);
                            console.log('Rules cities_prices:', this.rules.cities_prices);
                        }
                        if (field === 'num_of_travellers') {
                            const numTravellers = Number(this.form.num_of_travellers) || 0;
                            console.log("----------- no of travllers ---------------:", numTravellers,
                                this
                                .form.num_of_travellers);
                            this.form.num_of_travellers_info = this.form.num_of_travellers_info || [];
                            this.errors.num_of_travellers_info = this.errors.num_of_travellers_info || [];
                            this.rules.num_of_travellers_info = this.rules.num_of_travellers_info || [];
                            const currentLength = this.form.num_of_travellers_info.length;

                            // Populate indices 1 to numTravellers-1 for additional travelers
                            if (numTravellers > currentLength) {
                                for (let i = currentLength; i < numTravellers; i++) {
                                    this.form.num_of_travellers_info.push({
                                        title: '',
                                        first_name: '',
                                        last_name: ''
                                    });
                                    this.errors.num_of_travellers_info.push({
                                        title: '',
                                        first_name: '',
                                        last_name: ''
                                    });
                                    this.rules.num_of_travellers_info.push(i == 0 ? {
                                        title: {},
                                        first_name: {},
                                        last_name: {}
                                    } : {
                                        title: {
                                            required: true
                                        },
                                        first_name: {
                                            required: true
                                        },
                                        last_name: {
                                            required: true
                                        }
                                    });
                                }
                            }

                            // Decrease the number of travelers, removing only extra data
                            else if (numTravellers < currentLength) {
                                this.form.num_of_travellers_info.splice(numTravellers);
                                this.errors.num_of_travellers_info.splice(numTravellers);
                                this.rules.num_of_travellers_info.splice(numTravellers);
                            }

                            // Debug logs (optional, helpful for debugging)
                            console.log('Form num_of_travellers_info:', this.form
                                .num_of_travellers_info);
                            console.log('Errors num_of_travellers_info:', this.errors
                                .num_of_travellers_info);
                            console.log('Rules num_of_travellers_info:', this.rules
                                .num_of_travellers_info);
                        }
                    },

                    // Generate form, errors, rules, and errorMessages
                    initFields() {
                        return {
                            form: Object.fromEntries(
                                Object.entries(this.fieldConfig).map(([key, {
                                    initial
                                }]) => [key, initial])
                            ),
                            errors: Object.fromEntries(
                                Object.entries(this.fieldConfig).map(([key, {
                                    error
                                }]) => [key, error])
                            ),
                            rules: Object.fromEntries(
                                Object.entries(this.fieldConfig).map(([key, {
                                    rules
                                }]) => [key, rules])
                            ),
                            errorMessages: Object.fromEntries(
                                Object.entries(this.fieldConfig).map(([key, {
                                    messages
                                }]) => [key, messages])
                            )
                        };
                    },

                    // Initialize form, errors, rules, and errorMessages
                    init() {
                        const {
                            form,
                            errors,
                            rules,
                            errorMessages
                        } = this.initFields();
                        this.form = form;
                        this.errors = errors;
                        this.rules = rules;
                        this.errorMessages = errorMessages;

                        this.generateInsuranceTravelers;


                    },

                    // Skip rules for conditional validation
                    skipRules: [{
                            fields: 'future_delivery_date',
                            when: function() {
                                return this.form.interview_documents !==
                                    'Schedule in Future Date';
                            },
                            reset: function() {
                                this.errors.future_delivery_date = '';
                            }
                        },
                        {
                            fields: ['num_of_cities', 'cities_prices'],
                            when: function() {
                                return !this.showTravelGuides;
                            },
                            reset: function() {
                                this.errors.num_of_cities = '';
                                this.errors.cities_prices = Array(this.form.num_of_cities || 0)
                                    .fill('');
                            }
                        },
                        {
                            fields: ['first_flight'],
                            when: function() {
                                return !this.showFlightForm;
                            },
                            reset: function() {
                                this.errors.first_flight = '';

                            }
                        },
                        {
                            fields: ['total_hotel_booking_travelers', 'first_hotel'],
                            when: function() {
                                return !this.showHotelBooking;
                            },
                            reset: function() {
                                this.errors.total_hotel_booking_travelers = '';
                                this.errors.first_hotel = '';
                                this.errors.flight_additional_info = '';
                            }
                        },

                        {
                            fields: ['insurance_title', 'insurance_first_name',
                                'insurance_last_name',
                                'insurance_travelling_from', 'insurance_travelling_to',
                                'insurance_num_of_travellers_info', 'inusrance_end_date',
                                'inusrance_start_date'
                            ],
                            when: function() {
                                return !this.showTravelInsurance;
                            },
                            reset: function() {
                                this.errors.insurance_title = '';
                                this.errors.insurance_first_name = '';
                                this.errors.insurance_last_name = '';
                                this.errors.insurance_travelling_from = '';
                                this.errors.insurance_travelling_to = '';
                                this.errors.inusrance_end_date = '';
                                this.errors.inusrance_start_date = '';

                                this.errors.insurance_num_of_travellers_info = [];

                            }
                        },

                    ],


                    getErrorMessage(field, innerField = null, type, index = null, params = {}) {
                        const messages = this.errorMessages[field] || {};
                        console.log("the whole row i am getting :", messages);
                        let message = null;
                        if (innerField !== null) {
                            console.log("this is the nestfield :", innerField);
                            console.log("message : ", messages[innerField][type]);
                            message = messages[innerField][type] || "cooked";
                        } else {
                            message = messages[type] ||
                                `${this.getFieldLabel(field, index)} is invalid.`;
                        }
                        if (params.min) message = message.replace('{min}', params.min);
                        if (params.max) message = message.replace('{max}', params.max);
                        if (field == "num_of_travellers_info" || field ==
                            "insurance_num_of_travellers_info")
                            message = message.replace('{index}', (index + 1).toString());
                        else
                        if (index !== null) message = message.replace('{index}', (index).toString());
                        return message;
                    },
                    validateField(field, index = null, innerField = null) {

                        // Skip validation if conditions met
                        for (const rule of this.skipRules) {
                            const targetFields = Array.isArray(rule.fields) ? rule.fields : [rule
                                .fields
                            ];
                            if (targetFields.includes(field) && rule.when.call(this)) {
                                rule.reset.call(this);
                                return;
                            }
                        }
                        // Clear errors
                        if (index !== null && innerField == null) {
                            this.errors[field][index] = '';
                        } else if (index !== null && innerField !== null) {
                            console.log("error before finding field :", this.errors[field][index][
                                innerField
                            ]);
                            this.errors[field][index][innerField] = '';
                            console.log("error after finding field :", this.errors[field][index]);
                        } else {
                            this.errors[field] = '';
                        }

                        let value = null;
                        let rules = null;
                        if (innerField !== null) {
                            value = this.form[field]?.[index]?.[innerField];
                            rules = this.rules[field]?.[index]?.[innerField];
                            console.log("rul : ", this.rules[field]?.[index]?.[innerField]);
                            console.log("value : ", value);

                        } else {
                            value = index !== null && index > 0 ? this.form[field]?.[index] : this
                                .form[
                                    field];
                            rules = index !== null && index > 0 ? this.rules[field]?.[index] : this
                                .rules[
                                    field];
                        }
                        // Resolve value and rules




                        // Validation
                        if (rules?.required && (!value || value.toString().trim() === '')) {
                            console.log("field is required for :", innerField);
                            this.setError(field, index, this.getErrorMessage(field, innerField,
                                'required',
                                index), innerField);
                            return;
                        }
                        if (rules?.email && value && !this.isValidEmail(value)) {
                            this.setError(field, index, this.getErrorMessage(field, innerField, 'email',
                                index), innerField);
                            return;
                        }
                        if (rules?.min && value && value.length < rules.min) {
                            this.setError(field, index, this.getErrorMessage(field, innerField, 'min',
                                index, {
                                    min: rules.min
                                }), innerField);
                            return;
                        }
                        if (rules?.max && value && value.length > rules.max) {

                            this.setError(field, index, this.getErrorMessage(field, innerField, 'max',
                                index, {
                                    max: rules.max
                                }), innerField);
                            return;
                        }

                        if (rules?.date && value && !this.isValidDate(value)) {
                            this.setError(field, index, this.getErrorMessage(field, innerField, 'date',
                                index), innerField);
                            return;
                        }
                        if (rules?.phone && value && !this.isValidPhoneNumber(value)) {
                            this.setError(field, index, this.getErrorMessage(field, innerField, 'phone',
                                index), innerField);
                            return;
                        }

                    },

                    isValidPhoneNumber(phoneStr) {
                        const regex = /^\d+$/;
                        return regex.test(phoneStr);
                    },
                    isValidEmail(emailStr) {
                        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        return regex.test(emailStr);
                    },
                    getFieldLabel(field, index) {
                        if (field === 'cities_prices' && index !== null) {
                            return `City ${index + 1}`;
                        }
                        return this.capitalize(field.replace('_', ' '));
                    },

                    setError(field, index, message, subfield) {
                        console.log("in set error ", field, index, subfield, message);
                        if (subfield) {
                            console.log("before seting error :", this.errors[field][index][subfield]);
                            this.errors[field][index][subfield] = message;
                            console.log("after setting errors :", this.errors[field][index][subfield]);
                            console.log("all erros :", this.errors[field]);
                            return;
                        }
                        if (index !== null) {
                            this.errors[field][index] = message;
                            return;
                        } else {
                            this.errors[field] = message;
                            return;
                        }
                    },

                    capitalize(str) {
                        return str.charAt(0).toUpperCase() + str.slice(1);
                    },

                    isValidDate(dateStr) {
                        const date = new Date(dateStr);
                        return !isNaN(date.getTime());
                    },

                    async submitForm() {
                        // 1. Clear all existing errors
                        const clearErrors = (obj) => {
                            if (Array.isArray(obj)) {
                                obj.forEach(item => clearErrors(item));
                            } else if (obj && typeof obj === 'object') {
                                Object.keys(obj).forEach(key => clearErrors(obj[key]));
                            } else {
                                // primitives are handled by validateField resetting them
                            }
                        };
                        //   clearErrors(this.errors);

                        // 2. Walk the form shape and call validateField for every leaf
                        const walkAndValidate = (field, value, index = null) => {
                            if (Array.isArray(value)) {
                                value.forEach((item, idx) => {
                                    walkAndValidate(field, item, idx);
                                });
                            } else if (value && typeof value === 'object') {
                                // Nested object: e.g. traveller_info[index] is an object with title, first_name, last_name
                                Object.keys(value).forEach(innerField => {
                                    // call validateField with innerField so it uses the nested logic
                                    console.log(
                                        "----------------------------------------------------"
                                    );
                                    console.log(field, index, innerField);
                                    console.log(
                                        "----------------------------------------------------"
                                    );

                                    this.validateField(field, index, innerField);
                                });
                            } else {
                                // Primitive field, or array of primitives (like cities_prices)
                                this.validateField(field, index);
                            }
                        };

                        Object.keys(this.form).forEach(fieldKey => {
                            walkAndValidate(fieldKey, this.form[fieldKey]);
                        });

                        // 3. Check if any errors remain
                        const hasErrors = Object.values(this.errors).some(err => {
                            if (Array.isArray(err)) {
                                // could be nested arrays or array of objects
                                return err.some(e => {
                                    if (Array.isArray(e)) return e.some(x => x !==
                                        '');
                                    if (e && typeof e === 'object') return Object
                                        .values(e).some(x => x !== '');
                                    return e !== '';
                                });
                            }
                            return err !== '';
                        });

                        if (hasErrors) {
                            this.$nextTick(() => {
                                // find the first <span class="text-red-500"> that actually has text
                                const allErrSpans = Array.from(
                                    this.$refs.form.querySelectorAll(
                                        'span.text-red-500')
                                );
                                const errSpan = allErrSpans.find(s => s.innerText.trim()
                                    .length > 0);
                                if (!errSpan) return;

                                // walk backwards to the actual .form-input
                                let field = errSpan.previousElementSibling;
                                while (field && !field.classList.contains('form-input')) {
                                    field = field.previousElementSibling;
                                }

                                // focus it—no border-styling at all
                                if (field && typeof field.focus === 'function') {
                                    field.focus();
                                }
                            });

                            return; // bail out, don’t submit
                        }
                        // 4. Submit or bail out

                        // All validation passed
                        // e.g. await axios.post('/api/submit', this.form)

                        this.$refs.form.submit();

                        //   else {
                        //     console.log('Validation failed:', this.errors);
                        //   }
                    },
                    updatePrices() {
                        const currentLength = this.cities_prices.length;
                        const targetLength = this.num_of_cities;
                        if (targetLength > currentLength) {
                            // Add new zero-value entries
                            for (let i = currentLength; i < targetLength; i++) {
                                this.cities_prices.push(0);
                            }
                        } else if (targetLength < currentLength) {
                            // Remove extra entries
                            this.cities_prices.splice(targetLength);
                        }
                    },
                    formatDate(date) {
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const year = date.getFullYear();
                        return `${month}/${day}/${year}`;
                    },
                    initializeStartDate() {
                        const today = new Date();
                        const tomorrow = new Date();
                        tomorrow.setDate(today.getDate() + 1);
                        this.start_date = this.formatDate(tomorrow);
                        this.form.inusrance_start_date = this.formatDate(tomorrow);
                        this.errors.inusrance_start_date = '';

                        const initialDisabledDates = [];
                        for (let i = 1; i <= 5; i++) {
                            const d = new Date(tomorrow);
                            d.setDate(d.getDate() + i);
                            initialDisabledDates.push(new Date(d));
                        }
                        initialDisabledDates.push(tomorrow);
                        const initialEndDate = new Date(tomorrow);
                        initialEndDate.setDate(initialEndDate.getDate() + 5);
                        this.end_date = this.formatDate(initialEndDate);
                        this.form.inusrance_end_date = this.formatDate(initialEndDate);
                        this.errors.inusrance_end_date = '';
                        this.initializeEndDate(tomorrow, initialDisabledDates);
                        flatpickr(this.$refs.startDate, {
                            dateFormat: 'm/d/Y',
                            minDate: tomorrow,
                            defaultDate: tomorrow,
                            disable: [today],
                            onChange: (selectedDates) => {
                                const selected = new Date(selectedDates[0]);
                                this.start_date = this.formatDate(selected);
                                const newDisabledDates = [];
                                for (let i = 1; i <= 4; i++) {
                                    const d = new Date(selected);
                                    d.setDate(d.getDate() + i);
                                    newDisabledDates.push(new Date(d));
                                }
                                newDisabledDates.push(selected);
                                const newEnd = new Date(selected);
                                newEnd.setDate(newEnd.getDate() + 5);
                                this.end_date = this.formatDate(newEnd);
                                this.form.inusrance_end_date = this.formatDate(newEnd);
                                this.errors.inusrance_end_date = '';
                                this.initializeEndDate(selected, newDisabledDates);
                            }
                        });
                    },
                    initializeEndDate(start, disabledDates) {
                        flatpickr(this.$refs.endDate, {
                            dateFormat: 'm/d/Y',
                            minDate: start,
                            defaultDate: this.end_date,
                            disable: disabledDates
                        });
                    },
                    get generateInsuranceTravelers() {
                        if (!this.showTravelInsurance)
                            return;
                        const currentLength = this.insurace_travellers_prices.length || null;
                        const newLength = this.insurance_num_of_travellers;
                        this.form.insurance_no_of_travelers = this.insurance_num_of_travellers;
                        if (newLength > currentLength) {
                            for (let i = currentLength; i < newLength; i++) {

                                this.insurace_travellers_prices.push({
                                    ageGroup: null,
                                    isUsCitizen: 1
                                });
                                this.form.insurance_num_of_travellers_info.push({

                                    first_name: '',
                                    last_name: '',
                                    traveler_age: '',
                                    dob: '',
                                    citizenship: '',
                                    homeCountry: '',
                                    homeCountryAddress: '',
                                    homeCountryState: '',
                                    homeCountryCity: '',
                                    homeCountryPostalCode: '',
                                    homeCountryPhone: '',
                                    beneficaryName: '',
                                    beneficaryRelationShip: '',

                                });
                                this.errors.insurance_num_of_travellers_info.push({
                                    first_name: '',
                                    last_name: '',
                                    traveler_age: '',
                                    dob: '',
                                    citizenship: '',
                                    homeCountry: '',
                                    homeCountryAddress: '',
                                    homeCountryState: '',
                                    homeCountryCity: '',
                                    homeCountryPostalCode: '',
                                    homeCountryPhone: '',
                                    beneficaryName: '',
                                    beneficaryRelationShip: '',
                                });
                                this.rules.insurance_num_of_travellers_info.push({

                                    first_name: {
                                        required: true
                                    },
                                    last_name: {
                                        required: true
                                    },
                                    traveler_age: {
                                        required: true
                                    },
                                    dob: {
                                        required: true,
                                        date: true
                                    },
                                    citizenship: {
                                        required: true
                                    },
                                    homeCountry: {
                                        required: true
                                    },
                                    homeCountryAddress: {
                                        required: true
                                    },
                                    homeCountryState: {
                                        required: true
                                    },
                                    homeCountryCity: {
                                        required: true
                                    },
                                    homeCountryPostalCode: {
                                        required: true
                                    },
                                    homeCountryPhone: {
                                        required: true
                                    },
                                    beneficaryName: {
                                        required: true
                                    },
                                    beneficaryRelationShip: {
                                        required: true
                                    },


                                });

                            }
                        } else if (newLength < currentLength) {
                            this.insurace_travellers_prices.splice(newLength);
                            this.form.insurance_num_of_travellers_info.splice(newLength);
                            this.rules.insurance_num_of_travellers_info.splice(newLength);
                            this.errors.insurance_num_of_travellers_info.splice(newLength);

                        }
                    },
                    get_ordinal(n) {
                        if (n == null || isNaN(n)) return '';
                        const s = ["th", "st", "nd", "rd"];
                        const v = n % 100;
                        return n + (s[(v - 20) % 10] || s[v] || s[0]);
                    },
                    get totalInsurancePrice() {
                        if (!this.showTravelInsurance) return 0;
                        const travelersTotal = this.insurace_travellers_prices.reduce((sum,
                            traveler) => {
                            if (traveler.ageGroup) {
                                return sum + this.get_insurance_price(traveler);
                            }
                            return sum;
                        }, 0);
                        let visaExtra = this.visa_purpose === 2 ? 40 : 0;
                        return travelersTotal > 0 ? travelersTotal + visaExtra : travelersTotal;
                    },
                    // get num_of_travellers() {
                    //   return Array.from({
                    //     length: this.total_flight_reservation_travelers - 1
                    //   }, (_, i) => i + 2);
                    // },
                    get num_of_travellers_price() {
                        const prices = {
                            1: 20,
                            2: 28,
                            3: 42,
                            4: 56,
                            5: 70,
                            6: 84,
                            7: 98,
                            8: 112,
                        };
                        return prices[this.total_flight_reservation_travelers] || 0;
                    },
                    get_insurance_price(val) {
                        return (val.ageGroup * this.insurance_days) + (val.isUsCitizen == 1 ? 0 : 30) +
                            this.insurance_base_price;
                    },
                    get num_of_travellers_price_for_hotel_booking() {
                        const prices = {
                            1: 20,
                            2: 28,
                            3: 42,
                            4: 56,
                            5: 70,
                            6: 84,
                            7: 98,
                            8: 112,
                        };
                        return prices[this.total_hotel_booking_travelers] || 0;
                    },
                    get reset_flight_reservation_price() {
                        this.extra_flights = 0;
                        this.total_flight_reservation_travelers = 1;
                        this.form.num_of_travellers_info = [];
                    },
                    get reset_hotel_booking_price() {
                        this.extra_hotels = 0;
                        this.total_hotel_booking_travelers = 1;
                    },
                    get reset_travel_insurance_price() {
                        this.insurance_num_of_travellers = 1;
                        this.insurace_travellers_prices = [];
                        this.generateInsuranceTravelers;
                        this.end_date = '';
                        this.start_date = '';

                        this.insurance_days = 0;
                        this.visa_purpose = 1;
                    },
                    get reset_travel_guides_price() {
                        this.num_of_cities = '';
                        this.cities_prices = [];
                        this.updatePrices();
                    },
                    get extra_flight_price() {
                        const pricing = {
                            3: 0,
                            4: 0,
                            5: 10,
                            6: 20,
                            7: 30,
                            8: 40,
                            9: 50,
                        };
                        return pricing[this.extra_flights] || 0;
                    },
                    get extra_hotel_price() {
                        const pricing = {
                            3: 0,
                            4: 0,
                            5: 10,
                            6: 20,
                            7: 30,
                            8: 40,
                            9: 50,
                        };
                        return pricing[this.extra_hotels] || 0;
                    },
                    get flight_reservation_price() {
                        if (!this.showFlightForm) return 0;
                        return this.num_of_travellers_price + this.extra_flight_price;
                    },
                    get hotel_booking_price() {
                        if (!this.showHotelBooking) return 0;
                        return this.extra_hotel_price + this
                            .num_of_travellers_price_for_hotel_booking;
                    },
                    get urgent_reservation_price() {
                        const pricing = {
                            1: 30,
                            2: 15,
                        };
                        return pricing[this.urgent_reservation] || 0;
                    },
                    get total_order() {
                        let total = 0;
                        total += this.flight_reservation_price || 0;
                        total += this.hotel_booking_price || 0;
                        total += this.totalInsurancePrice || 0;
                        total += this.urgent_reservation_price || 0;
                        total += this.get_total_cities_prices || 0;
                        return total;
                    },
                    get get_total_cities_prices() {
                        let totalPrice = this.cities_prices.reduce((sum, price) => {
                            const num = Number(price);
                            if (!isNaN(num) && price !== null && price !== '' && price !==
                                0) {
                                return sum + num + 8;
                            }
                            return sum;
                        }, 0);
                        return totalPrice || 0;
                    },
                    getFlightPlaceholder(n) {
                        const placeholders = {
                            3: 'Departure from Paris to Edinburgh on 24 Feb 2025',
                            4: 'Departure from Edinburgh to Rome on 27 Feb 2025',
                            5: 'Departure from Rome to Barcelona on 3 March 2025',
                            6: 'Departure from Barcelona to Lisbon on 6 March 2025',
                            7: 'Departure from Lisbon to Athens on 10 March 2025',
                            8: 'Departure from Athens to Budapest on 15 March 2025',
                            9: 'Departure from Budapest to Prague on 17 March 2025'
                        };
                        return placeholders[n] || `Enter details for ${n}th flight`;
                    },
                    getHotelPlaceholder(n) {
                        const placeholders = {
                            3: 'Paris (Check-in 24 FEB 2025 - Checkout 27 FEB 2025)',
                            4: 'Paris (Check-in 27 FEB 2025 - Checkout 3 MAR 2025)',
                            5: 'Paris (Check-in 3 MAR 2025 - Checkout 6 MAR 2025)',
                            6: 'Paris (Check-in 6 MAR 2025 - Checkout 10 MAR 2025)',
                            7: 'Paris (Check-in 10 MAR 2025 - Checkout 15 MAR 2025)',
                            8: 'Paris (Check-in 15 MAR 2025 - Checkout 17 MAR 2025)',
                            9: 'Paris (Check-in 17 MAR 2025 - Checkout 20 MAR 2025)',
                        };
                        return placeholders[n] || `Enter details for ${n}th hotel stay`;
                    },
                    calculateDays(start, end) {
                        if (!start || !end) return '';
                        const startDate = new Date(start);
                        const endDate = new Date(end);
                        const diffTime = Math.abs(endDate - startDate);
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                        this.insurance_days = diffDays;
                        return `
                            <span class="text-primary font-medium text-xl">
                                <strong>${diffDays}</strong> day(s)
                            </span>`;
                    },

                    get requiredPaths() {
                        const paths = [];
                        const isSkipped = field =>
                            this.skipRules.some(rule => {
                                const flds = Array.isArray(rule.fields) ? rule.fields : [rule
                                    .fields
                                ];
                                return flds.includes(field) && rule.when.call(this);
                            });

                        Object.entries(this.rules).forEach(([field, rules]) => {
                            // 1) Nested-array fields
                            if (Array.isArray(rules)) {
                                rules.forEach((innerRules, idx) => {
                                    if (!isSkipped(field) && innerRules) {
                                        Object.entries(innerRules).forEach(([
                                            innerField,
                                            r
                                        ]) => {
                                            if (r.required) paths.push({
                                                field,
                                                idx,
                                                innerField
                                            });
                                        });
                                    }
                                });
                            }
                            // 2) Simple fields
                            else if (rules.required && !isSkipped(field)) {
                                paths.push({
                                    field
                                });
                            }
                        });
                        return paths;
                    },

                    get progress() {
                        const paths = this.requiredPaths;
                        const filled = paths.filter(p => {
                            if (p.innerField) {
                                const v = this.form[p.field]?.[p.idx]?.[p.innerField];
                                return v != null && String(v).trim() !== "";
                            }
                            const v = this.form[p.field];
                            return v != null && String(v).trim() !== "";
                        }).length;
                        var prog = paths.length ? Math.round((filled / paths.length) * 100) : 0;
                        console.log("this is the current prograess :", prog);
                        return prog;
                    },

                }));
            });
        </script>
<script>
  window.addEventListener('pageshow', function(event) {
    var navEntries = performance.getEntriesByType('navigation');
    var navType = navEntries.length
      ? navEntries[0].type
      : (performance.navigation && performance.navigation.type === performance.navigation.TYPE_BACK_FORWARD
         ? 'back_forward'
         : '');

                if (event.persisted || navType === 'back_forward') {


                    // find all forms and reset them
                    document.querySelectorAll('form').forEach(function(f) {
                        f.reset();
                    });
                }
            });
        </script>


</x-app-layout>
