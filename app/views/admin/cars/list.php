<?php
require_once './app/views/admin/master/master.php';
require_once './app/views/admin/master/header.php';
require_once './app/views/admin/master/sidebar.php';
?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Xe</h4>
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
                        <a href="<?= ADMIN_URL . '/car' ?>">Xe</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">

                                            <select class="form-control form-control-round" name="cate_id" id="">
                                                <option value="">Tất cả sản phẩm</option>
                                                <?php foreach ($categories as $cate) : ?>
                                                    <!-- <option value="<?= $cate->id ?>"><?= $cate->name ?></option> -->
                                                    <?php if ($cate->id == $_GET['cate_id']) { ?>
                                                        <option value="<?= $cate->id  ?>" selected><?= $cate->name  ?></option>

                                                    <?php } else { ?>
                                                        <option value="<?= $cate->id  ?>"><?= $cate->name ?></option>
                                                    <?php } ?>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control form-control-round" name="location_id" id="">
                                                <option value="">Tất cả sản phẩm</option>
                                                <?php foreach ($locations as $location) : ?>
                                                    <!-- <option value="<?= $location->id ?>"><?= $location->name ?></option> -->
                                                    <?php if ($location->id == $_GET['location_id']) { ?>
                                                        <option value="<?= $location->id  ?>" selected><?= $location->name  ?></option>

                                                    <?php } else { ?>
                                                        <option value="<?= $location->id  ?>"><?= $location->name ?></option>
                                                    <?php } ?>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-primary btn-round">Lọc</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="d-flex align-items-center">

                                <a href="<?= ADMIN_URL . '/car/add' ?>" class="btn btn-primary btn-round ml-auto">
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
                                            <th>Loại xe</th>
                                            <th>Địa điểm</th>
                                            <th>Hãng xe</th>
                                            <th>Chủ xe</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cars as $car) : ?>
                                            <tr>
                                                <td><?= $car->id ?></td>
                                                <td><?= $car->name ?></td>
                                                <td><?= $car->getCateName() ?></td>
                                                <td><?= $car->getLocaName() ?></td>
                                                <td><?= $car->getMakerName() ?></td>
                                                <td><?= $car->getUserName() ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="<?= ADMIN_URL . '/car/edit?id=' . $car->id ?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a onclick="return del()" href="<?= ADMIN_URL . '/car/del?id=' . $car->id ?>" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Xóa">
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