<script src="{{ asset('xhtml') }}/vendor/global/global.min.js"></script>
<script src="{{ asset('xhtml') }}/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="{{ asset('xhtml') }}/vendor/chart-js/chart.bundle.min.js"></script>
<script src="{{ asset('xhtml') }}/vendor/owl-carousel/owl.carousel.js"></script>
<script src="{{ asset('xhtml') }}/vendor/peity/jquery.peity.min.js"></script>

<!-- Apex Chart -->
<script src="{{ asset('xhtml') }}/vendor/apexchart/apexchart.js"></script>

<!-- Dashboard 1 -->
<script src="{{ asset('xhtml') }}/js/dashboard/dashboard-1.js"></script>
<script src="{{ asset('xhtml') }}/js/custom.min.js"></script>
<script src="{{ asset('xhtml') }}/js/deznav-init.js"></script>
<script src="{{ asset('xhtml') }}/vendor/datatables/js/jquery.dataTables.min.js"></script>

<!-- Datatable -->
<script src="{{ asset('xhtml') }}/js/plugins-init/datatables.init.js"></script>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("passwordConfirmation");
        const eyeIcon = document.getElementById("eyeIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
    </script>
 <script>
     function carouselReview() {
         /*  testimonial one function by = owl.carousel.js */
         jQuery('.testimonial-one').owlCarousel({
             nav: true,
             loop: true,
             autoplay: true,
             margin: 30,
             dots: false,
             left: true,
             navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>',
                 '<i class="fa fa-chevron-right" aria-hidden="true"></i>'
             ],
             responsive: {
                 0: {
                     items: 1
                 },
                 484: {
                     items: 2
                 },
                 882: {
                     items: 3
                 },
                 1200: {
                     items: 2
                 },

                 1540: {
                     items: 3
                 },
                 1740: {
                     items: 4
                 }
             }
         })
     }
     jQuery(window).on('load', function() {
         setTimeout(function() {
             carouselReview();
         }, 1000);
     });
 </script>
