<?php 

namespace App\Models;

/**
 * 
 */
class Category extends BaseModel
{
	protected $tableName = 'categories';

	public function countTotalCar(){
		$cars = Car::where(['cate_id', '=', $this->id])->get();
		return count($cars);
	}
	
}
 ?>