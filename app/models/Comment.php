<?php 

namespace App\Models;

/**
 * 
 */
class Comment extends BaseModel
{
	protected $tableName = 'comments';

	// lấy tên xe
	public function getCarName()
	{
		$prd = Car::where(['id', '=', $this->product_id])->first();
		if ($prd != null) {
			return $prd->name;
		}
		return "";
	}
	// lấy tên khách hàng
	public function getUserName()
	{
		$user = User::where(['id', '=', $this->user_id])->first();
		if ($user != null) {
			return $user->name;
		}
		return "";
	}
}

?>