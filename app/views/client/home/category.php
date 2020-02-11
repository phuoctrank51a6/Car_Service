<?php
include_once "./app/views/client/template/header.php";
include_once "./app/views/client/template/nav.php";
?>
<div class="col-lg-9">
  <div class="grid-list-product-wrapper tab-content">
    <div id="new-product" class="product-grid product-view tab-pane active">
      <div class="row">
        <?php if (isset($_GET['err_cars'])) : ?>
          <div class="text-danger" role="alert"><?= $_GET['err_cars'] ?></div>
        <?php endif ?>
        <?php
                                              foreach ($cars as $car) { ?>
          <div class="product-width col-md-6 col-xl-6 col-lg-6">
            <div class="product-wrapper mb-35">
              <div class="product-img">
                <a href="<?= BASE_URL . 'detail?id=' . $car->id ?>">
                  <img src="<?= IMAGE_URL . $car->feature_image ?>" alt="">
                </a>
                <div class="product-item-dec">
                  <ul>
                    <li>
                      <h5><?= $car->name ?></h5>
                    </li>
                  </ul>
                </div>
                <div class="product-action">
                  <a class="action-plus-2 p-action-none" title="Add To Cart" href="<?= BASE_URL . 'detail?id=' . $car->id ?>">
                    <i class=" ti-shopping-cart"></i>
                  </a>
                  <a class="action-cart-2" title="Wishlist" href="<?= BASE_URL . 'add-wishlist?id=' . $car->id ?>">
                    <i class=" ti-heart"></i>
                  </a>
                  <a class="action-reload" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                    <i class=" ti-zoom-in"></i>
                  </a>
                </div>
                <div class="product-content-wrapper">
                  <div class="product-title-spreed">
                    <h4><a href="<?= BASE_URL . 'detail?id=' . $car->id ?>"><?= $car->name ?></a></h4>
                    <span><?= $car->getLocaName() ?></span>
                  </div>
                  <div class="product-price">
                    <span>$ <?= $car->price ?></span>
                  </div>
                </div>
              </div>
              <div class="product-list-details">
                <h2><a href="<?= BASE_URL . 'detail?id=' . $car->id ?>">Gloriori GSX 250 R</a></h2>
                <div class="quick-view-rating">
                  <i class="fa fa-star reting-color"></i>
                  <i class="fa fa-star reting-color"></i>
                  <i class="fa fa-star reting-color"></i>
                  <i class="fa fa-star reting-color"></i>
                  <i class="fa fa-star reting-color"></i>
                </div>
                <div class="product-price">
                  <span>$2549</span>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipic it, sed do eiusmod tempor incididunt ut labore et dolore nisi aliqua. Ut enim ad minim veniam, quis exercitation to nostrud ullamco laboris nisi ut aliquip ex ea commodo conseut excepteur sint occaecat.</p>
                <div class="shop-list-cart">
                  <a href="cart.html"><i class="ti-shopping-cart"></i> Add to cart</a>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <!-- <div class="paginations text-center mt-20">
          <ul>
            <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li class="active"><a href="#"><i class="fa fa-angle-right"></i></a></li>
          </ul>
        </div> -->
</div>
</div>
</div>
</div>
<?php
                                                                                  include_once "./app/views/client/template/footer.php"
?>