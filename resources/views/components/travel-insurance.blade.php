<div>
     <!-- Conditional Form -->
        <div x-data="{
                    no_of_flights: '1',
                    form: {
                        no_of_flights: '1'
                    },
                    errors: {}
                }" class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm items-start">
            <!-- No. of Travelers Dropdown -->
            <div class="col-span-12 md:col-span-6">
                <label class="block mb-1 font-quicksand text-[16px] font-medium text-dark">
                    What is the purpose of this insurance?*
                </label>
                <p class="text-xs text-[#838083] mb-2">
                    This is the hotel bookings cost only
                </p>
                <select name="no_of_flights" x-model="no_of_flights"
                    class="form-input w-full"
                    @change="form.no_of_flights = $event.target.value; validateField('no_of_flights')"
                    @blur="validateField('no_of_flights')">

                    <option value="1">Just for visa purpose</option>
                    <option value="2">Visa and actual journey usable</option>
                </select>
                <span x-show="errors.no_of_flights" x-text="errors.no_of_flights"
                    class="text-success text-xs mt-1"></span>
            </div>
        </div>
        <!-- text-condition -->
        <div x-show="interview_documents == 'No, Delivery As Earliest'"
            class="bg-blue-100 max-md:text-[12px] text-sm text-gray-700 border border-blue-300 p-4 mt-4 rounded">
            <div class="font-semibold mb-2 flex items-center gap-1">
                <i class="fas fa-info-circle text-blue-500"></i> Note:
            </div>
            <ul class="list-disc pl-6 space-y-1">
                <li>You will receive your booking document in the next 12-24 hours including
                    weekend
                    days. If you need urgently then select the urgent delivery option at the
                    bottom
                    of this form</li>
                <li><strong class="text-tealDeep">Tip:</strong> Good for those who have visa
                    appointments in the next 1 or 2 days later.</li>
            </ul>
        </div>
        <!-- no-of-travelers -->
        <div x-data="{
                    no_of_flights: '1',
                    form: {
                        no_of_flights: '1'
                    },
                    errors: {}
                }" class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm items-start">
            <!-- No. of Travelers Dropdown -->
            <div class="col-span-12 md:col-span-6">
                <label class="block mb-1 font-quicksand text-[16px] font-medium text-dark">
                    No Of Travelers: *
                </label>
                <p class="text-xs text-light mb-2">
                    Select no of travelers for travel insurance
                </p>
                <select name="no_of_flights" x-model="no_of_flights"
                    class="form-input w-full"
                    @change="form.no_of_flights = $event.target.value; validateField('no_of_flights')"
                    @blur="validateField('no_of_flights')">

                    <option value="1">1 Traveler</option>
                    <option value="2">2 Traveler</option>
                    <option value="3">3 Traveler</option>
                    <option value="4">4 Traveler</option>

                </select>
                <span x-show="errors.no_of_flights" x-text="errors.no_of_flights"
                    class="text-success text-xs mt-1"></span>
            </div>
            <!-- travelling from -->
        </div>
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-x-4 gap-y-6 mt-6 text-sm">
            <!-- Travelling From -->
            <div class="col-span-1">
                <label class="block mb-1 font-quicksand text-[16px] font-medium text-dark">
                    Where are you traveling From?*
                </label>
                <input type="text" name="travelling_from" x-model="form.travelling_from"
                    @blur="validateField('travelling_from')" class="form-input w-full"
                    placeholder="Enter departure city" />
                <span x-show="errors.travelling_from" x-text="errors.travelling_from"
                    class="text-success text-xs mt-1"></span>
            </div>

            <!-- Travelling To -->
            <div class="col-span-1">
                <label class="block mb-1 font-quicksand text-[16px] font-medium text-daek">
                    Where are you traveling To?*
                </label>
                <input type="text" name="travelling_to" x-model="form.travelling_to"
                    @blur="validateField('travelling_to')" class="form-input w-full"
                    placeholder="Enter destination city" />
                <span x-show="errors.travelling_to" x-text="errors.travelling_to"
                    class="text-success text-xs mt-1"></span>
            </div>
        </div>
        <!-- start end and requiring insurence -->
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-6 mt-6 text-sm">
            <div>
                <label
                    class="block mb-1 font-quicksand font-medium text-dark flex items-center gap-1">
                    When Your Trip End:*
                    <div class="relative inline-flex group">
                        <i
                            class="fas fa-question-circle text-gray-400 text-xs cursor-pointer hover:text-gray-600"></i>
                        <div
                            class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-xs px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361]">
                        </div>
                    </div>
                </label>
                <input type="date" name="end_date" placeholder="end_date"
                    class="form-input w-full" @input="form.first_name = $event.target.value"
                    @input.debounce.500ms="validateField('first_name')"
                    @blur="validateField('first_name')" />
                <span x-show="errors.first_name" x-text="errors.first_name"
                    class="text-success text-xs mt-1"></span>
            </div>
            <div>
                <label
                    class="block mb-1 font-quicksand font-medium text-dark flex items-center gap-1">
                    When Your Trip Start:*
                    <div class="relative inline-flex group">
                        <i
                            class="fas fa-question-circle text-gray-400 text-xs cursor-pointer hover:text-gray-600"></i>
                        <div
                            class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-xs px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361]">
                        </div>
                    </div>
                </label>
                <input type="date" name="end_date" placeholder="end_date"
                    class="form-input w-full" @input="form.first_name = $event.target.value"
                    @input.debounce.500ms="validateField('first_name')"
                    @blur="validateField('first_name')" />
                <span x-show="errors.first_name" x-text="errors.first_name"
                    class="text-success text-xs mt-1"></span>
            </div>
            <div>
                <label
                    class="block mb-1 font-quicksand font-medium text-dark flex items-center gap-1">
                    Days of Requiring Insurance*
                    <div class="relative inline-flex group">
                        <i
                            class="fas fa-question-circle text-gray-400 text-xs cursor-pointer"></i>
                        <div
                            class="absolute left-1/2 -translate-x-1/2 bottom-full mb-3 w-max max-w-xs px-3 py-2 rounded-lg bg-[#495361] text-white text-sm shadow-xl border border-gray-700 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 ease-out z-50 pointer-events-none before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[8px] before:border-transparent before:border-t-[#495361]">
                        </div>
                    </div>
                </label>
                <input type="text" name="last_name" placeholder="Days"
                    class="form-input w-full" @input="form.last_name = $event.target.value"
                    @input.debounce.500ms="validateField('last_name')"
                    @blur="validateField('last_name')" />
                <span x-show="errors.last_name" x-text="errors.last_name"
                    class="text-success text-xs mt-1"></span>
            </div>
        </div>
        <div
            class="bg-blue-100 max-md:text-[12px] text-sm text-primary border border-blue-300 p-2 mt-4 rounded">
            <div class="font-semibold mb-2 flex items-center gap-1">
                <i class="fas fa-info-circle text-blue-500"></i>
            </div>
            <ul class="list-disc pl-6">
                <li>Both trip start and end date difference should be at least 6 days"</li>
            </ul>
        </div>
</div>