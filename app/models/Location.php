<?php 

namespace App\Models;

/**
 * 
 */
class Location extends BaseModel
{
	protected $tableName = 'locations';
	
	public function countTotalCarLocation(){
		$cars = Car::where(['location_id', '=' ,$this->id])->get();

		return count($cars);
	}

}
?>