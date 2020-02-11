<?php
require_once './app/views/admin/master/master.php';
require_once './app/views/admin/master/header.php';
require_once './app/views/admin/master/sidebar.php';
?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Voucher</h4>
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
                        <a href="<?= ADMIN_URL . '/account' ?>">Voucher</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">

                                <a href="<?= ADMIN_URL . "/voucher/add" ?>" class="btn btn-primary btn-round ml-auto">
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
                                            <th>Mã voucher</th>
                                            <th>Giảm giá</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày kết thúc</th>
                                            <th>Trạng thái</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($vouchers as $voucher) : ?>
                                            <tr>
                                                <td><?= $voucher->id ?></td>
                                                <td><?= $voucher->code ?></td>
                                                <td><?= $voucher->discount_price ?></td>
                                                <td><?= $voucher->start_time ?></td>
                                                <td><?= $voucher->end_time ?></td>
                                                <td>
                                                    <?php if($voucher->status == 1) : ?>
                                                        Đã kích hoạt
                                                    <?php elseif($voucher->status == 0): ?>
                                                        Chưa kích hoạt
                                                    <?php endif ?>
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="<?= ADMIN_URL . "/voucher/edit?id=" ?><?= $voucher->id ?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a onclick="return del()" href="<?= ADMIN_URL . '/voucher/del?id=' . $voucher->id ?>" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Xóa">
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