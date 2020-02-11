<?php
require_once './app/views/admin/master/master.php';
require_once './app/views/admin/master/header.php';
require_once './app/views/admin/master/sidebar.php';
?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Thông tin tài khoản</h4>
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
                        <a href="<?= ADMIN_URL . '/car' ?>">Thông tin tài khoản</a>
                    </li>
                </ul>

            </div>
            
            <div class="row">
                
                <div class="col-md-10 ml-auto mr-auto">
                <div class="card card-post card-round">
							
								<div class="card-body">
									<div class="d-flex">
										<div class="col-md-3">
											<img src="<?= AVATAR_URL . $user->avatar ?>" alt="..." class="avatar-img rounded-circle">
                                        </div>
                                        <div class="col-md-6">
										<div class="info-post ml-2">
                                            <h1 class="username"><?= $user->name ?></h1>
                                            
                                            <p class="date text-muted">#<?= $user->id ?></p>
                                            <h3>Email: <?= $user->email ?></h3>
                                            <h3>Vai trò: <?= $user->getRoleName() ?></h3>
                                        </div>
                                        </div>

                                        <div class="col-md-3 text-right">
                                        <a href="<?= ADMIN_URL . '/account/edit?id=' . $user->id ?>" class="btn btn-round btn-primary">Chỉnh sửa</a>
                                        </div>

									</div>
                                    <div class="separator-solid"></div>

                              
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