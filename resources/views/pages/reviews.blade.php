<x-app-layout>
    <style>
        body{
            background-color: #F2F2F2;
        }
    </style>
    <!-- Dummy Visa Ticket  FAQs -->
    <div class="bg-gradient-to-r from-[#F4D36B] to-[#D3F5FF] h-fit">
        <div class='my-container mt-10 font-poppins'>
            <div class="grid grid-cols-1 md:grid-cols-2 p-2 md:p-2">
                <!-- Left Div -->
                <div class=" pt-14 space-y-5 text-left ">
                    <h1 class="text-[32px] font-[700] text-secondary  ">
                        Voices from Around the World
                    </h1>
                    <p class="text-[16px] text-secondary font-[500]">
                        Discover what our travelers are saying—real stories,
                        honest reviews, unforgettable journeys. Their experiences speak louder than promises—see where
                        trust has taken them.
                    </p>
                </div>

                <!-- Right Div -->
                <div class="justify-self-end  rounded-lg text-center  h-auto">
                    <img src="{{asset('assets/reviews.webp')}}" alt='reviews image' class="" />
                </div>
            </div>
        </div>
    </div>

    <!-- What Our Client Says -->
    <div class='bg-[#D3F5FF] w-full h-fit pb-12'>
        <div class="items-center justify-center text-center">
            <h1 class="text-[44px] font-[500] text-primary pt-12">
                What Our Client Says
            </h1>
            <p class="text-[18px] font-[600] text-secondary">Give us feedback and let us know what experiences you had
                while
                on
                vacation with us</p>
        </div>

        <div class='my-container  font-poppins '>
            <!-- vedios -->
            <div class=" mt-16">
                <div class="grid grid-cols-1 md:grid-cols-[65%_35%] bg-primary gap-3">

                    <!-- Left Main Video Section -->
                    <div class="w-full">
                        <iframe class="w-full h-[520px]" src="https://www.youtube.com/embed/6DFyNWt2kHs"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>

                    <!-- Right Review Section -->
                    <div class="flex flex-col text-primary font-semibold text-sm">

                        <!-- Yellow Heading -->
                        <div
                            class="flex items-center justify-center bg-[#F4BD0F] h-[54px] px-2 space-x-2 border-primary ">
                            <img src="{{asset('assets/plane-logo.webp')}}" alt="mask" class="w-8 h-8" />
                            <p class="font-bold text-lg text-center">Dummy ticket for visa Client Reviews Page</p>
                        </div>

                        <!-- Scrollable Reviews Container -->
                        <div
                            class="overflow-y-auto max-h-[450px] space-y-2 py-2 text-white bg-primary overflow-x-hidden">
                            <!-- Individual Review Card -->
                            <div class="grid grid-cols-[35%_65%] gap-2 bg-primary">
                                <div class="relative">
                                    <iframe class="w-full h-[90px]" src="https://www.youtube.com/embed/6DFyNWt2kHs"
                                        title="YouTube video player" frameborder="0" allowfullscreen>
                                    </iframe>
                                    <div class="absolute bottom-0 left-0 right-0 h-[1px] bg-white"></div>
                                </div>
                                <div class="text-sm text-left">
                                    <p>Client review or testimonial content <br> goes here for this row.</p>
                                    <p class="mt-2">#AliKhan</p>
                                    <p class="mt-2">23 Reviews</p>
                                </div>
                            </div>

                            <!-- 🔁 Repeat Review Cards as needed -->
                            <div class="grid grid-cols-[35%_65%] gap-2 bg-primary">
                                <div class="relative">
                                    <iframe class="w-full h-[90px]" src="https://www.youtube.com/embed/6DFyNWt2kHs"
                                        title="YouTube video player" frameborder="0" allowfullscreen>
                                    </iframe>
                                    <div class="absolute bottom-0 left-0 right-0 h-[1px] bg-white"></div>
                                </div>
                                <div class="text-sm text-left">
                                    <p>Another happy client sharing their experience.</p>
                                    <p class="text-xs mt-2">#SanaKhan</p>
                                    <p class="text-xs mt-2">12 Reviews</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-[35%_65%] gap-2 bg-primary">
                                <div class="relative">
                                    <iframe class="w-full h-[90px]" src="https://www.youtube.com/embed/6DFyNWt2kHs"
                                        title="YouTube video player" frameborder="0" allowfullscreen>
                                    </iframe>
                                    <div class="absolute bottom-0 left-0 right-0 h-[1px] bg-white"></div>
                                </div>
                                <div class="text-sm text-left">
                                    <p>Another happy client sharing their experience.</p>
                                    <p class="text-xs mt-2">#SanaKhan</p>
                                    <p class="text-xs mt-2">12 Reviews</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-[35%_65%] gap-2 bg-primary">
                                <div class="relative">
                                    <iframe class="w-full h-[90px]" src="https://www.youtube.com/embed/6DFyNWt2kHs"
                                        title="YouTube video player" frameborder="0" allowfullscreen>
                                    </iframe>
                                    <div class="absolute bottom-0 left-0 right-0 h-[1px] bg-white"></div>
                                </div>
                                <div class="text-sm text-left">
                                    <p>Another happy client sharing their experience.</p>
                                    <p class="text-xs mt-2">#SanaKhan</p>
                                    <p class="text-xs mt-2">12 Reviews</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-[35%_65%] gap-2 bg-primary">
                                <div class="relative">
                                    <iframe class="w-full h-[90px]" src="https://www.youtube.com/embed/6DFyNWt2kHs"
                                        title="YouTube video player" frameborder="0" allowfullscreen>
                                    </iframe>
                                    <div class="absolute bottom-0 left-0 right-0 h-[1px] bg-white"></div>
                                </div>
                                <div class="text-sm text-left">
                                    <p>Another happy client sharing their experience.</p>
                                    <p class="text-xs mt-2">#SanaKhan</p>
                                    <p class="text-xs mt-2">12 Reviews</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-[35%_65%] gap-2 bg-primary">
                                <div class="relative">
                                    <iframe class="w-full h-[90px]" src="https://www.youtube.com/embed/6DFyNWt2kHs"
                                        title="YouTube video player" frameborder="0" allowfullscreen>
                                    </iframe>
                                    <div class="absolute bottom-0 left-0 right-0 h-[1px] bg-white"></div>
                                </div>
                                <div class="text-sm text-left">
                                    <p>Another happy client sharing their experience.</p>
                                    <p class="text-xs mt-2">#SanaKhan</p>
                                    <p class="text-xs mt-2">12 Reviews</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-[35%_65%] gap-2 bg-primary">
                                <div class="relative">
                                    <iframe class="w-full h-[90px]" src="https://www.youtube.com/embed/6DFyNWt2kHs"
                                        title="YouTube video player" frameborder="0" allowfullscreen>
                                    </iframe>
                                    <div class="absolute bottom-0 left-0 right-0 h-[1px] bg-white"></div>
                                </div>
                                <div class="text-sm text-left">
                                    <p>Another happy client sharing their experience.</p>
                                    <p class="text-xs mt-2">#SanaKhan</p>
                                    <p class="text-xs mt-2">12 Reviews</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-[35%_65%] gap-2 bg-primary">
                                <div class="relative">
                                    <iframe class="w-full h-[90px]" src="https://www.youtube.com/embed/6DFyNWt2kHs"
                                        title="YouTube video player" frameborder="0" allowfullscreen>
                                    </iframe>
                                    <div class="absolute bottom-0 left-0 right-0 h-[1px] bg-white"></div>
                                </div>
                                <div class="text-sm text-left">
                                    <p>Another happy client sharing their experience.</p>
                                    <p class="text-xs mt-2">#SanaKhan</p>
                                    <p class="text-xs mt-2">12 Reviews</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <!-- cards -->

            <div class="my-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
                <!-- Repeat this block 6 times -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <!-- Top Row: DP + Info -->
                    <div class="grid grid-cols-[48px_auto] gap-4 items-center mb-2">
                        <!-- DP -->
                        <img src="/src/assets/aniq.png" class="w-12 h-12 rounded-full" alt="DP">

                        <!-- Name + Country -->
                        <div>
                            <div class="font-semibold text-lg text-black">John Doe</div>
                            <div class="text-success text-sm">USA - Visa</div>
                        </div>
                    </div>

                    <!-- Stars -->
                    <div class="flex mt-8 text-base ">
                        <img src="{{asset('assets/Star.webp ')}}" alt="">
                    </div>

                    <!-- Quote icon -->

                    <img src="{{asset('assets/quotes.webp')}}" class="w-4 h-4 mt-12" alt="quote">

                    <!-- Review Content -->
                    <p class="text-[16px] text-secondary font-[500] mt-4 leading-relaxed">
                        This is a sample review or testimonial content written by the user. It gives feedback or
                        experience.
                        This is a sample review or testimonial content written by the user. It gives feedback or
                        experience.
                    </p>
                </div>

                <!-- Duplicate this card 5 more times below 👇 -->

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="grid grid-cols-[48px_auto] gap-4 items-center mb-2">
                        <img src="/src/assets/aniq.png" class="w-12 h-12 rounded-full" alt="DP">
                        <div>
                            <div class="font-semibold text-lg text-black"> Sheikh</div>
                            <div class="text-success text-sm">Spain Visa Applicant</div>
                        </div>
                    </div>
                    <div class="flex mt-8 text-base ">
                        <img src="{{asset('assets/Star.webp ')}}" alt="">
                    </div>
                    <img src="{{asset('assets/quotes.webp')}}" class="w-4 h-4 mt-12" alt="quote">
                    <p class="text-[16px] text-secondary font-[500] mt-4 leading-relaxed">
                        Amazing service! I got my dummy ticket in minutes. Very smooth experience. Highly recommend!
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Inventore sint culpa aliquid sunt
                        eveniet!
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="grid grid-cols-[48px_auto] gap-4 items-center mb-2">
                        <img src="/src/assets/aniq.png" class="w-12 h-12 rounded-full" alt="DP">
                        <div>
                            <div class="font-semibold text-lg text-black">Ali Raza</div>
                            <div class="text-success text-sm">UK - Visa</div>
                        </div>
                    </div>
                    <div class="flex mt-8 text-base ">
                        <img src="{{asset('assets/Star.webp ')}}" alt="">
                    </div>
                    <img src="{{asset('assets/quotes.webp')}}" class="w-4 h-4 mt-12" alt="quote">
                    <p class="text-[16px] text-secondary font-[500] mt-4 leading-relaxed">
                        The team is responsive and very professional. They helped me get the right documentation
                        quickly.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam molestiae voluptate nam!
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="grid grid-cols-[48px_auto] gap-4 items-center mb-2">
                        <img src="/src/assets/aniq.png" class="w-12 h-12 rounded-full" alt="DP">
                        <div>
                            <div class="font-semibold text-lg text-black"> Khan</div>
                            <div class="text-success text-sm">Germany - Visa</div>
                        </div>
                    </div>
                    <div class="flex mt-8 text-base ">
                        <img src="{{asset('assets/Star.webp ')}}" alt="">
                    </div>
                    <img src="{{asset('assets/quotes.webp')}}" class="w-4 h-4 mt-12" alt="quote">
                    <p class="text-[16px] text-secondary font-[500] mt-4 leading-relaxed">
                        Great service and very easy process. Loved how simple everything was.
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque, eos?
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="grid grid-cols-[48px_auto] gap-4 items-center mb-2">
                        <img src="/src/assets/aniq.png" class="w-12 h-12 rounded-full" alt="DP">
                        <div>
                            <div class="font-semibold text-lg text-black">Hamza Ali</div>
                            <div class="text-success text-sm">UAE - Visa</div>
                        </div>
                    </div>
                    <div class="flex mt-8 text-base ">
                        <img src="{{asset('assets/Star.webp ')}}" alt="">
                    </div>
                    <img src="{{asset('assets/quotes.webp')}}" class="w-4 h-4 mt-12" alt="quote">
                    <p class="text-[16px] text-secondary font-[500] mt-4 leading-relaxed">
                        Super fast and reliable. Would definitely use again for future trips.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias sint non exercitationem
                        dolore
                        at.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="grid grid-cols-[48px_auto] gap-4 items-center mb-2">
                        <img src="/src/assets/aniq.png" class="w-12 h-12 rounded-full" alt="DP">
                        <div>
                            <div class="font-semibold text-lg text-black"> Malik</div>
                            <div class="text-success text-sm">Italy - Visa</div>
                        </div>
                    </div>
                    <div class="flex mt-8 text-base ">
                        <img src="{{asset('assets/Star.webp ')}}" alt="">
                    </div>
                    <img src="{{asset('assets/quotes.webp')}}" class="w-4 h-4 mt-12" alt="quote">
                    <p class="text-[16px] text-secondary font-[500] mt-4 leading-relaxed">
                        The support team is amazing. They answered all my questions and helped me through every step.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, assumenda minus.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- last para -->
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


</x-app-layout>