 <!-- JavaScript Libraries -->
 {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
 {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> --}}
 <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
 <script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
 <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
 <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
 <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

 <!-- Template Javascript -->
 <script src="{{ asset('assets/js/main.js') }}"></script>

 <!-- SweetAlert Javascript -->
 <script src="{{ asset('js/sweetalert2.js') }}"></script>
 <script src="{{ asset('js/alerts.js') }}"></script>

 <script>
     const loader = $('#spinner');
     function submitForm({
         type,
         url,
         formData,
         successCallback = undefined
     }) {
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         loader.toggleClass('show');

         let ajaxOptions = {
             type: type,
             url: url,
             dataType: "json",
             data: formData,
             success: function(response) {
                 if (response.success) {
                     if (successCallback != undefined) {
                         successCallback(response)
                     }
                     notification({
                         icon: "success",
                         text: response.message
                     });
                 } else {
                     loader.toggleClass('show')
                     setTimeout(() => {
                         // sweetAlert({icon:"error", title:"Error", text:response.errors});
                         notification({
                             icon: "error",
                             text: response.errors
                         });
                     }, 500);
                 }
             },
             error: function(xhr) {
                 if (xhr.status === 422) {
                     const errors = xhr.responseJSON.errors;
                     $(`.errors`).text('');
                     $.each(errors, function(key, value) {
                         $(`.${key}`).text(value[0]);
                     });
                     setTimeout(() => {
                         notification({
                             icon: "error",
                             text: "Validation Failed!"
                         });
                     }, 500);
                 }
                 loader.toggleClass('show')
             }
         };

         // Check if formData is an instance of FormData
         if (formData instanceof FormData) {
             ajaxOptions.processData = false;
             ajaxOptions.contentType = false;
         }

         $.ajax(ajaxOptions);
     }
 </script>
