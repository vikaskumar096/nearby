@extends('user.layouts.main')



@push('styles')
  <style>
  .to-blue-500 {
    --tw-gradient-to: #3b82f6 var(--tw-gradient-to-position);
  }

  /* Update the body to use the Poppins font */
  body {
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
  }

  .from-cyan-500 {
    --tw-gradient-from: #06b6d4 var(--tw-gradient-from-position);
    --tw-gradient-to: rgb(6 182 212 / 0) var(--tw-gradient-to-position);
    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
  }

  .bg-gradient-to-r {
    background-image: linear-gradient(to right, var(--tw-gradient-stops));
  }
</style>
  <style>
   
    [x-cloak] { display: none !important; }
</style>
@endpush
@push('scripts')
  <script defer
    src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script>
  tailwind.config = {
    darkMode: "class",
    theme: {
      extend: {
        colors: {
          primary: {
            50: "#f0f9ff",
            100: "#e0f2fe",
            200: "#bae6fd",
            300: "#7dd3fc",
            400: "#38bdf8",
            500: "#0ea5e9",
            600: "#0284c7",
            700: "#0369a1",
            800: "#075985",
            900: "#0c4a6e",
            950: "#0b2e4f",
          },
          background: "#ffffff",
          foreground: "#000000",
          muted: "#f3f4f6",
          "muted-foreground": "#6b7280",
          accent: "#fbbf24",
          "accent-foreground": "#000000",
        },
      },
      fontFamily: {
        body: ["Poppins", "sans-serif"],  /* Set Poppins as the body font */
        sans: [
          "Arial",
          "ui-sans-serif",
          "system-ui",
          "-apple-system",
          "system-ui",
          "Segoe UI",
          "Roboto",
          "Helvetica Neue",
          "Arial",
          "Noto Sans",
          "sans-serif",
          "Apple Color Emoji",
          "Segoe UI Emoji",
          "Segoe UI Symbol",
          "Noto Color Emoji",
        ],
      },
    },
  };
</script>
<script>
  window.onscroll = function() {
    const header = document.getElementById('header');
    const sticky = header.offsetTop;

    if (window.pageYOffset > sticky) {
      header.classList.add('fixed-header');
    } else {
      header.classList.remove('fixed-header');
    }
  };
