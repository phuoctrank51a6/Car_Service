<?php 

namespace App\Models;

/**
 * 
 */
class Car extends BaseModel
{
	protected $tableName = 'cars';

	// lấy ra tên danh mục
	public function getCateName()
	{
		$cate = Category::where(['id', '=', $this->cate_id])->first();
		if ($cate != null) {
			return $cate->name;
		}
		return "";
	}
	// Hiện thị tên địa điểm
	public function getLocaName()
	{
		$loca = Location::where(['id', '=', $this->location_id])->first();
		if ($loca != null) {
			return $loca->name;
		}
		return "";
	}
	// hiện thị hãng xe
	public function getMakerName()
	{
		$maker = Makers::where(['id', '=', $this->maker_id])->first();
		if ($maker != null) {
			return $maker->name;
		}
		return "";
	}

	// tên chủ xe
	public function getUserName(){
		$user = User::where(['id','=', $this->user_id])->first();
		if($user != null){
			return $user->name;
		}
		return "";
	}
}
 ?>