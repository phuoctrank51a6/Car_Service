<?php
require_once './app/views/admin/master/master.php';
require_once './app/views/admin/master/header.php';
require_once './app/views/admin/master/sidebar.php';
?>
<div class="main-panel">
  <div class="content">
    <div class="page-inner">
      <div class="page-header">
        <h4 class="page-title">Cài đặt Website</h4>
        <ul class="breadcrumbs">
          <li class="nav-home">
            <a href="#">
              <i class="flaticon-home"></i>
            </a>
          </li>
          <li class="separator">
            <i class="flaticon-right-arrow"></i>
          </li>
          <li class="nav-item">
            <a href="<?= ADMIN_URL . '/setting' ?>">Cài đặt Website</a>
          </li>
        </ul>
      </div>
      <div class="row">

        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex align-items-center">

                <a href="<?= ADMIN_URL . '/setting' ?>" class="btn btn-primary btn-round ml-auto">
                  Danh sách
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="row justify-content-md-center">
                <div class="col-md-8">
                  <form action="<?= ADMIN_URL . '/setting/save-edit' ?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?= $setting->id ?>">
                    <div class="form-group">
                      <label for="">Logo</label>
                      <img style="height:100px;margin: 1% 2%;" src="<?= LOGO_URL . $setting->logo ?>" alt="">
                      <input type="hidden" name="logo" value="<?= $setting->logo ?>">
                      <input name="logo" type="file" class="form-control">
                      <small id="" class="form-text text-muted">
                        <?php if (isset($_GET['err_file'])) : ?>
                          <span style="color: red"><?= $_GET['err_file'] ?></span>
                        <?php endif ?>
                      </small>
                    </div>
                    <div class="form-group">
                      <label for="">Email</label>
                      <input name="email" type="text" class="form-control" placeholder="" value="<?= $setting->email ?>">
                      <small id="" class="form-text text-muted">
                        <?php if (isset($_GET['err_email'])) : ?>
                          <span style="color: red"><?= $_GET['err_email'] ?></span>
                        <?php endif ?>
                      </small>
                    </div>
                    <div class="form-group">
                      <label for="">Địa chỉ</label>
                      <input name="address" type="text" class="form-control" placeholder="" value="<?= $setting->address ?>">
                      <small id="" class="form-text text-muted">
                        <?php if (isset($_GET['err_address'])) : ?>
                          <span style="color: red"><?= $_GET['err_address'] ?></span>
                        <?php endif ?>
                      </small>
                    </div>
                    <div class="form-group">
                      <label for="">Hotline</label>
                      <input name="hotline" type="text" class="form-control" placeholder="" value="<?= $setting->hotline ?>">
                      <small id="" class="form-text text-muted">
                        <?php if (isset($_GET['err_hotline'])) : ?>
                          <span style="color: red"><?= $_GET['err_hotline'] ?></span>
                        <?php endif ?>
                      </small>
                    </div>

                    <div class="card-action">
                      <button class="btn btn-success">Cập nhật</button>
                      <button class="btn btn-danger">Trở lại</button>
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

<!-- End Custom template -->
<?php
require_once './app/views/admin/master/footer.php';
?>