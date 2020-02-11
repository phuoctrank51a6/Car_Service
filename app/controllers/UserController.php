<?php 
namespace App\Controllers;


use App\Models\User;
use App\Models\Role;

class UserController
{
	
	// list
	public function listUser(){	
		$users = User::all();
		
		include_once './app/views/admin/users/list.php';
	}
	// thêm mới
	public function addUser(){
		$roles = Role::all();
		include_once './app/views/admin/users/add.php';
	}
	public function saveAddUser(){
		$name = isset($_POST['name']) == true ? $_POST['name']: "";
		$email = isset($_POST['email']) == true ? $_POST['email']: "";
		$password = isset($_POST['password']) == true ? $_POST['password']: "";
		$role_id = isset($_POST['role_id']) == true ? $_POST['role_id']: "";
		$status = isset($_POST['status']) == true ? $_POST['status']: "";

		$avatar = isset($_FILES['avatar']) == true ? $_FILES['avatar']: "";
		
		if (isset($_SERVER['PHP_SELF'])){
			// tên
			$err_name = "";
			if($name == ""){
				$err_name = "Vui lòng nhập tên";
			} else{
				$nameUser = User::where(['name', '=', $name])->get();
				if($nameUser){
					$err_name = "Tên đã tồn tại";
				}
            }
			// validate email
			$err_email = "";
			if($email == ""){
				$err_email = "Vui lòng nhập email";
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$err_email = "Email nhập chưa đúng";
			}
			// pass
			$err_password = "";
			if($password == "" || strlen($password) < 6 ){
				$err_password = "Nhập mật khẩu ít nhất 6 kí tự";
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
			
		// kiểm tra và hiện validation
		if($err_name != "" || $err_email != "" || $err_password != "" || $err_file != ""){
			header(
				'location: ' . ADMIN_URL . '/account/add'
					. '&err_name=' . $err_name
					. '&err_email=' . $err_email
					. '&err_file=' . $err_file
					. '&err_password=' . $err_password
			);
			die;
		}
		}

		// mã hóa mật khẩu
		$hashpassword = password_hash($password, PASSWORD_DEFAULT);

		$data = compact('name', 'email', 'role_id', 'status');
		$data['password'] = $hashpassword;
		$data['avatar'] = $filename;
		$data['created_at'] = date_format(date_create(), 'Y-m-d H:i:s');
		// var_dump($data);die;
		$model = new User();
		$model->insert($data);

		header('location: ' . ADMIN_URL . '/account');
		
	}
	// sửa
	public function editUser(){

		$roles = Role::all();
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$user = User::where(['id', '=', $id])->first();
		if(!$user){
            header('location: '. BASE_URL . 'error');
			die;
		}
		include_once './app/views/admin/users/edit.php';
	}
	public function saveEditUser(){

		$id = isset($_POST['id']) == true ? $_POST['id']: "";
		$name = isset($_POST['name']) == true ? $_POST['name']: "";
		$email = isset($_POST['email']) == true ? $_POST['email']: "";
		$password = isset($_POST['password']) == true ? $_POST['password']: "";
		$role_id = isset($_POST['role_id']) == true ? $_POST['role_id']: "";
		$status = isset($_POST['status']) == true ? $_POST['status']: "";
		// dd($id);
		$avatar = isset($_FILES['avatar']) == true ? $_FILES['avatar']: "";

		if (isset($_SERVER['PHP_SELF'])){
			$user = User::where(['id', '=', $id])->first();
			// tên
			$err_name = "";
			if($name == ""){
				$err_name = "Vui lòng nhập tên";
			} elseif ($name != $user->name){
				$nameUser = User::where(['name', '=', $name])->get();
				if($nameUser){
					$err_name = "Tên đã tồn tại";
				}
			}
			// validate email
			$err_email = "";
			if($email == ""){
				$err_email = "Vui lòng nhập email";
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$err_email = "Email nhập chưa đúng";
			}
			// pass
			$err_password = "";
			if($password == "" || strlen($password) < 6 ){
				$err_password = "Nhập mật khẩu ít nhất 6 kí tự";
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
			
		// kiểm tra và hiện validation
		if($err_name != "" || $err_email != "" || $err_password != "" || $err_file != ""){
			header(
				'location: ' . ADMIN_URL . '/account/edit?id=' . $id
					. '&err_name=' . $err_name
					. '&err_email=' . $err_email
					. '&err_file=' . $err_file
					. '&err_password=' . $err_password
			);
			die;
		}
		}

		// mã hóa mật khẩu
		$hashpassword = password_hash($password, PASSWORD_DEFAULT);
		$data = compact('name', 'email', 'role_id', 'status');
		$data['password'] = $hashpassword;
		$data['avatar'] = $filename;
		$data['updated_at'] = date_format(date_create(), 'Y-m-d H:i:s');
		// var_dump($data);die;
		$model = new User();
		$model->id = $id;
		$model->update($data);

		header('location: ' . ADMIN_URL . '/account');
	}
	// thay đổi mật khẩu
	public function changePassword(){
		$roles = Role::all();
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$user = User::where(['id', '=', $id])->first();
		if(!$user){
            header('location: '. BASE_URL . 'error');
			die;
		}
		include_once './app/views/admin/users/change.php';
	}
	// 
	public function saveChangePassword(){
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
				$err_password_now = "Nhập lại mật khẩu";
			} elseif (!password_verify($passwordNow, $pass_sql)) {
				$err_password_now = "Mật khẩu không chính xác";
			}

			$err_password_new= "";
			if ($newPassword == "" || strlen($newPassword) < 6) {
				$err_password_new = "Nhập mật khẩu mới ít nhất 6 kí tự";
				}elseif (strcmp($newPassword, $passwordNow) == 0) {
					$err_password_new = "Mật khẩu mới không được giống mật khẩu cũ";
				}

			$err_rePassword = "";
			if (strcmp($newPassword, $rePassword) != 0) {
				$err_rePassword = "Nhập lại mật khẩu không trùng khớp";
			}


			// kiểm tra và hiện validation
			if ($err_password_now != "" || $err_password_new != "" || $err_rePassword != "") {
				header(
					'location: ' . ADMIN_URL . '/account/change-password?id=' .$id
						. '&err_password_now=' . $err_password_now
						. '&err_password_new=' . $err_password_new
						. '&err_rePassword=' . $err_rePassword
				);
				die;
			}
		}
		if (password_verify($passwordNow, $pass_sql)) {
			// echo 'thanh cong';
			$data = compact('password');
			// dd($data);
			$model = new User();
			$model = User::where(['id', '=', $id])->first();
			// dd($model);
			$model->update($data);
			header("Location: " .BASE_URL . 'account');
			// dd($model);
		include_once './app/views/client/home/changePassword.php';
		}else{
			echo 'that bai';
		}
	}
	// xóa

	public function delUser(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$user_id =  $_SESSION['AUTH']['id'];
		$error = "Không thể xóa";
		// var_dump($user_id);die;
		if($id != $user_id && $id != 1){
			$user = User::destroy($id);
			header('location: ' . ADMIN_URL . '/account');die;
		} else{
			header('location: ' . ADMIN_URL . '/account?error=' . $error);die;
		}
		
	}

	public function infomationUser(){
		$user_id = $_SESSION['AUTH']['id'];
	
		$user = User::where(['id', '=', $user_id])->first();
		// var_dump($user);die;
		include_once './app/views/admin/users/info.php';
	}
	
}
