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
            <span x-show="errors.travelers[idx]?.title" x-text="errors.travelers[idx]?.title"
                class="text-success text-xs min-h-[18px] block mb-1"></span>
            <select class="form-input w-full" x-model="traveler.title" @blur="validateTraveler(idx, 'title')">
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
            <span x-show="errors.travelers[idx]?.first_name" x-text="errors.travelers[idx]?.first_name"
                class="text-success text-xs min-h-[18px] block mb-1"></span>
            <input type="text" placeholder="First Name" class="form-input w-full"
                x-model="traveler.first_name" @input="restrictInput($event, 'letters')"
                @blur="validateTraveler(idx, 'first_name')" />
        </div>

        <!-- Last Name -->
        <div>
            <label class="block mb-1 font-quicksand font-medium text-tealDeep" 
                   x-text="getOrdinal(idx) + ' Last Name? *'"></label>
            <span x-show="errors.travelers[idx]?.last_name" x-text="errors.travelers[idx]?.last_name"
                class="text-success text-xs min-h-[18px] block mb-1"></span>
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
                    this.form.travelers = Array.from({ length: count }, () => ({
                        title: '',
                        first_name: '',
                        last_name: ''
                    }));
                    this.errors.travelers = Array(count).fill({});
                },

                updateFlights() {
                    const count = parseInt(this.form.num_of_flights);
                    this.form.flights = Array(count).fill('');
                    this.errors.flights = Array(count).fill('');
                },

                validateTraveler(index, field) {
                    const value = this.form.travelers[index][field];
                    let error = '';

                    if (!value) {
                        error = `${field.replace('_', ' ')} is required`;
                    } else if (['first_name', 'last_name'].includes(field) && !/^[a-zA-Z\s]+$/.test(value)) {
                        error = 'Only letters and spaces allowed';
                    }

                    this.$set(this.errors.travelers[index], field, error);
                },

                validateFlight(index) {
                    const value = this.form.flights[index];
                    this.errors.flights[index] = !value.trim() ? 'Flight details are required' : '';
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
                    }
                },

                getOrdinal(index) {
                    const suffixes = ['1st', '2nd', '3rd'];
                    const number = index + 1;
                    const suffix = suffixes[number - 1] || number + 'th';
                    return suffix;
                }
            }
        }
    </script>
</div>
