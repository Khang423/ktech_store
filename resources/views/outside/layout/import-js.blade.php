   {{-- jquery js  --}}
   <script src="{{ asset('js/libraries/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('js/admin/hyper/hyper-config.js') }}"></script>
   <script src="{{ asset('js/admin/hyper/vendor.min.js') }}"></script>
   {{-- app js --}}
   <script src="{{ asset('js/admin/hyper/app.min.js') }}"></script>
   {{-- swiper js  --}}
   <script src="{{ asset('js/libraries/swiper/swiper-bundle.min.js') }}"></script>
   {{-- main js  --}}
   <script src="{{ asset('js/outside/main.js') }}"></script>
   {{-- animate js --}}
   <script src="{{ asset('js/outside/animate.js') }}"></script>
   {{-- toast js  --}}
   <script src="{{ asset('js/libraries/sweetalert/sweetalert2.js') }}"></script>
   <script src="{{ asset('js/libraries/sweetalert/confirm_toast.js') }}"></script>
   {{-- select 2  --}}
   <script src="{{ asset('js/libraries/select2/select2.min.js') }}"></script>

   <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
   {{-- Pusher --}}
   <script src="{{ asset('js/libraries/pusher/pusher.min.js') }}"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.15.0/echo.iife.js"></script>

   <script>
       let pusher = new Pusher("5663e34e9aa73c142365", {
           cluster: "ap1",
           forceTLS: true,
       });

       window.pusher = pusher;
   </script>
