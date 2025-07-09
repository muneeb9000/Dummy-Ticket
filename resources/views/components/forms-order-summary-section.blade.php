<div class="border p-4 rounded-md shadow h-fit sticky top-6">
    <div>
        <h3 class="font-semibold text-xl text-primary mb-4">Order Summary</h3>
           <div :class="{'hidden': !showFlightHotel}" class="text-sm flex justify-between border-b py-2">
            <span class="font-semibold text-tealDeep">Flight & Hotel Bookings x <span class="text-primary" x-text="total_flight_reservation_travelers"></span></span>
            <span class="font-semibold" x-text="`$${flight_reservation_price.toString().includes('.')
        ? flight_reservation_price
        : flight_reservation_price + '.00'}`"></span>
            <input type="hidden" name="total_flight_reservation_&_hotel_bookings_price" :value="flight_reservation_price">
          </div>
          <span :class="{'hidden': showFlightHotel}">
        <div :class="{'hidden': !showFlightForm}" class="text-sm flex justify-between border-b py-2">
            <span class="font-semibold text-tealDeep">Flight Reservation x <span class="text-primary"
                    x-text="total_flight_reservation_travelers"></span></span>
            <span class="font-semibold" x-text="`$${flight_reservation_price}.00`"></span>
            <input type="hidden" name="total_flight_reservation_price" :value="flight_reservation_price">
        </div>

        <div :class="{'hidden': !showHotelBooking}" class="text-sm flex justify-between border-b py-2">
            <span class="font-semibold text-tealDeep">Hotel Booking x <span class="text-primary"
                    x-text="total_hotel_booking_travelers"></span></span>
            <span class="font-semibold" x-text="`$${hotel_booking_price}.00`"></span>
            <input type="hidden" name="total_hotel_booking_price" :value="hotel_booking_price">
          </div>
</span>
          <div :class="{'hidden': !showTravelInsurance}" class="text-sm flex justify-between border-b py-2">
            <span class="font-semibold text-tealDeep">Travel Inusrance x <span class="text-primary" x-text="insurance_num_of_travellers"></span></span>
            <div class="font-semibold" x-text="`$${totalInsurancePrice.toFixed(2)}`"></div>
            <input type="hidden" name="total_travel_insurance_price" :value="totalInsurancePrice">
        </div>
        <div :class="{'hidden': !showTravelGuides}">
            <div :class="{'hidden': !showTravelGuides}" class="text-sm flex justify-between border-b py-2">
                <span class="font-semibold text-tealDeep">Travel Guides x <span class="text-primary"
                        x-text="cities_prices.length"></span></span>
                <div class="font-semibold" x-text="`$${get_total_cities_prices.toFixed(2)}`"></div>
                <input type="hidden" name="total_travel_guides_price" :value="get_total_cities_prices">
            </div>
            {{-- <template x-for="(price, index) in cities_prices" :key="index">
                <div x-show="Number(price) && price !== '' && price !== null && price !== 0" class="text-sm flex justify-between border-b py-2">
            <span class="font-semibold text-tealDeep">Travel Guides x <span class="text-primary" x-text="index + 1"></span></span>
            <div class="font-semibold" >$<span  x-text="(Number(price) + 8).toFixed(2)"></span>  </div>
            </div>
            </template> --}}
        </div>

    </div>
    <div :class="{'hidden': !urgent_reservation}" class="text-sm flex justify-between border-b py-2">
        <span class="font-semibold text-tealDeep">Urgent Service Added</span>
        <div class="font-semibold" x-text="`$${urgent_reservation_price.toFixed(2)}`"></div>
    </div>

    <div class="text-xl font-bold flex justify-between py-4">
        <span class="text-tealDeep">Total</span>
        <span class="text-secondary" x-text="`$${Number(total_order).toFixed(2)}`"></span>
        <input type="hidden" name="total_order" :value="Number(total_order)">


    </div>

    <button type="submit"
        class="bg-secondary hover:bg-secondary_hover text-white w-full py-2 rounded font-semibold mb-4">
        Pay Your Bill
    </button>
    <ul class="text-sm space-y-2">
        <li class="flex items-start gap-2">
            <i class="fas fa-check-circle text-green-500 mt-1"></i>
            100% money back guarantee if not satisfied
        </li>
        <li class="flex items-start gap-2">
            <i class="fas fa-check-circle text-green-500 mt-1"></i>
            Confirmed and verifiable itinerary
        </li>
        <li class="flex items-start gap-2">
            <i class="fas fa-check-circle text-green-500 mt-1"></i>
            Pay via debit/credit card & PayPal
        </li>
    </ul>
    <div class="mt-4 grid grid-cols-12">
        <div class="col-span-6 ">
            <img src="{{asset('assets/comodo-secure.webp')}}" alt="comodo secure" class="w-[100px]">
        </div>
        <div class="col-span-6 ">
            <img src="{{asset('assets/buyer_protection_badge.png')}}" alt="comodo secure" class="w-[100%]">
        </div>
    </div>
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
