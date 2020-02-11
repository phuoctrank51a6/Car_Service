<?php
require_once './app/views/partner/master/master.php';
?>

<body>
    <div class="wrapper">
        <?php
        require_once './app/views/partner/master/header.php';
        ?>

        <!-- Sidebar -->
        <?php
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
                                <a href="<?= PARTNER_URL . '/account' ?>">Địa điểm</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">

                                        <a href="<?= PARTNER_URL . '/account' ?>" class="btn btn-primary btn-round ml-auto">
                                            Danh sách
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-8">
                                            <form  action="<?= PARTNER_URL . "/account/save-edit" ?>" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?= $user->id ?>">
                                                <div class="form-group">
                                                    <label>Tên</label>
                                                    <input type="text" class="form-control" placeholder="" name="name" value="<?= $user->name ?>">
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" placeholder="" name="email" value="<?= $user->email ?>">
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control" placeholder="" name="password" value="<?= $user->password ?>">
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Avatar</label>
                                                    <input id="img" type="file" class="form-control" name="avatar" onchange="changeImg(this)">
                                                </div>
                                                <img src="<?= AVATAR_URL . $user->avatar ?>" alt="" id="image" width="50%">
                                                <div class="form-group">
												<label for="exampleFormControlSelect1">Phân quyền</label>
												<select class="form-control"  name="role_id" >
                                                    <?php foreach ($roles as $role ) { ?>
                                                        <?php if($role->id == $user->role_id) { ?>
                                                            <option value="<?= $role->id ?>" selected > <?= $role->name ?> </option>
                                                        <?php } else { ?>
                                                            <option value="<?= $role->id ?>"> <?= $role->name ?> </option>
                                                        <?php } ?>
                                                    <?php } ?>
												</select>
											</div>
                                                 <div class="form-check">
                                                    <label>Trạng thái:</label><br>
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="status" value="1" <?php  if($user->status == 1){ echo 'checked';} ?>>
                                                        <span class="form-radio-sign">Kích hoạt</span>
                                                    </label>
                                                    <label class="form-radio-label">
                                                        <input class="form-radio-input" type="radio" name="status" value="0" <?php  if($user->status == 0){ echo 'checked';} ?> >
                                                        <span class="form-radio-sign">Chưa kích hoạt</span>
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

        <!-- End Custom template -->
        <?php
        require_once './app/views/partner/master/footer.php';
        ?>