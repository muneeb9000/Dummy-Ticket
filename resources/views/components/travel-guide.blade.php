<div>
    <div
                                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-x-4 gap-y-6 mt-6 text-sm">
                                        <!-- 1. No Of Cities -->
                                        <div class="col-span-12 sm:col-span-6 md:col-span-4">
                                            <label class="block mb-1 font-quicksand font-medium text-dark">No Of Cities
                                                *</label>
                                            <select name="no_of_cities" x-model="form.no_of_cities"
                                                class="form-input w-full" @change="validateField('no_of_cities')"
                                                @blur="validateField('no_of_cities')">
                                                <option value="" disabled selected>Select an option</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                            <span x-show="errors.no_of_cities" x-text="errors.no_of_cities"
                                                class="text-success text-xs mt-1"></span>
                                        </div>
                                    </div>

                                    <div x-data="{
                                                form: {
                                                    travel_guide_1: '',
                                                    travel_guide_2: ''
                                                },   
                                                errors: {}
                                            }" class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm items-start">

                                        <!-- Select Travel Guide 1 -->
                                        <div class="col-span-12 md:col-span-6">
                                            <label
                                                class="block mb-1 font-quicksand text-sm font-medium text-tealDeep mb-2">
                                                Select Travel Guide 1*
                                            </label>
                                            <select name="travel_guide_1" x-model="form.travel_guide_1"
                                                class="form-input w-full" @blur="validateField('travel_guide_1')">
                                                <option value="" disabled selected>Select a guide</option>
                                                <option value="John Doe">John Doe</option>
                                                <option value="Sarah Khan">Sarah Khan</option>
                                                <option value="Ali Ahmed">Ali Ahmed</option>
                                            </select>
                                            <span x-show="errors.travel_guide_1" x-text="errors.travel_guide_1"
                                                class="text-success text-xs mt-1"></span>
                                        </div>

                                        <!-- Select Travel Guide 2 -->
                                        <div class="col-span-12 md:col-span-6">
                                            <label
                                                class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">
                                                Select Travel Guide 2*
                                            </label>
                                            <input type="text" name="travel_guide_2" class="form-input w-full"
                                                placeholder="Enter second travel guide name"
                                                x-model="form.travel_guide_2"
                                                @input.debounce.500ms="validateField('travel_guide_2')"
                                                @blur="validateField('travel_guide_2')" />

                                            <span x-show="errors.travel_guide_2" x-text="errors.travel_guide_2"
                                                class="text-success text-xs mt-1"></span>
                                        </div>
                                    </div>
</div>