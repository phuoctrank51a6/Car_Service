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

class ClientOrderController
{
  public function checkout()
  {
    // dd(1);
    // SHOW DANH SÁCH MENU
    $id = isset($_GET['id']) == true ? $_GET['id'] : "";
    $customer_address = isset($_GET['customer_address']) == true ? $_GET['customer_address'] : "";
    $date_start = isset($_GET['date_start']) == true ? $_GET['date_start'] : "";
    $date_end = isset($_GET['date_end']) == true ? $_GET['date_end'] : "";
    $voucher = isset($_GET['voucher']) == true ? $_GET['voucher'] : "";

    $maker = Maker::all();
    $loca = Location::where(['show_location', '=', '1'])->get();
    $cate = Category::all();
    $voucher_code = Voucher::where(['code', '=', $voucher])->first();
    // dd($voucher_code);
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $now = date('d/m/Y');

    $car = Car::where(['id', '=', $id])->first();
    // dd($id);
    // dd($car);
    // tính ngày
    $minus = abs(strtotime($date_end) - strtotime($date_start));

    $year = floor($minus / (365 * 60 * 60 * 24));
    $month = floor(($minus - $year * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $day = floor(($minus + $year * 365 * 60 * 60 * 24 + $month * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    // dd($day);

    if (isset($_SERVER['PHP_SELF'])) {
      $err_check = "";
      if ($_SESSION['AUTH'] == null) {
        $err_check = "Đăng nhập để có thể đặt xe được bạn nhé!";
      }
      // pass
      date_default_timezone_set('Asia/Ho_Chi_Minh');
      $date = date('Y-m-d');
      // dd($date_start);
      $err_date_start = "";
      if ($date_start == "" || $date_start<= $date) {
        $err_date_start = "Hãy chon ngày nhận xe và sau ngày hiện tại";
      }
      $err_date_end = "";
      if ($date_end == "" || $date_start >= $date_end) {
        $err_date_end = "Hãy chon ngày trả xe và sau ngày đặt xe";
      }
      // $err_voucher = "";
      // if ($day < 5) {
      // 	$err_voucher = "Mã giảm giá chỉ áp dụng khi bạn thuê xe trên 4 ngày";
      // }elseif ($voucher_code ==null) {
      // 	$err_voucher = "Mã giảm giá không tồn tại";
      // }


      // kiểm tra và hiện validation
      if ($err_date_start != "" || $err_date_end != "" || $err_check != "") {
        header(
          'location: ' . BASE_URL . 'detail?id=' . $id
            . '&err_date_start=' . $err_date_start
            . '&err_date_end=' . $err_date_end
            . '&err_check=' . $err_check
          // . '&err_voucher=' . $err_voucher
        );
        die;
      }
    }

    include_once './app/views/client/home/checkout.php';
  }
  public function postCheckout()
  {
    $customer_name = isset($_POST['customer_name']) == true ? $_POST['customer_name'] : "";
    $customer_email = isset($_POST['customer_email']) == true ? $_POST['customer_email'] : "";
    $customer_phone_number = isset($_POST['customer_phone_number']) == true ? $_POST['customer_phone_number'] : "";
    $customer_address = isset($_POST['customer_address']) == true ? $_POST['customer_address'] : "";
    $total_price = isset($_POST['total_price']) == true ? $_POST['total_price'] : "";
    $buyer_id = isset($_POST['buyer_id']) == true ? $_POST['buyer_id'] : "";
    $message = isset($_POST['message']) == true ? $_POST['message'] : "";
    $payment_method = isset($_POST['payment_method']) == true ? $_POST['payment_method'] : "";
    $date_start = isset($_POST['date_start']) == true ? $_POST['date_start'] : "";
    $date_end = isset($_POST['date_end']) == true ? $_POST['date_end'] : "";
    $car_id = isset($_POST['car_id']) == true ? $_POST['car_id'] : "";
    $unit_price = isset($_POST['unit_price']) == true ? $_POST['unit_price'] : "";
    $count_day = isset($_POST['count_day']) == true ? $_POST['count_day'] : "";
    $voucher = isset($_POST['voucher']) == true ? $_POST['voucher'] : "";

    $voucher_code = Voucher::where(['code', '=', $voucher])->first();
    $discount = $voucher_code->discount_price;
    $voucher_id = $voucher_code->id;
    // dd($voucher_id);
    $status = 1;
    if (isset($_SERVER['PHP_SELF'])) {
      $err_customer_name = "";
      if ($customer_name == "" || strlen($customer_name) < 2) {
        $err_customer_name = 'Vui lòng điền họ và tên';
      }

      // dd($customer_name);
      $err_customer_phone_number = "";
      $pattern = '/[0-9]/';
      if ($customer_phone_number == "") {
        $err_customer_phone_number = "Vui lòng nhập số điện thoại";
      } elseif (!preg_match($pattern, $customer_phone_number)) {
        $err_customer_phone_number = "Số điện thoại là số và không có các ký tự ',' hoặc '.'";
      } elseif (strlen($customer_phone_number) != 10) {
        $err_customer_phone_number = "Số điện thoại hiện tại ở Việt Nam chỉ có 10 số";
      }


      $err_customer_address = "";
      if ($customer_address == "" || strlen($customer_address) < 6) {
        $err_customer_address = 'Địa chỉ của bạn quá ngắn';
      }

      $err_customer_email = "";
      if ($customer_email == "") {
        $err_customer_email = "Vui lòng nhập địa chỉ Email";
      } elseif (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
        $err_customer_email = "Cập nhật Email nhập chưa đúng";
      }

      $err_message = "";
      if ($message == "" || strlen($message) < 2) {
        $err_message = 'Lời nhắn quá ngắn';
      }

      // kiểm tra và hiện validation
      if ($err_customer_name != "" || $err_customer_phone_number != "" || $err_customer_address != "" || $err_message != "" || $err_customer_email != "") {
        header(
          'location: ' . BASE_URL . '/checkout?id=28&customer_address=&date_start=' . $date_start . '&date_end=' . $date_end . '&voucher=' . $voucher
            . '&err_customer_name=' . $err_customer_name
            . '&err_customer_phone_number=' . $err_customer_phone_number
            . '&err_customer_address=' . $err_customer_address
            . '&err_message=' . $err_message
            . '&err_customer_email=' . $err_customer_email
        );
        die;
      }
    }
    $success = "Đặt hàng thành công";
    // dd($voucher);
    $data = compact('customer_name', 'customer_email', 'customer_phone_number', 'customer_address', 'total_price', 'status', 'buyer_id', 'message', 'payment_method', 'date_start', 'date_end', 'discount', 'voucher_id');
    // dd($data);
    $model = new Order();
    $model->insert($data);
    // dd($model);
    $newOrder = Order::sttOrderBy('id', false)->limit(1)->first();
    // dd($newOrder);
    $order_id = $newOrder->id;
    // dd($order_id);
    $dataDetail = compact('order_id', 'car_id', 'unit_price');
    $modelDetail = new OrderDetail();
    $modelDetail->insert($dataDetail);
    $orderDetail = OrderDetail::where(['order_id', '=', $order_id])->first();
    // dd($orderDetail->car_id);
    // dd($dataDetail);
    $output = '<div style="width: 600px; margin: 0 auto; padding: 0 auto;">';
    $output .= '<div style="border: 1px dotted #007bff; padding:10px">';
    $output .= 'Cảm ơn các bạn đã tin tưởng Mego !!';
    $output .= '</div>';
    $output .= '<div><h2>Cảm ơn quý khách đã đặt hàng</h2>';
    $output .= '<p>Mego thông báo đơn hàng của quý khách đã được tiếp nhận và đang trong quá trình xử lý.</p></div>';
    $output .= '<div><h4>Thông tin đơn hàng #';
    $output .= $order_id;
    $output .= '</h4><hr>';
    $output .= '<table style="width: 100%;">';
    $output .= '<tr><th style="width: 50%; text-align: left;">Thông tin thanh toán</th><th style="width: 50%; text-align: left;">Địa chỉ giao hàng</th></tr>';
    $output .= '<tr><td>';
    $output .= $customer_name;
    $output .= '<br>';
    $output .= $customer_email;
    $output .= '<br>';
    $output .= $customer_phone_number;
    $output .= '</td><td>';
    $output .= $customer_address;
    $output .= '<br>';
    $output .= $customer_phone_number;
    $output .= '</td></tr></table>';
    $output .= '<p>Phương thức thanh toán: Thanh toán khi nhận xe';
    $output .= '</p></div>';

    $output .= '<h4>Chi tiết đơn hàng</h4><hr>';
    $output .= '<table style="width: 100%;"><tr><th style="text-align: left;">Tên xe</th><th style="text-align: left;">Đơn giá</th><th style="text-align: left;" >Số ngày</th><th style="text-align: left;" >Thành tiền</th></tr><tr>';
    $output .= '<td>';
    $output .= $orderDetail->getNameCar();
    $output .= '</td><td>';
    $output .= $unit_price;
    $output .= '</td><td>';
    $output .= $count_day;
    $output .= '</td><td>';
    $output .= $total_price;
    $output .= '</td></tr><tr>';
    $output .= '<td colspan="3"><b>Tổng giá trị đơn hàng</b></td><td>';
    $output .= $total_price;
    $output .= '</td></tr></table>';

    $output .= '<div><h4>Một lần nữa cảm ơn quý khách</h4></div>';
    $output .= '</div>';
    $body = $output;
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
      $emails = explode(",", $customer_email);
      foreach ($emails as $e) {
        $mail->addAddress($e);
      }
      $mail->isHTML(true);
      $mail->Subject = "Mego";
      $mail->Body    = $message;
      $mail->send();
      header('location: ' . BASE_URL . 'checkout?id=' . $car_id
        . '&customer_address=' . $customer_address
        . '&date_start=' . $date_start
        . '&date_end=' . $date_end
        . '&voucher=' . $voucher);
    } catch (Exception $e) {
      header('location: ' . BASE_URL);
      die;
    }
  }

}