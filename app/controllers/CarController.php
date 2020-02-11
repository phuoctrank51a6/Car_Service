<?php 
namespace App\Controllers;


use App\Models\Car;
use App\Models\Category;
use App\Models\Location;
use App\Models\Makers;
use App\Models\Order;
use App\Models\User;

class CarController
{
	
	// list
	public function listCar(){	
		$cate_id = isset($_GET['cate_id']) == true ? $_GET['cate_id'] : "";
		$location_id = isset($_GET['location_id']) == true ? $_GET['location_id'] : "";
		
		$categories = Category::all();
		$locations = Location::all();
		if($cate_id != "" && $location_id != ""){
			$cars = Car::where(['cate_id','=', $cate_id])->andWhere(['location_id', '=', $location_id])->get();
		} elseif($cate_id != "" && $location_id == ""){
			$cars = Car::where(['cate_id', '=', $cate_id])->get();
		} elseif($cate_id == "" && $location_id != ""){
			$cars = Car::where(['location_id', '=', $location_id])->get();
		}
		else{
			$cars = Car::sttOrderBy('id', false)->get();
		}	
		
		include_once './app/views/admin/cars/list.php';
	}
	// add
	public function addCar()
	{
		$categories = Category::all();
		$locations = Location::all();
		$makers = Makers::all();
		$users = User::where(['role_id', '=', 2])->orWhere(['role_id', '=', 1])->get();
		// var_dump($users);die;
		include_once './app/views/admin/cars/add.php';
	}
	public function saveAddCar()
	{
		$name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$cate_id = isset($_POST['cate_id']) == true ? $_POST['cate_id'] : "";
		$location_id = isset($_POST['location_id']) == true ? $_POST['location_id'] : "";
		$maker_id = isset($_POST['maker_id']) == true ? $_POST['maker_id'] : "";
		$user_id = isset($_POST['user_id']) == true ? $_POST['user_id'] : "";
		$price = isset($_POST['price']) == true ? $_POST['price'] : "";
		$detail = isset($_POST['detail']) == true ? $_POST['detail'] : "";

		$image = $_FILES['feature_image'];

		if (isset($_SERVER['PHP_SELF'])){
			// tên
			$err_name = "";
			if($name == ""){
				$err_name = "Vui lòng nhập tên";
			} else{
				$nameCar = Car::where(['name', '=', $name])->get();
				if($nameCar){
					$err_name = "Tên đã tồn tại";
				}
            }
			// validate giá
			$err_price = "";
			$pattern = '/[0-9]/';
			if ($_POST['price'] == "") {
				$err_price = "Chưa nhập đơn giá";
			} elseif (!preg_match($pattern, $_POST['price']) || $_POST['price'] < 1) {
				$err_price = "Vui lòng không để trống và nhập số dương";
			}
			// chi tiết
			$err_detail = "";
			if($detail == ""){
				$err_detail = "Vui lòng nhập chi tiết";
			}
			// ảnh
			$err_file = "";

			$allowed_image_extension = array(
				"png",
				"jpg",
				"jpeg"
			);
		
			// pathinfo trả về thông tin về đường dẫn tệp
			$file_extension = pathinfo($image["name"], PATHINFO_EXTENSION);
		
			//  Kiểm tra xem một tập tin hoặc thư mục tồn tại
			if (!file_exists($image["tmp_name"])) {
				$err_file = "Vui lòng chọn hình ảnh để tải lên";
			}
			//  Kiểm tra biến tồn tại trong mảng
			else if (!in_array($file_extension, $allowed_image_extension)) {
				$err_file = "Tải lên hình ảnh khác. Chỉ cho phép JPG, PNG và JPEG.";
			}
			// move_uploaded_file Di chuyển tệp đã tải lên đến một vị trí mới
			// upload ảnh
			else {
				if ($image['size'] > 0) {
					$filename = $image['name'];
					$filename = uniqid() . "-" . $filename;
					move_uploaded_file($image['tmp_name'], 'public/assets/img/cars/' . $filename);
					// $filePath = "public/images/cars/" . $filename;
				}
			}
			
		// kiểm tra và hiện validation
		if($err_name != "" || $err_price != "" || $err_detail != "" || $err_file != ""){
			header(
				'location: ' . ADMIN_URL . '/car/add'
					. '&err_name=' . $err_name
					. '&err_price=' . $err_price
					. '&err_file=' . $err_file
					. '&err_detail=' . $err_detail
			);
			die;
		}
		}

		// dd($filePath);
		$data = compact('name', 'cate_id', 'location_id', 'maker_id', 'user_id', 'price', 'detail');
		$data['feature_image'] = $filename;
		$model = new Car();
		$model->insert($data);
		header('location: ' . ADMIN_URL . '/car');
		die;
	}
	// edit
	public function editCar()
	{
		$categories = Category::all();
		$locations = Location::all();
		$makers = Makers::all();
		$users = User::where(['role_id', '=', 2])->orWhere(['role_id', '=', 1])->get();
		
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$car = Car::where(['id','=',$id])->first();
		if(!$car){
            header('location: '. BASE_URL . 'error');
			die;
		}
		include_once './app/views/admin/cars/edit.php';
	}

