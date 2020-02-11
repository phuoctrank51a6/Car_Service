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
                        <h4 class="page-title">Tài khoản</h4>
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
                                <a href="<?= ADMIN_URL . '/category' ?>">Tài khoản</a>
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
                                            <form action="<?= ADMIN_URL . "/account/save-add" ?>" method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label>Tên</label>
                                                    <input type="text" class="form-control" placeholder="" value="" name="name">
                                                    <small id="emailHelp2" class="form-text text-muted">
                                                        <?php if (isset($_GET['err_name'])) : ?>
                                                            <span style="color: red"><?= $_GET['err_name'] ?></span>
                                                        <?php endif ?>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" placeholder="" value="" name="email">
                                                    <small id="emailHelp2" class="form-text text-muted">
                                                        <?php if (isset($_GET['err_email'])) : ?>
                                                            <span style="color: red"><?= $_GET['err_email'] ?></span>
                                                        <?php endif ?>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control" placeholder="" value="" name="password">
                                                    <small id="emailHelp2" class="form-text text-muted">
                                                        <?php if (isset($_GET['err_password'])) : ?>
                                                            <span style="color: red"><?= $_GET['err_password'] ?></span>
                                                        <?php endif ?>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Avatar</label>
                                                    <input id="img" type="file" class="form-control-file" id="" name="avatar" onchange="changeImg(this)">
                                                    <img id="image" class="thumbnail" width="50%" height="">
                                                    <small id="emailHelp2" class="form-text text-muted">
                                                        <?php if (isset($_GET['err_file'])) : ?>
                                                            <span style="color: red"><?= $_GET['err_file'] ?></span>
                                                        <?php endif ?>
                                                    </small>
                                                </div>
                                                <div class="form-group">
												<label>Phân quyền</label>
												<select class="form-control" name="role_id" >
                                                    <?php foreach($roles as $role) : ?>
                                                        <option value="<?= $role->id ?>">
                                                        <?= $role->name ?>
                                                        </option>
                                                    <?php endforeach ?>
												</select>
											</div>
                                                <div class="form-check">
                                                    <label>Trạng thái:</label><br>
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="status" value="1" checked="">
                                                        <span class="form-radio-sign">Kích hoạt</span>
                                                    </label>
                                                    <label class="form-radio-label">
                                                        <input class="form-radio-input" type="radio" name="status" value="0" >
                                                        <span class="form-radio-sign">Chưa kích hoạt</span>
                                                    </label>
                                                    
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