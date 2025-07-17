<!-- Personal Details -->
<div class="mx-auto py-4 p-4" x-data="formValidation()">
    <!-- Form Inputs -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-6 mt-6 text-sm">

        <!-- Title -->
        <div>
            <label class="block mb-1 font-semibold text-secondary">Choose Your Title *</label>
            <div class="min-h-[16px] mb-1">
                <span x-show="errors.title" x-text="errors.title" class="text-success text-xs block"></span>
            </div>
            <select class="form-input w-full"
                    :class="{'error': errors.title}"
                    name="title"
                    x-model="form.title"
                    @change="validateField('title')"
                    @blur="validateField('title')">
                <option value="">Title</option>
                <option value="Mr">Mr.</option>
                <option value="Ms">Ms.</option>
                <option value="Mrs">Mrs.</option>
                <option value="Master">Master.</option>
            </select>
        </div>

        <!-- First Name -->
        <div>
            <label class="block mb-1 font-quicksand font-medium text-tealDeep flex items-center gap-1">
                Enter First Name? *
            </label>
            <div class="min-h-[16px] mb-1">
                <span x-show="errors.first_name" x-text="errors.first_name" class="text-success text-xs block"></span>
            </div>
            <input type="text"
                   name="first_name"
                   placeholder="First Name"
                   class="form-input w-full"
                   :class="{'error': errors.first_name}"
                   x-model="form.first_name"
                   @input="restrictInput($event, 'letters')"
                   @input.debounce.500ms="validateField('first_name')"
                   @blur="validateField('first_name')" />
        </div>

        <!-- Last Name -->
        <div>
            <label class="block mb-1 font-quicksand font-medium text-tealDeep flex items-center gap-1">
                Enter Last Name? *
            </label>
            <div class="min-h-[16px] mb-1">
                <span x-show="errors.last_name" x-text="errors.last_name" class="text-success text-xs block"></span>
            </div>
            <input type="text"
                   name="last_name"
                   placeholder="Last Name"
                   class="form-input w-full"
                   :class="{'error': errors.last_name}"
                   x-model="form.last_name"
                   @input="restrictInput($event, 'letters')"
                   @input.debounce.500ms="validateField('last_name')"
                   @blur="validateField('last_name')" />
        </div>

        <!-- Email -->
        <div>
            <label class="block mb-1 font-quicksand font-medium text-tealDeep">Your Email Address *</label>
            <div class="min-h-[16px] mb-1">
                <span x-show="errors.email" x-text="errors.email" class="text-success text-xs block"></span>
            </div>
            <input type="email"
                   name="email"
                   placeholder="Ex: jackson@gmail.com"
                   class="form-input w-full"
                   :class="{'error': errors.email}"
                   x-model="form.email"
                   @input.debounce.500ms="validateField('email')"
                   @blur="validateField('email')" />
        </div>

        <!-- Phone -->
        <div>
            <label class="block mb-1 font-quicksand font-medium text-tealDeep flex items-center gap-1">
                Your Phone No *
            </label>
            <div class="min-h-[16px] mb-1">
                <span x-show="errors.phone" x-text="errors.phone" class="text-success text-xs block"></span>
            </div>
            <input type="tel"
                   name="phone"
                   placeholder="1 646 555 2671"
                   class="form-input w-full"
                   :class="{'error': errors.phone}"
                   x-model="form.phone"
                   @input="restrictInput($event, 'numbers')"
                   @input.debounce.500ms="validateField('phone')"
                   @blur="validateField('phone')" />
        </div>

        <!-- Passport Number -->
        <div>
            <label class="block mb-1 font-quicksand font-medium text-tealDeep flex items-center gap-1">
                Enter your passport number *
            </label>
            <div class="min-h-[16px] mb-1">
                <span x-show="errors.passport_no" x-text="errors.passport_no" class="text-success text-xs block"></span>
            </div>
            <input type="text"
                   name="passport_no"
                   placeholder="A1234567"
                   class="form-input w-full"
                   :class="{'error': errors.passport_no}"
                   x-model="form.passport_no"
                   @input="restrictInput($event, 'alphanumeric')"
                   @input.debounce.500ms="validateField('passport_no')"
                   @blur="validateField('passport_no')" />
        </div>
    </div>

    <!-- Interview Date -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm items-start">
        <div class="col-span-12 md:col-span-6">
            <label class="block mb-1 font-quicksand text-sm font-medium text-tealDeep mb-2">
                Did you get visa interview date? *
            </label>
               <div class="min-h-[16px] mb-1"> </div>
            <select name="interview_documents"
                    x-model="form.interview_documents"
                    class="form-input w-full"
                    @change="validateField('visa_interview_date')">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

        <template x-if="form.interview_documents === 'Yes'">
            <div class="col-span-12 md:col-span-4 md:col-start-9">
                <label class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">
                    Your visa interview date? *
                </label>
                <div class="min-h-[16px] mb-1">
                    <span x-show="errors.visa_interview_date" x-text="errors.visa_interview_date" class="text-success text-xs block"></span>
                </div>
                <input name="visa_interview_date"
                       type="date"
                       class="form-input w-full"
                       :class="{'error': errors.visa_interview_date}"
                       x-model="form.visa_interview_date"
                       @change="validateField('visa_interview_date')"
                       @blur="validateField('visa_interview_date')" />
            </div>
        </template>
    </div>

    <!-- Delivery Option -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm items-start">
        <div class="col-span-12 md:col-span-6">
            <label class="block mb-1 font-quicksand text-sm font-medium text-tealDeep mb-2">
                Select document delivery date?*
            </label>
              <div class="min-h-[16px] mb-1"> </div>
            <select name="delivery_option"
                    x-model="form.delivery_option"
                    class="form-input w-full"
                    @change="validateField('future_delivery_date')">
                <option value="No, Delivery As Earliest">No, Delivery As Earliest</option>
                <option value="Schedule in Future Date">Schedule in Future Date</option>
            </select>
        </div>

        <template x-if="form.delivery_option === 'Schedule in Future Date'">
            <div class="col-span-12 md:col-span-4 md:col-start-9">
                <label class="block mb-1 font-quicksand font-medium text-sm text-tealDeep mb-2">
                    Select Future Delivery Date *
                </label>
                <div class="min-h-[16px] mb-1">
                    <span x-show="errors.future_delivery_date" x-text="errors.future_delivery_date" class="text-success text-xs block"></span>
                </div>
                <input name="future_delivery_date"
                       type="date"
                       class="form-input w-full"
                       :class="{'error': errors.future_delivery_date}"
                       x-model="form.future_delivery_date"
                       @change="validateField('future_delivery_date')"
                       @blur="validateField('future_delivery_date')" />
            </div>
        </template>
    </div>

    <!-- Alpine JS -->
    <script>
    function formValidation() {
        return {
            form: {
                title: '',
                first_name: '',
                last_name: '',
                email: '',
                phone: '',
                passport_no: '',
                interview_documents: 'No',
                visa_interview_date: '',
                delivery_option: 'No, Delivery As Earliest',
                future_delivery_date: ''
            },
            errors: {},

            validateField(fieldName) {
                let value = this.form[fieldName];
                let error = '';

                switch (fieldName) {
                    case 'title':
                        if (!value) error = 'Please select a title';
                        break;

                    case 'first_name':
                        if (!value) error = 'First name is required';
                        else if (value.length < 2) error = 'At least 2 characters';
                        else if (!/^[a-zA-Z\s]+$/.test(value)) error = 'Only letters and spaces';
                        break;

                    case 'last_name':
                        if (!value) error = 'Last name is required';
                        else if (value.length < 2) error = 'At least 2 characters';
                        else if (!/^[a-zA-Z\s]+$/.test(value)) error = 'Only letters and spaces';
                        break;

                    case 'email':
                        if (!value) error = 'Email is required';
                        else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) error = 'Invalid email';
                        break;

                    case 'phone':
                        if (!value) error = 'Phone is required';
                        else if (!/^\d{10,15}$/.test(value.replace(/\s/g, ''))) error = '10–15 digits required';
                        break;

                   case 'passport_no':
                        if (value && (value.length < 6 || value.length > 12)) {
                            error = 'Passport number must be 6–12 characters';
                        }
                        break;

                    case 'visa_interview_date':
                        if (this.form.interview_documents === 'Yes' && !value) error = 'Date is required';
                        else if (value && new Date(value) < new Date()) error = 'Date cannot be past';
                        break;

                    case 'future_delivery_date':
                        if (this.form.delivery_option === 'Schedule in Future Date' && !value) error = 'Date is required';
                        else if (value && new Date(value) <= new Date()) error = 'Must be after today';
                        break;
                }

                if (error) this.errors[fieldName] = error;
                else delete this.errors[fieldName];

                return !error;
            },

            validateAllFields() {
                let isValid = true;
                const fields = ['title', 'first_name', 'last_name', 'email', 'phone', 'passport_no'];

                if (this.form.interview_documents === 'Yes') fields.push('visa_interview_date');
                if (this.form.delivery_option === 'Schedule in Future Date') fields.push('future_delivery_date');

                fields.forEach(field => {
                    if (!this.validateField(field)) isValid = false;
                });

                return isValid;
            },

            restrictInput(event, type) {
                let value = event.target.value;
                switch (type) {
                    case 'letters': event.target.value = value.replace(/[^a-zA-Z\s]/g, ''); break;
                    case 'numbers': event.target.value = value.replace(/[^0-9]/g, ''); break;
                    case 'alphanumeric': event.target.value = value.replace(/[^a-zA-Z0-9]/g, ''); break;
                }
            },
        }
    }
    </script>
</div>
