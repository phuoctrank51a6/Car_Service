<?php
include_once "./app/views/client/template/header.php";
?>
<div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
  <div class="container-fluid">
    <div class="breadcrumb-content text-center">
      <h2>Thông tin tài khoản</h2>
      <ul>
        <li>
          <a href="<?= BASE_URL ?>">Trang chủ</a>
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
            <img width="100%" src="<?= AVATAR_URL . $user->avatar ?>" alt="avatar">
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
          <form action="<?= BASE_URL ?>save-change-password" method="POST">
            <div class="checkbox-form">
              <?php if (isset($_GET['success'])) : ?>
                <h3 class="text-danger" role="alert"><?= $_GET['success'] ?></h3>
              <?php endif ?>
              <h3>Đổi mật khẩu</h3>
              <?php if (isset($_GET['err_password_now'])) : ?>
                <div class="text-danger" role="alert"><?= $_GET['err_password_now'] ?></div>
              <?php endif ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>Nhập lại mật hiện tại <span class="required">*</span></label>
                    <input type="password" name="passwordNow" placeholder="" />
                    <?php if (isset($_GET['err_password_now'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_password_now'] ?></div>
                    <?php endif ?>
                  </div>
                  <div class="checkout-form-list">
                    <label>Mật khẩu mới <span class="required">*</span></label>
                    <input type="password" name="newPassword" placeholder="" />
                    <?php if (isset($_GET['err_password_new'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_password_new'] ?></div>
                    <?php endif ?>
                  </div>
                  <div class="checkout-form-list">
                    <label>Nhập lại mật khẩu mới <span class="required">*</span></label>
                    <input type="password" name="rePassword" placeholder="" />
                    <?php if (isset($_GET['err_rePassword'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_rePassword'] ?></div>
                    <?php endif ?>
                  </div>
                  <div class="button-box text-center">
                    <button type="submit" class="btn-style cr-btn"><span>Cập nhật</span></button>
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