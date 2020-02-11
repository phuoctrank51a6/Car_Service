<?php
include_once "./app/views/client/template/header.php";
?>
<div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
  <div class="container-fluid">
    <div class="breadcrumb-content text-center">
      <h2>Danh sách yêu thích</h2>
      <ul>
        <li>
          <a href="<?= BASE_URL ?>">Trang chủ</a>
        </li>
        <li>Danh sách yêu thích</li>
      </ul>
    </div>
  </div>
</div>
<div class="product-cart-area fluid-padding-3 pt-120 pb-130">
  <div class="container-fluid">
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
                <th class="product-subtotal">delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($carts as $cart) { ?>
                <tr>
                  <td class="product-thumbnail">
                    <a href="<?= BASE_URL . 'detail?id=' . $cart['id'] ?>"><img width="150px" src="<?= IMAGE_URL . $cart['image'] ?>" alt=""></a>
                  </td>
                  <td class="product-name">
                    <a href="#"><?= $cart['name'] ?></a>
                  </td>
                  <td class="product-price"><span class="amount">$ <?= $cart['price'] ?></span></td>
                  <td class="product-quantity">
                    <div class="quantity-range">
                      <input class="input-text qty text" type="number" step="1" min="0" value="1" title="Qty" size="4">
                    </div>
                  </td>
                  <td class="product-cart-icon product-subtotal"><a href="<?= BASE_URL . 'del-item-wishlist?id=' . $cart['id'] ?>"><i class="ti-trash"></i></a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include_once "./app/views/client/template/footer.php";
?>