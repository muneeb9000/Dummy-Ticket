<x-app-layout>
    <!-- Dummy Visa Ticket  FAQs -->
    <div class="bg-gradient-to-r from-[#F4D36B] to-[#D3F5FF] h-fit mt-10">
        <div class='my-container'>
            <div class="grid grid-cols-1 md:grid-cols-2 p-2 md:p-2">
                <!-- Left Div -->
                <div
                    class="justify-self-center p-4 md:p-6 rounded-lg w-full md:w-[662px] text-left h-auto space-y-4 mt-4 md:mt-4">
                    <h1 style="font-family: 'Poppins'" class="text-2xl  md:text-3xl font-bold ">
                        Voices from Around the World
                    </h1>
                    <p style="font-family: 'Poppins'" class="text-base md:text-lg font-[500]">
                        Discover what our travelers are saying—real stories,
                        honest reviews, unforgettable journeys. Their experiences speak louder than promises—see where
                        trust
                        has taken them.
                    </p>
                </div>

                <!-- Right Div -->
                <div class="justify-self-end p-s md:p-2 rounded-lg text-center w-full md:w-[499px] h-auto">
                    <img src="{{asset('assets/reiews.png')}}" class="w-full h-auto max-w-[400px] mx-auto" />
                </div>
            </div>
        </div>

    </div>

    <!-- What Our Client Says -->
    <div class="w-90% mx-auto h-auto items-center justify-center text-center mt-16">
        <h1 class="text-3xl font-extrabold text-[#1960A9]">
            What Our Client Says
        </h1>
        <p class="mt-4 font-semibold Futura-Bold ">Give us feedback and let us know what experiences you had while
            on
            vacation with us</p>
    </div>


    <!-- vedios -->
    <div class="w-[90%] mx-auto mt-16">
        <div class="grid [grid-template-columns:60%_40%] items-start bg-[#1960A9]">

            <!-- Left Main Video -->
            <div class="w-full">
                <iframe class="w-full h-[500px]" src="https://www.youtube.com/embed/6DFyNWt2kHs"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>
            </div>

            <!-- Right Column -->
            <div class="flex flex-col  text-[#1960A9] font-semibold text-sm">

                <!-- Top Static Row -->
                <div class="flex items-center justify-center bg-[#F4BD0F] h-[54px] px-2  space-x-2 border-[#1960A9] ">
                    <img src="/src/assets/mask.png" alt="mask" class="w-8 h-8" />
                    <p class="font-bold text-lg">Dummy ticket for visa Client Reviews Page</p>

                </div>

                <!-- Scrollable Rows -->
                <div class="overflow-y-auto max-h-[450px] px-2 space-y-2 py-2 text-white">

                    <!-- Loop of 7 rows -->
                    <!-- Repeat this block 7 times -->
                    <div class="grid  [grid-template-columns:35%_63%]  gap-2 bg-[#1960A9] p-2 rounded shadow">
                        <!-- Left (thumbnail/video) -->
                        <div>
                            <iframe class="w-[160px] h-[90px] " src="https://www.youtube.com/embed/6DFyNWt2kHs"
                                title="YouTube video player" frameborder="0" allowfullscreen>
                            </iframe>
                        </div>
                        <!-- Right (text) -->
                        <div class=" text-sm text-left ">
                            <p class="">Client review or testimonial content goes here for this row.</p>
                            <p class="text-xs mt-2 text-[#ffffff]">#AliKhan</p>
                            <p class="text-xs mt-2 text-gray-200 italic">23 Reviews</p>
                        </div>
                    </div>

                    <!-- 👇 Duplicate the above block 6 more times 👇 -->

                    <div class="grid [grid-template-columns:35%_63%]  gap-2 bg-[#1960A9] p-2 rounded shadow">
                        <div>
                            <iframe class="w-[160px] h-[90px] " src="https://www.youtube.com/embed/6DFyNWt2kHs"
                                title="YouTube" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class=" text-sm text-left">
                            <p>Another client's feedback on dummy ticket service.</p>
                            <p class="text-xs mt-2 text-[#ffffff]">#AliKhan</p>
                            <p class="text-xs mt-2 text-gray-200 italic">23 Reviews</p>
                        </div>
                    </div>

                    <div class="grid [grid-template-columns:35%_63%]  gap-2 bg-[#1960A9] p-2 rounded shadow">
                        <div>
                            <iframe class="w-[160px] h-[90px] " src="https://www.youtube.com/embed/6DFyNWt2kHs"
                                title="YouTube" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="text-sm text-left">
                            <p>Excellent support and service – client feedback here.</p>
                            <p class="text-xs mt-2 text-[#ffffff]">#AliKhan</p>
                            <p class="text-xs mt-2 text-gray-200 italic">23 Reviews</p>
                        </div>
                    </div>

                    <div class="grid [grid-template-columns:35%_63%]  gap-2 bg-[#1960A9] p-2 rounded shadow">
                        <div>
                            <iframe class="w-[160px] h-[90px] " src="https://www.youtube.com/embed/6DFyNWt2kHs"
                                title="YouTube" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class=" text-sm text-left">
                            <p>Customer review: fast response and verified ticket.</p>
                            <p class="text-xs mt-2 text-[#ffffff]">#AliKhan</p>
                            <p class="text-xs mt-2 text-gray-200 italic">23 Reviews</p>
                        </div>
                    </div>

                    <div class="grid [grid-template-columns:35%_63%]  gap-2 bg-[#1960A9] p-2 rounded shadow">
                        <div>
                            <iframe class="w-[160px] h-[90px] " src="https://www.youtube.com/embed/6DFyNWt2kHs"
                                title="YouTube" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class=" text-sm text-left">
                            <p>Highly recommended dummy ticket service!</p>
                            <p class="text-xs mt-2 text-[#ffffff]">#AliKhan</p>
                            <p class="text-xs mt-2 text-gray-200 italic">23 Reviews</p>
                        </div>
                    </div>

                    <div class="grid [grid-template-columns:35%_63%]  gap-2 bg-[#1960A9] p-2 rounded shadow">
                        <div>
                            <iframe class="w-[160px] h-[90px] " src="https://www.youtube.com/embed/6DFyNWt2kHs"
                                title="YouTube" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class=" text-sm text-left">
                            <p>Ticket accepted at visa embassy without issues.</p>
                            <p class="text-xs mt-2 text-[#ffffff]">#AliKhan</p>
                            <p class="text-xs mt-2 text-gray-200 italic">23 Reviews</p>

                        </div>
                    </div>

                    <div class="grid [grid-template-columns:35%_63%]  gap-2 bg-[#1960A9] p-2 rounded shadow">
                        <div>
                            <iframe class="w-[160px] h-[90px] " src="https://www.youtube.com/embed/6DFyNWt2kHs"
                                title="YouTube" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class=" text-sm text-left">
                            <p>Real review from a real customer — totally worth it.</p>
                            <p class="text-xs mt-2 text-[#ffffff]">#AliKhan</p>
                            <p class="text-xs mt-2 text-gray-200 italic">23 Reviews</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <!-- cards -->

    <div class="w-[90%] mx-auto my-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-8">
        <!-- Repeat this block 6 times -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <!-- Top Row: DP + Info -->
            <div class="grid grid-cols-[48px_auto] gap-4 items-center mb-2">
                <!-- DP -->
                <img src="/src/assets/aniq.png" class="w-12 h-12 rounded-full" alt="DP">

                <!-- Name + Country -->
                <div>
                    <div class="font-semibold text-lg text-black">John Doe</div>
                    <div class="text-gray-600 text-sm">USA - Visa</div>
                </div>
            </div>

            <!-- Stars -->
            <div class="flex text-yellow-400 mt-8 text-base ">
                ⭐⭐⭐⭐⭐
            </div>

            <!-- Quote icon -->
            <img src="/src/assets/“.png" class="w-4 h-4 mt-12" alt="quote">

            <!-- Review Content -->
            <p class="text-black-700 text-md font-semibold mt-4 leading-relaxed">
                This is a sample review or testimonial content written by the user. It gives feedback or experience.
                This is a sample review or testimonial content written by the user. It gives feedback or experience.
            </p>
        </div>

        <!-- Duplicate this card 5 more times below 👇 -->

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="grid grid-cols-[48px_auto] gap-4 items-center mb-2">
                <img src="/src/assets/aniq.png" class="w-12 h-12 rounded-full" alt="DP">
                <div>
                    <div class="font-semibold text-lg text-black"> Sheikh</div>
                    <div class="text-gray-600 text-sm">Canada - Visa</div>
                </div>
            </div>
            <div class="flex text-yellow-400 mt-8 text-base">⭐⭐⭐⭐⭐</div>
            <img src="/src/assets/“.png" class="w-4 h-4 mt-12" alt="quote">
            <p class="text-black-700 text-md font-semibold mt-4 leading-relaxed">
                Amazing service! I got my dummy ticket in minutes. Very smooth experience. Highly recommend!
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Inventore sint culpa aliquid sunt eveniet!
            </p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="grid grid-cols-[48px_auto] gap-4 items-center mb-2">
                <img src="/src/assets/aniq.png" class="w-12 h-12 rounded-full" alt="DP">
                <div>
                    <div class="font-semibold text-lg text-black">Ali Raza</div>
                    <div class="text-gray-600 text-sm">UK - Visa</div>
                </div>
            </div>
            <div class="flex text-yellow-400 mt-8 text-base">⭐⭐⭐⭐⭐</div>
            <img src="/src/assets/“.png" class="w-4 h-4 mt-12" alt="quote">
            <p class="text-black-700 text-md font-semibold mt-4 leading-relaxed">
                The team is responsive and very professional. They helped me get the right documentation quickly.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam molestiae voluptate nam!
            </p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="grid grid-cols-[48px_auto] gap-4 items-center mb-2">
                <img src="/src/assets/aniq.png" class="w-12 h-12 rounded-full" alt="DP">
                <div>
                    <div class="font-semibold text-lg text-black"> Khan</div>
                    <div class="text-gray-600 text-sm">Germany - Visa</div>
                </div>
            </div>
            <div class="flex text-yellow-400 mt-8 text-base">⭐⭐⭐⭐⭐</div>
            <img src="/src/assets/“.png" class="w-4 h-4 mt-12" alt="quote">
            <p class="text-black-700 text-md font-semibold mt-4 leading-relaxed">
                Great service and very easy process. Loved how simple everything was.
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque, eos?
            </p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="grid grid-cols-[48px_auto] gap-4 items-center mb-2">
                <img src="/src/assets/aniq.png" class="w-12 h-12 rounded-full" alt="DP">
                <div>
                    <div class="font-semibold text-lg text-black">Hamza Ali</div>
                    <div class="text-gray-600 text-sm">UAE - Visa</div>
                </div>
            </div>
            <div class="flex text-yellow-400 mt-8 text-base">⭐⭐⭐⭐⭐</div>
            <img src="/src/assets/“.png" class="w-4 h-4 mt-12" alt="quote">
            <p class="text-black-700 text-md font-semibold mt-4 leading-relaxed">
                Super fast and reliable. Would definitely use again for future trips.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias sint non exercitationem dolore
                at.
            </p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="grid grid-cols-[48px_auto] gap-4 items-center mb-2">
                <img src="/src/assets/aniq.png" class="w-12 h-12 rounded-full" alt="DP">
                <div>
                    <div class="font-semibold text-lg text-black"> Malik</div>
                    <div class="text-gray-600 text-sm">Italy - Visa</div>
                </div>
            </div>
            <div class="flex text-yellow-400 mt-8 text-base">⭐⭐⭐⭐⭐</div>
            <img src="/src/assets/“.png" class="w-4 h-4 mt-12" alt="quote">
            <p class="text-black-700 text-md font-semibold mt-4 leading-relaxed">
                The support team is amazing. They answered all my questions and helped me through every step.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, assumenda minus.
            </p>
        </div>
    </div>





    <!-- last para -->
    <div
        class="grid grid-cols-2 w-[70%] h-[300px] mb-32 mt-[120px] rounded-2xl mx-auto  bg-gradient-to-r from-[#FECE37] to-[#93BEEA]">
        <div class="w-full h-full ">
            <img src="/src/assets/dizzy-messages 1.png" alt="">
        </div>

        <!-- 2nd div -->
        <div class=" p-4 space-y-3 rounded-lg w-full  text-start h-auto mt-8 ">
            <p class="text-[#1960A9]">Stay Updated on the World of Travel</p>
            <h3 style="font-family: 'Poppins'" class="text-2xl font-[500] md:text-2xl w-[480px]">
                Subscribe for dreamy destinations, hidden gems, and travel tips you won’t find anywhere else.
            </h3>


            <div
                class="flex flex-col sm:flex-row bg-amber-50 border border-[#1960A9] border-opacity-50 mt-4 rounded-xl overflow-hidden w-[470px] h-auto sm:h-[64px]">
                <input type="text" placeholder="Your email Address" class="w-[470px] px-6 py-2 outline-none" />
                <button
                    class="flex items-center justify-center px-8 m-[2px] rounded-r-xl bg-[#F4BD0F] hover:cursor-pointer text-white font-[Quicksand] font-bold text-[16px]">


                    Subscribe
                </button>
            </div>
        </div>
    </div>
</x-app-layout>