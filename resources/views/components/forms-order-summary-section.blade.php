<div 
    x-data="{
        num_of_travelers: 1,
        travelerCost: 20,
        num_of_flights: 1,
        flightCost: 0,
        totalPrice: 20,
        hotel_num_of_travelers: 1,
        hotel_travelerCost: 20,
        hotel_num_of_hotels: 1,
        hotel_hotelCost: 0,
        hotel_totalPrice: 20,
        hotelBookingEnabled: false,
        showTravelGuides: false,
        travel_guides: [],
        travelGuideCosts: [],
        totalTravelGuideCost: 0,
        urgentAmount: 0,
        urgentLabel: '',

       get grandTotal() {
            return (this.totalPrice + 
                   (this.hotelBookingEnabled ? this.hotel_totalPrice : 0) + 
                   this.totalTravelGuideCost + 
                   this.urgentAmount).toFixed(2);
        }
    }"
    x-init="$watch('showTravelGuides', value => { if (!value) { travel_guides = []; travelGuideCosts = []; totalTravelGuideCost = 0; } })"
    @update-order-summary.window="
        num_of_travelers = $event.detail.num_of_travelers;
        travelerCost = $event.detail.travelerCost;
        num_of_flights = $event.detail.num_of_flights;
        flightCost = $event.detail.flightCost;
        totalPrice = $event.detail.totalPrice;
    "
    @update-hotel-summary.window="
        hotel_num_of_travelers = $event.detail.num_of_travelers;
        hotel_travelerCost = $event.detail.travelerCost;
        hotel_num_of_hotels = $event.detail.num_of_hotels;
        hotel_hotelCost = $event.detail.hotelCost;
        hotel_totalPrice = $event.detail.totalHotelPrice;
    "
    @hotel-booking-toggle.window="hotelBookingEnabled = $event.detail.enabled"
    @travel-guide-toggle.window="showTravelGuides = $event.detail.enabled"
    @travel-guide-toggle.window="
    showTravelGuides = $event.detail.enabled;
    if ($event.detail.clear) {
        travel_guides = [];
        travelGuideCosts = [];
        totalTravelGuideCost = 0;
    }
    "
    @update-travel-guide-summary.window="
        if (showTravelGuides) {
            travel_guides = $event.detail.travel_guides;
            travelGuideCosts = $event.detail.travelGuideCosts;
            totalTravelGuideCost = $event.detail.totalTravelGuideCost;
        }
    "
    @update-urgent-summary.window="urgentAmount = $event.detail.urgentAmount; urgentLabel = $event.detail.urgentLabel"
    class="bg-white border-[#1960A9] border-[1px] p-4 h-fit sticky top-6"
