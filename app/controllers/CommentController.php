<?php 
namespace App\Controllers;


use App\Models\Comment;

class CommentController
{
	
	// list
	public function listComment(){	
		$comments = Comment::all();
		
		include_once './app/views/admin/comments/list.php';
	}
	// edit
	public function editComment(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$comment = Comment::where(['id','=',$id])->first();
		if(!$comment){
            header('location: '. BASE_URL . 'error');
			die;
		}
		include_once './app/views/admin/comments/edit.php';
	}

	public function editSaveComment()
	{
		$id = isset($_POST['id']) == true ? $_POST['id'] : "";
		$status = isset($_POST['status']) == true ? $_POST['status'] : "";
		// dd($status);
		$data = compact('status');
		$model = new Comment();
		$model = Comment::where(['id', '=', $id])->first();
		// dd($data);
		$model->update($data);
		header('location: '. ADMIN_URL . '/comment/edit?id=' . $id);
	}
	public function delComment(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$comment = Comment::destroy($id);
        header('location: ' . ADMIN_URL . '/comment' );
	}
	
}

 ?>