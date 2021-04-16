 <!-- ======= Footer ======= -->
 <footer id="footer">
     <div class="container">
         <div class="row d-flex align-items-center">
             <div class="col-lg-6 text-lg-left text-center">
                 <div class="copyright">
                     &copy; <?= date('Y'); ?> Copy Right <br> <strong>Badan Kesatuan Bangsa Dan Politik</strong>. <br>
                 </div>

             </div>
             <div class="col-lg-6">
                 <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
                     <a href="#intro" class="scrollto">Home</a>
                     <a href="#about" class="scrollto">About</a>
                     <a href="#portfolio" class="scrollto">Gallery</a>

                 </nav>
             </div>
         </div>
     </div>
 </footer><!-- End Footer -->

 <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

 <!-- Vendor JS Files -->
 <script src="<?= base_url('assets2/vendor/jquery/jquery.min.js'); ?>"></script>
 <script src="<?= base_url('assets2/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
 <script src="<?= base_url('assets2/vendor/jquery.easing/jquery.easing.min.js'); ?>"></script>
 <script src="<?= base_url('assets2/vendor/php-email-form/validate.js'); ?>"></script>
 <script src="<<?= base_url('assets2/vendor/waypoints/jquery.waypoints.min.js'); ?>"></script>
 <script src="<?= base_url('assets2/vendor/counterup/counterup.min.js'); ?>"></script>
 <script src="<?= base_url('assets2/vendor/owl.carousel/owl.carousel.min.js'); ?>"></script>
 <script src="<?= base_url('assets2/vendor/isotope-layout/isotope.pkgd.min.js'); ?>"></script>
 <script src="<?= base_url('assets2/vendor/venobox/venobox.min.js'); ?>"></script>
 <script src="<?= base_url('assets2/vendor/aos/aos.js'); ?>"></script>

 <!-- Template Main JS File -->
 <script src="<?= base_url('assets2/js/main.js'); ?>"></script>
 </body>

 </html>

 <!-- Loader -->
 <script>
$(window).on('load', function() {
    $(".loader").fadeOut(1000);
    $(".content").fadeIn(1000);
});
 </script>