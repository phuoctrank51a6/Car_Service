<?php
require_once './app/views/admin/master/master.php';
require_once './app/views/admin/master/header.php';
require_once './app/views/admin/master/sidebar.php';
?>
<div class="main-panel">
  <div class="content">
    <div class="page-inner">
      <div class="page-header">
        <h4 class="page-title">Hãng xe</h4>
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
            <a href="<?= ADMIN_URL . '/maker' ?>">Hãng xe</a>
          </li>
        </ul>
      </div>
      <div class="row">

        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex align-items-center">

                <a href="<?= ADMIN_URL . '/maker' ?>" class="btn btn-primary btn-round ml-auto">
                  Danh sách
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="row justify-content-md-center">
                <div class="col-md-8">
                  <form action="<?= ADMIN_URL . '/maker/save-add' ?>" method="post">
                    <div class="form-group">
                      <label>Tên hãng xe:</label>
                      <input type="text" name="name" class="form-control" placeholder="" value="">
                      <small id="emailHelp2" class="form-text text-muted">
                          <?php if (isset($_GET['err_name'])) : ?>
                            <span style="color: red"><?= $_GET['err_name'] ?></span>
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