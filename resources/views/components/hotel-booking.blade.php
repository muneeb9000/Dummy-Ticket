<div x-data="hotelBookingSection()" x-init="init()">
    <!-- No. of Travelers Dropdown -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm items-start">
        <div class="col-span-12 md:col-span-6">
            <label class="block mb-1 font-quicksand text-[16px] font-medium text-secondary">No Of Travelers: *</label>
            <p class="text-xs text-[#838083] mb-2">This is the hotel booking cost only</p>
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
            <span class="text-success text-xs mt-1" x-show="errors.num_of_travelers" x-text="errors.num_of_travelers"></span>
        </div>
    </div>

    <!-- Dynamic Traveler Fields -->
    <template x-for="(traveler, idx) in form.travelers" :key="idx">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-4 gap-y-6 mt-6 text-sm">
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

    <!-- No. of Hotels Dropdown -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm items-start">
        <div class="col-span-12 md:col-span-6">
            <label class="block mb-1 font-quicksand text-[16px] font-medium text-[#121212]">No Of Hotels: *</label>
            <p class="text-xs text-[#838083] mb-2">This is the hotel booking cost only</p>
            <select name="num_of_hotels" x-model="form.num_of_hotels" class="form-input w-full"
                @change="updateHotels()">
                <option value="1">1 Hotel $0/Free</option>
                <option value="2">2 Hotel $0/Free</option>
                <option value="3">3 Hotel $0/Free</option>
                <option value="4">4 Hotel $0/Free</option>
                <option value="5">5 Hotel - $5/Hotel</option>
                <option value="6">6 Hotel - $5/Hotel</option>
                <option value="7">7 Hotel - $5/Hotel</option>
                <option value="8">8 Hotel - $5/Hotel</option>
            </select>
            <span class="text-success text-xs mt-1" x-show="errors.num_of_hotels" x-text="errors.num_of_hotels"></span>
        </div>
    </div>

    <!-- Dynamic Hotel Fields -->
    <template x-for="(hotel, idx) in form.hotels" :key="idx">
        <div class="mt-4">
            <label class="block mb-1 font-quicksand font-semibold text-[16px] text-secondary"
                x-text="'Hotel ' + (idx + 1) + ' *'"></label>
            <span x-show="errors.hotels[idx]" x-text="errors.hotels[idx]"
                class="text-success text-xs min-h-[18px] block mb-1"></span>
            <input type="text"
                :placeholder="'Example: City Paris - (Check in 11 May 2025 and Check out 15 May 2025)'"
                class="form-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-sm placeholder:text-gray-500"
                x-model="form.hotels[idx]" @blur="validateHotel(idx)" />
        </div>
    </template>

    <!-- Alpine JS Logic -->
    <script>
        function hotelBookingSection() {
            return {
                form: {
                    num_of_travelers: 1,
                    travelers: [],
                    num_of_hotels: 1,
                    hotels: ['']
                },
                errors: {
                    travelers: [],
                    hotels: [],
                    num_of_travelers: '',
                    num_of_hotels: ''
                },
                travelerCost: 20,
                hotelCost: 0,
                totalPrice: 20,
                init() {
                    this.updateTravelers();
                    this.updateHotels();
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
                        for (let i = current.length; i < count; i++) {
                            current.push({ title: '', first_name: '', last_name: '' });
                        }
                    } else if (current.length > count) {
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
                updateHotels() {
                    const count = parseInt(this.form.num_of_hotels);
                    // Preserve existing data
                    const current = this.form.hotels || [];
                    if (current.length < count) {
                        for (let i = current.length; i < count; i++) {
                            current.push('');
                        }
                    } else if (current.length > count) {
                        current.length = count;
                    }
                    this.form.hotels = current;
                    // Adjust errors array as well
                    const currentErrors = this.errors.hotels || [];
                    if (currentErrors.length < count) {
                        for (let i = currentErrors.length; i < count; i++) {
                            currentErrors.push('');
                        }
                    } else if (currentErrors.length > count) {
                        currentErrors.length = count;
                    }
                    this.errors.hotels = currentErrors;
                    // Calculate hotel cost - first 4 hotels are free, $5 for each additional hotel
                    let hCost = 0;
                    if (count > 4) {
                        hCost = (count - 4) * 5;
                    }
                    this.hotelCost = hCost;
                    this.updateTotalPrice();
                    this.emitSummary();
                },
                updateTotalPrice() {
                    const sum = (this.travelerCost || 0) + (this.hotelCost || 0);
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
                    if (!this.errors.travelers[index]) {
                        this.errors.travelers[index] = {};
                    }
                    this.errors.travelers[index][field] = error;
                },
                validateHotel(index) {
                    const value = this.form.hotels[index];
                    this.errors.hotels[index] = !value || !value.trim() ? `Hotel ${index + 1} details are required` : '';
                },
                restrictInput(event, type) {
                    let value = event.target.value;
                    if (type === 'letters') {
                        event.target.value = value.replace(/[^a-zA-Z\s]/g, '');
                    }
                },
                getOrdinal(index) {
                    const suffixes = ['1st', '2nd', '3rd'];
                    const number = index + 1;
                    const suffix = suffixes[number - 1] || number + 'th';
                    return suffix;
                },
                emitSummary() {
                    this.$dispatch('update-hotel-summary', {
                        num_of_travelers: this.form.num_of_travelers,
                        travelerCost: this.travelerCost,
                        num_of_hotels: this.form.num_of_hotels,
                        hotelCost: this.hotelCost,
                        totalHotelPrice: this.totalPrice
                    });
                }
            }
        }
    </script>
</div>
