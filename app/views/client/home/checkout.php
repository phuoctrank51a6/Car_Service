<?php
include_once "./app/views/client/template/header.php";
?>
<div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
  <div class="container-fluid">
    <div class="breadcrumb-content text-center">
      <h2>Đặt xe</h2>
      <ul>
        <li>
          <a href="#">home</a>
        </li>
        <li>đặt xe</li>
      </ul>
    </div>
  </div>
</div>
<!-- checkout-area start -->
<div class="checkout-area pt-130 pb-100">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="product-details-content">
          <div class="table-content table-responsive">
            <table>
              <thead>
                <tr>
                  <th class="product-name">Hình ảnh</th>
                  <th class="product-price">Xe</th>
                  <th class="product-name">Giá</th>
                  <th class="product-price">Địa điểm</th>
                  <th class="product-quantity">Hãng xe</th>
                  <th class="product-subtotal">delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="product-thumbnail">
                    <a href="#"><img width="120px" src="<?= IMAGE_URL . $car->feature_image ?>" alt=""></a>
                  </td>
                  <td class="product-name">
                    <a href="#"><?= $car->name ?></a>
                  </td>
                  <td class="product-price"><span class="amount">$ <?= $car->price ?></span></td>
                  <td class="product-quantity">
                    <div class="quantity-range"><span class="amount">$ <?= $car->getLocaName() ?></span></div>
                  </td>
                  <td class="product-subtotal">$ <?= $car->getMakerName() ?></td>
                  <td class="product-cart-icon product-subtotal"><a href="<?= BASE_URL . 'detail?id=' . $car->id ?>"><i class="ti-zoom-in"></i></a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div style="height: 40px; width: 100%;"></div>
      <div class="col-md-4">
        <div class="product-details-content">
          <div class="product-overview">
            <h5 class="pd-sub-title">Địa điểm nhận xe</h5>
            <p><?= $car->getLocaName() ?></p>
          </div>
          <div class="product-overview">
            <h5 class="pd-sub-title">Thời gian nhận xe</h5>
            <input type="text" value="<?= $_GET['date_start'] ?>" readonly>
          </div>
          <div class="product-overview">
            <h5 class="pd-sub-title">Thời gian trả xe</h5>
            <input type="text" value="<?= $_GET['date_end'] ?>" readonly>
          </div>
          <div class="product-overview">
            <h5 class="pd-sub-title">Chi tiết giá</h5>
            <table class="table">
              <tr>
                <td>Đơn giá ngày</td>
                <td><?= $car->price ?> đ</td>
              </tr>
              <tr>
                <td>Ngày</td>
                <td><?= $day ?> ngày</td>
              </tr>
              <tr>
                <td>Giảm giá</td>
                <td><?= $discount = $voucher_code->discount_price ?> đ</td>
              </tr>
              <tr>
                <td><b>Tổng</b></td>
                <td><?= $total_price = $car->price * $day - $discount ?> đ</td>
              </tr>
            </table>
          </div>
        </div>

      </div>
      <div class="col-md-8">
        <div class="product-details-content">
          <form action="<?= BASE_URL . 'post-checkout' ?>" method="post">
            <div class="checkbox-form">
              <?php if (isset($_GET['success'])) : ?>
                <div class="alert alert-success" role="alert"><?= $_GET['success'] ?></div>
              <?php endif ?>
              <input type="hidden" name="buyer_id" value="<?= $_SESSION['AUTH']['id'] ?>">
              <input type="hidden" name="date_start" value="<?= $_GET['date_start'] ?>" id="">
              <input type="hidden" name="date_end" value="<?= $_GET['date_end'] ?>" id="">
              <input type="hidden" name="car_id" value="<?= $car->id ?>" id="">
              <input type="hidden" name="total_price" value="<?= $total_price ?>" id="">
              <input type="hidden" name="voucher" value="<?= $voucher = $voucher_code->code ?>" id="">
              <input type="hidden" name="unit_price" value="<?= $car->price ?>" id="">
              <input type="hidden" name="count_day" value="<?= $day ?>" id="">
              <h3>Thông tin khách hàng</h3>
              <p>Nhập thông tin cá nhân để tiến hành đặt</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>Họ và tên <span class="required">*</span></label>
                    <input type="text" name="customer_name" placeholder="" />
                    <?php if (isset($_GET['err_customer_name'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_customer_name'] ?></div>
                    <?php endif ?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>Số điện thoại <span class="required">*</span></label>
                    <input type="text" name="customer_phone_number" />
                    <?php if (isset($_GET['err_customer_phone_number'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_customer_phone_number'] ?></div>
                    <?php endif ?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>Địa chỉ nhận xe <span class="required">*</span></label>
                    <input type="text" name="customer_address" />
                    <?php if (isset($_GET['err_customer_address'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_customer_address'] ?></div>
                    <?php endif ?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>Email<span class="required">*</span></label>
                    <input type="email" name="customer_email" />
                    <?php if (isset($_GET['err_customer_email'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_customer_email'] ?></div>
                    <?php endif ?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="order-notes">
                    <div class="checkout-form-list mrg-nn">
                      <label>Lưu ý</label>
                      <textarea id="checkout-mess" name="message" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                      <?php if (isset($_GET['err_message'])) : ?>
                        <div class="text-danger" role="alert"><?= $_GET['err_message'] ?></div>
                      <?php endif ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>Phương thức thanh toán<span class="required">*</span></label>
                    <select name="payment_method">
                      <option value="1" selected>Thanh toán khi nhận xe</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="cart-btn text-center mb-15">
                    <button class="btn-lg btn-warning btn-block " type="submit">Hoàn tất</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>
<?php
include_once "./app/views/client/template/footer.php";
?>