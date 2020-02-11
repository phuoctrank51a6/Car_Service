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
                                <a href="<?= ADMIN_URL . '/category' ?>">Voucher</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">

                                        <a href="<?= ADMIN_URL . '/voucher' ?>" class="btn btn-primary btn-round ml-auto">
                                            Danh sách
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-8">
                                            <form action="<?= ADMIN_URL . '/voucher/save-edit' ?>" method="post">
                                                <input type="hidden" name="id" value="<?= $voucher->id ?>">
                                                <div class="form-group">
                                                    <label>Mã voucher:</label>
                                                    <input type="text" class="form-control" placeholder="" name="code"value="<?= $voucher->code ?>">
                                                    <small id="" class="form-text text-muted">
                                                        <?php if (isset($_GET['err_code'])) : ?>
                                                            <span style="color: red"><?= $_GET['err_code'] ?></span>
                                                        <?php endif ?>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Thời gian bắt đầu:</label>
                                                  
                                                    <input type="text" id="timeCheckIn" class="form-control" name="start_time" value="<?= $voucher->start_time ?>" />
                                                    <small id="" class="form-text text-muted">
                                                        <?php if (isset($_GET['err_start_time'])) : ?>
                                                            <span style="color: red"><?= $_GET['err_start_time'] ?></span>
                                                        <?php endif ?>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Thời gian kết thúc:</label>
                                                    <input type="text" id="timeCheckOut" class="form-control" name="end_time" value="<?= $voucher->end_time ?>" />
                                                    <small id="" class="form-text text-muted">
                                                        <?php if (isset($_GET['err_end_time'])) : ?>
                                                            <span style="color: red"><?= $_GET['err_end_time'] ?></span>
                                                        <?php endif ?>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Giảm giá:</label>
                                                    <input type="text" class="form-control" placeholder="Nhập tiền giảm giá" name="discount_price" value="<?= $voucher->discount_price ?>">
                                                    <small id="" class="form-text text-muted">
                                                        <?php if (isset($_GET['err_discount_price'])) : ?>
                                                            <span style="color: red"><?= $_GET['err_discount_price'] ?></span>
                                                        <?php endif ?>
                                                    </small>
                                                </div>
                                                <div class="form-check">
                                                    <label>Trạng thái:</label><br>
                                                    <label class="form-radio-label">
                                                        <input class="form-radio-input" type="radio" name="status" value="0" <?php  if($voucher->status == 0){ echo 'checked';} ?> >
                                                        <span class="form-radio-sign">Không kích hoạt</span>
                                                    </label>
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="status" value="1" <?php if($voucher->status == 1){ echo 'checked';} ?>  >
                                                        <span class="form-radio-sign">Kích hoạt</span>
                                                    </label>
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


        <!-- End Custom template -->
        <?php
        require_once './app/views/admin/master/footer.php';
        ?>