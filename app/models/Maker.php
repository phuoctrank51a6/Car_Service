<?php 

namespace App\Models;

/**
 * 
 */
class Maker extends BaseModel
{
	protected $tableName = 'makers';

	public function countTotalCarMaker(){
		$cars = Car::where(['maker_id', '=' ,$this->id])->get();

		return count($cars);
	}
	
}
?>