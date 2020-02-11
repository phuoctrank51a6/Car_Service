<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from preview.freethemescloud.com/oswan/shop-grid-2-col.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 16:12:46 GMT -->

<head>
  <meta charset="utf-8">
  <base href="<?= BASE_VIEW ?>">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Mego</title>
  <meta name="description" content="Live Preview Of Oswan eCommerce HTML5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/icon.png">
  <link href="https://thichchiase.com/demo/date-range-picker/Date%20range%20picker%20sample_files/datepicker.css" rel="stylesheet" />

  <!-- all css here -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/chosen.min.css">
  <link rel="stylesheet" href="assets/css/jquery-ui.css">
  <link rel="stylesheet" href="assets/css/meanmenu.min.css">
  <link rel="stylesheet" href="assets/css/themify-icons.css">
  <link rel="stylesheet" href="assets/css/icofont.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/bundle.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
  <div class="wrapper">
    <!-- header start -->
    <header>
      <div class="header-area transparent-bar ptb-55 header-white">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-4">
              <div class="logo-small-device">
                <a href="<?= BASE_URL ?>"><img alt="" src="assets/img/logo/megologo.png"></a>
              </div>
            </div>
            <div class="col-lg-8 col-md-8 col-8">
              <div class="header-contact-menu-wrapper pl-45">
                <div class="header-contact">
                  <p>LIÊN HỆ VỚI CHÚNG TÔI 0987 654 321</p>
                </div>
                <div class="menu-wrapper text-center">
                  <button class="menu-toggle menu-sticky-none">
                    <img class="s-open" alt="" src="assets/img/icon-img/menu-2.png">
                    <img class="s-close" alt="" src="assets/img/icon-img/menu-close-2.png">
                  </button>
                  <button class="menu-toggle menu-for-sticky">
                    <img class="s-open" alt="" src="assets/img/icon-img/menu.png">
                    <img class="s-close" alt="" src="assets/img/icon-img/menu-close.png">
                  </button>
                  <div class="main-menu">
                    <nav>
                      <ul>
                        <li><a href="<?= BASE_URL ?>">Trang chủ</a></li>
                        <li><a href="#">loại xe</a>
                          <ul>
                            <?php
                            foreach ($cate as $cates) { ?>
                              <li><a href="<?= BASE_URL . 'category?id=' . $cates->id ?>"><?= $cates->name ?></a></li>
                            <?php } ?>
                          </ul>
                        </li>
                        <li><a href="">Hãng xe</a>
                          <ul>
                            <?php
                            foreach ($maker as $makers) { ?>
                              <li><a href="<?= BASE_URL . 'maker?id=' . $makers->id ?>"><?= $makers->name ?></a></li>
                            <?php } ?>
                          </ul>
                        </li>
                        <li><a href="<?= BASE_URL ?>locations">Địa điểm thuê xe</a>
                          <ul>
                            <?php
                            foreach ($loca as $locas) { ?>
                              <li><a href="<?= BASE_URL . 'location?id=' . $locas->id ?>"><?= $locas->name ?></a></li>
                            <?php } ?>
                          </ul>
                        </li>
                        <li><a href="<?= BASE_URL ?>contact">Liên hệ</a></li>
                      </ul>
                    </nav>

                  </div>
                </div>
              </div>
              <div class="header-cart cart-small-device">
                <button class="icon-cart">
                  <i class="ti-shopping-cart"></i>
                  <span class="count-style">02</span>
                  <span class="count-price-add">$295.95</span>
                </button>
                <div class="shopping-cart-content">
                  <ul>
                    <li class="single-shopping-cart">
                      <div class="shopping-cart-img">
                        <a href="#"><img alt="" src="assets/img/cart/cart-1.jpg"></a>
                      </div>
                      <div class="shopping-cart-title">
                        <h3><a href="#">Gloriori GSX 250 R </a></h3>
                        <span>Price: $275</span>
                        <span>Qty: 01</span>
                      </div>
                      <div class="shopping-cart-delete">
                        <a href="#"><i class="icofont icofont-ui-delete"></i></a>
                      </div>
                    </li>
                    <li class="single-shopping-cart">
                      <div class="shopping-cart-img">
                        <a href="#"><img alt="" src="assets/img/cart/cart-2.jpg"></a>
                      </div>
                      <div class="shopping-cart-title">
                        <h3><a href="#">Demonissi Gori</a></h3>
                        <span>Price: $275</span>
                        <span class="qty">Qty: 01</span>
                      </div>
                      <div class="shopping-cart-delete">
                        <a href="#"><i class="icofont icofont-ui-delete"></i></a>
                      </div>
                    </li>
                    <li class="single-shopping-cart">
                      <div class="shopping-cart-img">
                        <a href="#"><img alt="" src="assets/img/cart/cart-3.jpg"></a>
                      </div>
                      <div class="shopping-cart-title">
                        <h3><a href="#">Demonissi Gori</a></h3>
                        <span>Price: $275</span>
                        <span class="qty">Qty: 01</span>
                      </div>
                      <div class="shopping-cart-delete">
                        <a href="#"><i class="icofont icofont-ui-delete"></i></a>
                      </div>
                    </li>
                  </ul>
                  <div class="shopping-cart-total">
                    <h4>total: <span>$550.00</span></h4>
                  </div>
                  <div class="shopping-cart-btn">
                    <a class="btn-style cr-btn" href="#">checkout</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="mobile-menu-area col-12">
              <div class="mobile-menu">
                <nav id="mobile-menu-active">
                  <ul class="menu-overflow">
                    <li><a href="index.html">HOME</a></li>
                    <li><a href="#">pages</a>
                      <ul>
                        <li><a href="about-us.html">about us</a></li>
                        <li><a href="cart.html">cart page</a></li>
                        <li><a href="checkout.html">checkout</a></li>
                        <li><a href="wishlist.html">wishlist</a></li>
                        <li><a href="login-register.html">login</a></li>
                        <li><a href="contact.html">contact</a></li>
                      </ul>
                    </li>
                    <li><a href="#">shop</a>
                      <ul>
                        <li><a href="#">shop grid</a>
                          <ul>
                            <li><a href="shop-grid-2-col.html"> grid 2 column</a></li>
                            <li><a href="shop.html"> grid 3 column</a></li>
                            <li><a href="shop-grid-4-col.html"> grid 4 column</a></li>
                          </ul>
                        </li>
                        <li><a href="#">shop list</a>
                          <ul>
                            <li><a href="shop-list.html"> list 1 column</a></li>
                            <li><a href="shop-list-2-col.html"> list 2 column</a></li>
                            <li><a href="shop-list-box.html"> list box style</a></li>
                          </ul>
                        </li>
                        <li><a href="#">product details</a>
                          <ul>
                            <li><a href="product-details.html">tab style</a></li>
                            <li><a href="product-details-sticky.html">sticky style</a></li>
                            <li><a href="product-details-gallery.html">gallery style</a></li>
                            <li><a href="product-details-fixed-img.html">fixed image style</a></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li><a href="#">BLOG</a>
                      <ul>
                        <li><a href="blog.html">blog page</a></li>
                        <li><a href="blog-sidebar.html">blog sidebar</a></li>
                        <li><a href="blog-sidebar-2.html">blog sidebar 2</a></li>
                        <li><a href="blog-details.html">blog details</a></li>
                      </ul>
                    </li>
                    <li><a href="contact.html"> Contact us</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <div class="header-cart-wrapper">
          <div class="header-cart">
            <button class="icon-cart">
              <a title="Danh sách yêu thích" href="<?= BASE_URL ?>wishlist">
                <i class=" ti-heart text-danger"></i>
              </a>
              <a title="Thông tin tài khoản" href="<?= BASE_URL ?>account">
                <i style="float: right; margin-left:15px" style="margin-left: 30px;" class="ti-user"></i>
              </a>
            </button>
          </div>
        </div>
      </div>
    </header>