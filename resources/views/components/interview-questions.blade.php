<div>
  <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4 text-sm items-start">
                                        <!-- Interview Visa Purpose -->
                                        <div class="col-span-12 md:col-span-6">
                                            <label
                                                class="block mb-1 font-quicksand text-[16px] font-medium text-tealDeep mb-2">
                                                For which visa purposes do you need an interview questionnaire?
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