<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="<?= BASE_URL . '/public/assets/img/logo/icon.png' ?>" alt=".." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a  href="<?= ADMIN_URL ?>" aria-expanded="true">
                        <span>
                        <?php if (isset($_SESSION['AUTH'])) : ?>
                            <?= $_SESSION['AUTH']['name']; ?>
                        <?php endif ?>
                        <span class="user-level">
                        <?php if (isset($_SESSION['AUTH'])) : ?>
                            <?= $_SESSION['AUTH']['email']; ?>
                        <?php endif ?>
                        </span>
                        
                        </span>
                    </a>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a href="<?= ADMIN_URL ?>" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section"></h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#category">
                        <i class="fas fa-layer-group text-primary"></i>
                        <p>Loại xe</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="category">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= ADMIN_URL . '/category' ?>">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= ADMIN_URL . '/category/add' ?>">
                                    <span class="sub-item">Thêm mới</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#location">
                        <i class="fas fa-map-marker-alt text-primary"></i>
                        <p>Địa điểm thuê xe</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="location">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= ADMIN_URL . '/location' ?>">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= ADMIN_URL . '/location/add' ?>">
                                    <span class="sub-item">Thêm mới</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#maker">
                        <i class="fas fa-industry text-primary"></i>
                        <p>Hãng xe</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maker">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= ADMIN_URL . '/maker' ?>">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= ADMIN_URL . '/maker/add' ?>">
                                    <span class="sub-item">Thêm mới</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#car">
                        <i class="fas fa-motorcycle text-primary"></i>
                        <p>Xe</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="car">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= ADMIN_URL . "/car" ?>">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= ADMIN_URL . "/car/add" ?>">
                                    <span class="sub-item">Thêm mới</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#users">
                        <i class="fas fa-user-friends text-primary"></i>
                        <p>Tài khoản</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= ADMIN_URL . "/account" ?>">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= ADMIN_URL . "/account/add" ?>">
                                    <span class="sub-item">Thêm mới</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= ADMIN_URL . '/role' ?>">
                                    <span class="sub-item">Vai trò</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#comments">
                        <i class="fas fa-comment-dots text-primary"></i>
                        <p>Bình luận</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="comments">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= ADMIN_URL . "/comment" ?>">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= ADMIN_URL . "/comment/add" ?>">
                                    <span class="sub-item">Thêm mới</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#voucher">
                        <i class="fas fa-money-bill text-primary"></i>
                        <p>Mã giảm giá</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="voucher">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= ADMIN_URL . "/voucher" ?>">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= ADMIN_URL . "/voucher/add" ?>">
                                    <span class="sub-item">Thêm mới</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#orders">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        <p>Đơn hàng</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="orders">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= ADMIN_URL . "/order" ?>">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#page">
                        <i class="fas fa-th-list text-primary"></i>
                        <p>Trang</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="page">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= ADMIN_URL . "/page" ?>">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= ADMIN_URL . "/page/add" ?>">
                                    <span class="sub-item">Thêm mới</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#setting">
                        <i class="fas fa-sliders-h text-primary"></i>
                        <p>Cấu hình website</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="setting">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= ADMIN_URL . "/setting" ?>">
                                    <span class="sub-item">Thông tin website</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>