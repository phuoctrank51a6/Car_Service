<?php
include_once "./app/views/client/template/header.php";
?>
<div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
  <div class="container-fluid">
    <div class="breadcrumb-content text-center">
      <h2>Thông tin tài khoản</h2>
      <ul>
        <li>
          <a href="#">home</a>
        </li>
        <li>Thông tin tài khoản</li>
      </ul>
    </div>
  </div>
</div>
<!-- checkout-area start -->
<div class="checkout-area pt-130 pb-100">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="product-details-content">
          <div class="text-center">
            <img style="border-radius:50%;width: 100%; margin-bottom:20px" src=" <?= AVATAR_URL . $user->avatar ?>" alt="avatar">
            <h4><?= $user->name ?></h4>
          </div>
          <hr>
          <div>
            <p><a href="<?= BASE_URL ?>history">Lịch sử thuê xe</a></p>
            <p><a href="<?= BASE_URL ?>change-password">Đổi mật khẩu</a></p>
            <p><a href="<?= BASE_URL ?>logout">Đăng xuất</a></p>
          </div>
        </div>

      </div>
      <div class="col-md-8">
        <div class="product-details-content">
          <form action="#">
            <div class="checkbox-form">
              <h3>Lịch sử thuê xe</h3>
              <div class="row">
                <div class="history-car">
                  <?php
                  if ($cars != null) {
                    foreach ($cars as $car) { ?>
                      <div class="row">
                        <div class="col-md-5">
                          <img width="280px" style="margin-right: 50px" src="<?= IMAGE_URL . $car->feature_image ?>" alt="">
                        </div>
                        <div class="col-md-7">
                          <div class="row">
                            <div class="col-md-6">
                              <h4><?= $car->name ?></h4>
                            </div>
                            <div class="col-md-6 text-right">
                              <a href="" class="btn btn-warning">Chi tiết</a>
                            </div>
                            <div class="col-md-12">
                              <p class="text-danger">Trạng thái: <?php if ($car->status == 0) {
                                                                        echo "Tiếp nhận đơn hàng";
                                                                      } elseif ($car->status == 1) {
                                                                        echo "Đang xử lý";
                                                                      } elseif ($car->status == 2) {
                                                                        echo "Chờ thanh toán";
                                                                      } elseif ($car->status == 3) {
                                                                        echo "Đã hoàn thành";
                                                                      } elseif ($car->status == 4) {
                                                                        echo "Hủy bỏ";
                                                                      } elseif ($car->status == 5) {
                                                                        echo "Hoàn tiền";
                                                                      } ?></p>
                            </div>

                          </div>

                          <hr>
                          <div>
                            <p>Bắt đầu: <?= $car->date_start ?> </p>
                            <p>Kết thúc: <?= $car->date_end ?> </p>
                            <h5>Tổng tiền: <?= $car->total_price ?> vnđ</h5>

                          </div>

                        </div>
                      </div>

                    <?php }
                    } else { ?>
                    <div class="alert alert-primary" role="alert">
                      Bạn chưa thuê xe tại Mego
                    </div>
                  <?php } ?>
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