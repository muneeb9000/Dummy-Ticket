<x-app-layout>
    <div
      class="bg-gradient-to-r from-[#F4D36B] to-[#D3F5FF] h-[500px] md:h-[290px] "
    >
      <div class="grid grid-cols-1 md:grid-cols-2 px-4 py-6 md:py-10 gap-4">
        <!-- Left Div -->
        <div
          class="justify-self-center p-4 md:p-6 rounded-lg w-full max-w-[662px] text-left h-auto space-y-4"
        >
          <h1
            style="font-family: 'Poppins'"
            class="text-2xl md:text-3xl font-bold"
          >
            Talk to the Travel Pros
          </h1>
          <p
            style="font-family: 'Poppins'"
            class="text-base md:text-lg font-[500] leading-relaxed"
          >
            Got questions? Our travel pros are here to help you plan, book, and
            explore with confidence. We turn questions into plans—and plans into
            unforgettable journeys.
          </p>
        </div>

        <!-- Right Div -->
        <div
          class="justify-self-center md:justify-self-end p-4 md:p-2 rounded-lg text-center w-full max-w-[499px] h-auto"
        >
          <img
            src="/src/assets/contact vector.png"
            alt="Image"
            class="w-full max-w-[350px] h-auto mx-auto"
          />
        </div>
      </div>
    </div>

    <!-- forms -->

    <div class="w-[90%] h-auto mx-auto mt-16 ">
  <div class="grid grid-cols-1 lg:[grid-template-columns:35%_60%] gap-x-16">
    <!-- left div -->
    <div
      class="flex flex-col justify-center items-center bg-[#dce3eb] py-8 space-y-6 p-4 sm:p-6 md:p-10 lg:p-[58px] rounded-md"
    >
      <h1 class="text-[#1960A9] text-2xl sm:text-3xl font-bold text-center sm:text-left">
        Love to hear from you, Get in touch 👋
      </h1>
      <p class="text-center sm:text-left px-2 text-lg sm:px-0">
        Fill up the form and our Team will get back to you within 24 hours.
      </p>

      <div class="w-full p-2">
        <!-- Main Column -->
        <div class="grid grid-rows-3 gap-2">
          <!-- Row 1 -->
          <div class="flex items-start space-x-4 p-4 rounded-lg">
            <i class="fas fa-map-marker-alt text-xl text-[#1960A9]"></i>
            <div>
              <p class="text-md font-semibold">
                1 Greig St Inverness-Shire United Kingdom
              </p>
            </div>
          </div>

          <!-- Row 2 -->
          <div class="flex items-start space-x-4 p-4 rounded-lg">
            <i class="fas fa-phone-alt text-xl text-[#1960A9]"></i>
            <div>
              <p class="text-md font-semibold">+1 (302) 219-4576</p>
            </div>
          </div>

          <!-- Row 3 -->
          <div class="flex items-start space-x-4 p-4 rounded-lg">
            <i class="fas fa-envelope text-xl text-[#1960A9]"></i>
            <div>
              <p class="underline text-md font-semibold">Email Us</p>
            </div>
          </div>

          <!-- row 4 -->
          <div class="flex items-start space-x-4 p-4 rounded-lg">
            <button
              class="flex items-center justify-center w-[175px] h-[44px] rounded-sm bg-[#F4BD0F] hover:cursor-pointer text-[#1960A9] font-[Quicksand] font-bold text-[16px]"
              style="box-shadow: -4px 4px 0px 0px #00000099"
            >
              Chat Support »
            </button>
          </div>
        </div>
      </div>
    </div>



    <!-- right div -->
   <div class="w-[full] p-6 border border-[#d1dce7] rounded-sm  pt-16  space-y-4">
  <!-- Row 1: Name & Email -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="flex flex-col">
      <label class="text-sm  font-medium mb-1">Your Name</label>
      <input
        type="text"
        placeholder="Enter your name"
        class="border border-gray-300 bg-[#dce3eb]   px-3 py-4 focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
    </div>
    <div class="flex flex-col">
      <label class="text-sm font-medium mb-1">Your Email</label>
      <input
        type="email"
        placeholder="Enter your email"
        class="border border-gray-300 bg-[#dce3eb]   px-3 py-4 focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
    </div>
  </div>

  <!-- Row 2: Phone & Subject -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="flex flex-col">
  <label class="text-sm font-medium mb-1">Phone Number</label>

  <div class="flex items-center border border-gray-300 bg-[#dce3eb] rounded-md px-2 py-2 focus-within:ring-2 focus-within:ring-blue-400">
    
    <!-- Flag + Code -->
    <div class="flex items-center space-x-1 pr-2 border-r border-gray-400">
      
      <select class="bg-transparent text-sm focus:outline-none">
        <option value="+44">+44</option>
        <option value="+92">+92</option>
        <option value="+1">+1</option>
        <option value="+91">+91</option>
        <option value="+91">+912</option>
        <option value="+91">+923</option>
        <option value="+91">+915</option>
        <!-- Add more as needed -->
      </select>
      <img src="https://flagcdn.com/gb.svg" alt="UK Flag" class="w-5 h-5 rounded-sm" />
    </div>

    <!-- Phone Input -->
    <input
      type="text"
      placeholder="Enter your phone number"
      class="flex-1 bg-transparent px-3 py-2 text-sm focus:outline-none"
    />
  </div>
</div>

    <div class="flex flex-col">
      <label class="text-sm font-medium mb-1">Subject</label>
      <input
        type="text"
        placeholder="Subject"
        class="border border-gray-300 bg-[#dce3eb]   px-3 py-4 focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
    </div>
  </div>

  <!-- Row 3: Message (Full Width) -->
  <div class="flex flex-col">
    <label class="text-sm font-medium mb-1">Message</label>
    <textarea
      rows="5"
      placeholder="Let tell us know about your trip"
      class="border border-gray-300 bg-[#dce3eb]   px-3 py-4 resize-none focus:outline-none focus:ring-2 focus:ring-blue-400"
    ></textarea>
  </div>

  <!-- Row 4: I'm not a robot -->
  <div class="flex items-center space-x-2 border  border-[#D6D6D6] w-[270px] px-3 bg-amber-50 h-16">
    <input type="checkbox" id="robot" class="w-4 h-4" />
    <label for="robot" class="text-sm ">I'm not a robot</label>
    <img src="/src//assets/Logo.png"  class="ml-16">
  </div>

  <!-- Row 5: Submit Button -->
  <div>
    <button
              class="flex items-center mt-8 justify-center w-[175px] h-[44px] rounded-sm bg-[#F4BD0F] hover:cursor-pointer text-[#1960A9] font-[Quicksand] font-bold text-[16px]"
              style="box-shadow: -4px 4px 0px 0px #00000099"
            >
              Send Message »
            </button>
  </div>
</div>


  </div>
</div>



<!-- location image -->
 <div class="mt-32">
  <img src="/src/assets/Frame 246.png"
  class="w-full h-auto" alt="">
 </div>

</x-app-layout>