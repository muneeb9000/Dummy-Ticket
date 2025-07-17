<x-app-layout>
    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Hero Section -->
    <div class="my-container mb-4">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
            <div class="md:col-span-3">
                <h1 class="text-[32px] md:text-[46px] font-[700] my-4">Flight Reservation</h1>
                <p class="text-[#121212] text-[16px] font-[500] leading-relaxed">
                    Need a flight itinerary for your visa application? You're in the right place! Fill out the form below to place your order. Standard delivery is 12–24 hours (including weekends), with an urgent option available.
                </p>

                <!-- Steps Section -->
                <div class="flex flex-col items-center mt-6">
                    <div class="flex items-center justify-center gap-16">
                        <img src="{{ asset('assets/Frame1.png') }}" alt="Step 1" class="w-24 h-24" />
                        <img src="{{ asset('assets/Arrow 3.png') }}" alt="Arrow" class="w-8 h-4" />
                        <img src="{{ asset('assets/Frame1.png') }}" alt="Step 2" class="w-24 h-24" />
                        <img src="{{ asset('assets/Arrow 3.png') }}" alt="Arrow" class="w-8 h-4" />
                        <img src="{{ asset('assets/Frame1.png') }}" alt="Step 3" class="w-24 h-24" />
                    </div>

                    <div class="w-full mt-6">
                        <div class="h-[12px] bg-[#F4BD0F] rounded-xl relative overflow-hidden">
                            <div class="bg-[#1960A9] h-full w-[30%] rounded-xl"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-sm font-semibold text-primary">
                            <span>Fill the Form</span>
                            <span>Pay Invoice</span>
                            <span>Receive Docs</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2 flex justify-end items-center">
                <img src="{{ asset('assets/cuate.png')}}" alt="Illustration" class="max-w-full object-contain" />
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class='bg-[#D3F5FFBF]'>
        <div class="my-container py-5 font-quicksand flex flex-col md:flex-row gap-10"
             x-data="{
                hotelBooking: 'no',
                travelInsurance: 'no',
                travelGuide: 'no',
                interviewGuide: 'no'
             }">

            <!-- Left Side: Form -->
            <div class="bg-white border border-[#1960A9] w-full">
                <form method="POST" @submit.prevent="submitForm">
                    @csrf

                    <!-- Personal -->
                    <div class="bg-primary h-[60px] w-full">
                        <div class="flex items-center justify-center w-full max-w-4xl mx-auto md:p-3 gap-4">
                            <img src="{{ asset('assets/person.png')}}" alt="" />
                            <h2 class="text-[24px] text-white font-[500]">Personal Details</h2>
                        </div>
                    </div>
                    <x-personal-details />

                    <!-- Flight -->
                    <div class="bg-primary h-[60px] w-full">
                        <div class="flex items-center justify-center w-full max-w-4xl mx-auto md:p-3 gap-4">
                            <img src="{{ asset('assets/person.png')}}" alt="" />
                            <h2 class="text-[24px] text-white font-[500]">Flight Reservation</h2>
                        </div>
                    </div>
                    <x-flight-reservation />

                    <!-- Hotel Booking -->
                    <div class="bg-primary h-[60px] w-full">
                        <div class="flex items-center justify-center w-full max-w-4xl mx-auto md:p-3 gap-4">
                            <img src="{{ asset('assets/person.png')}}" alt="" />
                            <h2 class="text-[24px] text-white font-[500]">Hotel Booking</h2>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-secondary font-semibold text-[20px] mt-6">Do You Need Hotel Booking for each traveller?</p>
                        <div class="flex gap-6 mt-2">
                            <label class="flex items-center gap-1">
                                <input type="radio" name="hotelBookingToggle" x-model="hotelBooking" value="yes" class="text-primary"> Yes
                            </label>
                            <label class="flex items-center gap-1">
                                <input type="radio" name="hotelBookingToggle" x-model="hotelBooking" value="no" class="text-primary"> No
                            </label>
                        </div>
                        <template x-if="hotelBooking === 'yes'">
                            <div>
                                <x-hotel-booking />
                            </div>
                        </template>
                    </div>

                    <!-- Travel Insurance -->
                    <div class="bg-primary h-[60px] w-full">
                        <div class="flex items-center justify-center w-full max-w-4xl mx-auto md:p-3 gap-4">
                            <img src="{{ asset('assets/person.png')}}" alt="" />
                            <h2 class="text-[24px] text-white font-[500]">Travel Insurance</h2>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-secondary font-semibold text-[16px] mt-6">Do You Need Travel Insurance?</p>
                        <div class="flex gap-6 mt-2">
                            <label class="flex items-center gap-1">
                                <input type="radio" name="travelInsuranceToggle" x-model="travelInsurance" value="yes" class="text-primary"> Yes
                            </label>
                            <label class="flex items-center gap-1">
                                <input type="radio" name="travelInsuranceToggle" x-model="travelInsurance" value="no" class="text-primary"> No
                            </label>
                        </div>
                        <template x-if="travelInsurance === 'yes'">
                            <div>
                                <x-travel-insurance />
                                <x-travel-insurance-details />
                            </div>
                        </template>
                    </div>

                    <!-- Travel Guide -->
                    <div class="bg-primary h-[60px] w-full">
                        <div class="flex items-center justify-center w-full max-w-4xl mx-auto md:p-3 gap-4">
                            <img src="{{ asset('assets/person.png')}}" alt="" />
                            <h2 class="text-[24px] text-white font-[500]">Travel Guide</h2>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-secondary font-semibold text-[16px] mt-6">Do You Need Travel Guides to create a compelling visa story?</p>
                        <div class="flex gap-6 mt-2">
                            <label class="flex items-center gap-1">
                                <input type="radio" name="travelGuideToggle" x-model="travelGuide" value="yes" class="text-primary"> Yes
                            </label>
                            <label class="flex items-center gap-1">
                                <input type="radio" name="travelGuideToggle" x-model="travelGuide" value="no" class="text-primary"> No
                            </label>
                        </div>
                        <template x-if="travelGuide === 'yes'">
                            <div>
                                <x-travel-guide />
                            </div>
                        </template>
                    </div>

                    <!-- Interview Guide -->
                    <div class="bg-primary h-[60px] w-full">
                        <div class="flex items-center justify-center w-full max-w-4xl mx-auto md:p-3 gap-4">
                            <img src="{{ asset('assets/person.png')}}" alt="" />
                            <h2 class="text-[24px] text-white font-[500]">Interview Questions</h2>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-secondary font-semibold text-[16px] mt-6">Would you like a Schengen visa interview guide?</p>
                        <div class="flex gap-6 mt-2">
                            <label class="flex items-center gap-1">
                                <input type="radio" name="interviewGuideToggle" x-model="interviewGuide" value="yes" class="text-primary"> Yes
                            </label>
                            <label class="flex items-center gap-1">
                                <input type="radio" name="interviewGuideToggle" x-model="interviewGuide" value="no" class="text-primary"> No
                            </label>
                        </div>
                        <template x-if="interviewGuide === 'yes'">
                            <div>
                                <x-interview-questions />
                            </div>
                        </template>
                    </div>

                    <!-- Urgent Reservation -->
                    <div class="bg-primary h-[60px] w-full">
                        <div class="flex items-center justify-center w-full max-w-4xl mx-auto md:p-3 gap-4">
                            <img src="{{ asset('assets/person.png')}}" alt="" />
                            <h2 class="text-[24px] text-white font-[500]">Urgent Reservation</h2>
                        </div>
                    </div>
                    <x-urgent-reservation />
                </form>
            </div>

            <!-- Right Side: Summary -->
            <div class="mt-6 w-full max-w-sm">
                <x-forms-order-summary-section />
            </div>
        </div>
    </div>
</x-app-layout>
