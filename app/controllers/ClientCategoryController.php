<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Car;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Location;
use App\Models\Maker;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Voucher;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ClientCategoryController
{
  // trang danh mục
  public function categories()
  {
    $maker = Maker::all();
    $loca = Location::where(['show_location', '=', '1'])->get();
    $cate = Category::all();
    $cars = $car = Car::all();
    if (!$cars) {
      include_once './app/views/error.php';
    }
    // echo "<pre>";
    // dd($car);
    include_once './app/views/client/home/category.php';
  }
  public function category()
  {
    $id = isset($_GET['id']) == true ? $_GET['id'] : "";
    $maker = Maker::all();
    $loca = Location::where(['show_location', '=', '1'])->get();
    $cate = Category::all();
    $cars = Car::where(['cate_id', '=', $id])->get();
    $category = Category::where(['id', '=', $id])->first();
    $nameCategory = $category->name;
    if (!$category) {
      header('location: ' . BASE_URL . 'error');
      die;
    }
    // dd($cars);
    // echo "<pre>";
    // dd($car);
    include_once './app/views/client/home/category.php';
  }
  public function makers()
  {
    $id = isset($_GET['id']) == true ? $_GET['id'] : "";
    $maker = Maker::all();
    $loca = Location::where(['show_location', '=', '1'])->get();
    $cate = Category::all();
    $car = Car::all();
    $category = Maker::where(['id', '=', $id])->first();
    $nameCategory = 'xe của hãng ' . $category->name;

    $cars = Car::where(['maker_id', '=', $id])->get();
    if (!$category) {
      include_once './app/views/error.php';
    }
    // dd($makers);
    // echo "<pre>";
    // dd($car);
    include_once './app/views/client/home/category.php';
  }
  public function locations()
  {
    $id = isset($_GET['id']) == true ? $_GET['id'] : "";
    $maker = Maker::all();
    $loca = Location::where(['show_location', '=', '1'])->get();
    $cate = Category::all();
    $car = Car::all();
    $category = Location::where(['id', '=', $id])->first();
    $nameCategory = 'xe ở ' . $category->name;

    $cars = Car::where(['location_id', '=', $id])->get();
    $err_cars = "Chưa có xe";
    if (!$category) {
      header('location: ' . BASE_URL . 'error');
      die;
    }

      include_once './app/views/client/home/category.php';
    // dd($makers);
    // echo "<pre>";
    // dd($car);
  }
  // chi tiết xe
  public function detail()
  {
    $id = isset($_GET['id']) == true ? $_GET['id'] : "";
    $maker = Maker::all();
    $loca = Location::where(['show_location', '=', '1'])->get();
    $cate = Category::all();
    $comments = Comment::rawQuery('SELECT * 
																	FROM comments 
																	INNER JOIN users 
																	ON comments.user_id = users.id
																	WHERE comments.status = 1
																	AND comments.product_id =' . $id)->get();
    // dd($comments);

    $detail = Car::where(['id', '=', $id])->first();
    $listLoca = Car::where(['location_id', '=', $id])->get();
    // dd($detail);


    if (!$detail) {
      header('location: ' . BASE_URL . 'error');
      die;
    }
    include_once './app/views/client/home/detail.php';
  }

}