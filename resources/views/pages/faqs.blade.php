<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./output.css" rel="stylesheet" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />  
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
  </head>
  <body class="bg-blue-100">
    <!-- Dummy Visa Ticket  FAQs -->
    <div class="bg-gradient-to-r from-[#F4D36B] to-[#D3F5FF] min-h-[382px]">
      <div class="grid grid-cols-1 md:grid-cols-2 p-4 md:p-10">
        <!-- Left Div -->
        <div
          class="justify-self-center p-4 md:p-6 rounded-lg w-full md:w-[690px] text-left h-auto space-y-4 mt-2 md:mt-2"
        >
          <h1
            style="font-family: 'Poppins'"
            class="text-2xl font-[700] md:text-3xl "
          >
            Dummy Visa Ticket FAQs
          </h1>
          <p
            style="font-family: 'Poppins'"
            class="text-base md:text-lg font-[500]"
          >
            Get quick answers about our flight itineraries, hotel bookings,
            travel insurance, and other visa-related services. We've got you
            covered for any country, anytime..
          </p>

          <div
            class="flex flex-col sm:flex-row bg-amber-50 border border-[#1960A9] border-opacity-50 mt-4 rounded-md overflow-hidden w-full h-auto sm:h-[64px]"
          >
            <input
              type="text"
              placeholder="Type your question"
              class="w-full px-4 py-2 outline-none"
            />
            <button
              class="flex items-center justify-center px-8 m-[8px] rounded-[5px] bg-[#F4BD0F] hover:cursor-pointer text-[#1960A9] font-[Quicksand] font-bold text-[16px]"
              style="box-shadow: -5px 5px 0px 0px #00000099"
            >
              <i class="fas fa-paper-plane mr-2 text-[#1960A9] text-xl rotate-6"
                >&nbsp
              </i>

              Search
            </button>
          </div>
        </div>

        <!-- Right Div -->
        <div
          class="justify-self-end p-4 md:p-6 rounded-lg text-center w-full md:w-[499px] h-auto"
        >
          <img
            src="/src/assets/FAQ.png"
            alt="FAQ Image"
            class="w-full h-auto max-w-[400px] mx-auto"
          />
        </div>
      </div>
    </div>

    <div class="flex justify-center w-full h-auto mt-16 py-6">
      <div
        class="w-[90%] md:w-[80%] flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-2"
      >
        <!-- Icon / Logo -->
        <span>
          <img
            class="w-[40px] sm:w-[50px] h-[40px] sm:h-[50px]"
            src="/src/assets/logo1.png"
            alt="logo"
          />
        </span>

        <!-- Heading + Line -->
        <span class="text-center">
          <h1
            style="font-family: Poppins"
            class="text-2xl sm:text-3xl font-semibold text-[#1960A9]"
          >
            General Questions
          </h1>
          <hr
            class="mx-auto w-[100px] sm:w-[152px] border-[2px] border-[#F4BD0F] mt-2 rounded-full"
          />
        </span>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-4 w-[80%] mx-auto mt-2">
      <!-- Column 1 -->
      <div class="grid grid-rows-3 gap-4">
        <!-- Row 1: Double Height -->
        <div
          class="row-span-2 bg-white p-4 flex items-center rounded-lg shadow"
        >
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <!-- Icon -->
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-minus text-xl text-blue-600"></i>
            </div>

            <!-- Content -->
            <div class="flex flex-col space-y-2">
              <h2 style="font-family: 'Poppins'" class="text-lg font-semibold text-black">
                What IS THE ACTUAL PURPOSE OF SUBMITTING FLIGHT RESERVATION TO
                EMBASSY FOR VISA?
              </h2>
              <p style="font-family: 'Poppins'" class="text-black-600 ">
                The actual purposes of submitting a flight reservation are, for
                a diplomatic officer, want to know the traveler’s intent, route
                schedules, departure and returning timings if roundtrip, and
                traveler’s name printed over the documents. These are the only
                essential things a diplomatic officer wants from you.
              </p>
            </div>
          </div>
        </div>

        <!-- Row 2 -->
        <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
                WHERE I WILL RECEIVE MY ITINERARY DOCUMENTS?
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Column 2 -->
      <div class="grid grid-rows-3 gap-4">
        <!-- Row 1 -->
        <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col space-y-2">
              <p style="font-family: 'Poppins'" class="text-black-600">Is YOUR FLIGHT ITINERARY VERIFIABLE?</p>
            </div>
          </div>
        </div>

        <!-- Row 2 -->
        <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col space-y-2">
              <p style="font-family: 'Poppins'" class="text-black-600">
                How MANY TIMES CHANGES/CORRECTIONS ARE ALLOWED?
              </p>
            </div>
          </div>
        </div>

        <!-- Row 3 -->
        <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
                HOW LONGER IT WILL TAKE TO GET MY ITINERARY DOCUMENT?
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

