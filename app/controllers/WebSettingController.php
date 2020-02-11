<?php

namespace App\Controllers;


use App\Models\WebSetting;

class WebSettingController
{

  // list
  public function listWebSetting()
  {
    // dd(1);
    $setting = WebSetting::all();

    include_once './app/views/admin/setting/list.php';
  }
  // thêm mới
  public function addWebSetting()
  {
    include_once './app/views/admin/setting/add.php';
  }
  public function SaveAddWebSetting()
  {
    $address = isset($_POST['address']) == true ? $_POST['address'] : "";
    $email = isset($_POST['email']) == true ? $_POST['email'] : "";
    $hotline = isset($_POST['hotline']) == true ? $_POST['hotline'] : "";

    $logo = $_FILES['logo'];

    if (isset($_SERVER['PHP_SELF'])) {
      // dịa chỉ
      $err_address = "";
      if ($address == "") {
        $err_address = "Vui lòng nhập địa chỉ";
      }
      // validate email
      $err_email = "";
      if ($email == "") {
        $err_email = "Vui lòng nhập email";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_email = "Email nhập chưa đúng";
      }
      // hotline
      // validate số điện thoại
      $err_hotline = "";
      $pattern = '/[0-9]/';
      if ($hotline == "") {
        $err_hotline = "Vui lòng nhập số điện thoại";
      } elseif (!preg_match($pattern, $hotline) || $hotline < 1) {
        $err_hotline = "Vui lòng nhập số điện thoại";
      }

      // ảnh
      $err_file = "";

      $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
      );

      // pathinfo trả về thông tin về đường dẫn tệp
      $file_extension = pathinfo($logo["name"], PATHINFO_EXTENSION);

      //  Kiểm tra xem một tập tin hoặc thư mục tồn tại
      if (!file_exists($logo["tmp_name"])) {
        $err_file = "Vui lòng chọn hình ảnh để tải lên";
      }
      //  Kiểm tra biến tồn tại trong mảng
      else if (!in_array($file_extension, $allowed_image_extension)) {
        $err_file = "Tải lên hình ảnh khác. Chỉ cho phép JPG, PNG và JPEG.";
      }
      // move_uploaded_file Di chuyển tệp đã tải lên đến một vị trí mới
      // upload ảnh
      else {
        if ($logo['size'] > 0) {
          $filename = $logo['name'];
          $filename = uniqid() . "-" . $filename;
          move_uploaded_file($logo['tmp_name'], 'public/assets/img/logo/' . $filename);
        }
      }

      // kiểm tra và hiện validation
      if ($err_address != "" || $err_email != "" || $err_hotline != "" || $err_file != "" ) {
        header(
          'location: ' . ADMIN_URL . '/setting/add'
            . '&err_address=' . $err_address
            . '&err_email=' . $err_email
            . '&err_hotline=' . $err_hotline
            . '&err_file=' . $err_file

        );
        die;
      }
    }


    $data = compact('address', 'email', 'hotline');
    $data['logo'] = $filename;
    $model = new WebSetting();
    $model->insert($data);
		header('location: ' . ADMIN_URL . '/setting');
  }
  // sửa
  public function editWebSetting()
  {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $setting = WebSetting::where(['id', '=', $id])->first();
    if (!$setting) {
      header('location: '. BASE_URL . 'error');
			die;
    }
    include_once './app/views/admin/setting/edit.php';
  }
  public function saveEditWebSetting()
  {
    $id = isset($_POST['id']) == true ? $_POST['id'] : "";
    $email = isset($_POST['email']) == true ? $_POST['email'] : "";
    $address = isset($_POST['address']) == true ? $_POST['address'] : "";
    $hotline = isset($_POST['hotline']) == true ? $_POST['hotline'] : "";
    $logo = $_FILES['logo'];

		if (isset($_SERVER['PHP_SELF'])){
      // dịa chỉ
      $err_address = "";
      if ($address == "") {
        $err_address = "Vui lòng nhập địa chỉ";
      }
      // validate email
      $err_email = "";
      if ($email == "") {
        $err_email = "Vui lòng nhập email";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_email = "Email nhập chưa đúng";
      }
      // validate số điện thoại
      $err_hotline = "";
      $pattern = '/[0-9]/';
      if ($hotline == "") {
        $err_hotline = "Vui lòng nhập số điện thoại";
      } elseif (!preg_match($pattern, $hotline) || $hotline < 1) {
        $err_hotline = "Vui lòng nhập số điện thoại";
      }

			// ảnh
			$err_file = "";

			$allowed_image_extension = array(
				"png",
				"jpg",
				"jpeg"
			);
		
			// pathinfo trả về thông tin về đường dẫn tệp
			$file_extension = pathinfo($logo["name"], PATHINFO_EXTENSION);
		
			//  Kiểm tra xem một tập tin hoặc thư mục tồn tại
			if (!file_exists($logo["tmp_name"])) {
				$err_file = "Vui lòng chọn hình ảnh để tải lên";
			}
			//  Kiểm tra biến tồn tại trong mảng
			else if (!in_array($file_extension, $allowed_image_extension)) {
				$err_file = "Tải lên hình ảnh khác. Chỉ cho phép JPG, PNG và JPEG.";
			}
			// move_uploaded_file Di chuyển tệp đã tải lên đến một vị trí mới
			// upload ảnh
			else {
        if ($logo['size'] > 0) {
          $filename = $logo['name'];
          $filename = uniqid() . "-" . $filename;
          move_uploaded_file($logo['tmp_name'], 'public/assets/img/logo/' . $filename);
        }
			}
			
		// kiểm tra và hiện validation
    if ($err_address != "" || $err_email != "" || $err_hotline != "" || $err_file != "" ) {
      header(
        'location: ' . ADMIN_URL . '/setting/edit?id=' . $id
          . '&err_address=' . $err_address
          . '&err_email=' . $err_email
          . '&err_hotline=' . $err_hotline
          . '&err_file=' . $err_file

      );
      die;
    }
		}


    $data = compact('address', 'email', 'hotline');
    $data['logo'] = $filename;
    $model = new WebSetting();
    $model->id = $id;
    $model->update($data);
		header('location: ' . ADMIN_URL . '/setting/edit?id=' . $id);
  }
  public function delWebSetting($id)
  {
    $id = $_GET['id'];
    $setting = WebSetting::destroy($id);
		header('location: ' . ADMIN_URL . '/setting');
  }
}
