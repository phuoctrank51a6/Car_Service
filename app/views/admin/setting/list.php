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

                <a href="<?= ADMIN_URL . '/setting/add' ?>" class="btn btn-primary btn-round ml-auto">
                  <i class="fa fa-plus"></i>
                  Thêm mới
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Logo</th>
                      <th>Địa chỉ</th>
                      <th>Hotline</th>
                      <th>Email</th>
                      <th style="width: 10%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($setting as $settings) : ?>
                      <tr>
                        <td><?= $settings->id ?></td>
                        <td><img height="100%" src="<?= LOGO_URL . $settings->logo ?>" alt=""></td>
                        <td><?= $settings->address ?></td>
                        <td><?= $settings->hotline ?></td>
                        <td><?= $settings->email ?></td>
                        <td>
                          <div class="form-button-action">
                            <a href="<?= ADMIN_URL . '/setting/edit?id=' . $settings->id ?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
                              <i class="fa fa-edit"></i>
                            </a>
                            <a onclick=" return del()" href="<?= ADMIN_URL . '/setting/del?id=' . $settings->id ?>" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Xóa">
                              <i class="fa fa-times"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach ?>


                  </tbody>
                </table>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require_once './app/views/admin/master/footer.php';
?>