<?php
require_once './app/views/admin/master/master.php';
require_once './app/views/admin/master/header.php';
require_once './app/views/admin/master/sidebar.php';
?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Bình luận</h4>
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
                        <a href="<?= ADMIN_URL . '/account' ?>">Bình luận</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">

                                <a href="<?= ADMIN_URL ?>" class="btn btn-primary btn-round ml-auto">
                                    Dashboard
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tiêu đề</th>
                                            <th>Sản phẩm</th>
                                            <th>Người bình luận</th>
                                            <th>Hiện thị</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($comments as $comment) : ?>
                                            <form action="<?= ADMIN_URL . '/comment/save-edit' ?>" method="post">
                                                <input type="hidden" name="id" value="<?= $comment->id ?>">
                                                <tr>
                                                    <td><?= $comment->id ?></td>
                                                    <td><?= $comment->title ?></td>
                                                    <td><?= $comment->getCarName() ?></td>
                                                    <td><?= $comment->getUserName() ?></td>
                                                    <td>
                                                        <?php
                                                            for ($i = 1; $i <= 5; $i++) {
                                                                if ($comment->rating >= $i) {
                                                                    echo "<i class='fas fa-star text-warning'></i>";
                                                                } else if (!is_int($comment->rating)) {
                                                                    echo "<i class='fas fa-star-half-alt text-warning'></i>";
                                                                    if ($i < 5) {
                                                                        for ($j = $i; $j < 5; $j++) {
                                                                            echo "<i class='far fa-star text-warning'></i>";   # code...
                                                                        }

                                                                        break;
                                                                    }
                                                                }
                                                                // else if ($comment->rating < $i) {
                                                                //     echo "<i class='far fa-star text-warning'></i>";
                                                                // }
                                                            }
                                                            ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($comment->status == 1) {
                                                                echo "Hiện";
                                                            } else {
                                                                echo "Ẩn";
                                                            } ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a href="<?= ADMIN_URL . "/comment/edit?id=" ?><?= $comment->id ?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a onclick="return del()" href="<?= ADMIN_URL . '/comment/del?id=' . $comment->id  ?>" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Xóa">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </form>
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