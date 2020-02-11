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
	<form class="form-signin" action="<?= ADMIN_URL . '/submit-forgot-password' ?>" method="POST">
		<div class="text-center mb-4">
			<img class="mb-4" src="<?= BASE_URL . '/public/assets/img/logo/icon.png' ?>" alt="">
			<h1 class="h3 mb-3 font-weight-normal">Quên mật khẩu</h1>

		</div>

		<div class="form-label-group">
			<input type="email" id="inputEmail" class="form-control" name="email" placeholder="Địa chỉ email">
			<label for="inputEmail">Email của bạn</label>
			<small id="emailHelp2" class="form-text text-muted">
				<?php if (isset($_GET['error'])) : ?>
					<span style="color: red"><?= $_GET['error'] ?></span>
				<?php endif ?>
			</small>
		</div>

		<div class="checkbox mb-3">
			<div>
				<a href="<?= ADMIN_URL . '/login' ?>">Đăng nhập</a>
			</div>
		</div>

		<button class="btn btn-lg btn-primary btn-block" type="submit">Lấy lại mật khẩu</button>
		<p class="mt-5 mb-3 text-muted text-center">&copy; 2019-2020</p>
	</form>
</body>

</html>