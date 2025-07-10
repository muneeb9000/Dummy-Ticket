<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />
    <link href="./output.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
</head>
<body class="bg-[#f2f2f2]">
     <div
      class="bg-gradient-to-r from-[#F4D36B] to-[#D3F5FF] h-[500px] md:h-[260px] "
    >
      <div class="grid grid-cols-1 md:grid-cols-2 px-4 py-6 md:py-10 gap-4">
        <!-- Left Div -->
        <div
          class="justify-self-center p-4 md:p-6 w-full max-w-[662px] text-left h-auto space-y-4"
        >
          <h1
            style="font-family: 'Poppins'"
            class="text-2xl md:text-3xl font-bold"
          >
            404 – Page Not Found
          </h1>
          <p
            style="font-family: 'Poppins'"
            class="text-base md:text-lg font-[500] leading-relaxed"
          >
           Oops! The page you’re looking for doesn’t exist or has been moved. Please check the URL or return to the homepage.
          </p>
        </div>

        <!-- Right Div -->
        <div
          class="justify-self-center md:justify-self-end p-4 md:p-2 rounded-lg text-center w-full max-w-[499px] h-auto"
        >
          <img
            src="/src/assets/404 vector.png"
            alt="Image"
            class="w-full max-w-[350px] h-auto mx-auto"
          />
        </div>
      </div>
    </div>
    
    <!-- heading -->
     <div class="w-[47%] mx-auto h-auto items-center justify-center text-center mt-16">
      <h1 class="text-3xl font-extrabold text-[#1960A9]">
        Are you in need of any of the following services?
      </h1>
      <p class="mt-4 font-semibold text-lg Futura-Bold ">All our flight itineraries are verifiable and can be
         confirmed from airline websites through the unique reservation code we provide on the itinerary document.</p>
     </div>



     <!-- grid  -->

      <div class="w-[90%] mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 p-6 mt-16 ">
  <!-- CARD START -->
  <div class="bg-white rounded-md shadow-md overflow-hidden  ">
    <div class="grid" style="grid-template-columns: 40% 60%;">
      <!-- Image Column -->
      <div class="h-full">
        <img src="/src/assets/cuate.png" alt="Card Image" class="w-full h-full object-cover" />
      </div>
      <!-- Content Column -->
      <div class="flex flex-col justify-between p-4 space-y-">
        <h2 class="text-xl font-bold text-[#1960A9]">Flight Reservation</h2>
        <p class="text-sm text-gray-600">Hotel booking also called proof of accommodation or dummy hotel bookings</p>
        <button class="bg-[#F4BD0F] text-[#1960A9] font-semibold px-4 py-2 rounded hover:bg-yellow-400 transition duration-200">
          Learn More
        </button>
      </div>
    </div>
  </div>
  <!-- CARD END -->

  <!-- Repeat 3 more cards -->
  <div class="bg-white rounded-md shadow-md overflow-hidden">
    <div class="grid" style="grid-template-columns: 40% 60%;">
      <div class="h-full">
        <img src="/src/assets/Hotel Booking.png" alt="Card Image" class="w-full h-full object-cover" />
      </div>
      <div class="flex flex-col justify-between p-4 space-y-2">
        <h2 class="text-xl font-bold text-[#1960A9]">Hotel Booking</h2>
        <p class="text-sm text-gray-600">Hotel booking also called proof of accommodation or dummy hotel bookings</p>
        <button class="bg-[#F4BD0F] text-[#1960A9] font-semibold px-4 py-2 rounded hover:bg-yellow-400 transition duration-200">
          Learn More
        </button>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-md shadow-md overflow-hidden ">
    <div class="grid" style="grid-template-columns: 40% 60%;">
      <div class="h-full">
        <img src="/src/assets/Travel insurance icon.png" alt="Card Image" class="w-full h-full object-cover" />
      </div>
      <div class="flex flex-col justify-between p-4 space-y-4">
        <h2 class="text-xl font-bold text-[#1960A9]">Travel Insurance</h2>
        <p class="text-sm text-gray-600">Hotel booking also called proof of accommodation or dummy hotel bookings</p>
        <button class="bg-[#F4BD0F] text-[#1960A9] font-semibold px-4 py-2 rounded hover:bg-yellow-400 transition duration-200">
          Learn More
        </button>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-md shadow-md overflow-hidden">
    <div class="grid" style="grid-template-columns: 40% 60%;">
      <div class="h-full">
        <img src="/src/assets/Travel Guide Artwork.png" alt="Card Image" class="w-full h-full object-cover" />
      </div>
      <div class="flex flex-col justify-between p-4 space-y-4">
        <h2 class="text-xl font-bold text-[#1960A9]">Travel Guide</h2>
        <p class="text-sm text-gray-600">Hotel booking also called proof of accommodation or dummy hotel bookings.</p>
        <button class="bg-[#F4BD0F] text-[#1960A9] font-semibold px-4 py-2 rounded hover:bg-yellow-400 transition duration-200">
          Learn More
        </button>
      </div>
    </div>
  </div>
</div>



<!-- image grid -->
 <div
  class="w-[90%] h-full mx-auto bg-cover bg-center bg-no-repeat p-6 rounded-lg my-16"
  style="background-image: url('/src/assets/OBJECTS.png');"
>
  <div class="grid grid-cols-1 md:grid-cols-2  bg-opacity-80 rounded-lg overflow-hidden shadow-md">
    <!-- Left Column: Image -->
    <div class="h-full">
      <img
        src="/src/assets/Visa interview Questions.png"
        alt="Left Image"
        class="w-full h-full object-cover"
      />
    </div>

    <!-- Right Column: Content -->
    <div class="flex flex-col justify-center space-y-16 items-center w-[350px] p-6 ">
      <!-- Heading -->
      <h2 class="text-2xl font-bold text-[#1960A9]">Visa interview Questions</h2>

      <!-- Paragraph -->
      <p class="text-gray-700 text-sm leading-relaxed">
        Use our updated travel guides to create a powerful justification for applying for visa.
         Our travel guides make your cover letter looks impressive. We deliver travel guides within 12 to 24 hours via email.
      </p>

      <!-- Button -->
      <button class="w-fit bg-[#F4BD0F] text-[#1960A9] font-semibold px-5 py-2 rounded hover:bg-yellow-400 transition duration-200">
        Learn More
      </button>
    </div>
  </div>
</div>

</body>
</html>