<div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
  <div class="container-fluid">
    <div class="breadcrumb-content text-center">
      <h2>Danh sách <?= $nameCategory ?></h2>
      <ul>
        <li>
          <a href="<?= BASE_URL ?>">Trang chủ</a>
        </li>
        <li>Danh sách xe</li>
      </ul>
    </div>
  </div>
</div>
<div class="shop-wrapper pt-120 pb-120">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="product-sidebar-area pr-10">
          <div class="sidebar-widget pb-55">
            <h3 class="sidebar-widget">Tìm kiếm</h3>
            <div class="sidebar-search">
              <form action="<?= BASE_URL . 'find' ?>" method="get">
                <input type="text" name="keyword" placeholder="Tìm kiếm...">
                <button type="submit"><i class="ti-search"></i></button>
              </form>
            </div>
          </div>
          <div class="sidebar-widget pb-50">
            <h3 class="sidebar-widget">Hãng xe</h3>
            <div class="widget-categories">
              <ul>
                <?php foreach ($cate as $category) { ?>
                  <li><a href="<?= BASE_URL . 'category?id=' . $category->id ?>"><?= $category->name ?></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <div class="sidebar-widget pb-50">
            <h3 class="sidebar-widget">Địa điểm nhận xe</h3>
            <div class="widget-categories">
              <ul>
                <?php foreach ($loca as $location) { ?>
                  <li><a href="<?= BASE_URL . 'location?id=' . $location->id ?>"><?= $location->name ?></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>