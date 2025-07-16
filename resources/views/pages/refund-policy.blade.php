<x-app-layout>
    <style>
    body {
        background-color: #f2f2f2;
    }
    </style>
    <!-- Banner Section -->
    <div class="font-poppins">
        <div
            class="bg-gradient-to-r from-[#F4D36B] to-[#D3F5FF] min-h-[200px] flex items-center justify-center px-4 md:px-6 py-4 mt-8">
            <div class="text-center w-full max-w-[90%] sm:max-w-[500px] md:max-w-[820px] space-y-6 mx-auto">
                <h1 class="text-[32px] md:text-3xl font-[600] text-secondary">
                    Refund Policy
                </h1>
                <p class="text-[16px] font-[500]">
                    All bookings are non-refundable once processed. However, if your visa is rejected,
                    you may request a review or partial refund within 7 days, subject to verification and approval.
                    Refunds are not guaranteed and are assessed on a case-by-case basis.
                </p>
            </div>
        </div>

        <!-- Structured Content Section -->
        <div class="my-container py-10 space-y-10">
            <!-- Section 1 -->
            <div class="space-y-4 mt-6">
                <div class="flex items-start space-x-2">
                    <div class="w-[4px] h-[30px] md:h-[36px] bg-[#F4BD0F] rounded"></div>
                    <h2 class="text-[26px] font-[600] text-primary">
                        A refund would be possible in the case of the below situations.
                    </h2>
                </div>
                <ul class="list-disc pl-6 ml-2 w-full ">
                    <div class='text-[16px] space-y-2'>
                        <li>
                            If we are unable to provide you with documents within the committed time. 12-24 hours for
                            normal
                            delivery and 6-8 hours for urgent delivery.
                        </li>
                        <li>
                            If there are any mistakes from our side in your reservation first we will try to correct it
                            ASAP
                            OR we can refund you if you insist.
                        </li>
                        <li>
                            If you cancel your order before delivery with or without any reason, then a flat 30%
                            deduction
                            will apply on the full cost and 70% will be returned to your associated card in the next
                            5-10
                            days.
                        </li>
                        <li>
                            If we go against our FAQs.
                        </li>
                    </div>

                </ul>
            </div>

            <!-- Section 2 -->
            <div class="space-y-4 mt-6">
                <div class="flex items-start space-x-2">
                    <div class="w-[4px] h-[30px] md:h-[36px] bg-[#F4BD0F] rounded"></div>
                    <h2 class="text-[26px] font-[600] text-primary">
                        Prohibited Use
                    </h2>
                </div>
                <ul class="list-disc pl-6 ml-2 w-full space-y-2 break-words text-justify">
                    <li>
                        If you ask for changes or modifications in your provided routes and dates (Flight /Hotel
                        Details) after we sent you your documents to your email. It is because airlines don’t allow
                        us
                        to make changes in existing or generated reservations they only allow us to create a new
                        one,
                        that is why we recommend in case of modification place another order and repeat the same
                        process
                        again. We know this is awkward or weird but that is the only thing we can do for you.
                    </li>
                    <li>
                        If you come back to us due to the cancelled reservation so please first note the FAQs
                        validation
                        time guidelines if we are not against this then a refund would not be possible.
                    </li>
                    <li>
                        If you come in the future and ask for a refund just because you didn’t use our documents so
                        in
                        that case, we won’t refund you.
                    </li>
                    <li>
                        If you want to make amendments to your reservation after the 5 days of delivery of your
                        documents.
                    </li>
                    <li>
                        If your visa is refused because of our provided documents/services and you’re not able to
                        show
                        sufficient proof that your visa denied reason is our docs then a refund is not possible, you
                        have to show the embassy a written letter for the visa refusal cause to us to initiate the
                        refund.
                    </li>
                    <li>
                        In case you receive the documents early and you saw that after the time so we don’t refund.
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="grid grid-cols-1 md:grid-cols-2 w-[90%] md:w-[70%] h-auto md:h-[370px] mb-32 mt-[60px] rounded-2xl mx-auto bg-gradient-to-r from-[#FECE37] to-[#93BEEA]">
            <div class="w-full h-full flex items-center justify-center p-4">
                <img src="{{ asset('assets/dizzy-messages.webp') }}" alt="" class="w-full h-auto object-contain" />
            </div>

            <!-- 2nd div -->
            <div class="p-4 space-y-3 rounded-lg w-full text-start h-auto mt-4 md:mt-16">
                <p class="text-primary">Stay Updated on the World of Travel</p>
                <h3 class="text-2xl font-[600] md:text-2xl">
                    Subscribe for dreamy destinations, hidden gems, and travel tips you
                    won’t find anywhere else.
                </h3>

                <div
                    class="flex bg-amber-50 border border-primary/50 mt-4 rounded-xl w-full max-w-full sm:max-w-[470px] h-[50px] sm:h-[60px]">
                    <!-- Input field - takes remaining space -->
                    <input type="email" placeholder="Your Email Address"
                        class="flex-1 min-w-0 px-4 sm:px-6 outline-none bg-transparent border-none placeholder:text-success text-sm sm:text-base" />
                    <!-- Button - auto width with minimum size -->
                    <button
                        class="px-4 sm:px-6 m-[1px] py-2 rounded-r-xl bg-[#F4BD0F] text-white font-bold text-sm sm:text-base whitespace-nowrap min-w-[100px] sm:min-w-[120px]">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>