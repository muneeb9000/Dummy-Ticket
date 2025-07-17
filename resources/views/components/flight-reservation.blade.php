<div class="mx-auto py-4 p-4" x-data="flightReservationSection()" x-init="init()">

    <!-- Travelers Count -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm items-start">
        <div class="col-span-12 md:col-span-6">
            <label class="block mb-1 font-quicksand text-sm font-medium text-secondary">No Of Travelers: *</label>
            <p class="text-xs text-[#838083] mb-2">This is the flight reservation cost only</p>
            <select name="num_of_travelers" x-model="form.num_of_travelers" class="form-input w-full"
                @change="updateTravelers()">
                <option value="1">1 Traveler $20 USD</option>
                <option value="2">2 Travelers $28 USD (30% OFF)</option>
                <option value="3">3 Travelers $42 USD (30% OFF)</option>
                <option value="4">4 Travelers $56 USD (30% OFF)</option>
                <option value="5">5 Travelers $70 USD (30% OFF)</option>
                <option value="6">6 Travelers $84 USD (30% OFF)</option>
                <option value="7">7 Travelers $98 USD (30% OFF)</option>
                <option value="8">8 Travelers $112 USD (30% OFF)</option>
            </select>
            <p class="text-xs text-red-500" x-show="errors.num_of_travelers" x-text="errors.num_of_travelers"></p>
        </div>
    </div>

    <!-- Dynamic Traveler Fields -->
    <template x-for="(traveler, idx) in form.travelers" :key="idx">
        <div x-show="idx > 0" class="grid grid-cols-1 sm:grid-cols-3 gap-x-4 gap-y-6 mt-6 text-sm">
            <!-- Title -->
            <div>
                <label class="block mb-1 font-semibold text-secondary" x-text="getOrdinal(idx) + ' Title *'"></label>
                <div class="min-h-[18px]">
                  <span x-show="errors.travelers[idx]?.title" x-text="errors.travelers[idx]?.title"
                      class="text-success text-xs block mb-1"></span>
                </div>
                <select class="form-input w-full" x-model="traveler.title" 
                        @blur="validateTraveler(idx, 'title')" 
                        @change="validateTraveler(idx, 'title')">
                    <option value="">Title</option>
                    <option value="Mr">Mr.</option>
                    <option value="Ms">Ms.</option>
                    <option value="Mrs">Mrs.</option>
                    <option value="Master">Master.</option>
                </select>
            </div>

            <!-- First Name -->
            <div>
                <label class="block mb-1 font-quicksand font-medium text-tealDeep" 
                       x-text="getOrdinal(idx) + ' First Name? *'"></label>
                <div class="min-h-[18px]">
                  <span x-show="errors.travelers[idx]?.first_name" x-text="errors.travelers[idx]?.first_name"
                      class="text-success text-xs block mb-1"></span>
                </div>
                <input type="text" placeholder="First Name" class="form-input w-full"
                    x-model="traveler.first_name" @input="restrictInput($event, 'letters')"
                    @blur="validateTraveler(idx, 'first_name')" />
            </div>

            <!-- Last Name -->
            <div>
                <label class="block mb-1 font-quicksand font-medium text-tealDeep" 
                       x-text="getOrdinal(idx) + ' Last Name? *'"></label>
                <div class="min-h-[18px]">
                  <span x-show="errors.travelers[idx]?.last_name" x-text="errors.travelers[idx]?.last_name"
                      class="text-success text-xs block mb-1"></span>
                </div>
                <input type="text" placeholder="Last Name" class="form-input w-full"
                    x-model="traveler.last_name" @input="restrictInput($event, 'letters')"
                    @blur="validateTraveler(idx, 'last_name')" />
            </div>
        </div>
    </template>

    <!-- Flights Count -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-6 text-sm items-start">
        <div class="col-span-12 md:col-span-6">
            <label class="block mb-1 font-quicksand text-sm font-medium text-secondary">No Of Flights: *</label>
            <p class="text-xs text-[#838083] mb-2">This is the flight reservation cost only</p>
            <select name="num_of_flights" x-model="form.num_of_flights" class="form-input w-full"
                @change="updateFlights()">
                <option value="1">1 Flight $0/Free</option>
                <option value="2">2 Flight $0/Free</option>
                <option value="3">3 Flight $0/Free</option>
                <option value="4">4 Flight $0/Free</option>
                <option value="5">5 Flight - $5/Flight</option>
                <option value="6">6 Flight - $5/Flight</option>
                <option value="7">7 Flight - $5/Flight</option>
                <option value="8">8 Flight - $5/Flight</option>
            </select>
        </div>
    </div>

    <!-- Dynamic Flight Inputs -->
    <template x-for="(flight, idx) in form.flights" :key="idx">
        <div class="mt-4">
            <label class="block mb-1 font-quicksand font-semibold text-[16px] text-secondary"
                x-text="'Flight ' + (idx + 1) + ' *'"></label>
            <span x-show="errors.flights[idx]" x-text="errors.flights[idx]"
                class="text-success text-xs min-h-[18px] block mb-1"></span>
            <input type="text"
                :placeholder="'Example: Flight ' + (idx+1) + ' Departure From New York (10 May 2025) to Paris, Returning (20 May 2025) From Paris to New York.'"
                class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                x-model="form.flights[idx]" @blur="validateFlight(idx)" />
        </div>
    </template>

    <!-- Add More Flights -->
    <div class="mt-4">
        <button type="button"
            class="flex items-center justify-center gap-2 px-4 py-2 rounded-[5px] bg-[#F4BD0F] text-primary font-semibold text-[16px]"
            style="box-shadow: -5px 5px 0px 0px #00000099"
            @click="addFlight()" :disabled="form.flights.length >= 8">
            Add More Flights
        </button>
    </div>
    <!-- Additional Instructions -->
    <div class="mt-4">
        <p class="mt-3 text-secondary text-[16px] font-[600]">
            Mention that, if you have any intended arrival date in departure or returning.
        </p>
        <p class="text-success text-[14px]">
            Ex: Your departure is 10 Oct 2024 and you want to arrive on 11 Oct the next day or maybe the same day then mention <br />
            the date of arrival below.
        </p>
        <div class="mt-3">
            <input type="text"
                placeholder="Example: I want departure at 10 Oct and need arrival next day but not before."
                class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                name="arrival_instruction" />
        </div>

        <p class="mt-3 text-secondary text-[16px] font-[600]">
            Mention that, if you want or avoid any specific country layover/stop/transit.
        </p>
        <p class="text-success text-[14px]">
            Ex: If you want to avoid or add any country as a stop before you arrive at your destination then mention below so <br />
            we will consider while making your bookings.
        </p>
        <div class="mt-3">
            <input type="text"
                placeholder="Example: Please avoid UK and US stops/layovers because I don't have their transit visas."
                class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                name="layover_instruction" />
        </div>

        <p class="mt-3 text-secondary text-[16px] font-[600]">Any extra detail or instruction?</p>
        <div class="mt-3">
            <textarea rows="3"
                placeholder="Write any extra details or instructions like if you have any preferred airline"
                class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                name="extra_instruction"></textarea>
        </div>
    </div>

    <!-- Alpine JS Logic -->
    <script>
        function flightReservationSection() {
            return {
                form: {
                    num_of_travelers: 1,
                    travelers: [],
                    num_of_flights: 1,
                    flights: [''] // <-- one field by default
                },
                errors: {
                    travelers: [],
                    flights: [],
                    num_of_travelers: '' // <-- add this
                },
                travelerCost: 20,
                flightCost: 0,
                totalPrice: 20,
                init() {
                    this.updateTravelers();
                    this.updateFlights();
                },
                updateTravelers() {
                    const count = parseInt(this.form.num_of_travelers);
                    if (!count || count < 1) {
                        this.errors.num_of_travelers = 'Please select the number of travelers';
                    } else {
                        this.errors.num_of_travelers = '';
                    }
                    // Preserve existing data
                    const current = this.form.travelers || [];
                    if (current.length < count) {
                        // Add new empty travelers as needed
                        for (let i = current.length; i < count; i++) {
                            current.push({ title: '', first_name: '', last_name: '' });
                        }
                    } else if (current.length > count) {
                        // Trim the array if count decreased
                        current.length = count;
                    }
                    this.form.travelers = current;
                    // Adjust errors array as well
                    const currentErrors = this.errors.travelers || [];
                    if (currentErrors.length < count) {
                        for (let i = currentErrors.length; i < count; i++) {
                            currentErrors.push({});
                        }
                    } else if (currentErrors.length > count) {
                        currentErrors.length = count;
                    }
                    this.errors.travelers = currentErrors;
                    // Calculate traveler cost
                    let tCost = 20;
                    if (count === 2) tCost = 28;
                    else if (count === 3) tCost = 42;
                    else if (count === 4) tCost = 56;
                    else if (count === 5) tCost = 70;
                    else if (count === 6) tCost = 84;
                    else if (count === 7) tCost = 98;
                    else if (count === 8) tCost = 112;
                    this.travelerCost = tCost;
                    this.updateTotalPrice();
                    this.emitSummary();
                },
                updateFlights() {
                    const count = parseInt(this.form.num_of_flights);
                    // Preserve existing data
                    const current = this.form.flights || [];
                    if (current.length < count) {
                        for (let i = current.length; i < count; i++) {
                            current.push('');
                        }
                    } else if (current.length > count) {
                        current.length = count;
                    }
                    this.form.flights = current;
                    // Adjust errors array as well
                    const currentErrors = this.errors.flights || [];
                    if (currentErrors.length < count) {
                        for (let i = currentErrors.length; i < count; i++) {
                            currentErrors.push('');
                        }
                    } else if (currentErrors.length > count) {
                        currentErrors.length = count;
                    }
                    this.errors.flights = currentErrors;
                    // Calculate flight cost - first 4 flights are free, $5 for each additional flight
                    let fCost = 0;
                    if (count > 4) {
                        fCost = (count - 4) * 5; // Only charge for flights beyond the first 4
                    }
                    this.flightCost = fCost;
                    this.updateTotalPrice();
                    this.emitSummary();
                },
                updateTotalPrice() {
                    const sum = (this.travelerCost || 0) + (this.flightCost || 0);
                    this.totalPrice = sum < 20 ? 20 : sum;
                    this.emitSummary();
                },
                validateTraveler(index, field) {
                    const value = this.form.travelers[index][field];
                    let error = '';
                    const ordinal = this.getOrdinal(index);
                    let fieldLabel = '';
                    if (field === 'title') fieldLabel = 'Title';
                    else if (field === 'first_name') fieldLabel = 'First Name';
                    else if (field === 'last_name') fieldLabel = 'Last Name';
                    if (!value || value.trim() === '') {
                        error = `${ordinal} ${fieldLabel} is required`;
                    } else if (['first_name', 'last_name'].includes(field) && !/^[a-zA-Z\s]+$/.test(value)) {
                        error = 'Only letters and spaces allowed';
                    }
                    // Ensure the error object exists
                    if (!this.errors.travelers[index]) {
                        this.errors.travelers[index] = {};
                    }
                    this.errors.travelers[index][field] = error;
                },
                validateAllTravelers() {
                    this.form.travelers.forEach((traveler, index) => {
                        // Skip validation for the first traveler (index 0)
                        if (index > 0) {
                            this.validateTraveler(index, 'title');
                            this.validateTraveler(index, 'first_name');
                            this.validateTraveler(index, 'last_name');
                        }
                    });
                },
                validateFlight(index) {
                    const value = this.form.flights[index];
                    this.errors.flights[index] = !value || !value.trim() ? 'Flight details are required' : '';
                },
                validateAllFlights() {
                    this.form.flights.forEach((flight, index) => {
                        this.validateFlight(index);
                    });
                },
                validateAll() {
                    this.validateAllTravelers();
                    this.validateAllFlights();
                },
                restrictInput(event, type) {
                    let value = event.target.value;
                    if (type === 'letters') {
                        event.target.value = value.replace(/[^a-zA-Z\s]/g, '');
                    }
                },
                addFlight() {
                    if (this.form.flights.length < 8) {
                        this.form.flights.push('');
                        this.errors.flights.push('');
                        this.form.num_of_flights = this.form.flights.length;
                        this.updateFlights(); // Ensure price and summary update
                    }
                },
                getOrdinal(index) {
                    const suffixes = ['1st', '2nd', '3rd'];
                    const number = index + 1;
                    const suffix = suffixes[number - 1] || number + 'th';
                    return suffix;
                },
                emitSummary() {
                    this.$dispatch('update-order-summary', {
                        num_of_travelers: this.form.num_of_travelers,
                        travelerCost: this.travelerCost,
                        num_of_flights: this.form.num_of_flights,
                        flightCost: this.flightCost,
                        totalPrice: this.totalPrice
                    });
                }
            }
        }
    </script>
</div>