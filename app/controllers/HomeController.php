<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Car;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Location;
use App\Models\Maker;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Voucher;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class HomeController
{
	// trang chủ
	public function index()
	{
		$makers = Maker::all();
		$hondaMaker = Maker::where(['name', '=', 'Honda'])->first();
		$yamahaMaker = Maker::where(['name', '=', 'Yamaha'])->first();
		// dd($hondaMaker);
		$locations = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		$cars = Car::all();
		$carsHonda = Car::where(['maker_id', '=', $hondaMaker->id])->get();
		$carsYamaha = Car::where(['maker_id', '=', $yamahaMaker->id])->get();
		include_once './app/views/client/home/homepage.php';
	}

	public function errorPage()
	{
		include_once './app/views/error.php';
	}

	public function search()
	{
		$locationId = isset($_GET['locationId']) == true ? $_GET['locationId'] : "";
		$categoryId = isset($_GET['categoryId']) == true ? $_GET['categoryId'] : "";
		// dd($locationId);
		if (isset($_SERVER['PHP_SELF'])) {
			$errLocationId = "";
			if ($categoryId == "") {
				$errLocationId = "Mời bạn chọn địa điểm";
			}
			$errCategoryId = "";
			if ($locationId == "") {
				$errCategoryId = "Mời bạn chọn loại xe";
			}
			// kiểm tra và hiện validation
			if ($errLocationId != "" || $errCategoryId != "") {
				header(
					'location: ' . BASE_URL . '/?'
						. 'errLocationId=' . $errLocationId
						. '&errCategoryId=' . $errCategoryId
				);
				die;
			}
		}

		// kiểm tra và hiện validation
		if ($errLocationId != "" || $errCategoryId != "") {
			header(
				'location: ' . BASE_URL . '/?'
					. 'errLocationId=' . $errLocationId
					. '&errCategoryId=' . $errCategoryId
			);
			die;
		}

		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		$cars = Car::where(['location_id', '=', $locationId])->andWhere(['cate_id', '=', $categoryId])->get();

		$nameCategory = " ";
		// dd($cars);
		include_once './app/views/client/home/category.php';
	}
	public function find()
	{
		$keyword =  isset($_GET['keyword']) == true ? $_GET['keyword'] : "";
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();

		$cars = Car::where(['name', 'like', "%$keyword%"])->get();
		// dd($cars);
		$nameCategory = "có từ khóa là " . $keyword;

		include_once './app/views/client/home/category.php';
	}
	public function comment()
	{
		$product_id = isset($_POST['product_id']) == true ? $_POST['product_id'] : "";
		$title = isset($_POST['title']) == true ? $_POST['title'] : "";
		$rating = isset($_POST['rating']) == true ? $_POST['rating'] : "";
		$content = isset($_POST['content']) == true ? $_POST['content'] : "";
		$user_id = $_SESSION['AUTH']['id'];
		$status = 1;

		if (isset($_SERVER['PHP_SELF'])) {
			// pass
			// dd($_SESSION['AUTH']);
			$err_checkout = "";
			if ($_SESSION['AUTH'] == null) {
				$err_checkout = "Đăng nhập để có thể đặt xe được bạn nhé!";
			}
			$err_title = "";
			if ($title == "" || strlen($title) < 2) {
				$err_title = "Tiêu đề quá ngắn";
			}

			$err_content = "";
			if ($content == "" || strlen($content) < 6) {
				$err_content = "Nội dung bình luận quá ngắn";
			}


			// kiểm tra và hiện validation
			if ($err_checkout != "" || $err_title != "" || $err_content != "") {
				header(
					'location: ' . BASE_URL . '/detail?id=' . $product_id
						. '&err_checkout=' . $err_checkout
						. '&err_title=' . $err_title
						. '&err_content=' . $err_content
				);
				die;
			}
		}

		// dd($user_id);	
		// dd($rating);
		$data = compact('title', 'rating', 'content', 'product_id', 'user_id', 'status');
		$model = new Comment();
		$model->insert($data);
		header('location: ' . BASE_URL . 'detail?id=' . $product_id);
	}
	public function contact()
	{
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		include_once './app/views/client/home/contact.php';
	}
	public function postContact()
	{
		$name = isset($_POST['name']) == true ? $_POST['name'] : null;
		$phone_number = isset($_POST['phone_number']) == true ? $_POST['phone_number'] : null;
		$email = isset($_POST['email']) == true ? $_POST['email'] : null;
		$title = isset($_POST['title']) == true ? $_POST['title'] : null;
		$content = isset($_POST['content']) == true ? $_POST['content'] : null;
		// dd($content);
		if (isset($_SERVER['PHP_SELF'])) {
			// pass
			$err_name = "";
			if ($name == "" || strlen($name) < 2) {
				$err_name = "Hãy nhập tên của bạn";
			}
			$err_title = "";
			if ($title == "" || strlen($title) < 2) {
				$err_title = "Hãy nhập tiêu đề";
			}
			$err_content = "";
			if ($content == "" || strlen($content) < 2) {
				$err_content = "Hãy nhập nội dung";
			}
			$err_email = "";
			if ($email == "") {
				$err_email = "Vui lòng nhập địa chỉ Email";
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$err_email = "Email nhập chưa đúng";
			}
			$err_phone_number = "";
			$pattern = '/[0-9]/';
			if ($phone_number == "") {
				$err_phone_number = "Vui lòng nhập số điện thoại";
			} elseif (!preg_match($pattern, $phone_number)) {
				$err_phone_number = "Số điện thoại là số và không có các ký tự ',' hoặc '.'";
			} elseif (strlen($phone_number) != 10) {
				$err_phone_number = "Số điện thoại hiện tại ở Việt Nam chỉ có 10 số";
			}



			// kiểm tra và hiện validation
			if ($err_name != "" || $err_email != "" || $err_title != "" || $err_content != "" || $err_phone_number != "") {
				header(
					'location: ' . BASE_URL . 'contact?'
						. 'err_name=' . $err_name
						. '&err_email=' . $err_email
						. '&err_title=' . $err_title
						. '&err_content=' . $err_content
						. '&err_phone_number=' . $err_phone_number
				);
				die;
			}
		}
		$data = compact('name', 'email', 'title', 'content', 'phone_number');
		$model = new Contact();
		$model->insert($data);
		$success = "Gửi liên hệ thành công";
		$message = '<div style="width: 600px; margin: 0 auto; padding: 0 auto;">';
		$message .= '<div style="border: 1px dotted #007bff; padding:10px">';
		$message .= 'Cảm ơn các bạn đã tin tưởng Mego !!';
		$message .= '</div>';
		$message .= "<div><h2>Chúng tôi sẽ liện hệ với bạn $name sớm nhất</h2>";
		$message .= "---------------------------------------------------------------- <br>";
		$message .= "Chúng tôi sẽ liện hệ với bạn qua số điện thoại $phone_number và email $email <br>";
		$message .= "Nội dung bạn muốn liên hệ chúng tôi: <br>";
		$message .= "<h4>$title</h4> <br> <p>$content</p>";

		$mail = new PHPMailer(true);
		try {
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->CharSet = 'UTF-8';
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username = 'd3tmobilebk@gmail.com';
			$mail->Password = 'd3t123456789';
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;
			$mail->setFrom('phuoctrank51a6@gmail.com', 'Mego');
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$emails = explode(",", $email);
			foreach ($emails as $e) {
				$mail->addAddress($e);
			}
			$mail->isHTML(true);
			$mail->Subject = "Mego";
			$mail->Body    = $message;
			$mail->send();
			echo 'Message has been sent';
			header('location: ' . BASE_URL . 'contact'
				. '?success=' . $success);
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
	public function addWishlist()
	{
		$id = isset($_GET['id']) == true ? $_GET['id'] : null;

		$car = Car::where(['id', '=', $id])->first();
		// dd($car->feature_image);
		if ($car == null) {
			header('location: ' . BASE_URL);
			die;
		}
		$item = [
			'id' => $car->id,
			'name' => $car->name,
			'image' => $car->feature_image,
			'price' => $car->price,
			'location_id' => $car->location_id,
			'quantity' => 1
		];

		if (!isset($_SESSION[CART]) || count($_SESSION[CART]) == 0) {
			$_SESSION[CART][] = $item;
		} else {
			$cart = $_SESSION[CART];
			$existed = false;

			for ($i = 0; $i < count($cart); $i++) {
				if ($cart[$i]['id'] == $car->id) {
					$existed = true;
					$cart[$i]['quantity'] += 1;
					break;
				}
			}

			if ($existed == false) {
				$cart[] = $item;
			}

			$_SESSION[CART] = $cart;
		}
		// dd($_SESSION[CART]);
		header('location: ' . BASE_URL);
		die;
	}
	public function wishlist()
	{
		// SHOW DANH SÁCH MENU
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();

		$carts = isset($_SESSION[CART]) == true ? $_SESSION[CART] : [];
		// dd($carts);
		if (count($carts) <= 0) {
			header('location: ' . BASE_URL);
			die;
		}
		include_once './app/views/client/home/wishlist.php';
	}
	public function delItemWishlist()
	{
		$carId = isset($_GET['id']) == true ? $_GET['id'] : null;
		$cart = isset($_SESSION[CART]) == true ? $_SESSION[CART] : [];
		$index = false;
		for ($i = 0; $i < count($cart); $i++) {
			if ($cart[$i]['id'] == $carId) {
				$index = $i;
				break;
			}
		}
		if ($index !== false) {
			array_splice($cart, $index, 1);
		}
		$_SESSION[CART] = $cart;
		if (count($cart) == 0) {
			header('location: ' . BASE_URL);
			die;
		} else {
			header('location: ' . BASE_URL . 'wishlist');
			die;
		}
	}


	public function history()
	{
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		$id = $_SESSION['AUTH']['id'];
		// dd($id);
		$user = User::where(['id', '=', $id])->first();
		$cars = OrderDetail::rawQuery('SELECT *
																FROM order_detail
																INNER JOIN cars ON order_detail.car_id = cars.id
																INNER JOIN orders ON order_detail.order_id = orders.id
																WHERE orders.buyer_id = ' . $id)->get();
		// dd($cars);
		include_once './app/views/client/home/history.php';
	}



	public function mailForm()
	{
		$menus = Category::where(['show_menu', '=', 1])->get();
		include_once './app/views/client/home/mail-form.php';
	}
	public function sendMail()
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$content = $_POST['content'];
		$err_mail = "Gửi không thành công";

		if (isset($_POST["submit"])) {
			// validate tên
			$err_name = "";
			if ($name == "") {
				$err_name = "Vui lòng nhập tên";
			}
			// validate email
			$err_email = "";
			if ($email == "") {
				$err_email = "Vui lòng nhập email";
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$err_email = "Email nhập chưa đúng";
			}
			// validate tiêu đề
			$err_subject = "";
			if ($subject == "") {
				$err_subject = "Vui lòng nhập tiêu đề nội dung";
			}
			// validate nội dung
			$err_content = "";
			if ($content == "") {
				$err_content = "Vui lòng nhập nội dung";
			}

			// kiểm tra và hiện validate
			if ($err_email != "" || $err_subject != "" || $err_content != "" || $err_name != "") {
				header(
					'location: ' . BASE_URL . 'contact?'
						. 'err_email=' . $err_email
						. '&err_subject=' . $err_subject
						. '&err_content=' . $err_content
						. '&err_name=' . $err_name
				);
				die;
			}
		}
		// dd($content);
		$mail = new PHPMailer(true);
		try {
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->CharSet = 'UTF-8';
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username = 'noiconsong@gmail.com';
			$mail->Password = 'cuong16051996';
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;

			$mail->setFrom('vuduycuong996@gmail.com', 'Cuong Poly');

			$mail->addAddress($email);
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body    = $content;
			$mail->send();
			header('location: ' . BASE_URL . 'contact');
			die;
		} catch (Exception $e) {
			header('location: ' . BASE_URL . 'contact?' . 'err_mail=' . $err_mail);
			die;
		}
	}
}
