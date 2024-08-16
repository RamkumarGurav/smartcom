<footer class="footer-style-three">
   <div class="shadow-layer" style="background-image:url(images/background/shadow-6.png)"></div>
   <div class="auto-container">
      <!--Widgets Section-->
      <div class="widgets-section">
         <div class="row clearfix">

            <!-- Column -->
            <div class="big-column col-lg-6 col-md-12 col-sm-12">
               <div class="row clearfix">

                  <!-- Footer Column -->
                  <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                     <div class="footer-widget logo-widget">
                        <div class="logo">
                           <a href="<?= MAINSITE ?>"><img src="<?= IMAGE ?>/logo.png" alt=""></a>
                        </div>
                        <div class="text"> We are part of Make in India initiative and majority of input materials for
                           manufacturing of our products are being locally sourced.</div>
                        <!-- Social Box -->
                        <ul class="social-box">
                           <li><a href="https://www.facebook.com/" class="fa-brands fa-facebook"></a></li>
                           <li><a href="https://www.google.com/" class="fa-brands fa-instagram"></a></li>
                           <li><a href="https://www.twitter.com/" class="fa-brands fa-twitter"></a></li>
                           <li><a href="https://www.dribbble.com/" class="fa-brands fa-whatsapp"></a></li>

                        </ul>
                     </div>
                  </div>

                  <!-- Footer Column -->
                  <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                     <div class="footer-widget contact-widget">
                        <h5>Useful Links</h5>
                        <ul class="quick-links-two">
                           <li><a href="<?= MAINSITE ?>">Home</a></li>
                           <li><a href="about-us">About us</a></li>
                           <li><a href="clients">Clients</a></li>
                           <li><a href="contact-us">Enquiry</a></li>
                           <li><a href="contact-us">Contact Us</a></li>
                        </ul>
                     </div>
                  </div>

               </div>
            </div>

            <!-- Column -->
            <div class="big-column col-lg-6 col-md-12 col-sm-12">
               <div class="row clearfix">

                  <!-- Footer Column -->
                  <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                     <div class="footer-widget contact-widget">
                        <h5>Get In Touch</h5>
                        <ul class="contact-list">
                           <li>
                              <span class="icon flaticon-house"><i class="fa-solid fa-location-dot"></i></span>
                              No.49, Alahalli, Gottigere Main Road, 8th Phase , JP Nagar Anjanapura Post, Bangalore –
                              560062
                           </li>
                           <li>
                              <span class="icon flaticon-telephone"><i class="fa-solid fa-phone"></i></span>
                              +91 80733 14501
                           </li>
                           <li>
                              <span class="icon flaticon-email"><i class="fa-solid fa-envelope"></i></span>
                              Sales@smartcomindia.com
                           </li>
                        </ul>
                     </div>
                  </div>

                  <!-- Footer Column -->
                  <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                     <div class="footer-widget contact-widget">
                        <h5>Products</h5>
                        <ul class="quick-links-two">
                           <li><a href="antenna-products">Antenna Products</a></li>
                           <li><a href="antenna-products">RF components</a></li>
                           <li><a href="antenna-products">RF Co-axial Cable</a></li>
                           <li><a href="antenna-products">RF Co-axial Connectors</a></li>
                           <li><a href="antenna-products">RF Shielded Boxes</a></li>
                        </ul>
                     </div>
                  </div>

               </div>
            </div>

         </div>
      </div>

      <!-- Footer Bottom -->
      <div class="footer-bottom">
         <div class="inner-container">
            <div class="copyright">© Smartcom | Designed by <a href="#">Masrweb Solution</a>.</div>
         </div>
      </div>

   </div>
</footer>
<!-- scripts starts here -->
<script src="<?= JS ?>jquery.min.js"></script>
<script src="<?= JS ?>main.js"></script>

<?php if (!empty($direct_js)) {
   foreach ($direct_js as $dj) {
      echo '<script src="' . $dj . '" type="text/javascript"></script>';
   }
} ?>
<?php if (!empty($js)) {
   foreach ($js as $j) {
      echo '<script src="' . __scriptFilePath__ . $j . '" type="text/javascript"></script>';
   }
} ?>
<?php if (!empty($php)) {
   foreach ($php as $j) {
      $this->load->view($j, $this->data);
   }
} ?>
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
   integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
   integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
   integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
   crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 -->
</body>

</html>