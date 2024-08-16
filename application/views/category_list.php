<!-- breadcrum -->
<section class="page-title" style="background-image: url(<?= IMAGE ?>bread.jpg)">
  <div class="auto-container">
    <h2>Antenna Products</h2>
  </div>
</section>
<!-- ebd -->
<!-- Sidebar Page Container -->

<section class="pricing-section" style="background-image: url(<?= IMAGE ?>pat1.png)">
  <div class="container">
    <!-- Sec Title -->

    <!-- End Sec Title -->
    <div class="row clearfix slider-product">


      <?php if (!empty($product_data)): ?>


        <?php foreach ($product_data as $product): ?>
          <!-- Price Block -->
          <div class="col-lg-3">
            <div class="inner-box1 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
              <div class="upper-box">
                <img src="<?= _uploaded_files_ ?>product_gallery_image/<?= $product->default_image->file_name ?>"
                  title="<?= $product->default_image->file_title ?>" alt="<?= $product->default_image->file_alt_title ?>" />
                </a>
                <h4> <a href="yagi-antenna.html"> Yagi Antenna</a></h4>
              </div>

            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>


      <div class="col-lg-3">
        <div class="inner-box1 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
          <div class="upper-box">
            <img src="<?= IMAGE ?>products/p2.jpg" alt="" /> </a>
            <h4> <a href="antenna-products.html"> Yagi Antenna</a></h4>
          </div>

        </div>
      </div>
      <div class="col-lg-3">
        <div class="inner-box1 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
          <div class="upper-box">
            <img src="<?= IMAGE ?>products/p3.jpg" alt="" /> </a>
            <h4> <a href="antenna-products.html"> Yagi Antenna</a></h4>
          </div>

        </div>
      </div>
      <div class="col-lg-3">
        <div class="inner-box1 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
          <div class="upper-box">
            <img src="<?= IMAGE ?>products/p1.jpg" alt="" /> </a>
            <h4> <a href="antenna-products.html"> Yagi Antenna</a></h4>
          </div>

        </div>
      </div>
      <div class="col-lg-3">
        <div class="inner-box1 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
          <div class="upper-box">
            <img src="<?= IMAGE ?>products/p2.jpg" alt="" /> </a>
            <h4> <a href="antenna-products.html"> Yagi Antenna</a></h4>
          </div>

        </div>
      </div>
      <div class="col-lg-3">
        <div class="inner-box1 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
          <div class="upper-box">
            <img src="<?= IMAGE ?>products/p3.jpg" alt="" /> </a>
            <h4> <a href="antenna-products.html"> Yagi Antenna</a></h4>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>