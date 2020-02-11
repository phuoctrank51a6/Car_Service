<?php 
namespace App\Controllers;


use App\Models\Maker;


class MakerController
{
	
	// list
	public function listMaker(){
        $makers = Maker::all();
        include_once './app/views/admin/makers/list.php';
    }
    // thêm mới
    public function addMaker()
    {
        include_once './app/views/admin/makers/add.php';
    }
    public function saveAddMaker()
    {
        $name = isset($_POST['name']) == true ? $_POST['name'] : "";

		if (isset($_SERVER['PHP_SELF'])){
			$err_name = "";
			if($name == ""){
				$err_name = "Vui lòng nhập tên";
			} else{
                $nameMaker = Maker::where(['name', '=', $name])->get();
				if($nameMaker){
					$err_name = "Tên đã tồn tại";
				}
            }

			
		// kiểm tra và hiện validation
		if($err_name != ""){
			header(
				'location: ' . ADMIN_URL . '/maker/add?'
					. 'err_name=' . $err_name
			);
			die;
		}
		}

        $data = compact('name');
        $model = new Maker;
        $model->insert($data);

        header('location: ' . ADMIN_URL . '/maker');
    }

    // sửa
    public function editMaker()
    {
        $id = $_GET['id'];
        $maker = Maker::where(['id', '=', $id])->first();
        if(!$maker){
            header('location: '. BASE_URL . 'error');
			die;
        }
        include_once './app/views/admin/makers/edit.php';
    }
    public function saveEditMaker()
    {
        $id = isset($_POST['id']) == true ? $_POST['id'] : "";
        $name = isset($_POST['name']) == true ? $_POST['name'] : "";

		if (isset($_SERVER['PHP_SELF'])){
            $maker = Maker::where(['id', '=', $id])->first();
			$err_name = "";
			if($name == ""){
				$err_name = "Vui lòng nhập tên";
			} elseif($name != $maker->name){
                $nameMaker = Maker::where(['name', '=', $name])->get();
				if($nameMaker){
					$err_name = "Tên đã tồn tại";
				}
            }

			
		// kiểm tra và hiện validation
		if($err_name != ""){
			header(
				'location: ' . ADMIN_URL . '/maker/edit?id=' . $id
					. '&err_name=' . $err_name
			);
			die;
		}
		}

        $data = compact('name');
        $model = new Maker();
        $model = Maker::where(['id', '=', $id])->first();
        $model->update($data);
        header('location: '. ADMIN_URL . '/maker/edit?id=' . $id);
    }

    public function delMaker()
    {
        $id = $_GET['id'];
        $maker = Maker::destroy($id);
        header('location: '. ADMIN_URL . '/maker');
    }
}

 ?>