<!-- Flight Reservation -->
    <div class="flex justify-center w-full h-auto py-6 mt-12">
      <div
        class="w-[90%] md:w-[80%] flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-2"
      >
        <!-- Icon / Logo -->
        <span>
          <img
            class="w-[40px] sm:w-[50px] h-[40px] sm:h-[50px]"
            src="/src/assets/logo2.png"
            alt="logo"
          />
        </span>

        <!-- Heading + Line -->
        <span class="text-center">
          <h1
            style="font-family: Poppins"
            class="text-2xl sm:text-3xl mt-4 font-semibold text-[#1960A9]"
          >
            Flight Reservation
          </h1>
          <hr
            class="mx-auto w-[100px] sm:w-[152px] border-[2px] border-[#F4BD0F] mt-2 rounded-full"
          />
        </span>
      </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-[80%] mx-auto mt-4 p-4">
      <!-- Column 1 -->
      <div class="grid grid-rows-3 gap-4  h-[340px]">
        <!-- Row 1: Double Height -->
       <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
                HOW LONGER IT WILL TAKE TO GET MY ITINERARY DOCUMENT?
              </p>
            </div>
          </div>
        </div>

        <!-- Row 2 -->
        <div class="bg-white p-4  flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
                WHERE I WILL RECEIVE MY ITINERARY DOCUMENTS?
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Column 2 -->
      <div class="grid grid-rows-3 gap-4">
        <!-- Row 1 -->
        <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col space-y-2">
              <p style="font-family: 'Poppins'" class="text-black-600">Is YOUR FLIGHT ITINERARY VERIFIABLE?</p>
            </div>
          </div>
        </div>

        <!-- Row 2 -->
         <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
              How MANY TIMES CHANGES/CORRECTIONS ARE ALLOWED?
              </p>
            </div>
          </div>
         </div>
        </div>
      </div>
    </div>


    <!-- hotel Booking -->

     <div class="flex justify-center w-full h-auto  ">
      <div
        class="w-[90%] md:w-[80%] flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 "
      >
        <!-- Icon / Logo -->
        <span>
          <img
            class="w-[40px] sm:w-[50px] h-[40px] sm:h-[50px]"
            src="/src/assets/logo3.png"
            alt="logo"
          />
        </span>

        <!-- Heading + Line -->
        <span class="text-center">
          <h1
            style="font-family: Poppins"
            class="text-2xl sm:text-3xl   font-semibold text-[#1960A9]"
          >
            Hotel Booking
          </h1>
          <hr
            class="mx-auto w-[100px] sm:w-[152px] border-[2px] border-[#F4BD0F] mt-2 rounded-full"
          />
        </span>
      </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-[80%] mx-auto mt-8 p-4">
      <!-- Column 1 -->
      <div class="grid grid-rows-3 gap-4  h-[340px]">
        <!-- Row 1: Double Height -->
       <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
                HOW LONGER IT WILL TAKE TO GET MY ITINERARY DOCUMENT?
              </p>
            </div>
          </div>
        </div>

        <!-- Row 2 -->
        <div class="bg-white p-4  flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
                WHERE I WILL RECEIVE MY ITINERARY DOCUMENTS?
              </p>
            </div>
          </div>
        </div>

        <!-- row 3 -->
        <div class="bg-white p-4  flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
                WHERE I WILL RECEIVE MY ITINERARY DOCUMENTS?
              </p>
            </div>
          </div>
        </div>
      </div>
          

      <!-- Column 2 -->
      <div class="grid grid-rows-3 gap-4">
        <!-- Row 1 -->
        <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col space-y-2">
              <p style="font-family: 'Poppins'" class="text-black-600">Is YOUR FLIGHT ITINERARY VERIFIABLE?</p>
            </div>
          </div>
        </div>

        <!-- Row 2 -->
         <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
               How MANY TIMES CHANGES/CORRECTIONS ARE ALLOWED?
              </p>
            </div>
          </div>
        </div>

                <!-- Row 3 -->

         <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
                HOW LONGER IT WILL TAKE TO GET MY ITINERARY DOCUMENT?
              </p>
            </div>
          </div>
        </div>
     </div>
    </div>
    </div>
  


  <!-- travel insurance -->
   <div class="flex justify-center w-full h-auto py-6 mt-12">
      <div
        class="w-[90%] md:w-[80%] flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-8"
      >
        <!-- Icon / Logo -->
        <span>
          <img
            class="w-[40px] sm:w-[50px] h-[40px] sm:h-[50px]"
            src="/src/assets/logo4.png"
            alt="logo"
          />
        </span>

        <!-- Heading + Line -->
        <span class="text-center">
          <h1
            style="font-family: Poppins"
            class="text-2xl sm:text-3xl mt-4 font-semibold text-[#1960A9]"
          >
            Travel Insursance
          </h1>
          <hr
            class="mx-auto w-[100px] sm:w-[152px] border-[2px] border-[#F4BD0F] mt-2 rounded-full"
          />
        </span>
      </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-[80%] mx-auto mt-4 p-4">
      <!-- Column 1 -->
      <div class="grid grid-rows-3 gap-4  h-[340px]">
        <!-- Row 1: Double Height -->
       <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
                HOW LONGER IT WILL TAKE TO GET MY ITINERARY DOCUMENT?
              </p>
            </div>
          </div>
        </div>

        <!-- Row 2 -->
        <div class="bg-white p-4  flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p class="text-black-600">
               WHERE I WILL RECEIVE MY ITINERARY DOCUMENTS?
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Column 2 -->
      <div class="grid grid-rows-3 gap-4">
        <!-- Row 1 -->
        <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col space-y-2">
              <p style="font-family: 'Poppins'" class="text-black-600">Is YOUR FLIGHT ITINERARY VERIFIABLE?</p>
            </div>
          </div>
        </div>

        <!-- Row 2 -->
         <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
                How MANY TIMES CHANGES/CORRECTIONS ARE ALLOWED?
              </p>
            </div>
          </div>
         </div>
        </div>
      </div>
    </div>

    <!-- Travel Guide -->
     <div class="flex justify-center w-full h-auto py-6 ">
      <div
        class="w-[90%] md:w-[80%] flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 "
      >
        <!-- Icon / Logo -->
        <span>
          <img
            class="w-[40px] sm:w-[50px] h-[40px] sm:h-[50px]"
            src="/src/assets/logo6.png"
            alt="logo"
          />
        </span>

        <!-- Heading + Line -->
        <span class="text-center">
          <h1
            style="font-family: Poppins"
            class="text-2xl sm:text-3xl  font-semibold text-[#1960A9]"
          >
            Travel Guide
          </h1>
          <hr
            class="mx-auto w-[100px] sm:w-[152px] border-[2px] border-[#F4BD0F] mt-2 rounded-full"
          />
        </span>
      </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-[80%] mx-auto mt-4 p-4">
      <!-- Column 1 -->
      <div class="grid grid-rows-3 gap-4  h-[340px]">
        <!-- Row 1: Double Height -->
       <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
                HOW LONGER IT WILL TAKE TO GET MY ITINERARY DOCUMENT?
              </p>
            </div>
          </div>
        </div>

        <!-- Row 2 -->
        <div class="bg-white p-4  flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
               WHERE I WILL RECEIVE MY ITINERARY DOCUMENTS?
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Column 2 -->
      <div class="grid grid-rows-3 gap-4">
        <!-- Row 1 -->
        <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col space-y-2">
              <p style="font-family: 'Poppins'" class="text-black-600">Is YOUR FLIGHT ITINERARY VERIFIABLE?</p>
            </div>
          </div>
        </div>

        <!-- Row 2 -->
         <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
                How MANY TIMES CHANGES/CORRECTIONS ARE ALLOWED?
              </p>
            </div>
          </div>
         </div>
        </div>
      </div>
    </div>


    <!-- Interview Questions -->
      <div class="flex justify-center w-full h-auto  ">
      <div
        class="w-[90%] md:w-[80%] flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 "
      >
        <!-- Icon / Logo -->
        <span>
          <img
            class="w-[40px] sm:w-[50px] h-[40px] sm:h-[50px]"
            src="/src/assets/logo6.png"
            alt="logo"
          />
        </span>

        <!-- Heading + Line -->
        <span class="text-center">
          <h1
            style="font-family: Poppins"
            class="text-2xl sm:text-3xl   font-semibold text-[#1960A9]"
          >
            Interview Questions
          </h1>
          <hr
            class="mx-auto w-[100px] sm:w-[152px] border-[2px] border-[#F4BD0F] mt-2 rounded-full"
          />
        </span>
      </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-[80%] mx-auto mt-8 p-4">
      <!-- Column 1 -->
      <div class="grid grid-rows-3 gap-4  h-[340px]">
        <!-- Row 1: Double Height -->
       <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
                HOW LONGER IT WILL TAKE TO GET MY ITINERARY DOCUMENT?
              </p>
            </div>
          </div>
        </div>

        <!-- Row 2 -->
        <div class="bg-white p-4  flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p class="text-black-600">
                WHERE I WILL RECEIVE MY ITINERARY DOCUMENTS?
              </p>
            </div>
          </div>
        </div>

        <!-- row 3 -->
        <div class="bg-white p-4  flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
               WHERE I WILL RECEIVE MY ITINERARY DOCUMENTS?
              </p>
            </div>
          </div>
        </div>
      </div>
          

      <!-- Column 2 -->
      <div class="grid grid-rows-3 gap-4">
        <!-- Row 1 -->
        <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col space-y-2">
              <p style="font-family: 'Poppins'" class="text-black-600">   Is YOUR FLIGHT ITINERARY VERIFIABLE?</p>
            </div>
          </div>
        </div>

        <!-- Row 2 -->
         <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
             How MANY TIMES CHANGES/CORRECTIONS ARE ALLOWED?
              </p>
            </div>
          </div>
        </div>

                <!-- Row 3 -->

         <div class="bg-white p-4 flex items-center rounded-lg shadow">
          <div class="grid grid-cols-[50px_1fr] gap-x-4">
            <div class="flex flex-col items-center mt-1">
              <i class="fas fa-plus text-xl text-blue-600"></i>
            </div>
            <div class="flex flex-col">
              <p style="font-family: 'Poppins'" class="text-black-600">
                HOW LONGER IT WILL TAKE TO GET MY ITINERARY DOCUMENT?
              </p>
            </div>
          </div>
        </div>
     </div>
    </div>
    </div>

    <!-- Still searching for an answer? Let us help! -->
     <div class="flex items-center text-center justify-center w-80% mx-auto h-full mt-16">
      
         <h3 class="font-bold text-3xl">Still searching for an answer? Let us help!</h3> 
      
      </div>
      
    
     <div class="flex items-center text-center justify-center w-80% mx-auto h-full mt-2 mb-16">
      <button class="flex items-center justify-center w-[175px] h-[44px] px-6 m-[8px] rounded-sm bg-[#F4BD0F] hover:cursor-pointer text-[#1960A9] font-[Quicksand] font-bold text-[16px]"
              style="box-shadow: -3px 3px 0px 0px #00000099"
            >

              Contact us »
            </button>
      <button class="flex items-center justify-center w-[185px] h-[44px] px-6 m-[8px] rounded-sm bg-transparent hover:cursor-pointer border border-[#1960A9] text-[#1960A9] font-[Quicksand] font-bold text-[16px] "             
            >

              Call Our Support »
            </button>
     
     </div>
    
    </div>
  </body>
</html>
