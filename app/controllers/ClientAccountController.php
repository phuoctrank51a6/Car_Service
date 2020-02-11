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

class ClientAccountController
{

  public function login()
  {
    $maker = Maker::all();
    $loca = Location::where(['show_location', '=', '1'])->get();
    $cate = Category::all();
    include_once './app/views/login.php';
  }
  public function postLogin()
  {
    $email = isset($_POST['email']) == true ? $_POST['email'] : "";
    $password = isset($_POST['password']) == true ? $_POST['password'] : "";
    $model = User::where(['email', '=', $email])->first();
    // dd($model);

    $user = $model->email;
    $pass_sql = $model->password;
    // dd($pass_sql);

    if (isset($_SERVER['PHP_SELF'])) {
      $err_email = "";
      if ($email == "") {
        $err_email = "Vui lòng nhập địa chỉ Email";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_email = "Email nhập chưa đúng";
      } elseif ($model == null) {
        $err_email = "Địa chỉ Email chưa đúng";
      }
      // pass
      $err_password = "";
      if ($password == "" || strlen($password) < 6) {
        $err_password = "Nhập mật khẩu ít nhất 6 kí tự";
      } elseif (!password_verify($password, $pass_sql)) {
        $err_password = "Mật khẩu chưa chính xác";
      }

      // kiểm tra và hiện validation
      if ($err_email != "" || $err_password != "") {
        header(
          'location: ' . BASE_URL . '/login?'
            . 'err_email=' . $err_email
            . '&err_password=' . $err_password
        );
        die;
      }
    }
    // dd($model);
    if (password_verify($password, $pass_sql)) {
      $_SESSION['AUTH'] = [
        'name' => $model->name,
        'email' => $model->email,
        'avatar' => $model->avatar,
        'id' => $model->id,
        'role_id' => $model->role_id
      ];
      // dd($_SESSION['AUTH']);
      header("Location: ./");
    } else {
      echo "thất bại";
    }
  }
  public function forgotPassword()
  {
    include_once './app/views/client/home/forgotPassword.php';
  }
  public function postForgotPassword()
  {
    $email = isset($_POST['email']) == true ? $_POST['email'] : "";
    // dd($email);
    $user = User::where(['email', '=', $email])->first();
    // dd($user);
    if (isset($_SERVER['PHP_SELF'])) {

      $err_email = "";
      if ($email == "") {
        $err_email = "Vui lòng nhập địa chỉ Email";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_email = "Email nhập chưa đúng";
      } elseif (!$user) {
        $err_email = "Email chưa được đăng ký";
      }

      // kiểm tra và hiện validation
      if ($err_email != "") {
        header(
          'location: ' . BASE_URL . '/forgot-password?'
            . 'err_email=' . $err_email
        );
        die;
      } else {

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
        $reset_expired_time = date("Y-m-d H:i:s", $expFormat);
        $token =  md5($reset_expired_time);
        $addToken = substr(md5(uniqid(rand(), 1)), 3, 10);
        // dd($addToken);
        $token = $token . $addToken;

        $data['token'] = $token;
        $data['reset_expired_time'] = $reset_expired_time;
        $model = new User();
        $model->id = $user->id;
        $model->update($data);
        // dd($model);
        // 
        $output = '<span>Xin chào </span> ' . $email;
        $output .= '<p>Vui lòng nhấp vào liên kết sau để đặt lại mật khẩu của bạn..</p>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= '<p><a href="http://localhost/project/project_one/admin/reset-password?token=' . $token . '&email=' . $email . '" target="_blank">Click vào đây lấy lại mật khẩu</a></p>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= '<p>Vui lòng nhấp liên kết để lấy lại mật khẩu. Liên kết sẽ hết hạn sau 1 ngày vì lý do bảo mật.</p>';
        $output .= '<p>Cảm ơn bạn luôn đồng hành cùng MeGo,</p>';
        $output .= '<p>MeGo Team</p>';
        // var_dump($email);die;
        $body = $output;
        $subject = "Khôi phục mật khẩu - Mego";
        $email_to = $email;
        $error = "Gửi không thành công";
        // dd($content);
        $mail = new PHPMailer(true);
        try {
          $mail->SMTPDebug = SMTP::DEBUG_SERVER;
          $mail->CharSet = 'UTF-8';
          $mail->isSMTP();
          $mail->Host       = 'smtp.gmail.com';
          $mail->SMTPAuth   = true;
          $mail->Username = 'noiconsong@gmail.com';
          $mail->Password = 'qkxrjoenwrpshmhk';
          $mail->SMTPSecure = 'tls';
          $mail->Port = 587;

          $mail->setFrom('vuduycuong996@gmail.com', 'Mego');

          $mail->addAddress($email_to);
          $mail->isHTML(true);
          $mail->Subject = $subject;
          $mail->Body    = $body;
          $mail->send();
          header('location: ' . BASE_URL . '/forgot-password?err_success=' . "Mego vừa gởi thông tin vào email của bạn. Vui lòng kiểm tra email nhé!");
          die;
        } catch (Exception $e) {
          header('location: ' . BASE_URL . '/forgot-password?' . 'err_email=' . $error);
          die;
        }
      }
    }
  }
  public function resetPassword()
  {
  }
  public function register()
  {
    $maker = Maker::all();
    $loca = Location::where(['show_location', '=', '1'])->get();
    $cate = Category::all();
    include_once './app/views/client/home/register.php';
  }
  public function saveRegister()
  {
    $name = isset($_POST['name']) == true ? $_POST['name'] : "";
    $email = isset($_POST['email']) == true ? $_POST['email'] : "";
    $phone_number = isset($_POST['phone_number']) == true ? $_POST['phone_number'] : "";
    $pass = isset($_POST['password']) == true ? $_POST['password'] : "";
    $rePassword = isset($_POST['rePassword']) == true ? $_POST['rePassword'] : "";
    $password =  password_hash($pass, PASSWORD_DEFAULT);
    $role_id = 3;
    $status = 1;
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    // dd($created_at);
    $avatar = $_FILES['avatar'];
    $filePath = "";

    // dd($filename);


    if (isset($_SERVER['PHP_SELF'])) {
      $err_name = "";
      if ($name == "" || strlen($name) < 2) {
        $err_name = 'Vui lòng điền họ và tên';
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
      // pass
      $err_password = "";
      if ($pass == "" || strlen($pass) < 6) {
        $err_password = "Nhập mật khẩu ít nhất 6 kí tự";
      }
      // dd($rePassword);
      $err_rePassword = "";
      if (strcmp($pass, $rePassword) != 0) {
        $err_rePassword = "mật khẩu nhập không trùng khớp";
      }
      // ảng
      $err_file = "";

      $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
      );
      // pathinfo trả về thông tin về đường dẫn tệp
      $file_extension = pathinfo($avatar["name"], PATHINFO_EXTENSION);

      //  Kiểm tra xem một tập tin hoặc thư mục tồn tại
      if (!file_exists($avatar["tmp_name"])) {
        $err_file = "Vui lòng chọn hình ảnh để tải lên";
      }
      //  Kiểm tra biến tồn tại trong mảng
      else if (!in_array($file_extension, $allowed_image_extension)) {
        $err_file = "Tải lên hình ảnh khác. Chỉ cho phép JPG, PNG và JPEG.";
      }
      // move_uploaded_file Di chuyển tệp đã tải lên đến một vị trí mới
      // upload ảnh
      else {
        if ($avatar['size'] > 0) {
          $filename = $avatar['name'];
          $filename = uniqid() . "-" . $filename;
          move_uploaded_file($avatar['tmp_name'], 'public/assets/img/users/' . $filename);
        }
      }

      // kiểm tra và hiện validation
      if ($err_name != "" || $err_email != "" || $err_phone_number != "" || $err_rePassword != "" || $err_file != "") {
        header(
          'location: ' . BASE_URL . '/register?'
            . 'err_name=' . $err_name
            . '&err_email=' . $err_email
            . '&err_phone_number=' . $err_phone_number
            . '&err_password=' . $err_password
            . '&err_rePassword=' . $err_rePassword
            . '&err_file=' . $err_file
        );
        die;
      }
      $data = compact('name', 'email', 'password', 'role_id', 'phone_number', 'status');
      $data['avatar'] = $filename;
      $data['created_at'] = date_format(date_create(), 'Y-m-d H:i:s');
      // dd($data);
      $model = new User();
      $model->insert($data);
      if (isset($_SERVER['PHP_SELF'])) {
        $err_success = "";
        $err_success = 'Chúc mừng bạn đã đăng ký thành công!';
        // kiểm tra và hiện validation
        header(
          'location: ' . BASE_URL . '/register?'
            . 'err_success=' . $err_success
        );
      }
    }
  }
  public function registerPartner()
  {
    $maker = Maker::all();
    $loca = Location::where(['show_location', '=', '1'])->get();
    $cate = Category::all();
    include_once './app/views/client/home/registerPartner.php';
  }
  public function saveRegisterPartner()
  {
    // dd(1);
    $name = isset($_POST['name']) == true ? $_POST['name'] : "";
    $email = isset($_POST['email']) == true ? $_POST['email'] : "";
    $phone_number = isset($_POST['phone_number']) == true ? $_POST['phone_number'] : "";
    $pass = isset($_POST['password']) == true ? $_POST['password'] : "";
    $rePassword = isset($_POST['rePassword']) == true ? $_POST['rePassword'] : "";
    $password =  password_hash($pass, PASSWORD_DEFAULT);
    $role_id = 2;
    $status = 1;
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    // dd($created_at);
    $avatar = $_FILES['avatar'];
    $filePath = "";

    // dd($filename);


    if (isset($_SERVER['PHP_SELF'])) {
      $err_name = "";
      if ($name == "" || strlen($name) < 2) {
        $err_name = 'Vui lòng điền họ và tên';
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
      // pass
      $err_password = "";
      if ($pass == "" || strlen($pass) < 6) {
        $err_password = "Nhập mật khẩu ít nhất 6 kí tự";
      }

      $err_rePassword = '';
      if (strcmp($pass, $rePassword) != 0) {
        $err_rePassword = 'mật khẩu nhập không trùng khớp';
      }
      // ảng
      $err_file = "";

      $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
      );
      // pathinfo trả về thông tin về đường dẫn tệp
      $file_extension = pathinfo($avatar["name"], PATHINFO_EXTENSION);

      //  Kiểm tra xem một tập tin hoặc thư mục tồn tại
      if (!file_exists($avatar["tmp_name"])) {
        $err_file = "Vui lòng chọn hình ảnh để tải lên";
      }
      //  Kiểm tra biến tồn tại trong mảng
      else if (!in_array($file_extension, $allowed_image_extension)) {
        $err_file = "Tải lên hình ảnh khác. Chỉ cho phép JPG, PNG và JPEG.";
      }
      // move_uploaded_file Di chuyển tệp đã tải lên đến một vị trí mới
      // upload ảnh
      else {
        if ($avatar['size'] > 0) {
          $filename = $avatar['name'];
          $filename = uniqid() . "-" . $filename;
          move_uploaded_file($avatar['tmp_name'], 'public/assets/img/users/' . $filename);
        }
      }

      // kiểm tra và hiện validation
      if ($err_name != "" || $err_email != "" || $err_phone_number != "" || $err_rePassword != "" || $err_file != "") {
        header(
          'location: ' . BASE_URL . '/register-partner?'
            . 'err_name=' . $err_name
            . '&err_email=' . $err_email
            . '&err_phone_number=' . $err_phone_number
            . '&err_password=' . $err_password
            . '&err_rePassword=' . $err_rePassword
            . '&err_file=' . $err_file
        );
        die;
      }
      $data = compact('name', 'email', 'password', 'role_id', 'phone_number', 'status');
      $data['avatar'] = $filename;
      $data['created_at'] = date_format(date_create(), 'Y-m-d H:i:s');
      // dd($data);
      $model = new User();
      $model->insert($data);
      if (isset($_SERVER['PHP_SELF'])) {
        $err_success = 'Chúc mừng bạn đã chính trợ thành 1 thành viên của Mego!';
        // kiểm tra và hiện validation
        header(
          'location: ' . BASE_URL . '/register-partner?'
            . 'err_success=' . $err_success
        );
        die;
      }
    }
  }
  // logout
  public function logout()
  {
    // $_SESSION['AUTH'] = null;
    if (isset($_SESSION['AUTH'])) {
      // dd($_SESSION['AUTH']);
      unset($_SESSION['AUTH']); // xóa session login
      include_once './app/views/login.php';
      // header('location: ' . BASE_URL . 'login');
    }
  }
  public function account()
  {
    // SHOW DANH SÁCH MENU
    $maker = Maker::all();
    $loca = Location::where(['show_location', '=', '1'])->get();
    $cate = Category::all();
    $id = $_SESSION['AUTH']['id'];
    // dd($id);
    $user = User::where(['id', '=', $id])->first();
    // dd($user->name);
    // dd($account['id']);
    include_once './app/views/client/home/account.php';
  }
  public function saveAccount()
  {
    $id = isset($_POST['id']) == true ? $_POST['id'] : "";
    $name = isset($_POST['name']) == true ? $_POST['name'] : "";
    $email = isset($_POST['email']) == true ? $_POST['email'] : "";
    $phone_number = isset($_POST['phone_number']) == true ? $_POST['phone_number'] : "";
    $avatar = isset($_FILES['avatar']) == true ? $_FILES['avatar'] : "";
    // dd($id);
    if (isset($_SERVER['PHP_SELF'])) {
      // pass
      $err_name = "";
      if ($name == "" || strlen($name) < 2) {
        $err_name = "Vui lòng cập nhật tên ít nhất 2 kí tự";
      }


      $err_email = "";
      if ($email == "") {
        $err_email = "Vui lòng nhập địa chỉ Email";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_email = "Cập nhật Email nhập chưa đúng";
      }

      // ảnh
      $err_file = "";

      $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
      );

      // pathinfo trả về thông tin về đường dẫn tệp
      $file_extension = pathinfo($avatar["name"], PATHINFO_EXTENSION);

      //  Kiểm tra xem một tập tin hoặc thư mục tồn tại
      if (!file_exists($avatar["tmp_name"])) {
        $err_file = "Vui lòng chọn hình ảnh để tải lên";
      }
      //  Kiểm tra biến tồn tại trong mảng
      else if (!in_array($file_extension, $allowed_image_extension)) {
        $err_file = "Tải lên hình ảnh khác. Chỉ cho phép JPG, PNG và JPEG.";
      }
      // move_uploaded_file Di chuyển tệp đã tải lên đến một vị trí mới
      // upload ảnh
      else {
        if ($avatar['size'] > 0) {
          $filename = $avatar['name'];
          $filename = uniqid() . "-" . $filename;
          move_uploaded_file($avatar['tmp_name'], 'public/assets/img/users/' . $filename);
        }
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
      if ($err_name != "" || $err_email != "" || $err_phone_number != "" || $err_file != "") {
        header(
          'location: ' . BASE_URL . '/account?'
            . 'err_name=' . $err_name
            . '&err_email=' . $err_email
            . '&err_phone_number=' . $err_phone_number
            . '&err_file=' . $err_file
        );
        die;
      }
    }
    $data = compact('name', 'email', 'phone_number');
    $data['avatar'] = $filename;
    $model = new User();
    $model = User::where(['id', '=', $id])->first();
    // dd($model);
    $model->update($data);
    header("Location: " . BASE_URL . 'account');
  }
  public function changePassword()
  {
    $maker = Maker::all();
    $loca = Location::where(['show_location', '=', '1'])->get();
    $cate = Category::all();
    $id = $_SESSION['AUTH']['id'];
    // dd($id);
    $user = User::where(['id', '=', $id])->first();
    include_once './app/views/client/home/changePassword.php';
  }
  public function saveChangePassword()
  {
    $rePassword = $_POST['rePassword'];
    $passwordNow = isset($_POST['passwordNow']) == true ? $_POST['passwordNow'] : null;
    $newPassword = isset($_POST['newPassword']) == true ? $_POST['newPassword'] : null;
    $password = password_hash($newPassword, PASSWORD_DEFAULT);
    // dd($password);
    $id = $_SESSION['AUTH']['id'];
    // dd($passwordNow);
    $user = User::where(['id', '=', $id])->first();

    $pass_sql = $user->password;
    // dd($passwordNow);
    if (isset($_SERVER['PHP_SELF'])) {
      // pass
      $err_password_now = "";
      if ($passwordNow == "" || strlen($passwordNow) < 6) {
        $err_password_now = "Nhập mật khẩu ít nhất 6 kí tự";
      } elseif (!password_verify($passwordNow, $pass_sql)) {
        $err_password_now = "Mật khẩu không chính xác";
      }

      $err_password_new = "";
      if ($newPassword == "" || strlen($newPassword) < 6) {
        $err_password_new = "Nhập mật khẩu mới ít nhất 6 kí tự";
      } elseif (strcmp($newPassword, $passwordNow) == 0) {
        $err_password_new = "Mật khẩu mới không được giống mật khẩu cũ";
      }

      $err_rePassword = "";
      if (strcmp($newPassword, $rePassword) != 0) {
        $err_rePassword = "Nhập lại mật khẩu không trùng khớp";
      }


      // kiểm tra và hiện validation
      if ($err_password_now != "" || $err_password_new != "" || $err_rePassword != "") {
        header(
          'location: ' . BASE_URL . '/change-password?'
            . 'err_password_now=' . $err_password_now
            . '&err_password_new=' . $err_password_new
            . '&err_rePassword=' . $err_rePassword
        );
        die;
      }
    }
    $success =  "Đổi mật khẩu thành công";
    if (password_verify($passwordNow, $pass_sql)) {
      // echo 'thanh cong';
      $data = compact('password');
      // dd($data);
      $model = new User();
      $model = User::where(['id', '=', $id])->first();
      // dd($model);
      $model->update($data);
      header("Location: " . BASE_URL . 'change-password?success='. $success);
      // dd($model);
    }
  }
}
