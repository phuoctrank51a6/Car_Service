<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

	<title>Quên mật khẩu</title>

	<link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/floating-labels/">

	<!-- Bootstrap core CSS -->
	<link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="https://getbootstrap.com/docs/4.0/examples/floating-labels/floating-labels.css" rel="stylesheet">
</head>

<body>
	<form class="form-signin" action="<?= ADMIN_URL . '/submit-reset-password' ?>" method="POST">
		<div class="text-center mb-4">
			<img class="mb-4" src="<?= BASE_URL . '/public/assets/img/logo/icon.png' ?>" alt="">
			<h1 class="h3 mb-3 font-weight-normal">Đặt lại mật khẩu</h1>

		</div>
		<input type="hidden" name="token" value="<?= $token ?>">
		<input type="hidden" name="email" value="<?= $email ?>">
		<div class="form-label-group">
			<input type="password" id="inputPassword" class="form-control" name="password" placeholder="Mật khẩu mới">
			<label for="inputPassword">Mật khẩu mới</label>
		</div>
		<div class="form-label-group">
			<input type="password" id="inputCfPassword" class="form-control" name="cfpassword" placeholder="Nhập lại mật khẩu mới">
			<label for="inputCfPassword">Nhập lại mật khẩu mới</label>
			<small id="emailHelp2" class="form-text text-muted">
				<?php if (isset($_GET['err_password'])) : ?>
					<span style="color: red"><?= $_GET['err_password'] ?></span>
				<?php endif ?>
			</small>
			<small id="emailHelp2" class="form-text text-muted">
				<?php if (isset($_GET['error'])) : ?>
					<span style="color: red"><?= $_GET['error'] ?></span>
				<?php endif ?>
			</small>
		</div>
		<div class="checkbox mb-3">
			<a href="<?= ADMIN_URL . '/forgot-password' ?>">Lấy lại mật khẩu</a>
		</div>


		<button class="btn btn-lg btn-primary btn-block" type="submit">Lấy lại mật khẩu</button>
		<p class="mt-5 mb-3 text-muted text-center">&copy; 2019-2020</p>
	</form>
</body>

</html>