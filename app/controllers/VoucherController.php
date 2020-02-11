<?php 
namespace App\Controllers;


use App\Models\Voucher;

class VoucherController
{
	
	// list
	public function listVoucher(){	
		$vouchers = Voucher::all();
		
		include_once './app/views/admin/vouchers/list.php';
	}
	// thêm mới
	public function addVoucher(){
		include_once './app/views/admin/vouchers/add.php';
	}
	public function saveAddVoucher(){
		$code = isset($_POST['code']) == true ? $_POST['code'] : "";
		$start_time = isset($_POST['start_time']) == true ? $_POST['start_time'] : "";
		$end_time = isset($_POST['end_time']) == true ? $_POST['end_time'] : "";
		$discount_price = isset($_POST['discount_price']) == true ? $_POST['discount_price'] : "";
		$status = isset($_POST['status']) == true ? $_POST['status'] : "";

		// chuyển đổi định dạng ngày
		$start_time = date_create("$start_time");
		$start_time = date_format($start_time,"Y-m-d" );
		// 
		$end_time = date_create("$end_time");
		$end_time = date_format($end_time, "Y-m-d");

		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$created_at = date('Y-m-d');

		if (isset($_SERVER['PHP_SELF'])){
			// mã giảm giá
			$err_code = "";
			if($code == ""){
				$err_code = "Vui lòng nhập mã voucher giảm giá";
			} else{
				$codeVoucher = Voucher::where(['code', '=', $code])->get();
				if($codeVoucher){
					$err_code = "Mã đã tồn tại";
				}
            }
			// thời gian bắt đầu
			$err_start_time = "";
			if($start_time == "" || $start_time >= $created_at){
				$err_start_time = "Vui lòng nhập ngày và ngày trước hiện tại";
			}
			// thời gian kết thúc
			$err_end_time = "";
			if($end_time == "" || $end_time >= $created_at){
				$err_end_time = "Vui lòng nhập ngày và ngày trước hiện tại";
			}
			// số tiền giảm giá
			$err_discount_price = "";
			$pattern = '/[0-9]/';
			if ($discount_price == "") {
				$err_discount_price = "Chưa nhập số tiền giảm giá";
			} elseif (!preg_match($pattern, $_POST['discount_price']) || $_POST['discount_price'] < 1) {
				$err_discount_price = "Vui lòng không để trống và nhập số dương";
			}
		// kiểm tra và hiện validation
		if($err_code != "" || $err_start_time != "" || $err_end_time != "" || $err_discount_price != "" ){
			header(
				'location: ' . ADMIN_URL . '/voucher/add?'
					. 'err_code=' . $err_code
					. '&err_start_time=' . $err_start_time
					. '&err_end_time=' . $err_end_time
					. '&err_discount_price=' . $err_discount_price
			);
			die;
		}
		}


		$data = compact('code', 'start_time', 'end_time', 'discount_price', 'status', 'created_at');
		// dd($data);
		$model = new Voucher();
		$model->insert($data);
		header('location: ' . ADMIN_URL . '/voucher');
		die;
	}
	// chỉnh sửa
	public function editVoucher(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$voucher = Voucher::where(['id', '=', $id])->first();
		if(!$voucher){
            header('location: '. BASE_URL . 'error');
			die;
		}
		include_once './app/views/admin/vouchers/edit.php';
	}
	public function saveEditVoucher(){
		$id = isset($_POST['id']) == true ? $_POST['id'] : "";
		$code = isset($_POST['code']) == true ? $_POST['code'] : "";
		$start_time = isset($_POST['start_time']) == true ? $_POST['start_time'] : "";
		$end_time = isset($_POST['end_time']) == true ? $_POST['end_time'] : "";
		$discount_price = isset($_POST['discount_price']) == true ? $_POST['discount_price'] : "";
		// $used_count = isset($_POST['used_count']) == true ? $_POST['used_count'] : "";
		$status = isset($_POST['status']) == true ? $_POST['status'] : "";

		// chuyển đổi định dạng ngày
		$start_time = date_create("$start_time");
		$start_time = date_format($start_time,"Y-m-d" );
		// 
		$end_time = date_create("$end_time");
		$end_time = date_format($end_time, "Y-m-d");

		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$created_at = date('Y-m-d');

		if (isset($_SERVER['PHP_SELF'])){
			$voucher = Voucher::where(['id', '=', $id])->first();
			// mã giảm giá
			$err_code = "";
			if($code == ""){
				$err_code = "Vui lòng nhập mã voucher giảm giá";
			} elseif ($code != $voucher->code){
				$codeVoucher = Voucher::where(['code', '=', $code])->get();
				if($codeVoucher){
					$err_code = "Mã đã tồn tại";
				}
			}
			// thời gian bắt đầu
			$err_start_time = "";
			if($start_time == "" ){
				$err_start_time = "Vui lòng nhập ngày và ngày trước hiện tại";
			}
			// thời gian kết thúc
			$err_end_time = "";
			if($end_time == "" ){
				$err_end_time = "Vui lòng nhập ngày và ngày trước hiện tại";
			}
			// số tiền giảm giá
			$err_discount_price = "";
			$pattern = '/[0-9]/';
			if($discount_price == ""){
				$err_discount_price = "Vui lòng nhập số tiền giảm giá";
			} elseif(!preg_match($pattern, $discount_price) || $discount_price < 1){
				$err_discount_price = "Vui lòng không để trống và nhập số tiền dương";
			}
		// kiểm tra và hiện validation
		if($err_code != "" || $err_start_time != "" || $err_end_time != "" || $err_discount_price != ""){
			header(
				'location: ' . ADMIN_URL . '/voucher/edit?id=' . $id
					. '&err_code=' . $err_code
					. '&err_start_time=' . $err_start_time
					. '&err_end_time=' . $err_end_time
					. '&err_discount_price=' . $err_discount_price
			);
			die;
		}
		}

		$data = compact('code', 'start_time', 'end_time', 'discount_price', 'status');
		// dd($data);
		$model = new Voucher();
		$model->id = $id;
		$model->update($data);
		header('Location: ../voucher');
		
	}

	public function delVoucher(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$voucher = Voucher::destroy($id);
		header('Location: ../voucher');
	}
	
}
