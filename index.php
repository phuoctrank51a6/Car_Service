<?php



session_start();
// session_destroy();
require_once './commons/utils.php';
require_once './commons/helpers.php';

require_once './vendor/autoload.php';

$url = isset($_GET['url']) ? $_GET['url'] : '/';

use App\Controllers\AdminController;
use App\Controllers\CarController;
use App\Controllers\CategoryController;
use App\Controllers\CommentController;
use App\Controllers\HomeController;
use App\Controllers\LocationController;
use App\Controllers\MakerController;
use App\Controllers\UserController;
use App\Controllers\VoucherController;
use App\Controllers\OrderController;
use App\Controllers\PageController;
use App\Controllers\WebSettingController;
use App\Controllers\RoleController;
use App\Controllers\LoginController;
use App\Controllers\PartnerController;
use App\Models\Comment;
use App\Controllers\ClientAccountController;
use App\Controllers\ClientCategoryController;
use App\Controllers\ClientOrderController;

switch ($url) {
	// trang chủ
	case '/':
		$ctr = new HomeController();
		$ctr->index();
		break;
	case 'error':
		$ctr = new HomeController();
		$ctr->errorPage();
		break;
		// login user
	case 'login':
		$ctr = new ClientAccountController();
		$ctr->login();
		break;
	case 'post-login':
		$ctr = new ClientAccountController();
		$ctr->postLogin();
		break;

	case 'forgot-password':
		$ctr = new ClientAccountController();
		$ctr->forgotPassword();
		break;
	case 'post-forgot-password':
		$ctr = new ClientAccountController();
		$ctr->postForgotPassword();
		break;
	case 'reset-password':
		$ctr = new ClientAccountController();
		$ctr->resetPassword();
		break;
		
		// logout
	case 'logout':
		$ctr = new ClientAccountController();
		$ctr->logout();
		break;
	case 'search':
		$ctr = new HomeController();
		$ctr->search();
		break;
	case 'find':
		$ctr = new HomeController();
		$ctr->find();
		break;
		// search
		// trang danh mục
	case 'categories':
		$ctr = new ClientCategoryController();
		$ctr->categories();
		break;
	case 'category':
		$ctr = new ClientCategoryController();
		$ctr->category();
		break;
		// trang danh xe theo hãng xe
	case 'maker':
		$ctr = new ClientCategoryController();
		$ctr->makers();
		break;
	case 'location':
		$ctr = new ClientCategoryController();
		$ctr->locations();
		break;
		// chi tiết
	case 'detail':
		$ctr = new ClientCategoryController();
		$ctr->detail();
		break;
	case 'comment':
		$ctr = new HomeController();
		$ctr->comment();
		break;
	case 'contact':
		$ctr = new HomeController();
		$ctr->contact();
		break;
	case 'post-contact':
		$ctr = new HomeController();
		$ctr->postContact();
		break;
	case 'add-wishlist':
		checkLoginClient();
		$ctr = new HomeController();
		$ctr->addWishlist();
		break;
	case 'wishlist':
		checkLoginClient();
		$ctr = new HomeController();
		$ctr->wishlist();
		break;
	case 'del-item-wishlist':
		checkLoginClient();
		$ctr = new HomeController();
		$ctr->delItemWishlist();
		break;
	case 'checkout':
		$ctr = new ClientOrderController();
		$ctr->checkout();
		break;
	case 'post-checkout':
		$ctr = new ClientOrderController();
		$ctr->postCheckout();
		break;
	case 'account':
		checkLoginClient();
		$ctr = new ClientAccountController();
		$ctr->account();
		break;
	case 'save-account':
		checkLoginClient();
		$ctr = new ClientAccountController();
		$ctr->saveAccount();
		break;
		// đổi mật khẩu
	case 'change-password':
		$ctr = new ClientAccountController();
		$ctr->changePassword();
		break;
	case 'save-change-password':
		$ctr = new ClientAccountController();
		$ctr->saveChangePassword();
		break;


	case 'history':
		$ctr = new HomeController();
		$ctr->history();
		break;
	case 'register':
		$ctr = new ClientAccountController();
		$ctr->register();
		break;
	case 'save-register':
		$ctr = new ClientAccountController();
		$ctr->saveRegister();
		break;
	case 'register-partner':
		$ctr = new ClientAccountController();
		$ctr->registerPartner();
		break;
	case 'save-register-partner':
		$ctr = new ClientAccountController();
		$ctr->saveRegisterPartner();
		break;





	// trang tìm kiếm
	// login admin
	case 'admin/login':
		$ctr = new LoginController();
		$ctr->loginAdmin();
		break;
	case 'admin/post-login':
		$ctr = new LoginController();
		$ctr->postLoginAdmin();
		break;
	case 'admin/logout':
		$ctr = new LoginController();
		$ctr->logoutAdmin();
		break;
	case 'admin/forgot-password':
		$ctr = new LoginController();
		$ctr->forgotPassword();
		break;
	case 'admin/submit-forgot-password':
		$ctr = new LoginController();
		$ctr->submitForgotPassword();
		break;
	case 'admin/reset-password':
		$ctr = new LoginController();
		$ctr->resetPassword();
		break;
	case 'admin/submit-reset-password':
		$ctr = new LoginController();
		$ctr->submitResetPassword();
		break;
	// admin
	case 'admin':
		checkLogin();
		$ctr = new AdminController();
		$ctr->index();
		break;
	case 'admin/':
		checkLogin();
		$ctr = new AdminController();
		$ctr->index();
		break;
	// danh mục xe
	case 'admin/category':
		checkLogin();
		$ctr = new CategoryController();
		$ctr->listCategory();
		break;
	case 'admin/category/add':
		$ctr = new CategoryController();
		$ctr->addCategory();
		break;
	case 'admin/category/save-add':
		$ctr = new CategoryController();
		$ctr->saveAddCategory();
		break;
	case 'admin/category/edit':
		$ctr = new CategoryController();
		$ctr->editCategory();
		break;
	case 'admin/category/save-edit':
		$ctr = new CategoryController();
		$ctr->editSaveCategory();
		break;
	case 'admin/category/del':
		$ctr = new CategoryController();
		$ctr->delCategory();
		break;
	// địa điểm cho thuê xe
	case 'admin/location':
		$ctr = new LocationController();
		$ctr->listLocation();
		break;
	case 'admin/location/add':
		$ctr = new LocationController();
		$ctr->addLocation();
		break;
	case 'admin/location/save-add':
		$ctr = new LocationController();
		$ctr->saveAddLocation();
		break;
	case 'admin/location/edit':
		$ctr = new LocationController();
		$ctr->editLocation();
		break;
	case 'admin/location/save-edit':
		$ctr = new LocationController();
		$ctr->saveEditLocation();
		break;
	case 'admin/location/del':
		$ctr = new LocationController();
		$ctr->delLocation();
		break;
	// maker (hãng xe)
	case 'admin/maker':
		$ctr = new MakerController();
		$ctr->listMaker();
		break;
	case 'admin/maker/add':
		$ctr = new MakerController();
		$ctr->addMaker();
		break;
	case 'admin/maker/save-add':
		$ctr = new MakerController();
		$ctr->saveAddMaker();
		break;
	case 'admin/maker/edit':
		$ctr = new MakerController();
		$ctr->editMaker();
		break;
	case 'admin/maker/save-edit':
		$ctr = new MakerController();
		$ctr->saveEditMaker();
		break;
	case 'admin/maker/del':
		$ctr = new MakerController();
		$ctr->delMaker();
		break;
	// xe
	case 'admin/car':
		$ctr = new CarController();
		$ctr->listCar();
		break;
	case 'admin/car/add':
		$ctr = new CarController();
		$ctr->addCar();
		break;
	case 'admin/car/save-add':
		$ctr = new CarController();
		$ctr->saveAddCar();
		break;
	case 'admin/car/edit':
		$ctr = new CarController();
		$ctr->editCar();
		break;
	case 'admin/car/save-edit':
		$ctr = new CarController();
		$ctr->saveEditCar();
		break;
	case 'admin/car/del':
		$ctr = new CarController();
		$ctr->delCar();
		break;

	// tài khoản
	case 'admin/account':
		$ctr = new UserController();
		$ctr->listUser();
		break;
	case 'admin/account/add':
		$ctr = new UserController();
		$ctr->addUser();
		break;
	case 'admin/account/save-add':
		$ctr = new UserController();
		$ctr->saveAddUser();
		break;
	case 'admin/account/edit':
		$ctr = new UserController();
		$ctr->editUser();
		break;
	case 'admin/account/save-edit':
		$ctr = new UserController();
		$ctr->saveEditUser();
		break;
	case 'admin/account/change-password':
		$ctr = new UserController();
		$ctr->changePassword();
		break;
	case 'admin/account/save-change-password':
		$ctr = new UserController();
		$ctr->saveChangePassword();
		break;
	case 'admin/account/del':
		$ctr = new UserController();
		$ctr->delUser();
		break;
	case 'admin/account/infomation':
		$ctr = new UserController();
		$ctr->infomationUser();
		break;
	// vai trò
	case 'admin/role':
		$ctr = new RoleController();
		$ctr->listRole();
		break;
	case 'admin/role/add':
		$ctr = new RoleController();
		$ctr->addRole();
		break;
	case 'admin/role/save-add':
		$ctr = new RoleController();
		$ctr->saveAddRole();
		break;
	case 'admin/role/edit':
		$ctr = new RoleController();
		$ctr->editRole();
		break;
	case 'admin/role/save-edit':
		$ctr = new RoleController();
		$ctr->saveEditRole();
		break;
	case 'admin/role/del':
		$ctr = new RoleController();
		$ctr->delRole();
		break;
	// bình luận
	case 'admin/comment':
		$ctr = new CommentController();
		$ctr->listComment();
		break;
	case 'admin/comment/edit':
		$ctr = new CommentController();
		$ctr->editComment();
		break;
	case 'admin/comment/save-edit':
		$ctr = new CommentController();
		$ctr->editSaveComment();
		break;
	case 'admin/comment/del':
		$ctr = new CommentController();
		$ctr->delComment();
		break;
	// mã giảm giá voucher
	case 'admin/voucher':
		$ctr = new VoucherController();
		$ctr->listVoucher();
		break;
	case 'admin/voucher/add':
		$ctr = new VoucherController();
		$ctr->addVoucher();
		break;
	case 'admin/voucher/save-add':
		$ctr = new VoucherController();
		$ctr->SaveAddVoucher();
		break;
	case 'admin/voucher/edit':
		$ctr = new VoucherController();
		$ctr->editVoucher();
		break;
	case 'admin/voucher/save-edit':
		$ctr = new VoucherController();
		$ctr->saveEditVoucher();
		break;
	case 'admin/voucher/del':
		$ctr = new VoucherController();
		$ctr->delVoucher();
		break;
	// đơn hàng
	case 'admin/order':
		$ctr = new OrderController();
		$ctr->listOrder();
		break;
	case 'admin/order/edit':
		$ctr = new OrderController();
		$ctr->editOrder();
		break;
	case 'admin/order/save-edit':
		$ctr = new OrderController();
		$ctr->saveEditOrder();
		break;
	
	// page
	case 'admin/page':
		$ctr = new PageController();
		$ctr->listPage();
		break;
	case 'admin/page/add':
		$ctr = new PageController();
		$ctr->addPage();
	break;
	case 'admin/page/save-add':
		$ctr = new PageController();
		$ctr->saveAddPage();
		break;
	case 'admin/page/edit':
		$ctr = new PageController();
		$ctr->editPage();
	break;
	case 'admin/page/save-edit':
		$ctr = new PageController();
		$ctr->SaveEditPage();
		break;
	case 'admin/page/del':
		$ctr = new PageController();
		$ctr->delPage();
		break;
	// cấu hình website
	case 'admin/setting':
		$ctr = new WebSettingController();
		$ctr->listWebSetting();
		break;
	case 'admin/setting/add':
		$ctr = new WebSettingController();
		$ctr->addWebSetting();
		break;
	case 'admin/setting/save-add':
		$ctr = new WebSettingController();
		$ctr->SaveAddWebSetting();
		break;
	case 'admin/setting/edit':
		$ctr = new WebSettingController();
		$ctr->editWebSetting();
		break;
	case 'admin/setting/save-edit':
		$ctr = new WebSettingController();
		$ctr->saveEditWebSetting();
		break;
	case 'admin/setting/del':
		$id = $_GET['id'];
		$ctr = new WebSettingController();
		$ctr->delWebSetting($id);
		break;
	case 'partner':
		checkLogin();
		$ctr = new PartnerController();
		$ctr->homePagePartner();
		break;
	case 'partner/cars':
		$ctr = new PartnerController();
		$ctr->listCarsPartner();
		break;
	case 'partner/cars/add':
		$ctr = new PartnerController();
		$ctr->addCarsPartner();
		break;
	case 'partner/cars/save-add':
		$ctr = new PartnerController();
		$ctr->saveAddCarsPartner();
		break;
	case 'partner/cars/edit':
		$ctr = new PartnerController();
		$ctr->editCarsPartner();
		break;
	case 'partner/cars/save-edit':
		$ctr = new PartnerController();
		$ctr->saveEditCarsPartner();
		break;
	case 'partner/account':
		$ctr = new PartnerController();
		$ctr->informationAccount(); 
		break;
	case 'partner/account/edit':
		$ctr = new PartnerController();
		$ctr->editAccount(); 
		break;
	case 'partner/account/save-edit':
		$ctr = new PartnerController();
		$ctr->saveEditAccount(); 
		break;
	case 'partner/orders':
		$ctr = new PartnerController();
		$ctr->listOrdersPartner();
		break;
	case 'partner/orders/edit':
		$ctr = new PartnerController();
		$ctr->editOrdersPartner();
		break;
		
		break;
}
