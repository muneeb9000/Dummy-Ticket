<div x-data="travelGuideForm()" class="space-y-6">

    <!-- No Of Cities -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-x-4 gap-y-6 mt-6 text-sm">
        <div class="col-span-12 sm:col-span-6 md:col-span-4">
            <label class="block mb-1 font-quicksand font-medium text-dark">No Of Cities *</label>
            <select name="no_of_cities" x-model="form.no_of_cities" class="form-input w-full"
                @change="updateTravelGuides()" @blur="validateField('no_of_cities')">
                <option value="" disabled>Select an option</option>
                <template x-for="n in 6" :key="n">
                    <option :value="n" x-text="n"></option>
                </template>
            </select>
            <span x-show="errors.no_of_cities" x-text="errors.no_of_cities" class="text-success text-xs mt-1"></span>
        </div>
    </div>

    <!-- Dynamic Travel Guide Dropdowns -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
        <template x-for="(guide, index) in form.travel_guides" :key="index">
            <div>
                <label class="block mb-1 font-quicksand font-medium text-tealDeep">
                    Travel Guide <span x-text="index + 1"></span>*
                </label>
                <span x-show="errors['travel_guide_' + index]" x-text="errors['travel_guide_' + index]"
                class="text-success text-xs mt-1"></span>
                <select :name="'travel_guide_' + (index + 1)"
                        x-model="form.travel_guide_amounts[index]"
                        class="form-input w-full"
                        @change="setGuideSelection(index, $event)"
                        @blur="validateGuide(index)">
                    <option value="" disabled>Select a guide</option>
                    <x-num-of-cities/>
                </select>
              
            </div>
        </template>
    </div>

</div>

<script>
    function travelGuideForm() {
        return {
            form: {
                no_of_cities: '',
                travel_guides: [],
                travel_guide_amounts: []
            },
            errors: {},
            clearForm() {
                this.form.no_of_cities = '';
                this.form.travel_guides = [];
                this.form.travel_guide_amounts = [];
                this.errors = {};
                this.emitSummary();
                this.$dispatch('travel-guide-toggle', { enabled: false, clear: true });
            },

            updateTravelGuides() {
                const count = parseInt(this.form.no_of_cities) || 0;
                if (count > 6) return;

                // Initialize or truncate guide fields
                this.form.travel_guides = Array.from({ length: count }, (_, i) => this.form.travel_guides[i] || '');
                this.form.travel_guide_amounts = Array.from({ length: count }, (_, i) => this.form.travel_guide_amounts[i] || '');
                this.emitSummary();
            },

            validateField(field) {
                if (!this.form[field]) {
                    this.errors[field] = 'This field is required';
                } else {
                    delete this.errors[field];
                }
            },

            validateGuide(index) {
                if (!this.form.travel_guide_amounts[index]) {
                    this.errors['travel_guide_' + index] = 'Please select a travel guide';
                } else {
                    delete this.errors['travel_guide_' + index];
                }
                this.emitSummary();
            },

            setGuideSelection(index, event) {
                const select = event.target;
                const selectedOption = select.options[select.selectedIndex];
                const guideName = selectedOption.getAttribute('data-name') || selectedOption.text;
                const amount = select.value;
                this.form.travel_guides[index] = guideName;
                this.form.travel_guide_amounts[index] = amount;
                this.emitSummary();
            },

            emitSummary() {
                this.$dispatch('update-travel-guide-summary', {
                    travel_guides: this.form.travel_guides,
                    travelGuideCosts: this.form.travel_guide_amounts.map(a => parseFloat(a) || 0),
                    totalTravelGuideCost: this.form.travel_guide_amounts.reduce((sum, a) => sum + (parseFloat(a) || 0), 0)
                });
            }
        }
    }
</script>
