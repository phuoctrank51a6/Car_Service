<?php
require_once './app/views/admin/master/master.php';
require_once './app/views/admin/master/header.php';
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
                        <a href="<?= ADMIN_URL . '/account' ?>">Tài khoản</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <?php if (isset($_GET['error'])) : ?>
                                    <span style="color: red"><?= $_GET['error'] ?></span>
                                <?php endif ?>
                                <a href="<?= ADMIN_URL . "/account/add" ?>" class="btn btn-primary btn-round ml-auto">
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Vai trò</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user) : ?>
                                            <tr>
                                                <td><?= $user->id ?></td>
                                                <td><?= $user->name ?></td>
                                                <td><?= $user->email ?></td>
                                                <td><?= $user->getRoleName() ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="<?= ADMIN_URL . "/account/change-password?id=" ?><?= $user->id ?>" data-toggle="tooltip" title="" class="btn btn-link btn-success btn-lg" data-original-title="Đổi mật khẩu">
                                                            <i class="fas fa-unlock"></i>
                                                        </a>
                                                        <a href="<?= ADMIN_URL . "/account/edit?id=" ?><?= $user->id ?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa thông tin">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a onclick="return del()" href="<?= ADMIN_URL . '/account/del?id=' . $user->id ?>" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Xóa">
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

<!-- End Custom template -->
<?php
require_once './app/views/admin/master/footer.php';
?>