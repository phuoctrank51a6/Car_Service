<?php
require_once './app/views/partner/master/master.php';
require_once './app/views/partner/master/header.php';
require_once './app/views/partner/master/sidebar.php';
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
                        <a href="<?= PARTNER_URL . '/cars' ?>">Địa điểm</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">

                                <a href="<?= PARTNER_URL . '/cars' ?>" class="btn btn-primary btn-round ml-auto">
                                    Danh sách
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-md-center">
                                <div class="col-md-8">
                                    <form action="<?= PARTNER_URL . '/cars/save-edit' ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $car->id ?>">
                                        <div class="form-group">
                                            <label>Tên:</label>
                                            <input name="name" type="text" class="form-control" placeholder="" value="<?= $car->name ?>">
                                            <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
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
                                                                                            ?>><?= $location->name ?></option>

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
                                                                                            ?>><?= $maker->name ?></option>

                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Giá:</label>
                                            <input name="price" type="text" class="form-control" placeholder="" value="<?= $car->price ?>">
                                            <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                        </div>
                                        <div class="form-group">
                                            <label>Ảnh:</label>
                                            <img id="image" style="height:200px;margin: 1% 2%;" src="<?= IMAGE_URL . $car->feature_image ?>" alt="" >
                                            <input type="hidden" name="feature_image" value="<?= $car->feature_image ?>">
                                            <input id="img" type="file" name="feature_images" class="form-control" placeholder="" value="" onchange="changeImg(this)">
                                            <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                        </div>
                                        <div class="form-group">
                                            <label for="comment">Chi tiết:</label>
                                            <textarea name="detail" class="form-control" id="comment" rows="5"><?= $car->detail ?></textarea>
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
require_once './app/views/partner/master/footer.php';
?>