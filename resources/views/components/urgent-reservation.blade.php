<div>
    <div class="mx-auto p-4">
                                    <!-- Heading -->
                                    <p class="mt-6 text-secondary font-semibold text-[16px]">
                                        Do You Want Your Reservation URGENT?
                                    </p>
                                    <p class="text-[14px] text-success">
                                        Typically URGENT Email Delivery Time Period is 6-8 Hours!
                                    </p>

                                    <!-- Visa Purpose Dropdown -->
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm items-start">
                                        <div class="col-span-12 md:col-span-6">
                                            <label
                                                class="block mb-1 font-quicksand text-sm font-medium text-tealDeep mb-2">
                                                For which visa purpose is this urgent reservation? *
                                            </label>
                                            <select name="visa_purpose" class="form-input w-full">
                                                <option value="" disabled selected>Select a purpose</option>
                                                <option value="Visitor_Visa">Visitor Visa</option>
                                                <option value="Student_Visa">Student Visa</option>
                                                <option value="Work_Visa">Work Visa</option>
                                                <option value="Immigration_Visa">Immigration Visa</option>
                                            </select>
                                            <span x-show="errors.visa_purpose" x-text="errors.visa_purpose"
                                                class="text-success text-xs mt-1"></span>
                                        </div>
                                    </div>
                                </div>
</div>