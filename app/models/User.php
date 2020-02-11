<?php 

namespace App\Models;

/**
 * 
 */
class User extends BaseModel
{
	protected $tableName = 'users';

	public function getRoleName(){
		$role = Role::where(['id', '=',$this->role_id ])->first();
		if($role != null){
			return $role->name;
		}
	}
	
}
 ?>