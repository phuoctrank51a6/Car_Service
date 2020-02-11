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
            <a href="<?= BASE_URL ?>login">
              <h4 style="color: #fd7e14"> Quên mật khẩu</h4>
            </a>
          </div>
          <div class="tab-content">
            <div id="lg1" class="tab-pane active">
              <div class="login-form-container">
                <?php if (isset($_GET['err_success'])) : ?>
                  <div class="alert alert-success" role="alert"><?= $_GET['err_success'] ?></div>
                <?php endif ?>
                <div class="login-form">
                  <form action="<?= BASE_URL ?>post-forgot-password" method="post">
                    <?php if (isset($_GET['err_email'])) : ?>
                      <div class="alert alert-danger" role="alert"><?= $_GET['err_email'] ?></div>
                    <?php endif ?>
                    <input type="text" name="email" placeholder="Email">
                    <div class="button-box">
                      <button type="submit" class="btn-style cr-btn"><span>lấy mật khẩu</span></button>
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