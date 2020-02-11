<?php
require_once './app/views/admin/master/master.php';
?>

<body>
    <div class="wrapper">
        <?php
        require_once './app/views/admin/master/header.php';
        ?>

        <!-- Sidebar -->
        <?php
        require_once './app/views/admin/master/sidebar.php';
        ?>
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Địa điểm</h4>
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
                                <a href="<?= ADMIN_URL . '/account' ?>">Địa điểm</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">

                                        <a href="<?= ADMIN_URL . '/account' ?>" class="btn btn-primary btn-round ml-auto">
                                            Danh sách
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-8">
                                            <form  action="<?= ADMIN_URL . "/account/save-change-password" ?>" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?= $user->id ?>">
                                                <div class="form-group">
                                                    <label>Password cũ</label>
                                                    <input type="password" class="form-control" placeholder="" name="passwordNow" value="">
                                                    <small id="emailHelp2" class="form-text text-muted">
                                                        <?php if (isset($_GET['err_password_now'])) : ?>
                                                            <span style="color: red"><?= $_GET['err_password_now'] ?></span>
                                                        <?php endif ?>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Password mới</label>
                                                    <input type="password" class="form-control" placeholder="" name="newPassword" value="">
                                                    <small id="emailHelp2" class="form-text text-muted">
                                                        <?php if (isset($_GET['err_password_new'])) : ?>
                                                            <span style="color: red"><?= $_GET['err_password_new'] ?></span>
                                                        <?php endif ?>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nhập lại mật khẩu mới</label>
                                                    <input type="password" class="form-control" placeholder="" name="newPassword" value="">
                                                    <small id="emailHelp2" class="form-text text-muted">
                                                        <?php if (isset($_GET['err_rePassword'])) : ?>
                                                            <span style="color: red"><?= $_GET['err_rePassword'] ?></span>
                                                        <?php endif ?>
                                                    </small>
                                                </div>

                                                <div class="card-action">
                                                    <button class="btn btn-success">Cập nhật</button>
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