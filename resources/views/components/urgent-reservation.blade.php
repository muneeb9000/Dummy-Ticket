<div x-data="{
    urgentAmount: 0,
    urgentLabel: '',
    handleUrgentChange(event) {
        const value = event.target.value;
        if (value === '1') {
            this.urgentAmount = 30;
            this.urgentLabel = '6 Hours';
        } else if (value === '2') {
            this.urgentAmount = 20;
            this.urgentLabel = '8 Hours';
        } else {
            this.urgentAmount = 0;
            this.urgentLabel = '';
        }
        this.$dispatch('update-urgent-summary', {
            urgentAmount: this.urgentAmount,
            urgentLabel: this.urgentLabel
        });
    }
}">
    <div class="mx-auto p-4">
        <!-- Heading -->
        <p class="mt-6 text-secondary font-semibold text-[16px]">
            Do You Want Your Reservation URGENT?
        </p>
        <p class="text-[14px] text-success">
            Typically URGENT Email Delivery Time Period is 6-8 Hours!
        </p>

        <!-- Urgent Reservation Dropdown -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm items-start">
            <div class="col-span-12 md:col-span-6">
                <select name="urgent_reservation" class="form-input w-full" @change="handleUrgentChange($event)">
                    <option value="" selected>Select Please</option>
                    <option value="1">6 Hours ($30 Extra for urgent)</option>
                    <option value="2">8 Hours ($20 Extra for urgent)</option>
                </select>
                <span x-show="errors.urgent_reservation" x-text="errors.urgent_reservation"
                    class="text-success text-xs mt-1"></span>
            </div>
        </div>
    </div>
</div>
