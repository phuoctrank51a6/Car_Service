<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="<?= BASE_URL . '/public/assets/img/logo/icon.png' ?>" alt=".." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <?php if (isset($_SESSION['AUTH'])) : ?>
                                <?= $_SESSION['AUTH']['name']; ?>
                            <?php endif ?>
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
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
                    <a data-toggle="collapse" href="#car">
                        <i class="fas fa-motorcycle text-primary"></i>
                        <p>Xe</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="car">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= PARTNER_URL . "/cars" ?>">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= PARTNER_URL . "/cars/add" ?>">
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
                                <a href="<?= PARTNER_URL . "/account" ?>">
                                    <span class="sub-item">Thông tin</span>
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
                                <a href="<?= PARTNER_URL . "/orders" ?>">
                                    <span class="sub-item">Danh sách</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>


            </ul>
        </div>
    </div>
</div>