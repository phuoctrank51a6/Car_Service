<?php
include_once "./app/views/client/template/header.php";
?>
<div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
  <div class="container-fluid">
    <div class="breadcrumb-content text-center">
      <h2>Đăng ký</h2>
      <ul>
        <li>
          <a href="#">home</a>
        </li>
        <li>Đăng ký</li>
      </ul>
    </div>
  </div>
</div>
<div class="login-register-area ptb-130">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 ml-auto mr-auto">
        <div class="login-register-wrapper">
          <div class="login-register-tab-list nav">
            <a href="#">
              <h4 style="color: #fd7e14"> Đăng ký cộng tác viên</h4>
            </a>
          </div>
          <div class="tab-content">
            <div id="lg1" class="tab-pane active">
              <div class="login-form-container">
                <?php if (isset($_GET['err_success'])) : ?>
                  <div class="alert alert-success" role="alert"><?= $_GET['err_success'] ?></div>
                <?php endif ?>
                <div class="login-form">
                  <form action="<?= BASE_URL ?>save-register-partner" method="post" enctype="multipart/form-data">
                    <?php if (isset($_GET['err_name'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_name'] ?></div>
                    <?php endif ?>
                    <input type="text" name="name" placeholder="Họ và tên">
                    <?php if (isset($_GET['err_email'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_email'] ?></div>
                    <?php endif ?>
                    <input type="text" name="email" placeholder="Email">
                    <?php if (isset($_GET['err_phone_number'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_phone_number'] ?></div>
                    <?php endif ?>
                    <input type="text" name="phone_number" placeholder="Số điện thoại">
                    <?php if (isset($_GET['err_password'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_password'] ?></div>
                    <?php endif ?>
                    <input type="password" name="password" placeholder="Mật khẩu">
                    <?php if (isset($_GET['err_rePassword'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_rePassword'] ?></div>
                    <?php endif ?>
                    <input type="password" name="rePassword" placeholder="Nhập lại mật khẩu">
                    <?php if (isset($_GET['err_file'])) : ?>
                      <div class="text-danger" role="alert"><?= $_GET['err_file'] ?></div>
                    <?php endif ?>
                    <input type="file" name="avatar">
                    <div class="button-box">
                      <button type="submit" class="btn-style cr-btn"><span>Đăng ký</span></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
                                                              include_once "./app/views/client/template/footer.php";
?>