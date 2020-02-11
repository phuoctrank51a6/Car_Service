<?php

namespace App\Controllers;


use App\Models\Page;

class PageController
{

  // list
  public function listPage()
  {
    // dd(1);
    $page = Page::all();

    include_once './app/views/admin/page/list.php';
  }
  // thêm mới
  public function addPage()
  {
    include_once './app/views/admin/page/add.php';
  }
  public function saveAddPage()
  {
    // dd(1);
    $title = isset($_POST['title']) == true ? $_POST['title'] : "";
    $description = isset($_POST['description']) == true ? $_POST['description'] : "";
    $content = isset($_POST['content']) == true ? $_POST['content'] : "";

    if (isset($_SERVER['PHP_SELF'])){
      // tiêu đề
			$err_title = "";
			if($title == ""){
				$err_title = "Vui lòng nhập tên";
      } else{
          $titlePage = Page::where(['title', '=', $title])->get();
          if($titlePage){
            $err_title = "Tiêu đề đã tồn tại";
          }
      }
      // mô tả
      $err_description = "";
      if($description == ""){
        $err_description = "Vui lòng nhập";
      }
      // nội dung
      $err_content = "";
      if($content == ""){
        $err_content = "Vui lòng nhập nội dung";
      }
			
		// kiểm tra và hiện validation
		if($err_title != "" || $err_description != "" || $err_content != ""){
			header(
				'location: ' . ADMIN_URL . '/page/add?'
          . 'err_title=' . $err_title
          . '&err_description=' . $err_description
          . '&err_content=' . $err_content
			);
			die;
		}
		}

    $data = compact('title', 'description' , 'content');
    $model = new Page();
    $model->insert($data);
    header('location: ' . ADMIN_URL . '/page' );
  }
  // sửa
  public function editPage()
  {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $page = Page::where(['id', '=', $id])->first();
    if (!$page) {
      header('location: '. BASE_URL . 'error');
			die;
    }
    include_once './app/views/admin/page/edit.php';
  }
  public function SaveEditPage()
  {
    $id = isset($_POST['id']) == true ? $_POST['id'] : "";
    $title = isset($_POST['title']) == true ? $_POST['title'] : "";
    $description = isset($_POST['description']) == true ? $_POST['description'] : "";
    $content = isset($_POST['content']) == true ? $_POST['content'] : "";

    if (isset($_SERVER['PHP_SELF'])){
      $page = Page::where(['id', '=', $id])->first();
      // tiêu đề
			$err_title = "";
			if($title == ""){
				$err_title = "Vui lòng nhập tên";
      } elseif ($title != $page->title){
          $titlePage = Page::where(['title', '=', $title])->get();
          if($titlePage){
            $err_title = "Tiêu đề đã tồn tại";
          }
      }
      // mô tả
      $err_description = "";
      if($description == ""){
        $err_description = "Vui lòng nhập";
      }
      // nội dung
      $err_content = "";
      if($content == ""){
        $err_content = "Vui lòng nhập nội dung";
      }
			
		// kiểm tra và hiện validation
		if($err_title != "" || $err_description != "" || $err_content != ""){
			header(
				'location: ' . ADMIN_URL . '/page/edit?id=' . $id
          . '&err_title=' . $err_title
          . '&err_description=' . $err_description
          . '&err_content=' . $err_content
			);
			die;
		}
		}

    $data = compact('title', 'description' , 'content');
    $model = new Page();
    $model->id = $id;
    $model->update($data);

    header('location: ' . ADMIN_URL . '/page/edit?id=' . $id );
  }
  public function delPage()
  {
    $id = $_GET['id'];
    $page = Page::destroy($id);
		header('location: ' . ADMIN_URL . '/page');
  }

}
