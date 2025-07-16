<x-app-layout>
    <style>
    body {
        background-color: #f2f2f2;
    }
    </style>
    <div class="mt-8">
        <div class="bg-gradient-to-r from-[#F4D36B] to-[#D3F5FF] py-8">
            <div class="my-container mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 px-4 sm:px-6 lg:px-8 items-center">

                <!-- Left Column -->
                <div class="text-left space-y-4">
                    <h1 class="text-[24px] font-poppins sm:text-[28px] md:text-[32px] font-[700] text-secondary">
                        Talk to the Travel Pros
                    </h1>
                    <p class="text-sm sm:text-base md:text-lg font-medium text-secondary leading-relaxed">
                        Got questions? Our travel pros are here to help you plan, book, and
                        explore with confidence. We turn questions into plans—and plans into
                        unforgettable journeys.
                    </p>
                </div>

                <!-- Right Column -->
                <div class="flex justify-center md:justify-end">
                    <img src="{{ asset('assets/contact-vector.webp') }}" alt="Image"
                        class="w-[250px] sm:w-[300px] md:w-[350px] h-auto" />
                </div>

            </div>
        </div>



        <!-- forms -->

        <div class="my-container h-auto mt-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-stretch">
                <!-- Added items-stretch -->
                <!-- Left Column -->
                <div class="col-span-1 lg:col-span-5 h-full">
                    <!-- Added h-full -->
                    <div
                        class="flex flex-col h-full bg-[#dce3eb] py-8 space-y-6 p-4 sm:p-6 md:p-10 lg:p-[58px] rounded-md">
                        <div>
                            <h1
                                class="text-primary text-2xl sm:text-[32px] font-poppins font-[700] text-center sm:text-left leading-relaxed">
                                Love to hear from you, <br>Get in touch 👋
                            </h1>
                            <p class="text-center sm:text-left px-2 text-lg sm:px-0 mt-5">
                                Fill up the form and our Team will get back to you within 24 hours.
                            </p>
                        </div>

                        <!-- Contact Info -->
                        <ul class="flex flex-col space-y-4">
                            <!-- Address -->
                            <li class="flex items-start space-x-4 p-3 rounded-lg">
                                <i class="fas fa-map-marker-alt text-xl text-primary"></i>
                                <p class="text-md font-semibold">1 Greig St Inverness-Shire United Kingdom</p>
                            </li>

                            <!-- Phone -->
                            <li class="flex items-start space-x-4 p-3 rounded-lg">
                                <i class="fas fa-phone-alt text-xl text-primary"></i>
                                <p class="text-md font-semibold">+1 (302) 219-4576</p>
                            </li>

                            <!-- Email -->
                            <li class="flex items-start space-x-4 p-3 rounded-lg">
                                <i class="fas fa-envelope text-xl text-primary"></i>
                                <p class="underline text-md font-semibold">Email Us</p>
                            </li>

                            <!-- Chat Button -->
                            <li class="flex items-start p-3 rounded-lg">
                                <button
                                    class="mt-6 flex items-center justify-center px-6 py-3 rounded-sm bg-[#F4BD0F] text-primary  font-bold text-[15px] font-poppins"
                                    style="box-shadow: -4px 4px 0px 0px #00000099">
                                    Chat Support »
                                </button>
                            </li>
                        </ul>

                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-span-1 lg:col-span-7 h-full">
                    <!-- Added h-full -->
                    <div class="w-full h-full p-6 border border-[#d1dce7] rounded-sm pt-16 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <label class="text-sm  font-medium mb-1">Your Name</label>
                                <input type="text" placeholder="Enter your name"
                                    class="border border-gray-300 bg-[#dce3eb] px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                            </div>
                            <div class="flex flex-col">
                                <label class="text-sm font-medium mb-1">Your Email</label>
                                <input type="email" placeholder="Enter your email"
                                    class="border border-gray-300 bg-[#dce3eb] px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                            </div>
                        </div>

                        <!-- Row 2: Phone & Subject -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <label class="text-sm font-medium mb-1">Phone No.</label>
                                <div class="flex items-center bg-[#dce3eb] p-[6px] ">
                                    <!-- Flag + Code -->
                                    <div class="flex items-center space-x-1 pr-2">
                                        <select class="text-sm bg-transparent border-none">
                                            <option value="+40">+40</option>
                                            <option value="+44">+44</option>
                                            <option value="+92">+92</option>
                                            <option value="+1">+1</option>
                                            <option value="+91">+91</option>
                                        </select>
                                    </div>
                                    <!-- Phone Input -->
                                    <input type="text" placeholder="Enter your Phone no."
                                        class=" bg-transparent text-sm border-none" />
                                </div>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-sm font-medium mb-1">Subject</label>
                                <input type="text" placeholder=""
                                    class="border border-gray-300 bg-[#dce3eb] px-3 py-3" />
                            </div>
                        </div>

                        <!-- Row 3: Message (Full Width) -->
                        <div class="flex flex-col">
                            <label class="text-sm font-medium mb-1">Message</label>
                            <textarea rows="5" placeholder="Let tell us know about your trip"
                                class="border border-gray-300 bg-[#dce3eb] px-3 py-4 resize-none focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                        </div>

                        <!-- Row 4: I'm not a robot -->
                        <div
                            class="flex items-center space-x-2 border border-[#D6D6D6] w-[270px] px-3 bg-amber-50 h-16">
                            <input type="checkbox" id="robot" class="w-4 h-4" />
                            <label for="robot" class="text-sm">I'm not a robot</label>
                            <img src="{{ asset('assets/robot.webp') }}" class="ml-16">
                        </div>

                        <!-- Row 5: Submit Button -->
                        <div>
                            <button
                                class="flex items-center mt-8 justify-center px-6 py-3 rounded-sm bg-[#F4BD0F] hover:cursor-pointer text-primary font-bold text-[16px] font-poppins"
                                style="box-shadow: -4px 4px 0px 0px #00000099">
                                Send Message »
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- location image -->
        <div class="mt-32">
            <img src="{{ asset('assets/map.png') }}" class="w-full h-auto" alt="">
        </div>
    </div>
</x-app-layout>