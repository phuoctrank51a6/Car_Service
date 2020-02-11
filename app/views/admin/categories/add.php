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
                        <h4 class="page-title">Loại xe</h4>
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
                                <a href="<?= ADMIN_URL . '/category' ?>">Loại xe</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">

                                        <a href="<?= ADMIN_URL . '/category' ?>" class="btn btn-primary btn-round ml-auto">
                                            Danh sách
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-8">
                                            <form action="<?= ADMIN_URL . '/category/save-add' ?>" method="post">
                                                <div class="form-group">
                                                    <label>Tên loại xe:</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Tên loại xe" value="">
                                                    <small id="emailHelp2" class="form-text text-muted">
                                                        <?php if (isset($_GET['err_name'])) : ?>
                                                            <span style="color: red"><?= $_GET['err_name'] ?></span>
                                                        <?php endif ?>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="comment">Mô tả loại xe:</label>
                                                    <textarea name="description" class="form-control" rows="5"></textarea>
                                                    <small id="emailHelp2" class="form-text text-muted">
                                                        <?php if (isset($_GET['err_description'])) : ?>
                                                            <span style="color: red"><?= $_GET['err_description'] ?></span>
                                                        <?php endif ?>
                                                    </small>
                                                </div>
                                                <div class="form-check">
                                                    <label>Hiển thị ra menu:</label><br>
                                                    <label class="form-radio-label">
                                                        <input class="form-radio-input" type="radio" name="show_menu" value="2" checked="">
                                                        <span class="form-radio-sign">Không</span>
                                                    </label>
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="show_menu" value="1">
                                                        <span class="form-radio-sign">Có</span>
                                                    </label>
                                                </div>

                                                <div class="card-action">
                                                    <button class="btn btn-success" >Cập nhật</button>
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