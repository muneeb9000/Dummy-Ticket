<div>
    <div class="bg-primary h-[60px] w-full">
            <div class="flex items-center justify-center w-full max-w-4xl mx-auto md:p-3 gap-4">
                <img src="{{ asset('assets/person.png')}}" alt="" />
                <h2 class="text-[24px] text-white font-[500]">
                    Travel 1 Insurance Details
                </h2>
            </div>
        </div>
        <div class="mx-auto py-4 p-4">
            <div x-data="{
                        interview_documents: 'No',
                        form: { 
                            interview_documents: 'No', 
                            visa_interview_date: '' 
                        },
                        errors: {}
                    }" class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm items-start">
                <!-- Select Document Delivery -->
                <div class="col-span-12 md:col-span-6">
                    <label
                        class="block mb-1 font-quicksand text-sm font-medium text-tealDeep mb-2">
                        Traveler 1 First Name? *
                    </label>
                    <input type="text" name="traveler_1_first_name"
                        x-model="form.traveler_1_first_name" class="form-input w-full"
                        placeholder="Enter first name"
                        @blur="validateField('traveler_1_first_name')" />

                    <span x-show="errors.traveler_1_first_name"
                        x-text="errors.traveler_1_first_name"
                        class="text-success text-xs mt-1"></span>
                </div>
                <div class="col-span-12 md:col-span-6">
                    <label
                        class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">
                        Traveler 1 Last Name? *
                    </label>
                    <input type="text" name="traveler_1_last_name" class="form-input w-full"
                        placeholder="Enter last name" x-model="form.traveler_1_last_name"
                        @input.debounce.500ms="validateField('traveler_1_last_name')"
                        @blur="validateField('traveler_1_last_name')" />

                    <span x-show="errors.traveler_1_last_name"
                        x-text="errors.traveler_1_last_name"
                        class="text-success text-xs mt-1"></span>
                </div>
            </div>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-x-4 gap-y-6 mt-6 text-sm">

                <!-- 1. Are you a US Citizen? -->
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                    <label class="block mb-1 font-quicksand font-medium text-dark">Are you a US
                        Citizen? *</label>
                    <select name="us_citizen" x-model="form.us_citizen"
                        class="form-input w-full" @change="validateField('us_citizen')"
                        @blur="validateField('us_citizen')">
                        <option value="" disabled selected>Select an option</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    <span x-show="errors.us_citizen" x-text="errors.us_citizen"
                        class="text-success text-xs mt-1"></span>
                </div>

                <!-- 2. Traveller Age -->
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                    <label class="block mb-1 font-quicksand font-medium text-dark">Traveller Age
                        *</label>
                    <select name="traveller_age" x-model="form.traveller_age"
                        class="form-input w-full" @change="validateField('traveller_age')"
                        @blur="validateField('traveller_age')">
                        <option value="" disabled selected>Select age range</option>
                        <option value="18-21">18 - 21</option>
                        <option value="22-27">22 - 27</option>
                        <option value="28-35">28 - 35</option>
                        <option value="36-45">36 - 45</option>
                        <option value="46+">46 and above</option>
                    </select>
                    <span x-show="errors.traveller_age" x-text="errors.traveller_age"
                        class="text-success text-xs mt-1"></span>
                </div>

                <!-- 3. Date of Birth -->
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                    <label class="block mb-1 font-quicksand font-medium text-dark">Date of Birth
                        *</label>
                    <input type="date" name="date_of_birth" class="form-input w-full"
                        x-model="form.date_of_birth"
                        @input.debounce.500ms="validateField('date_of_birth')"
                        @blur="validateField('date_of_birth')" />
                    <span x-show="errors.date_of_birth" x-text="errors.date_of_birth"
                        class="text-success text-xs mt-1"></span>
                </div>

                <!-- 4. Choose Your Title -->
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                    <label class="block mb-1 font-quicksand font-medium text-dark">Choose Your
                        Title *</label>
                    <select name="title" x-model="form.title" class="form-input w-full"
                        @change="validateField('title')" @blur="validateField('title')">
                        <option value="" disabled selected>Select your title</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Master.">Master.</option>
                    </select>
                    <span x-show="errors.title" x-text="errors.title"
                        class="text-success text-xs mt-1"></span>
                </div>

                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                    <label class="block mb-1 font-quicksand font-medium text-dark">
                        Country of Citizenship? *
                    </label>
                    <input type="text" name="citizenship_country" class="form-input w-full"
                        x-model="form.citizenship_country" placeholder="Enter country"
                        @input.debounce.500ms="validateField('citizenship_country')"
                        @blur="validateField('citizenship_country')" />

                    <span x-show="errors.citizenship_country"
                        x-text="errors.citizenship_country"
                        class="text-success text-xs mt-1"></span>
                </div>

                <!-- Passport Number (Optional) -->
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                    <label class="block mb-1 font-quicksand font-medium text-dark">
                        Passport Number
                        <span class="text-xs text-gray-500 ml-1">(Optional)</span>
                    </label>
                    <input type="text" name="passport" class="form-input w-full"
                        x-model="form.passport" placeholder="Enter passport number (if any)"
                        @input.debounce.500ms="validateField('passport')"
                        @blur="validateField('passport')" />

                    <span x-show="errors.passport" x-text="errors.passport"
                        class="text-success text-xs mt-1"></span>
                </div>


                <!-- Home Country -->
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                    <label class="block mb-1 font-quicksand font-medium text-dark">Home Country?
                        *</label>
                    <input type="text" name="home_country" class="form-input w-full"
                        x-model="form.home_country" placeholder="Enter your home country"
                        @input.debounce.500ms="validateField('home_country')"
                        @blur="validateField('home_country')" />

                    <span x-show="errors.home_country" x-text="errors.home_country"
                        class="text-success text-xs mt-1"></span>
                </div>

                <!-- Home Country Address -->
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                    <label class="block mb-1 font-quicksand font-medium text-dark">Home Country
                        Address? *</label>
                    <input type="text" name="home_country_address" class="form-input w-full"
                        x-model="form.home_country_address"
                        placeholder="Enter your home country address"
                        @input.debounce.500ms="validateField('home_country_address')"
                        @blur="validateField('home_country_address')" />

                    <span x-show="errors.home_country_address"
                        x-text="errors.home_country_address"
                        class="text-success text-xs mt-1"></span>
                </div>

                <!-- Home Country State -->
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                    <label class="block mb-1 font-quicksand font-medium text-dark">Home Country
                        State? *</label>
                    <input type="text" name="home_country_state" class="form-input w-full"
                        x-model="form.home_country_state" placeholder="Enter your state"
                        @input.debounce.500ms="validateField('home_country_state')"
                        @blur="validateField('home_country_state')" />

                    <span x-show="errors.home_country_state" x-text="errors.home_country_state"
                        class="text-success text-xs mt-1"></span>
                </div>


                <!-- Home Country City -->
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                    <label class="block mb-1 font-quicksand font-medium text-dark">Home Country
                        City? *</label>
                    <input type="text" name="home_country_city" class="form-input w-full"
                        x-model="form.home_country_city" placeholder="Enter your city"
                        @input.debounce.500ms="validateField('home_country_city')"
                        @blur="validateField('home_country_city')" />

                    <span x-show="errors.home_country_city" x-text="errors.home_country_city"
                        class="text-success text-xs mt-1"></span>
                </div>

                <!-- Home Country Postal Code -->
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                    <label class="block mb-1 font-quicksand font-medium text-dark">Home Country
                        Postal Code? *</label>
                    <input type="text" name="home_postal_code" class="form-input w-full"
                        x-model="form.home_postal_code" placeholder="Enter postal code"
                        @input.debounce.500ms="validateField('home_postal_code')"
                        @blur="validateField('home_postal_code')" />

                    <span x-show="errors.home_postal_code" x-text="errors.home_postal_code"
                        class="text-success text-xs mt-1"></span>
                </div>

                <!-- Home Country Phone Number -->
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                    <label class="block mb-1 font-quicksand font-medium text-dark">Home Country
                        Phone no.? *</label>
                    <input type="tel" name="home_country_phone" class="form-input w-full"
                        x-model="form.home_country_phone" placeholder="+1 (302) 219-4576"
                        @input.debounce.500ms="validateField('home_country_phone')"
                        @blur="validateField('home_country_phone')" />

                    <span x-show="errors.home_country_phone" x-text="errors.home_country_phone"
                        class="text-success text-xs mt-1"></span>
                </div>
            </div>
            <div x-data="{
                            form: {                                                      
                                beneficiary_name: '',
                                beneficiary_relationship: ''
                            },   
                            errors: {}
                        }"
                class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm items-start">

                <!-- Beneficiary Name -->
                <div class="col-span-12 md:col-span-6">
                    <label
                        class="block mb-1 font-quicksand text-sm font-medium text-tealDeep mb-2">
                        Beneficiary Name? <span class="text-[10px] text-gray-500">(Can't be
                            yourself)</span> *
                    </label>
                    <input type="text" name="beneficiary_name" x-model="form.beneficiary_name"
                        class="form-input w-full" placeholder="Enter beneficiary name"
                        @blur="validateField('beneficiary_name')" />

                    <span x-show="errors.beneficiary_name" x-text="errors.beneficiary_name"
                        class="text-success text-xs mt-1"></span>
                </div>

                <!-- Beneficiary Relationship -->
                <div class="col-span-12 md:col-span-6">
                    <label
                        class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">
                        Beneficiary Relationship? *
                    </label>
                    <input type="text" name="beneficiary_relationship" class="form-input w-full"
                        placeholder="Enter relationship (e.g. spouse, sibling)"
                        x-model="form.beneficiary_relationship"
                        @input.debounce.500ms="validateField('beneficiary_relationship')"
                        @blur="validateField('beneficiary_relationship')" />

                    <span x-show="errors.beneficiary_relationship"
                        x-text="errors.beneficiary_relationship"
                        class="text-success text-xs mt-1"></span>
                </div>
            </div>
            <button
                class="flex items-center justify-center gap-2 mt-4 px-4 py-2 rounded-[5px] bg-[#F4BD0F] text-primary font-[Quicksand] font-bold text-[16px]"
                style='box-shadow: -5px 5px 0px 0px #00000099'>
                +1 (302) 219-0076
            </button>

        </div>
</div>