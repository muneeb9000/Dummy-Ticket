<div>
    <!-- Conditional Hotel Booking Form -->
   
        <!-- No. of Travelers Dropdown -->
        <div x-data="{
            no_of_flights: '1',
            form: { no_of_flights: '1' },
            errors: {}
        }" class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm items-start">
            <div class="col-span-12 md:col-span-6">
                <label class="block mb-1 font-quicksand text-[16px] font-medium text-secondary">No Of Travelers: *</label>
                <p class="text-xs text-[#838083] mb-2">This is the flight reservation cost only</p>
                <select name="no_of_flights" x-model="no_of_flights" class="form-input w-full"
                    @change="form.no_of_flights = $event.target.value; validateField('no_of_flights')"
                    @blur="validateField('no_of_flights')">
                    <option value="1">1 Traveler $20 USD</option>
                    <option value="2">2 Travelers $35 USD (15% OFF)</option>
                    <option value="3">3 Travelers $42 USD (30% OFF)</option>
                    <option value="4">4 Travelers $48 USD (40% OFF)</option>
                    <option value="5">5 Travelers $50 USD (50% OFF)</option>
                </select>
                <span x-show="errors.no_of_flights" x-text="errors.no_of_flights" class="text-success text-xs mt-1"></span>
            </div>
        </div>

        <!-- Traveler Fields -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-6 mt-6 text-sm">
            <!-- 2nd Title -->
            <div>
                <label class="block mb-1 font-semibold text-secondary">Choose 2nd Title *</label>
                <select class="form-input w-full" name="title"
                    @change="form.title = $event.target.value; validateField('title')"
                    @blur="validateField('title')">
                    <option value="">Title</option>
                    <option value="Mr">Mr.</option>
                    <option value="Ms">Ms.</option>
                    <option value="Mrs">Mrs.</option>
                    <option value="Master">Master.</option>
                </select>
                <span x-show="errors.title" x-text="errors.title" class="text-success text-xs mt-1"></span>
            </div>

            <!-- 2nd First Name -->
            <div>
                <label class="block mb-1 font-quicksand font-medium text-tealDeep flex items-center gap-1">
                    2nd First Name? *
                    <div class="relative inline-flex group">
                        <i class="fas fa-question-circle text-gray-400 text-xs cursor-pointer hover:text-gray-600"></i>
                        <div class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-xs px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361]"></div>
                    </div>
                </label>
                <input type="text" name="first_name" placeholder="First Name" class="form-input w-full"
                    @input="form.first_name = $event.target.value"
                    @input.debounce.500ms="validateField('first_name')"
                    @blur="validateField('first_name')" />
                <span x-show="errors.first_name" x-text="errors.first_name" class="text-success text-xs mt-1"></span>
            </div>

            <!-- 2nd Last Name -->
            <div>
                <label class="block mb-1 font-quicksand font-medium text-tealDeep flex items-center gap-1">
                    2nd Last Name? *
                    <div class="relative inline-flex group">
                        <i class="fas fa-question-circle text-gray-400 text-xs cursor-pointer"></i>
                        <div class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-xs px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361]"></div>
                    </div>
                </label>
                <input type="text" name="last_name" placeholder="Last Name" class="form-input w-full"
                    @input="form.last_name = $event.target.value"
                    @input.debounce.500ms="validateField('last_name')"
                    @blur="validateField('last_name')" />
                <span x-show="errors.last_name" x-text="errors.last_name" class="text-success text-xs mt-1"></span>
            </div>

            <!-- 3rd Title -->
            <div>
                <label class="block mb-1 font-semibold text-secondary">Choose 3rd Title *</label>
                <select class="form-input w-full" name="title"
                    @change="form.title = $event.target.value; validateField('title')"
                    @blur="validateField('title')">
                    <option value="">Title</option>
                    <option value="Mr">Mr.</option>
                    <option value="Ms">Ms.</option>
                    <option value="Mrs">Mrs.</option>
                    <option value="Master">Master.</option>
                </select>
                <span x-show="errors.title" x-text="errors.title" class="text-success text-xs mt-1"></span>
            </div>

            <!-- 3rd First Name -->
            <div>
                <label class="block mb-1 font-quicksand font-medium text-tealDeep flex items-center gap-1">
                    3rd First Name? *
                    <div class="relative inline-flex group">
                        <i class="fas fa-question-circle text-gray-400 text-xs cursor-pointer hover:text-gray-600"></i>
                        <div class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-xs px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361]"></div>
                    </div>
                </label>
                <input type="text" name="3rd_first_name" placeholder="First Name" class="form-input w-full"
                    @input="form.first_name = $event.target.value"
                    @input.debounce.500ms="validateField('3rd_first_name')"
                    @blur="validateField('3rd_first_name')" />
                <span x-show="errors.3rd_first_name" x-text="errors.3rd_first_name" class="text-success text-xs mt-1"></span>
            </div>

            <!-- 3rd Last Name -->
            <div>
                <label class="block mb-1 font-quicksand font-medium text-tealDeep flex items-center gap-1">
                    3rd Last Name? *
                    <div class="relative inline-flex group">
                        <i class="fas fa-question-circle text-gray-400 text-xs cursor-pointer"></i>
                        <div class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-xs px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361]"></div>
                    </div>
                </label>
                <input type="text" name="last_name" placeholder="Last Name" class="form-input w-full"
                    @input="form.last_name = $event.target.value"
                    @input.debounce.500ms="validateField('last_name')"
                    @blur="validateField('last_name')" />
                <span x-show="errors.last_name" x-text="errors.last_name" class="text-success text-xs mt-1"></span>
            </div>
        </div>

        <!-- No. of Hotels Dropdown -->
        <div x-data="{
            no_of_flights: '1',
            form: { no_of_flights: '1' },
            errors: {}
        }" class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm items-start">
            <div class="col-span-12 md:col-span-6">
                <label class="block mb-1 font-quicksand text-[16px] font-medium text-[#121212]">No Of Hotels: *</label>
                <p class="text-xs text-[#838083] mb-2">This is the flight reservation cost only</p>
                <select name="no_of_flights" x-model="no_of_flights" class="form-input w-full"
                    @change="form.no_of_flights = $event.target.value; validateField('no_of_flights')"
                    @blur="validateField('no_of_flights')">
                    <option value="1">1 Traveler $20 USD</option>
                    <option value="2">2 Travelers $35 USD (15% OFF)</option>
                    <option value="3">3 Travelers $42 USD (30% OFF)</option>
                    <option value="4">4 Travelers $48 USD (40% OFF)</option>
                    <option value="5">5 Travelers $50 USD (50% OFF)</option>
                </select>
                <span x-show="errors.no_of_flights" x-text="errors.no_of_flights" class="text-success text-xs mt-1"></span>
            </div>
        </div>

        <!-- Hotel Details Textarea -->
        <div>
            <p class="mt-3 text-secondary text-[16px] font-[600]">Your Hotel Details:*</p>
            <p class="text-[14px] text-light">
                City - (Check in Date - Check out Date)<br />
                Max: 5 hotels are allowed within 1 trip. More than that, please contact us on chat.
            </p>
            <div class="mt-3">
                <textarea rows="3" type="text"
                    placeholder="City Paris - (Check in 11 May 2025 and Check out 15 May 2025"
                    class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                    name="flight-1"></textarea>
            </div>
        </div>

</div>
