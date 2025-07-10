<x-app-layout>
    <!-- Banner Section -->
    <div
      class="bg-gradient-to-r from-[#F4D36B] to-[#D3F5FF] min-h-[200px] flex items-center justify-center px-4 md:px-6 py-4"
    >
      <div
        class="text-center w-full max-w-[90%] sm:max-w-[500px] md:max-w-[820px] space-y-6 mx-auto"
      >
        <h1
          class="text-2xl md:text-3xl font-extrabold"
          style="font-family: 'Poppins'"
        >
          Refund Policy
        </h1>
        <p
          class="text-base md:text-lg font-[500] leading-relaxed"
          style="font-family: 'Poppins'"
        >
          All bookings are non-refundable once processed. However, if your visa is rejected, 
          you may request a review or partial refund within 7 days, subject to verification and approval. Refunds are not guaranteed and are assessed on a case-by-case basis.
        </p>
      </div>
    </div>

    <!-- Structured Content Section -->
    <div class="w-[90%] mx-auto py-10 space-y-10">
      <!-- Section 1 -->
      <div class="space-y-4 mt-6">
        <div class="flex items-start space-x-2">
          <div class="w-[4px] h-[30px] md:h-[36px] bg-[#F4BD0F] rounded"></div>
          <h2 class="text-2xl font-semibold text-[#1960A9]">
            A refund would be possible in the case of the below situations.
          </h2>
        </div>
        <ul class="list-disc pl-6 ml-2 w-full space-y-2 break-words text-justify">
          <li>
            If we are unable to provide you with documents within the committed time. 12-24 hours for normal delivery and 6-8 hours for urgent delivery.
          </li>
          <li>
            If there are any mistakes from our side in your reservation first we will try to correct it ASAP OR we can refund you if you insist.
          </li>
          <li>
           If you cancel your order before delivery with or without any reason, then a flat 30% deduction will apply on the full cost and 70% will be returned to your associated card in the next 5-10 days.
          </li>
          <li>
           If we go against our FAQs.
          </li>
        </ul>
      </div>

      <!-- Section 2 -->
      <div class="space-y-4 mt-6">
        <div class="flex items-start space-x-2">
          <div class="w-[4px] h-[30px] md:h-[36px] bg-[#F4BD0F] rounded"></div>
          <h2 class="text-2xl font-semibold text-[#1960A9]">
            Prohibited Use
          </h2>
        </div>
        <ul class="list-disc pl-6 ml-2 w-full space-y-2 break-words text-justify">
          <li>
            If you ask for changes or modifications in your provided routes and dates (Flight /Hotel Details) after we sent you your documents to your email. It is because airlines don’t allow us to make changes in existing or generated reservations they only allow us to create a new one, that is why we recommend in case of modification place another order and repeat the same process again. We know this is awkward or weird but that is the only thing we can do for you.
          </li>
          <li>
            If you come back to us due to the cancelled reservation so please first note the FAQs validation time guidelines if we are not against this then a refund would not be possible.
          </li>
          <li>
            If you come in the future and ask for a refund just because you didn’t use our documents so in that case, we won’t refund you.
          </li>
          <li>
            If you want to make amendments to your reservation after the 5 days of delivery of your documents.
          </li>
          <li>
           If your visa is refused because of our provided documents/services and you’re not able to show sufficient proof that your visa denied reason is our docs then a refund is not possible, you have to show the embassy a written letter for the visa refusal cause to us to initiate the refund.
          </li>
          <li>
            In case you receive the documents early and you saw that after the time so we don’t refund.
          </li>
        </ul>
      </div>
    </div>

    <!-- last para -->
    <div
      class="grid grid-cols-1 md:grid-cols-2 w-[90%] md:w-[70%] h-auto md:h-[370px] mb-32 mt-[60px] rounded-2xl mx-auto bg-gradient-to-r from-[#FECE37] to-[#93BEEA]"
    >
      <div class="w-full h-full flex items-center justify-center p-4">
        <img src="/src/assets/dizzy-messages 1.png" alt="" class="w-full h-auto object-contain" />
      </div>

      <!-- 2nd div -->
      <div class="p-4 space-y-3 rounded-lg w-full text-start h-auto mt-4 md:mt-16">
        <p class="text-[#1960A9]">Stay Updated on the World of Travel</p>
        <h3
          style="font-family: 'Poppins'"
          class="text-2xl font-[500] md:text-2xl max-w-full md:max-w-[480px]"
        >
          Subscribe for dreamy destinations, hidden gems, and travel tips you
          won’t find anywhere else.
        </h3>

        <div
          class="flex flex-col sm:flex-row bg-amber-50 border border-[#1960A9] border-opacity-50 mt-4 rounded-xl overflow-hidden w-full max-w-full sm:max-w-[470px] h-auto sm:h-[64px]"
        >
          <input
            type="text"
            placeholder="Your email Address"
            class="w-full px-6 py-2 outline-none"
          />
          <button
            class="flex items-center justify-center px-8 m-[2px] rounded-r-xl bg-[#F4BD0F] hover:cursor-pointer text-white font-[Quicksand] font-bold text-[16px]"
          >
            Subscribe
          </button>
        </div>
      </div>
    </div>
</x-app-layout>
