<?php
include_once "./app/views/client/template/header.php";
?>
<div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
  <div class="container-fluid">
    <div class="breadcrumb-content text-center">
      <h2>Cart page</h2>
      <ul>
        <li>
          <a href="#">home</a>
        </li>
        <li>Cart page</li>
      </ul>
    </div>
  </div>
</div>
<div class="product-cart-area pt-120 pb-130">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-content table-responsive">
          <table>
            <thead>
              <tr>
                <th class="product-name">products</th>
                <th class="product-price">products name</th>
                <th class="product-name">price</th>
                <th class="product-price">quantity</th>
                <th class="product-quantity">total</th>
                <th class="product-subtotal">delete</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // dd($cart);
              foreach ($cart as $key) { ?>
                <tr>
                  <td class="product-thumbnail">
                    <a href="#"><img width="100%" src="<?= IMAGE_URL . $key['image'] ?>" alt=""></a>
                  </td>
                  <td class="product-name">
                    <a href="#"><?= $key['name'] ?></a>
                  </td>
                  <td class="product-price"><span class="amount">$ <?= $key['price'] ?></span></td>
                  <td class="product-quantity">
                    <div class="quantity-range">
                      <input class="input-text qty text" type="number" step="1" min="0" value="<?= $key['quantity'] ?>" title="Qty" size="4">
                    </div>
                  </td>
                  <td class="product-subtotal">$ <?= $key['price'] * $key['quantity'] ?></td>
                  <td class="product-cart-icon product-subtotal"><a href="#"><i class="ti-trash"></i></a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="cart-shiping-update">
          <div class="cart-shipping">
            <a class="btn-style cr-btn" href="<?= BASE_URL ?>">
              <span>continue shopping</span>
            </a>
          </div>
          <div class="update-checkout-cart">
            <div class="update-cart">
              <button class="btn-style cr-btn"><span>update</span></button>
            </div>
            <div class="update-cart">
              <a class="btn-style cr-btn" href="<?= BASE_URL ?>checkout">
                <span>checkout</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7 col-sm-6">
        <div class="discount-code">
          <h4>enter your discount code</h4>
          <div class="coupon">
            <input type="text">
            <input class="cart-submit" type="submit" value="enter">
          </div>
        </div>
      </div>
      <div class="col-md-5 col-sm-6">
        <div class="shop-total">
          <h3>cart total</h3>
          <ul>
            <li>
              sub total
              <span>$ <?= $total ?></span>
            </li>
            <li>
              tax
              <span>$9.00</span>
            </li>
            <li class="order-total">
              shipping
              <span>0</span>
            </li>
            <li>
              order total
              <span>$918.00</span>
            </li>
          </ul>
        </div>
        <div class="cart-btn text-center mb-15">
          <a href="#">payment</a>
        </div>
        <div class="continue-shopping-btn text-center">
          <a href="#">continue shopping</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include_once "./app/views/client/template/footer.php";
?>