<?php 
function dd($value){
	var_dump($value);
	die;
}

function getTotalProductInCart(){
	// dd($_SESSION[CART]);
	$totalProduct = 0;
	if(isset($_SESSION[CART]) && count($_SESSION[CART]) > 0){
		$cart = $_SESSION[CART];
		foreach ($cart as $item) {
			$totalProduct += $item['quantity'];
		}
	}
	return $totalProduct;
}

function getCartTotalPrice(){
	$totalPrice = 0;
	if(isset($_SESSION[CART]) && count($_SESSION[CART]) > 0){
		$cart = $_SESSION[CART];
		foreach ($cart as $item) {
			$totalPrice += $item['quantity'] * $item['price'];
		}
	}
	return $totalPrice;
}

function getPaymentMethod(){
	return [
		1 => "Thanh toán tiền mặt khi nhận hàng",
		2 => " Thanh toán online",
		3 => "Thanh toán bằng thẻ quốc tế Visa, Master, JCB"
	];
}

function checkLogin(){
	if(!isset($_SESSION['AUTH']) || $_SESSION['AUTH'] == null ){
		header('location: ' . ADMIN_URL . '/login');
		die;
	} elseif($_SESSION['AUTH']['role_id'] == 3){
		header('location: ' . ADMIN_URL . '/login'); 
	} 

}
function checkLoginClient()
{
	if (!isset($_SESSION['AUTH']) || $_SESSION['AUTH'] == null) {
		header('location: ' . BASE_URL . 'login');
		die;
	}
}



?>