>
    <div>
        <h3 class="font-semibold text-[24px] text-primary mb-4 text-center">Your Order Summary</h3>

        <!-- Flight Summary -->
        <div class="text-sm flex justify-between py-2">
            <span class="font-semibold text-secondary">Flight Reservation:</span>
            <span class="text-primary text-[18px] font-[600]" x-text="'$' + totalPrice.toFixed(2)"></span>
        </div>
        <div class="text-success text-[16px] mt-1" x-text="num_of_travelers + ' x Traveller'"></div>
        <div class='border-[#8BD3C8] border-b mb-3'></div>
    </div>

    <!-- Hotel Booking Summary Section -->
    <div x-show="hotelBookingEnabled">
        <div class="text-sm flex justify-between py-2">
            <span class="font-semibold text-secondary">Hotel Booking:</span>
            <span class="text-primary text-[18px] font-[600]" x-text="'$' + hotel_totalPrice.toFixed(2)"></span>
        </div>
        <div class="text-success text-[16px] mt-1" x-text="hotel_num_of_travelers + ' x Traveller'"></div>
        <div class='border-[#8BD3C8] border-b mb-3'></div>
    </div>

    <!-- Travel Guides Summary -->
       <template x-if="showTravelGuides && travel_guides.length">
        <div>
            <template x-for="(guide, index) in travel_guides" :key="index">
                <div class="text-sm flex justify-between pl-4">
                    <span x-text="'Travel Guide ' + (index + 1) + ':'"></span>
                    <span x-text="'$' + (travelGuideCosts[index] ? travelGuideCosts[index].toFixed(2) : '0.00')" class="text-primary font-semibold"></span>
                </div>
            </template>
            <div class="border-[#8BD3C8] border-b mb-3 mt-2"></div>
        </div>
    </template>

    <!-- Urgent Reservation Summary -->
    <template x-if="urgentAmount > 0">
        <div>
            <div class="text-sm flex justify-between py-2">
                <span class="font-semibold text-secondary">Urgent Reservation</span>
                <span class="text-primary text-[18px] font-[600]" x-text="'$' + urgentAmount.toFixed(2)"></span>
            </div>
            <div class="text-gray-400 text-[16px] mt-1" x-text="urgentLabel"></div>
            <div class="border-[#8BD3C8] border-b mb-3 mt-2"></div>
        </div>
    </template>

    <!-- Grand Total Section -->
    <div class="text-sm flex justify-between py-2">
        <span class="font-semibold text-primary text-[20px]">Grand Total:</span>
        <span class="text-primary text-[20px] font-[700]" x-text="'$' + grandTotal"></span>
    </div>
    <input type="hidden" name="grand_total" :value="grandTotal">

    
        <div class='border-[#8BD3C8] border-b mt-4'></div>

        <div class="mt-6 space-y-4">
            <h3 class="text-[20px] text-primary font-[600]">Pay Your Bill</h3>
            <h3 class="text-[18px] text-secondary font-[600]">How do you want to pay your bill? *</h3>
            <p class="text-[14px] text-secondary">We do accept all bank cards!</p>

            <div class="flex items-center gap-2">
                <input type="radio" id="card" name="payment" class="accent-primary" checked>
                <label for="card" class="text-[14px] text-secondary">Credit/Debit Cards</label>
            </div>

            <div class="flex items-center gap-2">
                <input type="radio" id="paypal" name="payment" class="accent-primary">
                <label for="paypal" class="text-[14px] text-secondary">PayPal</label>
            </div>

            <h3 class='text-[18px] font-[600] text-[#313638]'>We accept payments through following cards:</h3>
            <ul class="space-y-2 mt-2">
                <li class="flex items-start gap-8 text-[14px] text-secondary">
                    <span class="min-w-[20px] h-[20px] flex items-center justify-center rounded-full bg-primary">
                        <i class="fa-solid fa-check text-white text-[14px]"></i>
                    </span>
                    100% money back guarantee if not satisfied.
                </li>
                <li class="flex items-start gap-8 text-[14px] text-secondary">
                    <span class="min-w-[20px] h-[20px] flex items-center justify-center rounded-full bg-primary">
                        <i class="fa-solid fa-check text-white text-[14px]"></i>
                    </span>
                    Confirmed and verifiable itinerary.
                </li>
                <li class="flex items-start gap-8 text-[14px] text-secondary">
                    <span class="min-w-[20px] h-[20px] flex items-center justify-center rounded-full bg-primary">
                        <i class="fa-solid fa-check text-white text-[14px]"></i>
                    </span>
                    Pay via debit/credit card.
                </li>
            </ul>
        </div>


    <!-- Payment Card Logos -->
    <div class="mt-4 flex flex-row flex-wrap items-left gap-1">
        <img src="{{ asset('assets/visa.svg') }}" alt="visa" class="w-[65px] h-[54px]">
        <img src="{{ asset('assets/card-group.svg') }}" alt="card-group" class="w-[65px] h-[54px]">
        <img src="{{ asset('assets/american-express.svg') }}" alt="amex" class="w-[65px] h-[54px]">
        <img src="{{ asset('assets/discover.svg') }}" alt="discover" class="w-[65px] h-[54px]">
        <img src="{{ asset('assets/JCB.svg') }}" alt="jcb" class="w-[65px] h-[54px]">
        <img src="{{ asset('assets/union-pay.svg') }}" alt="union-pay" class="w-[65px] h-[54px]">
        <img src="{{ asset('assets/Diner-Club.svg') }}" alt="diners" class="w-[65px] h-[54px]">
        <img src="{{ asset('assets/wechat.svg') }}" alt="wechat" class="w-[65px] h-[54px]">
        <img src="{{ asset('assets/klarna.svg') }}" alt="klarna" class="w-[65px] h-[54px]">
    </div>

    <!-- Footer -->
    <div class="space-y-8 mt-8">
        <p class="text-gray-400">
            By clicking on ”Slide to Pay” below, you agree to our 
            <span class="underline text-black">terms & conditions </span>and 
            <span class="underline text-black">privacy policy.</span>
        </p>

        <button
            class="flex items-center justify-center w-full gap-2 px-4 py-2 rounded-[5px] bg-[#F4BD0F] text-primary font-[Quicksand] font-bold text-[16px]"
            style='box-shadow: -5px 5px 0px 0px #00000099' 
        >
            Pay Your Bill »
        </button>
    </div>
</div>