<?php 
namespace App\Controllers;


use App\Models\Category;

class CategoryController
{
	
	// list
	public function listCategory(){	
		$categories = Category::all();
		
		include_once './app/views/admin/categories/list.php';
	}

	public function addCategory(){
		include_once './app/views/admin/categories/add.php';
	}
	public function saveAddCategory(){
		//  
		$name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$description = isset($_POST['description']) == true ? $_POST['description'] : "";
		$show_menu = isset($_POST['show_menu']) == true ? $_POST['show_menu'] : "";

		// validate
		if (isset($_SERVER['PHP_SELF'])){
			$err_name = "";
			
			if($name == ""){
				$err_name = "Vui lòng nhập tên loại xe";
			} else {
				$nameCategory = Category::where(['name', '=', $name])->get();
				if($nameCategory){
					$err_name = "Tên đã tồn tại";
				}
			}
			$err_description = "";
			if($description == ""){
				$err_description = "Vui lòng nhập mô tả loại xe";
			}
			
		// kiểm tra và hiện validation
		if($err_name != "" || $err_description != ""){
			header(
				'location: ' . ADMIN_URL . '/category/add?'
					. 'err_name=' . $err_name
					. '&err_description=' . $err_description
			);
			die;
		}
		}

		$data = compact('name', 'description', 'show_menu');
		$model = new Category();
		$model->insert($data);
		header('location: '. ADMIN_URL . '/category');
	}

	public function editCategory(){
		$id = $_GET['id'];
		$cate = Category::where(['id','=',$id])->first();
		if (!$cate) {
			header('location: '. BASE_URL . 'error');
			die;
		}
		include_once './app/views/admin/categories/edit.php';
	}
	public function editSaveCategory()
	{
		$id = isset($_POST['id']) == true ? $_POST['id'] : "";
		$name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$description = isset($_POST['description']) == true ? $_POST['description'] : "";
		$show_menu = isset($_POST['show_menu']) == true ? $_POST['show_menu'] : "";

		if (isset($_SERVER['PHP_SELF'])){
			$cate = Category::where(['id','=',$id])->first();
			// dd($cate);
			// tên
			$err_name = "";
			if($name == ""){
				$err_name = "Vui lòng nhập tên loại xe";
			} elseif($name != $cate->name) { 
				$nameCategory = Category::where(['name', '=', $name])->get();
					if ($nameCategory){
					$err_name = "Tên đã tồn tại";
				}

			}
			// mô tả
			$err_description = "";
			if($description == ""){
				$err_description = "Vui lòng nhập mô tả loại xe";
			}
			
		// kiểm tra và hiện validation
		if($err_name != "" || $err_description != ""){
			header(
				'location: ' . ADMIN_URL . '/category/edit?id=' . $id
					. '&err_name=' . $err_name
					. '&err_description=' . $err_description
			);
			die;
		}
		}

		$data = compact('name', 'description', 'show_menu');
		$model = new Category();
		$model = Category::where(['id', '=', $id])->first();
		$model->update($data);
		// var_dump($model);die;
		header('location: '. ADMIN_URL . '/category/edit?id='.$id);
	}

	public function delCategory()
	{
		$id = $_GET['id'];
		$cate=Category::destroy($id);
		header('location: '. ADMIN_URL . '/category');
	}
}

 ?>