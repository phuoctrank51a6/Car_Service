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
          <form action="<?= BASE_URL . 'save-account' ?>" method="post" enctype="multipart/form-data">
            <div class="checkbox-form">
              <h3>Thay đổi thông tin</h3>
              <div class="row">
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>Name <span class="required">*</span></label>
                    <input type="hidden" name="id" value="<?= $user->id ?>">
                    <input type="text" name="name" value="<?= $user->name ?>" placeholder="" />
                    <?php if (isset($_GET['err_name'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_name'] ?></div>
                    <?php endif ?>
                  </div>
                  <div class="checkout-form-list">
                    <label>Email <span class="required">*</span></label>
                    <input type="text" name="email" value="<?= $user->email ?>" placeholder="" />
                    <?php if (isset($_GET['err_email'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_email'] ?></div>
                    <?php endif ?>
                  </div>
                  <div class="checkout-form-list">
                    <label>Avatar <span class="required">*</span></label>
                    <input type="file" name="avatar" />
                    <?php if (isset($_GET['err_email'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_email'] ?></div>
                    <?php endif ?>
                  </div>
                  <div class="checkout-form-list">
                    <label>Số điện thoại <span class="required">*</span></label>
                    <input type="text" name="phone_number" value="<?= $user->phone_number ?>" placeholder="" />
                    <?php if (isset($_GET['err_phone_number'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_phone_number'] ?></div>
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