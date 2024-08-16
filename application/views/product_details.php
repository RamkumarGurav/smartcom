<!-- breadcrum -->


<section class="page-title" style="background-image: url(<?= IMAGE ?>bread.jpg)">
  <div class="auto-container">
    <h2><?= $product_data->name; ?></h2>
  </div>
</section>
<!-- ebd -->
<!-- Sidebar Page Container -->
<section class="sidebar-page-container">
  <div class="auto-container">

    <div class="row clearfix">
      <div class="sidebar-side col-lg-5 col-md-12 col-sm-12">
        <aside class="sidebar sticky-top">
          <?php if (!empty($product_data->product_gallery_image)): ?>
            <?php foreach ($product_data->product_gallery_image as $pgi): ?>
              <div class="image">
                <img src="<?= _uploaded_files_ ?>product_gallery_image/<?= $pgi->file_name ?>" class="newim"
                  title="<?= $pgi->file_title ?>" alt="<?= $pgi->file_alt_title ?>" />
              </div>
            <?php endforeach; ?>

          <?php endif; ?>


        </aside>


      </div>

      <!-- Content Side -->
      <div class="content-side col-lg-7 col-md-12 col-sm-12">
        <div class="service-detail1">
          <div class="lower-content">

            <?php
            $parent_category_name = "";
            $category_tree_array = explode("~~~", $product_data->category_name);
            if (count($category_tree_array) == 1) {
              $parent_category_name = $category_tree_array[0];
            } else {
              $parent_category_name = $category_tree_array[1];
            }
            ?>
            <h3 class="padb"><?= $parent_category_name; ?></h3>


          </div>
          <!-- <p> Yagi Antenna</p> -->

          <div>
            <?= $product_data->description ?>
          </div>


          <?php if (!empty($product_data->electrical_parameter)): ?>
            <h4 class="newhp mt-3">Electrical Parameter</h4>
            <div class="lower-content">

              <?= $product_data->electrical_parameter ?>
            </div>

          <?php endif; ?>
          <?php if (!empty($product_data->mechanical_parameter)): ?>
            <h4 class="newhp mt-3">Mechanical Parameter</h4>
            <div class="lower-content">

              <?= $product_data->mechanical_parameter ?>
            </div>

          <?php endif; ?>
          <?php if (!empty($product_data->environmental_parameter)): ?>
            <h4 class="newhp mt-3">Environmental Parameter</h4>
            <div class="lower-content">

              <?= $product_data->environmental_parameter ?>
            </div>

          <?php endif; ?>


        </div>

      </div>

      <!-- Sidebar Side -->


    </div>
    <div class="d-flex gap-3">
      <?php if (!empty($product_data->brochure_file_name)): ?>
        <a target="_blank" href="<?= _uploaded_files_ ?>product_brochure/<?= $product_data->brochure_file_name ?>"
          class="btn btn-info btn-sm rounded mr-2">Download Brochure</a>
      <?php endif; ?>
      <?php if (!empty($product_data->datasheet_file_name)): ?>
        <a target="_blank" href="<?= _uploaded_files_ ?>product_datasheet/<?= $product_data->datasheet_file_name ?>"
          class="btn btn-warning btn-sm rounded text-white mr-2" style="background-color:#fa8519;">Download Datasheet</a>
      <?php endif; ?>


    </div>
  </div>
</section>