<!-- breadcrum -->
<section class="page-title" style="background-image: url(<?= IMAGE ?>bread.jpg)">
  <div class="auto-container">
    <h2><?= $gp_category->name ?></h2>
  </div>
</section>
<!-- ebd -->
<!-- Sidebar Page Container -->
<section class="sidebar-page-container">
  <div class="auto-container">
    <div class="row clearfix slider-product">
      <div class="sec-title light">
        <h1><?= $p_category->name ?></h1>
      </div>
      <p><?= $p_category->description ?></p>
      <!-- <h3 class="newh3">We offer these antennas in the following ranges :</h3> -->
    </div>
    <div class="row clearfix">
      <div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
        <aside class="sidebar sticky-top">

          <!-- Services Widget -->
          <div class="sidebar-widget services-widget">
            <div class="widget-content">
              <div class="sidebar-title">
                <h5>Our Products</h5>
              </div>
              <ul class="service-list">
                <?php if (!empty($product_grouped_by_c_category)): ?>
                  <?php foreach ($product_grouped_by_c_category as $product): ?>
                    <li><a href="#<?= $product->category_slug_url ?>"><i
                          class="fa-regular fa-circle-check"></i><?= $product->category_name ?></a></li>
                  <?php endforeach; ?>
                <?php endif; ?>


              </ul>
            </div>
          </div>



          <!-- Contact Widget -->
          <div class="sidebar-widget contact-widget">
            <div class="widget-content">
              <div class="sidebar-title">
                <h5>Contact Us</h5>
              </div>
              <ul class="contact-info-widget">
                <li>
                  <span class="icon flaticon-map"><i class="fa-solid fa-location-dot"></i></span>
                  No.49, Alahalli, Gottigere Main Road, 8th Phase , JP Nagar Anjanapura Post, Bangalore – 560062
                </li>
                <li>
                  <span class="icon flaticon-call"><i class="fa-solid fa-phone"></i></span>
                  <a href="tel:9180733 14501">+91 80733 14501</a>
                </li>
                <li>
                  <span class="icon flaticon-email-1"><i class="fa-regular fa-envelope"></i></span>
                  <a href="mailto:Sales@smartcomindia.com">Sales@smartcomindia.com</a>
                </li>
              </ul>
            </div>
          </div>

        </aside>
      </div>
      <!-- Content Side -->
      <div class="content-side col-lg-9 col-md-12 col-sm-12">
        <?php if (!empty($product_grouped_by_c_category)): ?>
          <?php foreach ($product_grouped_by_c_category as $product): ?>
            <div class="service-detail" id="<?= $product->category_slug_url ?>">
              <div class="inner-box">

                <div class="lower-content">
                  <h3><?= $product->category_name ?></h3>
                </div>
                <div class="row clearfix slider-product">



                  <?php if (!empty($product_data)): ?>

                    <?php foreach ($product_data as $item): ?>
                      <div class="col-lg-3">
                        <div class="inner-box1 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                          <div class="upper-box">
                            <img src="<?= IMAGE ?>products/p3.jpg" alt="" /> </a>
                            <h4> <a href="antenna-products.html"> Yagi Antenna</a></h4>
                          </div>
                        </div>

                      </div>
                    <?php endforeach; ?>
                  <?php endif; ?>


                </div>
              </div>
            </div>

          <?php endforeach; ?>
        <?php endif; ?>


      </div>

      <!-- Sidebar Side -->


    </div>
  </div>
</section>
<!-- End Sidebar Page Container -->