</script>
@endpush
@push('styles')
<style>
   .fixed-header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background-color: #fff; /* Blue color */
      color: white;
     
      z-index: 10;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    </style>
  @endpush
  @section('content')
  <div class="container mx-auto px-4 py-8 lg:px-0">
    <!-- Success Message -->
    <div class="flex items-center bg-[#58af0838] text-gray-800  rounded-lg px-4 py-3 mb-6">
      <i class="fas fa-check-circle text-xl"></i>
      <div class="ml-4">
        <h1 class="text-lg font-semibold">Thanks for Booking!</h1>
        <p class="text-sm">We’ve sent a confirmation to your email. See you soon!</p>
      </div>
    </div>

    <!-- Main Content -->
    <div class="grid lg:grid-cols-3 relative gap-8">
      <!-- Left Column -->
      <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-3 lg:p-6">
        <!-- Test Center Details -->
        <div class="">
          <!-- User Details Section -->
          <div class="mb-8 border-b border-gray-200 pb-3">
    <h2 class="text-xl font-semibold text-gray-900 mb-2">User Information</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
        <div>
            <p class="text-sm text-gray-600">Full Name</p>
            <p class="font-semibold text-gray-800">{{ $user->first_name }}  {{ $user->last_name }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Email Address</p>
            <p class="font-semibold text-gray-800">{{ $user->email }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Phone Number</p>
            <p class="font-semibold text-gray-800">{{ $user->phone ?? '-' }}</p>
        </div>
    </div>
</div>

          <!-- Booking Confirmation Status -->
          <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-2">Booking Confimed</h2>
          
            <!-- Confirmation Message -->
            <div class="flex items-center gap-2 mt-4">
              <i class="fas fa-check-circle text-4xl text-green-500"></i>
              <p class="font-semibold text-base lg:text-xl text-green-600">Thank you for your booking!</p>
            </div>
          
            <!-- Confirmation Text -->
            <p class="text-gray-600 mt-4 text-base leading-relaxed">
              Your booking has been successfully confirmed. We're looking forward to your visit!
            </p>
          </div>
          
        
          <!-- Booking Details -->
          <div class="grid grid-cols-1 sm:grid-cols-2 md:gap-6 gap-y-2 mb-1">
            <div>
              <p class="text-gray-800 text-sm">Booking ID</p>
              <p class="font-semibold text-gray-800">{{ $bookingConfirmation->booking_id }}</p>
            </div>
            <div class="md:text-right">
              <p class="text-gray-800 text-sm">Booked for</p>
              <p class="font-semibold text-gray-800">{{ $user->first_name }}</p>
            </div>
          </div>
        
          <div class="flex items-center gap-2 text-gray-800 mb-8 border-b border-gray-200 pb-3">
            <p class="text-gray-800 text-sm">Date:</p>
              <i class="far text-gray-900 fa-clock"></i>
              <span>{{ $order_date }}</span>
          </div>

        
          <!-- Payment and Delivery Information -->
          <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Payment Status</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
              <div>
                <p class="text-sm text-gray-600">Payment Status</p>
                <p class="font-semibold {{ $payment->payment_status == 'completed' ? 'text-green-600' : 'text-red-600' }}">
    {{ ucfirst($payment->payment_status) }}
</p>
              </div>
             
            </div>
          </div>
        
          <hr class="my-8">
        
          <!-- Purchased Products -->
          
          <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-6">Purchased Products</h3>
            <div class="space-y-6">
              <!-- Product 1 -->
      
              @foreach ($booking->items as $product_item)
  <div class="border rounded-lg overflow-hidden lg:shadow-lg">
    <div class="p-3">
      <div class="flex gap-3 flex-col md:flex-row">
        <div class="relative md:w-28 h-28 w-full rounded-lg overflow-hidden">
          <img src="{{ asset('storage/' . $product_item->variant->product->image) }}" alt="{{ $product_item->variant->product->name }}" class="w-full h-full object-cover">
        </div>
        <div class="flex-1">
          <h3 class="font-semibold text-sm lg:text-xl">{{ $product_item->variant->product->name }}</h3>
          <p class="text-sm text-gray-500 mt-0">{{ $product_item->variant->title }}</p>
          <p class="md:text-sm text-xs text-gray-500 mt-0">{{ $product_item->variant->product->short_description }}</p>
          <p class="text-sm text-gray-500 mt-2"><strong>Quantity:</strong> {{ $product_item->quantity }}</p>
          {{-- <p class="text-sm text-gray-500 mt-2"><strong>Date:</strong> {{ \Carbon\Carbon::parse($product_item->created_at)->format('d/m/Y') }}</p> --}}
        </div>
      </div>
      <div class="flex items-center justify-between mt-2">
        <div class="flex items-center gap-4">
          <div class="flex items-center gap-x-4">
            {{-- <img src="/images/US-UK_Add_to_Apple_Wallet_RGB_101421.svg" class="w-28"> --}}
              <a href="{{ route('user.booking.item.download',$product_item->id) }}"
              class="px-2 py-2 text-xs bg-green-100 text-black rounded-lg hover:bg-green-200 transition duration-300 flex items-center">
              <i class="fas fa-download  text-sm mr-1 "> </i> Download
              </a>

          </div>
        </div>
        <div class="text-right flex justify-center gap-x-4 items-center whitespace-nowrap">
          <div class="lg:text-3xl md:text-2xl text-md font-semibold text-gray-900">AED {{ number_format($product_item->variant->discounted_price, 2) }}</div>
          <div class="md:text-2xl text-md text-gray-500 line-through">AED {{ number_format($product_item->variant->unit_price, 2) }}</div>
        </div>
      </div>
      <hr class="my-2">
    </div>
  </div>
@endforeach

             
              <!-- Repeat Product 2 and Product 3 similar to Product 1 -->
            </div>
          </div>
          
          
          
        <!-- <hr class="my-8"> -->

        <!-- Accordion component -->
      <div class="divide-y divide-slate-200">
          <!-- Accordion item -->
          <div x-data="{ expanded: false }" class="py-2">
              <a href="javascript:void(0);"
                  id="faqs-title-01"
                  type="button"
                  class="flex items-center justify-between w-full text-left text-sm font-medium text-gray-700 py-2"
                  @click="expanded = !expanded"
                  :aria-expanded="expanded"
                  aria-controls="faqs-text-01"
              >
                  <span>How do I redeem my Nearby Voucher?</span>
                  <i class="fa-solid text-xl fa-angle-down transform origin-center transition duration-200 ease-out" :class="{'!rotate-180': expanded}"></i>
              </a>
              <div
                  id="faqs-text-01"
                  role="region"
                  aria-labelledby="faqs-title-01"
                  class="grid text-sm text-slate-600 overflow-hidden transition-all duration-300 ease-in-out"
                  :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'"
                  >
                  <div class="overflow-hidden">
                      <p class="pb-3">
                          Please carefully review the important details in the attached ticket for each item in your booking confirmation. Redemption instructions may vary based on the type of product or service you’ve booked.
                      </p>
                  </div>
              </div>
          </div>
          <!-- Accordion item -->
          <div x-data="{ expanded: false }" class="py-2">
              <a href="javascript:void(0);"
                  id="faqs-title-02"
                  type="button"
                  class="flex items-center justify-between w-full text-left text-sm font-medium text-gray-700 py-2"
                  @click="expanded = !expanded"
                  :aria-expanded="expanded"
                  aria-controls="faqs-text-02"
              >
                  <span>How can I confirm my booking?</span>
                  <i class="fa-solid text-xl fa-angle-down transform origin-center transition duration-200 ease-out" :class="{'!rotate-180': expanded}"></i>
              </a>
              <div
                  id="faqs-text-02"
                  role="region"
                  aria-labelledby="faqs-title-02"
                  class="grid text-sm text-slate-600 overflow-hidden transition-all duration-300 ease-in-out"
                  :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'"
                  >
                  <div class="overflow-hidden">
                      <p class="pb-3">
                          To confirm bookings, within the voucher's validity period, you must contact the service provider directly and visit the location. Make sure to carry a copy of the ticket attached in the confirmation email and provide the Verification Number to the receptionist to verify your booking.
                      </p>
                  </div>
              </div>
          </div> 
          <!-- Accordion item -->
          <div x-data="{ expanded: false }" class="py-2">
              <a href="javascript:void(0);"
                  id="faqs-title-03"
                  type="button"
                  class="flex items-center justify-between w-full text-left text-sm font-medium text-gray-700 py-2"
                  @click="expanded = !expanded"
                  :aria-expanded="expanded"
                  aria-controls="faqs-text-03"
              >
                  <span>What is a Verification Number?</span>
                  <i class="fa-solid text-xl fa-angle-down transform origin-center transition duration-200 ease-out" :class="{'!rotate-180': expanded}"></i>
              </a>
              <div
                  id="faqs-text-03"
                  role="region"
                  aria-labelledby="faqs-title-03"
                  class="grid text-sm text-slate-600 overflow-hidden transition-all duration-300 ease-in-out"
                  :class="expanded ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'"
                  >
                  <div class="overflow-hidden">
                      <p class="pb-3">
                          The Verification Number is a unique code associated with your booking or voucher. It ensures that your booking or redemption is valid and helps us track the status of your service. Keep this number safe as you may need it for confirmation or any support inquiries.
                      </p>
                  </div>
              </div>
          </div>                                                                                            
      </div>
      <!-- End: Accordion component -->
        <!-- FAQs -->
        <!-- <div class="lg:p-0">
          <h3 class="text-lg font-bold mb-4 text-gray-800">Frequently Asked Questions (FAQ)</h3>
          <div class="space-y-4">
            <div class="border-b pb-4">
              <button 
                class="faq-toggle w-full flex justify-between items-center text-left py-2 text-sm font-medium text-gray-700 focus:outline-none">
                <span class="text-black">How do I redeem my Nearby Voucher?</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div class="faq-content hidden text-sm text-gray-600 pl-6 mt-2">
                <p> Please carefully review the important details in the attached ticket for each item in your booking confirmation. Redemption instructions may vary based on the type of product or service you’ve booked.</p>
              </div>
            </div>
        
            <div class="border-b pb-4">
              <button 
                class="faq-toggle w-full flex justify-between items-center text-left py-2 text-sm font-medium text-gray-700 focus:outline-none">
                <span class="text-black">How can I confirm my booking?</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div class="faq-content hidden text-sm text-gray-600 pl-6 mt-2">
                <p>To confirm bookings, within the voucher's validity period, you must contact the service provider directly and visit the location. Make sure to carry a copy of the ticket attached in the confirmation email and provide the Verification Number to the receptionist to verify your booking.</p>
              </div>
            </div>
        
            <div>
              <button 
                class="faq-toggle w-full flex justify-between items-center text-left py-2 text-sm font-medium text-gray-700 focus:outline-none">
                <span class="text-black">What is a Verification Number?</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div class="faq-content hidden text-sm text-gray-600 pl-6 mt-2">
                <p> The Verification Number is a unique code associated with your booking or voucher. It ensures that your booking or redemption is valid and helps us track the status of your service. Keep this number safe as you may need it for confirmation or any support inquiries.</p>
              </div>
            </div>
          </div>
        </div> -->
        @push('scripts')
        <!-- JavaScript for FAQ Toggle -->
        <!-- <script>
          document.querySelectorAll('.faq-toggle').forEach(button => {
            button.addEventListener('click', () => {
              const content = button.nextElementSibling;
              const icon = button.querySelector('svg');
              
              // Toggle visibility without animation
              content.classList.toggle('hidden');
              
              // Rotate icon without animation
              icon.classList.toggle('rotate-180');
            });
          });
        </script> -->
        @endpush
        
      </div>
    </div>
      <!-- Right Column -->
      <div class="bg-white lg:col-span-1  rounded-lg shadow-md p-6 space-y-6">
        <!-- Booking Summary Header -->
       
        <div class="">
          <!-- Booking Summary Header -->
          <div class="flex items-center justify-between border-b pb-4 mb-6">
            <h3 class="text-xl font-semibold text-gray-800 flex items-center space-x-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 17v.01M3 5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
              </svg>
              <span>Booking Summary</span>
            </h3>
          
          </div>
          <ul class="space-y-5">
            <li class="flex items-center justify-between text-base text-gray-700">
              <div class="flex items-center space-x-3">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a6 6 0 10-12 0 6 6 0 0012 0z" />
                </svg> -->
                <i class="fa-solid fa-money-bill-wave"></i>
                <span>Total Amount</span>
              </div>
              <span class="font-medium text-gray-800">AED {{ number_format($booking->booking_amount, 2) }}</span>
            </li>
                        <li class="flex items-center justify-between text-base text-gray-700">
              <div class="flex items-center space-x-3">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5-6l3 3-3 3" />
                </svg> -->
                <i class="fa-solid fa-percent"></i>
                <span>VAT (5%)</span>
              </div>
              <span class="font-medium text-gray-800">AED {{ number_format($booking->vat, 2) }}</span>
            </li>
            @if (session('promocode'))
            <li class="flex items-center justify-between text-base text-gray-800">
              <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6M12 15V9m-4 4h8" />
                </svg>
                <span>Promocode</span>
              </div>
              <span class="font-medium text-gray-800"> {{ session('promocode') }} ({{ rtrim(rtrim(number_format($promo_discount, 2), '0'), '.') }}%)</span>
            </li>
            <li class="flex items-center justify-between text-base text-gray-700">
              <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5-6l3 3-3 3" />
                </svg>
                <span>Promocode Discount</span>
              </div>
              <span class="font-medium text-gray-800">AED {{ number_format($promocode_discount_amount,2) }}</span>
            </li>
            @endif


            <li class="flex items-center justify-between text-base text-gray-800">
              <div class="flex items-center space-x-3">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-3.333 0-5 1.667-5 5v5h10v-5c0-3.333-1.667-5-5-5zM7 16v2h10v-2" />
                </svg> -->
                <i class="fa-solid fa-calculator"></i>
                <span>Grand Total</span>
              </div>
              <span class="font-medium text-gray-800"> AED {{ number_format($booking->total_amount, 2) }}</span>
            </li>

          </ul>
          <!-- Price Breakdown List -->
          {{-- @if($checkoutData)
    <div class="checkout-summary p-4 bg-gray-100 rounded-lg shadow-md my-4">
        <h2 class="text-xl font-semibold mb-3">Booking Summary</h2>
        <ul class="space-y-2 text-sm">
            <li><strong>Total:AED {{ number_format($checkoutData['total'], 2) }}</strong> </li>
            <li><strong>Promo Code: {{ $checkoutData['promo_code'] ?? 'N/A' }}</strong> </li>
            <li><strong>Discount: AED {{ number_format($checkoutData['discount'], 2) }}</strong> </li>
            <li><strong>Amount After Discount: AED {{ number_format($checkoutData['after_discount'], 2) }}</strong> </li>
        </ul>
    </div>
@else
    <div class="checkout-summary p-4 bg-yellow-100 rounded-lg shadow-md my-4">
        <p class="text-sm text-gray-700">No recent checkout details found.</p>
    </div>
@endif --}}

          <!-- Coupon Section (New Table) -->
          <!-- <div class="mt-6">
            <h4 class="text-xl font-semibold text-gray-900 mb-5">Applied Coupons</h4>
            <table class="w-full text-sm text-left text-gray-700 border border-gray-300 rounded-lg shadow-lg">
              <thead class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white">
                <tr>
                  <th class="py-2 px-2 text-sm font-semibold">Coupon Code</th>
                  <th class="py-2 px-2 text-sm font-semibold">Discount</th>
                  <th class="py-2 px-2 text-sm font-semibold">Valid Until</th>
                </tr>
              </thead>
              <tbody>
                <tr class="bg-white border-b hover:bg-gray-50 transition-all duration-300">
                  <td class="py-3 px-6 text-sm text-gray-800 font-medium">
                    <span class="bg-green-100 text-green-600 py-1 px-2 rounded-lg">SAVE20</span>
                  </td>
                  <td class="py-3 px-6 text-sm text-green-500 font-semibold">₹200</td>
                  <td class="py-3 px-6 text-sm text-gray-700">Dec 31, 2024</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50 transition-all duration-300">
                  <td class="py-3 px-6 text-sm text-gray-800 font-medium">
                    <span class="bg-yellow-100 text-yellow-600 py-1 px-2 rounded-lg">FREESHIP</span>
                  </td>
                  <td class="py-3 px-6 text-sm text-green-500 font-semibold">₹50</td>
                  <td class="py-3 px-6 text-sm text-gray-700">Nov 30, 2024</td>
                </tr>
              </tbody>
            </table>
          </div> -->
             <!-- Total Amount -->
           
        
       
              </div>
          </div>
      </div>
      @push('scripts')
      <script>
          // Share booking functionality
          function shareBooking() {
              if (navigator.share) {
                  navigator.share({
                      title: 'My Booking',
                      text: 'Check out my booking!',
                      url: window.location.href
                  })
                  .catch(error => console.log('Error sharing:', error));
              } else {
                  // Fallback for browsers that don't support Web Share API
                  alert('Booking link copied to clipboard!');
              }
          }
      
          // Add to Apple Wallet functionality
          function addToAppleWallet() {
              // Implementation for adding to Apple Wallet would go here
              alert('Adding to Apple Wallet...');
          }
      
          // Download tickets functionality
          function downloadTickets() {
              // Implementation for downloading tickets would go here
              alert('Downloading tickets...');
          }
      
          // Add loading states to buttons
          document.querySelectorAll('button').forEach(button => {
              button.addEventListener('click', function() {
                  const originalContent = this.innerHTML;
                  this.innerHTML = `
                      <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                      </svg>
                  `;
                  setTimeout(() => {
                      this.innerHTML = originalContent;
                  }, 1000);
              });
          });
      </script>
      @endpush
      </div>
      
    

 <!-- App Download Section -->


  </div>

  </div>
  @endsection
  @push('scripts')
  <script>
    function toggleFooterSection(sectionId) {
      const section = document.getElementById(sectionId);
      const icon = document.getElementById(`${sectionId}-icon`);
      if (section.classList.contains('hidden')) {
        section.classList.remove('hidden');
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
      } else {
        section.classList.add('hidden');
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
      }
    }
  </script>
@endpush
@push('styles')
  <style>
/* Custom Styles for Owl Carousel */
.owl-carousel {
    position: relative;
}

/* Center Left and Right Navigation Buttons */
.owl-prev, .owl-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    
    
    height: 50px;
    
    border-radius: 100% !important;
    background-color: #fff !important;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Adjust button positions */
.owl-prev {
    left: 10px;
    
}
.owl-prev, .owl-next span{
    font-size: 40px !important;
    line-height: 40px !important;
    color: #000 !important;
}

.owl-next {
    right: 10px;
}

/* Hover effect for buttons */
.owl-prev:hover, .owl-next:hover {
    background-color: #00bcd4; /* Cyan */
    color: white ;
}

/* Custom icon size adjustment */
.custom-left-icon, .custom-right-icon {
    width: 24px !important;
    border-radius: 100%;
    height: 24px !important ;
    color: #fff !important;
    background-size: cover;
    display: inline-block;
}

/* Custom icons (you can add your own image or SVG) */
.custom-left-icon {
    background-image: url('path-to-your-left-arrow-icon.svg'); /* Replace with your custom left icon */
}

.custom-right-icon {
    background-image: url('path-to-your-right-arrow-icon.svg'); /* Replace with your custom right icon */
}
</style>
@endpush
@push('scripts')
    <script>
  $(document).ready(function(){
      $(".owl-carousel").owlCarousel({
          items: 1,
          loop: true,
          margin: 16,
          nav: true,  // Enable navigation
          dots: false, // Enable dots pagination
          autoplay: true,
          autoplayTimeout: 3000,
          responsive: {
              0: {
                  items: 1
              },
              600: {
                  items: 2
              },
              1000: {
                  items: 4
              }
          }
      });
  });
</script>

  </body>

  <script>
  const toggle = document.getElementById("mobile-menu-toggle");
  const menu = document.getElementById("mobile-menu"); // Ensure this matches the id in the HTML
  toggle.addEventListener("click", () => {
    menu.classList.toggle("hidden");
  });
</script>

  <script>
  const dropdown = document.getElementById("dropdown");

  function showDropdown() {
    dropdown.classList.remove("hidden");
  }

  function toggleDropdown() {
    dropdown.classList.toggle("hidden");
  }

  // Hide dropdown when clicking outside
  document.addEventListener("click", (event) => {
    if (
      !event.target.closest("#dropdown") &&
      !event.target.closest("#search-input") &&
      !event.target.closest("button")
    ) {
      dropdown.classList.add("hidden");
    }
  });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  $(function(){
    $('.download-pdf').click(function(){
      // grab the URL from this button's data attribute
      const url = $(this).data('url');

      $.ajax({
        type: 'GET',
        url: url,
        xhrFields: { responseType: 'blob' },
        success: function(blob) {
          const downloadUrl = window.URL.createObjectURL(new Blob([blob], { type: 'application/pdf' }));
          const link = document.createElement('a');
          link.href = downloadUrl;
          link.download = 'booking_item_' + Date.now() + '.pdf';
          document.body.appendChild(link);
          link.click();
          link.remove();
          window.URL.revokeObjectURL(downloadUrl);
        },
        error: function(err) {
          console.error('PDF download error:', err);
        }
      });
    });
  });
</script>


<script>
    // Push a dummy state so "Back" triggers `onpopstate`
    history.pushState(null, null, location.href);

    // If user clicks back button
    window.onpopstate = function () {
        window.location.href = "/"; // 👈 redirect to a safe page
    };

    // Block browser cache from showing payment page again
    window.addEventListener("pageshow", function(event) {
        if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
            window.location.href = "/";
        }
    });
</script>
@endpush


