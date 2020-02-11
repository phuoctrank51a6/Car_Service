<?php 
namespace App\Controllers;


use App\Models\Role;

class RoleController
{
	
	// list
	public function listRole(){	
		$roles = Role::all();
		include_once './app/views/admin/roles/list.php';
	}
	// thêm mới
	public function addRole(){
		include_once './app/views/admin/roles/add.php';
    }
    public function saveAddRole(){
        $name = isset($_POST['name']) == true ? $_POST['name']: "";
        $status = isset($_POST['status']) == true ? $_POST['status']: "";

        if (isset($_SERVER['PHP_SELF'])){
			$err_name = "";
			
			if($name == ""){
				$err_name = "Vui lòng nhập tên";
			} else{
				$nameRole = Role::where(['name', '=', $name])->get();
				if($nameRole){
					$err_name = "Tên đã tồn tại";
				}
            }
			
		// kiểm tra và hiện validation
		if($err_name != ""){
			header(
				'location: ' . ADMIN_URL . '/role/add?'
					. 'err_name=' . $err_name
			);
			die;
		}
		}

        $data = compact('name', 'status');
        $model = new Role();
        $model->insert($data);

        header('location: ' . ADMIN_URL . '/role' );
    }
	// sửa
	public function editRole(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$role = Role::where(['id', '=', $id])->first();
		if(!$role){
            header('location: '. BASE_URL . 'error');
			die;
		}
		include_once './app/views/admin/roles/edit.php';
    }
    public function saveEditRole(){
        $id = isset($_POST['id']) == true ? $_POST['id']: "";
        $name = isset($_POST['name']) == true ? $_POST['name']: "";
        $status = isset($_POST['status']) == true ? $_POST['status']: "";

        if (isset($_SERVER['PHP_SELF'])){
			$role = Role::where(['id', '=', $id])->first();
			$err_name = "";
			
			if($name == ""){
				$err_name = "Vui lòng nhập tên";
			} elseif ($role != $role->name){
				$nameRole = Role::where(['name', '=', $name])->get();
				if($nameRole){
					$err_name = "Tên đã tồn tại";
				}
			}
			
		// kiểm tra và hiện validation
		if($err_name != ""){
			header(
				'location: ' . ADMIN_URL . '/role/edit?id=' . $id
					. '&err_name=' . $err_name
			);
			die;
		}
		}

        $data = compact('name', 'status');
        $model = new Role();
        $model->id = $id;
        $model->update($data);

        header('location: ' . ADMIN_URL . '/role' );
    }
    // xóa
    public function delRole(){
        $id = isset($_GET['id']) ? $_GET['id'] : null;
		$role = Role::destroy($id);
		header('location: ' . ADMIN_URL . '/role');
    }
	
}

 ?>