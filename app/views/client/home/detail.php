<?php

include_once "./app/views/client/template/header.php";
?>
<div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
  <div class="container-fluid">
    <div class="breadcrumb-content text-center">
      <h2>Thông tin chi tiết xe</h2>
      <ul>
        <li>
          <a href="<?= BASE_URL ?>">Trang chủ</a>
        </li>
        <li>Chi tiết xe</li>
      </ul>
    </div>
  </div>
</div>
<div class="product-details-area fluid-padding-3 ptb-130">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="product-details-content">



          <div class="row">
            <div class="col-md-6">
              <img width="100%" src="<?= IMAGE_URL . $detail->feature_image ?>" alt="">
            </div>
            <div class="col-md-6">
              <h2><?= $detail->name ?></h2>
              <?php
                                      for ($i = 1; $i <= 5; $i++) {
                                        if ($detail->rating >= $i) {
                                          echo "<img width='20px' src='assets/img/icon-img/starFull.png' alt=''>";
                                        } else if (!is_int($detail->rating)) {
                                          echo "<img width='20px' src='assets/img/icon-img/star1.png' alt=''>";
                                          if ($i < 5) {
                                            for ($j = $i; $j < 5; $j++) {
                                              echo "<img width='20px' src='assets/img/icon-img/star0.png' alt=''>";
                                            }
                                            break;
                                          }
                                        }
                                      }
              ?>
              <div class="product-price">
                <span>$ <?= $detail->price ?></span>
              </div>
              <br>
              <div class="bundle-area">

                <div class="bundle-all-price">
                  <div class="bundle-price">
                    <ul>
                      <li><?= $detail->getCateName() ?></li>
                      <li><?= $detail->getMakerName() ?></li>
                      <li><?= $detail->getLocaName() ?></li>
                    </ul>
                  </div>
                  <div class="bundle-result">
                    <h4>Price For All : <span> <span class="bundle-cross"> $1300</span> -
                        $750</span></h4>
                  </div>
                </div>

              </div>
            </div>
          </div>



          <div class="product-overview">
            <h5 class="pd-sub-title">Thông tin chi tiết về xe</h5>
            <p><?= $detail->detail ?></p>
          </div>

        </div>

        <h3 style="margin: 40px 0px;">Nhận xét - Đánh giá:</h3>
        <div class="product-details-content">
          <div class="comments">
            <div class="row">
              <div class="col-md-12">
                <form method="post" action="<?= BASE_URL . 'comment' ?>" id="form" role="form" class="blog-comments">
                  <div class="row">

                    <?php if (isset($_GET['err_checkout'])) : ?>
                      <h3 class="text-danger" role="alert"><?= $_GET['err_checkout'] ?></h3>
                    <?php endif ?>
                    <div class="col-md-12 form-group">
                      <!-- Name -->
                      <input type="hidden" name="product_id" value="<?= $detail->id ?>">
                      <input type="text" name="title" id="name" class=" form-control" placeholder="Title *" maxlength="100" required="">
                      <?php if (isset($_GET['err_title'])) : ?>
                        <div class="text-danger" role="alert"><?= $_GET['err_title'] ?></div>
                      <?php endif ?>
                    </div>

                    <div class="form-group col-md-12">
                      <select class="form-control" name="rating">
                        <option value="" disabled>Đánh giá</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5" selected>5</option>
                      </select>
                    </div>

                    <!-- Comment -->
                    <div class="form-group col-md-12">
                      <textarea id="text" class=" form-control" rows="6" placeholder="Comment" maxlength="400" name="content"></textarea>
                      <?php if (isset($_GET['err_content'])) : ?>
                        <div class="text-danger" role="alert"><?= $_GET['err_content'] ?></div>
                      <?php endif ?>
                    </div>

                    <!-- Send Button -->
                    <div class="form-group col-md-12">
                      <button class="btn-lg btn-warning btn-block " type="submit">Gửi</button>
                    </div>


                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>

        <h3 style="margin: 40px 0px;">Khách hàng nhận xét:</h3>
        <div class="product-details-content">
          <div class="comments">
            <?php if ($comments != null) {
                                                                      foreach ($comments as $comment) { ?>
                <div class="row">
                  <div class="col-md-2">
                    <img width="100%" style="border-radius: 50%" class="img-comment" src="<?= AVATAR_URL . $comment->avatar ?>" alt="">
                  </div>
                  <div class="col-md-10">
                    <div class="product-overview">
                      <h4 class="pd-sub-title"><?= $comment->getUserName() ?></h4>
                      <div class="quick-view-rating">
                        <?php
                                                                                          for ($i = 1; $i <= 5; $i++) {
                                                                                            if ($comment->rating >= $i) {
                                                                                              echo "<i class='fa fa-star reting-color'></i>";
                                                                                            } else if (!is_int($comment->rating)) {
                                                                                              echo "<i class='fa fa-star-half-o reting-color'></i>";
                                                                                              if ($i < 5) {
                                                                                                for ($j = $i; $j < 5; $j++) {
                                                                                                  echo "<i class='fa fa-star-o reting-color'></i>";   # code...
                                                                                                }

                                                                                                break;
                                                                                              }
                                                                                            }
                                                                                          }
                        ?>
                      </div>
                      <b><?= $comment->title ?></b>
                      <p><?= $comment->content ?></p>
                    </div>
                  </div>
                </div>
              <?php }
                                                                                      } else { ?>
              <div class="alert alert-secondary" role="alert">
                Chưa có nhận xét về chiếc xe này. Hãy là người đầu tiên nhận xét về chiếc xe này nhé!
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="product-details-content">

          <div>
            <form action="<?= BASE_URL . 'checkout' ?>" method="get">
              <div class="form-group">
                <?php if (isset($_GET['err_check'])) : ?>
                  <div class="text-danger" role="alert"><?= $_GET['err_check'] ?></div>
                <?php endif ?>
                <button class="btn-lg btn-warning btn-block " type="submit">ĐẶT XE</button>
                <input type="hidden" name="id" value="<?= $detail->id ?>">
              </div>
              <div class="form-group">
                <label for="">Địa điểm nhận xe</label>
                <input type="text" name="customer_address" value="<?= $detail->getLocaName() ?>">
              </div>
              <div class="form-group">
                <label for="">Ngày nhận xe</label>
                <input type="date" id="timeCheckIn" class="form-control" name="date_start" value="" />
                <?php if (isset($_GET['err_date_start'])) : ?>
                  <div class="text-danger" role="alert"><?= $_GET['err_date_start'] ?></div>
                <?php endif ?>
              </div>
              <div class="form-group">
                <label for="">Ngày trả xe</label>
                <input class="form-control" type="date" name="date_end">
                <?php if (isset($_GET['err_date_end'])) : ?>
                  <div class="text-danger" role="alert"><?= $_GET['err_date_end'] ?></div>
                <?php endif ?>
              </div>
              <div class="form-group">
                <label for="">Voucher giảm giá</label>
                <input class="form-control" type="text" name="voucher">
                <?php if (isset($_GET['err_voucher'])) : ?>
                  <div class="text-danger" role="alert"><?= $_GET['err_voucher'] ?></div>
                <?php endif ?>
              </div>

            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>
<?php
                                                                                      include_once "./app/views/client/template/footer.php";
?>