	public function saveEditCar()
	{
		$id = isset($_POST['id']) == true ? $_POST['id'] : "";
		$name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$cate_id = isset($_POST['cate_id']) == true ? $_POST['cate_id'] : "";
		$location_id = isset($_POST['location_id']) == true ? $_POST['location_id'] : "";
		$maker_id = isset($_POST['maker_id']) == true ? $_POST['maker_id'] : "";
		$user_id = isset($_POST['user_id']) == true ? $_POST['user_id'] : "";
		$price = isset($_POST['price']) == true ? $_POST['price'] : "";
		$detail = isset($_POST['detail']) == true ? $_POST['detail'] : "";

		$image = isset($_FILES['feature_image']) == true ? $_FILES['feature_image']: "";

		if (isset($_SERVER['PHP_SELF'])){
			$car = Car::where(['id','=',$id])->first();
			// tên
			$err_name = "";
			if($name == ""){
				$err_name = "Vui lòng nhập tên";
			} elseif ($name != $car->name){
				$nameCar = Car::where(['name', '=', $name])->get();
				if($nameCar){
					$err_name = "Tên đã tồn tại";
				}
			}
			// validate giá
			$err_price = "";
			$pattern = '/[0-9]/';
			if ($_POST['price'] == "") {
				$err_price = "Chưa nhập đơn giá";
			} elseif (!preg_match($pattern, $_POST['price']) || $_POST['price'] < 1) {
				$err_price = "Vui lòng không để trống và nhập số dương";
			}
			// chi tiết
			$err_detail = "";
			if($detail == ""){
				$err_detail = "Vui lòng nhập chi tiết";
			}
			// ảnh
			$err_file = "";

			$allowed_image_extension = array(
				"png",
				"jpg",
				"jpeg"
			);
		
			// pathinfo trả về thông tin về đường dẫn tệp
			$file_extension = pathinfo($image["name"], PATHINFO_EXTENSION);
		
			//  Kiểm tra xem một tập tin hoặc thư mục tồn tại
			if (!file_exists($image["tmp_name"])) {
				$err_file = "Bạn chưa chọn hình ảnh thay thế";
			}
			//  Kiểm tra biến tồn tại trong mảng
			else if (!in_array($file_extension, $allowed_image_extension)) {
				$err_file = "Tải lên hình ảnh khác. Chỉ cho phép JPG, PNG và JPEG.";
			}
			// move_uploaded_file Di chuyển tệp đã tải lên đến một vị trí mới
			// upload ảnh
			else {
				if ($image['size'] > 0) {
					$filename = $image['name'];
					$filename = uniqid() . "-" . $filename;
					move_uploaded_file($image['tmp_name'], 'public/assets/img/cars/' . $filename);
					// $filePath = "public/images/cars/" . $filename;
				}
			}
			
		// kiểm tra và hiện validation
		if($err_name != "" || $err_price != "" || $err_detail != "" || $err_file != ""){
			header(
				'location: ' . ADMIN_URL . '/car/edit?id=' . $id
					. '&err_name=' . $err_name
					. '&err_price=' . $err_price
					. '&err_file=' . $err_file
					. '&err_detail=' . $err_detail
			);
			die;
		}
		}
		// dd($filePath);
		$data = compact('name', 'cate_id', 'location_id', 'maker_id', 'user_id', 'price', 'detail');
		$data['feature_image'] = $filename;
		$model = new Car();
		$model->id = $id;
		$model->update($data);
		header('location: ' . ADMIN_URL . '/car/edit?id=' . $id);
		die;
	}

	public function delCar()
	{
		$id = $_GET['id'];
		$car = Car::destroy($id);
		header('location: '. ADMIN_URL . '/car');
		die;
	}
	
}
