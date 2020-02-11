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
            <a href="<?= ADMIN_URL . '/comment' ?>">Bình luận</a>
          </li>
        </ul>
      </div>
      <div class="row">

        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex align-items-center">

                <a href="<?= ADMIN_URL . '/comment' ?>" class="btn btn-primary btn-round ml-auto">
                  Danh sách
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                  <ol class="activity-feed">
										<li class="feed-item feed-item-secondary">
											<p class="date">Người bình luận: </p>
											<span class="text"><?= $comment->getUserName() ?></span>
										</li>
										<li class="feed-item feed-item-success">
											<p class="date" datep="9-24">Tên xe</p>
											<span class="text"><?= $comment->getCarName() ?></span>
										</li>
										<li class="feed-item feed-item-info">
											<p class="date" datep="9-23">Tiêu đề bình luận:</p>
											<span class="text"><?= $comment->title ?></a></span>
										</li>
										<li class="feed-item feed-item-warning">
											<p class="date" datep="9-21">Nội dung bình luận</p>
											<span class="text"><?= $comment->content ?></span>
										</li>
										<li class="feed-item feed-item-danger">
											<p class="date" datep="9-18">Ngày bình luận</p>
											<span class="text"><?= $comment->created_at ?></span>
										</li>
										<li class="feed-item">
											<p class="date" datep="9-17">Đánh giá</p>
											<span class="text"><?= $comment->rating ?></span>
										</li>
									</ol>
                    
                  </div>
                  <div class="col-md-6">
                  <form action="<?= ADMIN_URL . '/comment/save-edit' ?>" method="post">
                    <input type="hidden" name="id" value="<?= $comment->id ?>">

                    <div class="form-check">
                      <label>Cập nhật trạng thái</label><br>
                      <label class="form-radio-label">
                        <input class="form-radio-input" type="radio" name="status" value="2" <?php
                                                                                              if ($comment->status == 2) {
                                                                                                echo 'checked';
                                                                                              } ?>>
                        <span class="form-radio-sign">Ẩn bình luận</span>
                      </label>
                      <label class="form-radio-label ml-3">
                        <input class="form-radio-input" type="radio" name="status" value="1" <?php
                                                                                              if ($comment->status == 1) {
                                                                                                echo 'checked';
                                                                                              } ?>>
                        <span class="form-radio-sign">Hiện bình luận</span>
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
  </div>
</div>

<!-- End Custom template -->
<?php

require_once './app/views/admin/master/footer.php';
?>


