<?php 
namespace App\Controllers;


use App\Models\Order;
use App\Models\OrderDetail;


class OrderController
{
	
	// list
	public function listOrder(){
		// dd(1);
		// $orders = Order::all();
		$status = isset($_GET['status']) == true ? $_GET['status'] : "";
		$date = isset($_GET['date']) == true ? $_GET['date'] : "";
		$date2 = isset($_GET['date2']) == true ? $_GET['date2'] : "";

		if($status != "" && $date != ""){
		$orders = Order::where(['status', '=', $status])->andWhere(['created_date', '>=', $date])->andWhere(['created_date', '<=' , $date2])->get();
		} elseif ($status != "" && $date == "") {
		$orders = Order::where(['status', '=', $status])->get();
		} elseif ($status == "" && $date != "" && $date2 != "") {
		$orders = Order::where(['created_date', '>=', $date])->andWhere(['created_date', '<=' , $date2])->get();
		} else {
		$orders = Order::sttOrderBy('id', false)->get();
		}
		
		include_once './app/views/admin/orders/list.php';
	}
	// Cập nhật
	public function editOrder(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$order = Order::where(['id', '=', $id])->first();
		if(!$order){
			header('location: '. BASE_URL . 'error');
			die;
		}
		if($order != ""){
			$orderDetail = OrderDetail::where(['order_id','=', $order->id])->get();
			// dd($orderDetail);
		}
		include_once './app/views/admin/orders/edit.php';
	}
	public function saveEditOrder(){
		
		
		$id = isset($_POST['id']) == true ? $_POST['id']: "";
		$customer_name = isset($_POST['customer_name']) == true ? $_POST['customer_name']: "";
		$customer_phone_number = isset($_POST['customer_phone_number']) == true ? $_POST['customer_phone_number']: "";
		$customer_email = isset($_POST['customer_email']) == true ? $_POST['customer_email']: "";
		$customer_address = isset($_POST['customer_address']) == true ? $_POST['customer_address']: "";
		$status = isset($_POST['status']) == true ? $_POST['status']: "";
		// dd($id);

		if (isset($_SERVER['PHP_SELF'])){

			$err_name = "";
            if($customer_name == ""){
                $err_name = "Vui lòng nhập họ tên";
            }
            // validate số điện thoại
            $err_phone_number = "";
            $pattern = '/[0-9]/';
            if($customer_phone_number == ""){
                $err_phone_number = "Vui lòng nhập số điện thoại";
            } elseif (!preg_match($pattern,$customer_phone_number) || $customer_phone_number < 1) {
                $err_phone_number = "Vui lòng nhập số điện thoại";
            }
             // validate email
			 $err_email = "";
			 if($customer_email == ""){
				 $err_email = "Vui lòng nhập email";
			 } elseif (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)){
				 $err_email = "Email nhập chưa đúng";
             }
             // validate địa chỉ
             $err_address = "";
             if($customer_address == ""){
                 $err_address = "Vui lòng nhập địa chỉ";
             }
		// kiểm tra và hiện validation
		if($err_name != "" || $err_phone_number != "" || $err_email != "" || $err_address != ""){
			header(
				'location: ' . ADMIN_URL . '/order/edit?id=' . $id
				. '&err_name=' . $err_name
				. '&err_phone_number=' . $err_phone_number
				. '&err_email=' . $err_email
				. '&err_address=' . $err_address
				); 
				die;
		}
		}
		
		$data = compact('customer_name', 'customer_phone_number', 'customer_email', 'customer_address', 'status'  );
		// $data['updated_date'] = date_format(date_create(), 'Y-m-d');
		$model = new Order();
		$model->id = $id;
		// var_dump($model);die;
		$model->update($data);
		
		header('location: ' . ADMIN_URL . '/order' );
		
		}
	
	
}
