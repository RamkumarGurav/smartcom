<?
$CI =& get_instance();
if (empty($meta_title)) {
   $meta_title = _project_name_;
}

if (empty($meta_description)) {
   $meta_description = _project_name_;
}

if (empty($meta_keywords)) {
   $meta_keywords = _project_name_;
}

if (empty($meta_others)) {
   $meta_others = "";
}



?>



<!doctype html>
<html class="no-js" lang="zxx">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <base href="<?= base_url() ?>">
   <meta property="og:type" content="object" />
   <meta property="og:site_name" content="<?= _project_complete_name_ ?>" />
   <title><?= $meta_title ?></title>
   <meta name="description" content="<?= $meta_description ?>">
   <meta name="keywords" content="<?= $meta_keywords ?>">
   <meta name="GOOGLEBOT" content="index,follow" />

   <meta name="distribution" content="global" />

   <link rel="shortcut icon" type="image/x-icon" href="<?= IMAGE ?>favicon.png">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
      rel="stylesheet">
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
      integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
      integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
      <?php if (!empty($direct_css)) {
      foreach ($direct_css as $dcss) {
         echo '<link rel="stylesheet" href="' . $dcss . '"  crossorigin="anonymous">';
      }
   } ?>
   <?php if (!empty($css)) {
      foreach ($css as $css) {
         echo '<link rel="stylesheet" href="' . CSS . $css . '"  crossorigin="anonymous">';
      }
   } ?>


   <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet">
   <link rel="stylesheet" href="<?= CSS ?>style.css">
   <link rel="stylesheet" href="<?= CSS ?>responsive.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Metrophobic&display=swap" rel="stylesheet">

</head>

<body>

   <div class="navik-header header-shadow" id="navbar">
      <div class="container">
         <!-- Navik header -->
         <div class="navik-header-container">
            <!--Logo-->
            <div class="logo" data-mobile-logo="<?= IMAGE ?>logo.png" data-sticky-logo="<?= IMAGE ?>logo.png">
               <a href="<?= MAINSITE ?>"><img src="<?= IMAGE ?>logo.png" alt="logo" /></a>
            </div>
            <!-- Burger menu -->
            <div class="burger-menu">
               <div class="line-menu line-half first-line"></div>
               <div class="line-menu"></div>
               <div class="line-menu line-half last-line"></div>
            </div>
            <!--Navigation menu-->
            <nav class="navik-menu menu-caret submenu-top-border submenu-scale">
               <ul class="list-unstyled">
                  <li class="current-menu"><a href="<?= MAINSITE ?>">
                        Home</a>
                  </li>
                  <li><a href="about-us">About Us</a></li>
                  <li class="submenu-right">
                     <a href="products">Products</a>

                     <ul class="list-unstyled">

                        <?php foreach ($category_tree as $grand_parent_cat): ?>

                           <?php if (!empty($grand_parent_cat['subcategories'])): ?>
                              <li><a href="<?= MAINSITE ?>products/category-list/<?= $grand_parent_cat['slug_url'] ?>"><?= $grand_parent_cat['name'] ?></a>
                           <ul class="list-unstyled">
                           <?php foreach ($grand_parent_cat['subcategories'] as $parent_cat): ?>
                                   <li><a href="<?= MAINSITE ?>products/sub-category-list/<?= $parent_cat['slug_url'] ?>"><?= $parent_cat['name'] ?></a></li>
                           <?php endforeach; ?>
                             
                           </ul>
                        </li>
                                
                             
                           <?php else: ?>
                              <li> <a href="<?= MAINSITE ?>products/list/<?= $grand_parent_cat['slug_url'] ?>"><?= $grand_parent_cat['name'] ?></a></li>
                           <?php endif; ?>

                        <?php endforeach; ?>
                     </ul>
                  </li>
                  <li><a href="clients">Clients</a></li>
                  <li><a href="contact-us">Contact Us</a></li>
                  <li>
                     <div class="mt-mar extra-nav">
                        <div class="extra-cell">
                           <a href="contact-us"
                              class="btn shadow-primary btn-primary btn-quote btn-sm d-sm-block d-none ">
                              <span>Enquiry Now</span>
                           </a>
                        </div>
                     </div>
                  </li>
               </ul>
            </nav>
         </div>
      </div>
   </div>