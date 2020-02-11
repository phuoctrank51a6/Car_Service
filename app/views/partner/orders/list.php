<?php
require_once './app/views/partner/master/master.php';
require_once './app/views/partner/master/header.php';
require_once './app/views/partner/master/sidebar.php';
?>
<div class="main-panel">
  <div class="content">
    <div class="page-inner">
      <div class="page-header">
        <h4 class="page-title">Đơn hàng</h4>
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
            <a href="<?= PARTNER_URL . '/orders' ?>">Đơn hàng</a>
          </li>
        </ul>
      </div>
      <div class="row">

        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex align-items-center">

                <a href="<?= PARTNER_URL ?>" class="btn btn-primary btn-round ml-auto">
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
                      <th>Tên khách hàng</th>
                      <th>Tổng tiền</th>
                      <th>Ngày mua</th>
                      <th>Trạng thái</th>
                      <th style="width: 10%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($orderOfPartner as $order) : ?>
                      <tr>
                        <td><?= $order->id ?></td>
                        <td><?= $order->customer_name ?></td>
                        <td><?= $order->total_price ?></td>
                        <td><?= $order->created_date ?></td>
                        <td>
                        <?php if ($order->status == 0) : ?>
                            Tiếp nhận đơn hàng
                          <?php elseif ($order->status == 1) : ?>
                            Đang xử lý
                          <?php elseif ($order->status == 2) : ?>
                            Chờ thanh toán
                          <?php elseif ($order->status == 3) : ?>
                            Đã hoàn thành
                          <?php elseif ($order->status == 4) : ?>
                            Hủy bỏ
                          <?php elseif ($order->status == 5) : ?>
                            Hoàn tiền
                          <?php endif  ?>
                        </td>
                        <td>
                          <div class="form-button-action">
                            <a href="<?php echo PARTNER_URL . '/orders/edit?id=' ?><?php echo $order->id ?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
                              <i class="fa fa-edit"></i>
                            </a>
                            <!-- <a href="" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Xóa">
                              <i class="fa fa-times"></i>
                            </a> -->
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
require_once './app/views/partner/master/footer.php';
?>