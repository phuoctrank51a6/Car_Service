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
                            <div class="d-flex align-items-center">

                                <a href="<?= ADMIN_URL . '/car' ?>" class="btn btn-primary btn-round ml-auto">
                                    Danh sách
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-md-center">
                                <div class="col-md-8">
                                    <form action="<?= ADMIN_URL . '/car/save-edit' ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $car->id ?>">
                                        <div class="form-group">
                                            <label>Tên:</label>
                                            <input name="name" type="text" class="form-control" placeholder="" value="<?= $car->name ?>">
                                            <small id="emailHelp2" class="form-text text-muted">
                                                    <?php if (isset($_GET['err_name'])) : ?>
                                                        <span style="color: red"><?= $_GET['err_name'] ?></span>
                                                    <?php endif ?>
                                            </small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Loại xe</label>
                                            <select name="cate_id" class="form-control" id="">
                                                <?php foreach ($categories as $cate) : ?>
                                                    <option value="<?= $cate->id ?>" <?php
                                                            if ($cate->id == $car->cate_id) {
                                                                echo "selected";
                                                                                            }
                                                            ?>>
                                                            <?= $cate->name ?>
                                                    </option>

                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Địa điểm</label>
                                            <select name="location_id" class="form-control" id="">
                                                <?php foreach ($locations as $location) : ?>
                                                    <option value="<?= $location->id ?>" <?php
                                                        if ($location->id == $car->location_id) {
                                                            echo "selected";
                                                        }
                                                        ?>>
                                                        <?= $location->name ?>
                                                    </option>

                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Hãng xe</label>
                                            <select name="maker_id" class="form-control" id="">
                                                <?php foreach ($makers as $maker) : ?>
                                                    <option value="<?= $maker->id ?>" <?php
                                                        if ($maker->id == $car->maker_id) {
                                                            echo "selected";
                                                        }
                                                        ?>>
                                                        <?= $maker->name ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Chủ xe</label>
                                            <select name="user_id" class="form-control" id="">
                                                <?php foreach ($users as $user) : ?>
                                                    <option value="<?= $user->id ?>" 
                                                        <?php
                                                        if ($user->id == $car->user_id) {
                                                            echo "selected";
                                                        }
                                                        ?>
                                                    >
                                                        <?= $user->name ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Giá:</label>
                                            <input name="price" type="text" class="form-control" placeholder="" value="<?= $car->price ?>">
                                            <small id="emailHelp2" class="form-text text-muted">
                                                    <?php if (isset($_GET['err_price'])) : ?>
                                                        <span style="color: red"><?= $_GET['err_price'] ?></span>
                                                    <?php endif ?>
                                            </small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Hình ảnh</label>
                                            <input id="img" type="file" class="form-control" name="feature_image" onchange="changeImg(this)">
                                            <small id="emailHelp2" class="form-text text-muted">
                                                    <?php if (isset($_GET['err_file'])) : ?>
                                                        <span style="color: red"><?= $_GET['err_file'] ?></span>
                                                    <?php endif ?>
                                            </small>
                                        </div>
                                            <img src="<?= IMAGE_URL . $car->feature_image ?>" alt="" id="image" width="50%">
                                        <div class="form-group">
                                            <label for="comment">Chi tiết:</label>
                                            <textarea name="detail" class="form-control" id="comment" rows="5"><?= $car->detail ?></textarea>
                                            <small id="emailHelp2" class="form-text text-muted">
                                                    <?php if (isset($_GET['err_detail'])) : ?>
                                                        <span style="color: red"><?= $_GET['err_detail'] ?></span>
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