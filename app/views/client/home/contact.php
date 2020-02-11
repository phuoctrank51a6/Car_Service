<?php
include_once "./app/views/client/template/header.php";
?>
<div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
  <div class="container-fluid">
    <div class="breadcrumb-content text-center">
      <h2>Liên hệ</h2>
      <ul>
        <li>
          <a href="<?= BASE_URL ?>">Trang chủ</a>
        </li>
        <li>Liên hệ</li>
      </ul>
    </div>
  </div>
</div>
<div class="contact-area pt-130">
  <div class="container">
    <div class="contact-map">
      <div id="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.79233206403!2d105.81519631476282!3d21.000959986013473!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac853318152d%3A0x6586bd843a7eeba3!2zMTIzIE5ndXnhu4VuIFRyw6NpLCBUaMaw4bujbmcgxJDDrG5oLCBUaGFuaCBYdcOibiwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1575602625089!5m2!1svi!2s" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
      </div>
    </div>
  </div>
  <div class="all-info ptb-130">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="contact-info-wrapper">
            <h4 class="contact-title">THÔNG TIN VỀ CHÚNG TÔI</h4>
            <div class="communication-info">
              <div class="single-communication">
                <div class="communication-icon">
                  <i class="ti-home" aria-hidden="true"></i>
                </div>
                <div class="communication-text">
                  <h4>Địa chỉ:</h4>
                  <p>123 Nguyễn Trãi, Thanh Xuân, Hà Nội</p>
                </div>
              </div>
              <div class="single-communication">
                <div class="communication-icon">
                  <i class="ti-mobile" aria-hidden="true"></i>
                </div>
                <div class="communication-text">
                  <h4>Số điện thoại:</h4>
                  <p>0123 456 789 - 15 2368 4597</p>
                </div>
              </div>
              <div class="single-communication">
                <div class="communication-icon">
                  <i class="ti-email" aria-hidden="true"></i>
                </div>
                <div class="communication-text">
                  <h4>Email:</h4>
                  <p><a href="#">info@mego.vn</a></p>
                </div>
              </div>
              <div class="single-communication">
                <div class="communication-icon">
                  <i class="ti-world" aria-hidden="true"></i>
                </div>
                <div class="communication-text">
                  <h4>Website:</h4>
                  <p><a href="#">https://mego.vn</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="contact-message-wrapper">
            <h4 class="contact-title">LIÊN HỆ</h4>
            <?php if (isset($_GET['success'])) : ?>
              <div class="alert alert-success" role="alert"><?= $_GET['success'] ?></div>
            <?php endif ?>
            <div class="contact-message">
              <form action="<?= BASE_URL . 'post-contact' ?>" method="post">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="contact-form-style mb-20">
                      <input name="name" placeholder="Tên" type="text">
                      <?php if (isset($_GET['err_name'])) : ?>
                        <div class="text-danger" role="alert"><?= $_GET['err_name'] ?></div>
                      <?php endif ?>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="contact-form-style mb-20">
                      <input name="phone_number" placeholder="Số điện thoại" type="text">
                      <?php if (isset($_GET['err_phone_number'])) : ?>
                        <div class="text-danger" role="alert"><?= $_GET['err_phone_number'] ?></div>
                      <?php endif ?>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="contact-form-style mb-20">
                      <input name="email" placeholder="Địa chỉ Email" type="text">
                      <?php if (isset($_GET['err_email'])) : ?>
                        <div class="text-danger" role="alert"><?= $_GET['err_email'] ?></div>
                      <?php endif ?>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="contact-form-style mb-20">
                      <input name="title" placeholder="Tiêu đề" type="text">
                      <?php if (isset($_GET['err_title'])) : ?>
                        <div class="text-danger" role="alert"><?= $_GET['err_title'] ?></div>
                      <?php endif ?>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="contact-form-style">
                      <textarea name="content" placeholder="Nội dung"></textarea>
                      <?php if (isset($_GET['err_content'])) : ?>
                        <div class="text-danger" role="alert"><?= $_GET['err_content'] ?></div>
                      <?php endif ?>
                      <button class="submit cr-btn btn-style" type="submit"><span>GỬI</span></button>
                    </div>
                  </div>
                </div>
              </form>
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