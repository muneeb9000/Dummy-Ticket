<div class=" bg-white border-[#1960A9] border-[1px] p-4 h-fit sticky top-6">
    <div>
        <h3 class="font-semibold text-[24px] text-primary mb-4 text-center">Your Order Summary</h3>
        <!-- Main Row -->
        <div :class="{' hidden': !showFlightHotel}" class="text-sm flex justify-between  py-2">
            <span class="font-semibold text-secondary">Flight Reservation:</span>

            <div class="flex gap-4 items-center">
                <span class="text-primary text-[18px] font-[600]"
                    x-text="total_flight_reservation_travelers">$0.00</span>
                <span class="font-semibold"
                    x-text="`$${flight_reservation_price.toString().includes('.') ? flight_reservation_price : flight_reservation_price + '.00'}`"></span>
            </div>
            <input type="hidden" name="total_flight_reservation_&_hotel_bookings_price"
                :value="flight_reservation_price">
        </div>
        <!-- _ Traveller Below Line -->
        <div class="text-success text-[16px] mt-1">
            _ Traveller
        </div>
        <div class='border-[#8BD3C8] border-b mb-3'></div>

        <div class="mt-3 relative w-full max-w-md">
            <h2 class="text-[14px] text-secondary font-[600] mb-2">
                Any Promotional Code?
            </h2>

            <!-- Input field -->
            <input type="text" placeholder="Enter code here"
                class="w-full pr-[120px] border border-gray-300 rounded px-3 py-2 placeholder:text-[#86898B] text-sm" />

            <!-- Button inside input -->
            <button
                class="absolute top-[38%] right-0 -translate-y-[-14%] flex items-center justify-center gap-2 w-[180px] py-2 rounded-[5px] bg-[#F4BD0F] text-primary font-[Quicksand] font-bold text-[13px]"
                style="box-shadow: -3px 3px 0px 0px #00000099">
                Apply Code
            </button>
        </div>
        <div class='border-[#8BD3C8] border-b mt-4'></div>





        <span :class="{'hidden': showFlightHotel}">
            <div :class="{'hidden': !showFlightForm}" class="text-sm flex justify-between py-2">
                <span class="font-semibold text-secondary text-[20px] mt-3">Total Amount: <span class="text-primary"
                        x-text="total_flight_reservation_travelers"></span></span>
                <span class="font-semibold" x-text="`$${flight_reservation_price}.00`">$0.00</span>
                <input type="hidden" name="total_flight_reservation_price" :value="flight_reservation_price">
            </div>
            <div class='border-[#8BD3C8] border-b mt-4'></div>


            <div class="mt-6 space-y-4">
                <h3 class="text-[20px] text-primary font-[600]">Pay Your Bill</h3>

                <h3 class="text-[18px] text-secondary font-[600]">
                    How do you want to pay your bill? *
                </h3>

                <p class="text-[14px] text-secondary">
                    We do accept all bank cards!
                </p>

                <div class="flex items-center gap-2">
                    <input type="radio" id="card" name="payment" class="accent-primary" checked>
                    <label for="card" class="text-[14px] text-secondary">Credit/Debit Cards</label>
                </div>

                <div class="flex items-center gap-2">
                    <input type="radio" id="paypal" name="payment" class="accent-primary">
                    <label for="paypal" class="text-[14px] text-secondary">PayPal</label>
                </div>
                <h3 class='text-[18px] font-[600] text-[#313638]'>
                    We accept payments through following cards:
                </h3>
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

        </span>

        <div class="mt-4 flex flex-row flex-wrap justify-evenly md:justify-between   md:gap-3 items-center">
            <img src="{{asset('assets/visa.svg')}}" alt="visa" class="w-[65px] h-[54px]">
            <img src="{{asset('assets/master.svg')}}" alt="visa" class="w-[65px] h-[54px]">
            <img src="{{asset('assets/american-express.svg')}}" alt="visa" class="w-[65px] h-[54px]">
            <img src="{{asset('assets/discover.svg')}}" alt="visa" class="w-[65px] h-[54px]">
            <img src="{{asset('assets/jcb.svg')}}" alt="visa" class="w-[65px] h-[54px]">
            <img src="{{asset('assets/dinner-club.svg')}}" alt="visa" class="w-[65px] h-[54px]">
            <img src="{{asset('assets/mastero.svg')}}" alt="visa" class="w-[65px] h-[54px]">
            <img src="{{asset('assets/union-pay.svg')}}" alt="visa" class="w-[65px] h-[34px]">
            <img src="{{asset('assets/wechat.svg')}}" alt="visa" class="w-[65px] h-[34px]">
        </div>
    </div>