<?php 

namespace App\Models;

/**
 * 
 */
class OrderDetail extends BaseModel
{
	protected $tableName = 'order_detail';

	public function getNameCar()
	{
		$car = Car::where(['id', '=', $this->car_id])->first();
		if ($car != null) {
			return $car->name;
		}
		return "";
	}
}
 ?>