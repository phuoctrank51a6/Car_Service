<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Location;
use App\Models\Car;
use App\Models\Order;
use App\Models\Comment;

class AdminController{

    public function index(){
        $users = User::all();
        $locations = Location::all();
        $cars = Car::all();
        $orders = Order::all();

        $chartOrder = Order::rawQuery('SELECT 
                                        month(created_date) month_date, 
                                        sum(total_price) total_price 
                                        FROM orders 
                                        WHERE year(created_date)=2019 
                                        GROUP BY month(created_date)')
                                        ->get();
        // var_dump($chartOrder);die;

        // đơn hàng mới nhất
		$ordersLatest = Order::sttOrderBy('id', false)->limit(5)->get();
        // var_dump($ordersLatest);die;
        // bình luận mới nhất
        $commentsLatest = Comment::sttOrderBy('id', false)->limit(5)->get(); 
        include_once './app/views/admin/home/home.php';
    }



    
}
