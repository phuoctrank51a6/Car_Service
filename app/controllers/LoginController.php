<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\PasswordReset;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class LoginController
{


    public function loginAdmin()
    {
        include_once './app/views/admin/login.php';
    }

    public function postLoginAdmin()
    {
        $email = isset($_POST['email']) == true ? $_POST['email'] : "";
        $password = isset($_POST['password']) == true ? $_POST['password'] : "";

        $user = new User();
        $user = User::where(['email', '=', $email])
            ->first();
        // var_dump($user);die;
        $pass =  $user->password;
        $role = $user->role_id;
        // var_dump($role); die;    
        // echo $pass;die;
        if (($user && password_verify($password, $pass))) {
            // if($role === 1){

            // }
            $_SESSION['AUTH'] = [
                'name' => $user->name,
                'email' => $user->email,
                'id' => $user->id,
                'role_id' => $user->role_id
            ];

            if ($_SESSION['AUTH']['role_id'] == 1) {
                header('location: ' . ADMIN_URL);
            } elseif ($_SESSION['AUTH']['role_id'] == 2) {
                header('location: ' . PARTNER_URL);
            } elseif ($_SESSION['AUTH']['role_id'] == 3) {
                header('location: ' . BASE_URL);
            }
            // var_dump($_SESSION['AUTH']['role_id']);die;

            die;
        } else {

            $err_login    = "Sai email hoặc mật khẩu";
            header(
                'location: ' . ADMIN_URL . '/login?'
                    . '&err_login=' . $err_login
            );
            die;
        }
    }

    public function logoutAdmin()
    {
        unset($_SESSION['AUTH']);
        header('location: ' . ADMIN_URL);
        die;
    }

    public function forgotPassword()
    {
        include_once './app/views/admin/forgot-password.php';
    }
    public function submitForgotPassword()
    {

        if (isset($_POST['email']) && (!empty($_POST["email"]))) {
            $email = $_POST['email'];
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $error = "";
            if (!$email) {
                $error = "Địa chỉ email không hợp lệ xin vui lòng nhập một địa chỉ email hợp lệ!";
            } else {
                $user = User::where(['email', '=', $email])->first();
                if ($user == "") {
                    $error = "Không có người dùng được đăng ký với địa chỉ email này!";
                }
            }

            if ($error != "") {
                header('location: ' . ADMIN_URL . '/forgot-password?' . 'error=' . $error);
                die;
            } else {

                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
                $reset_expired_time = date("Y-m-d H:i:s", $expFormat);
                $token =  md5($reset_expired_time);
                $addToken = substr(md5(uniqid(rand(), 1)), 3, 10);
                $token = $token . $addToken;

                $data['token'] = $token;
                $data['reset_expired_time'] = $reset_expired_time;
                $model = new User();
                $model->id = $user->id;
                $model->update($data);

                // 
                $output = '<span>Xin chào </span> ' . $email;
                $output .= '<p>Vui lòng nhấp vào liên kết sau để đặt lại mật khẩu của bạn..</p>';
                $output .= '<p>-------------------------------------------------------------</p>';
                $output .= '<p><a href="http://localhost/project/project_one/admin/reset-password?token=' . $token . '&email=' . $email . '" target="_blank">Click vào đây lấy lại mật khẩu</a></p>';
                $output .= '<p>-------------------------------------------------------------</p>';
                $output .= '<p>Vui lòng nhấp liên kết để lấy lại mật khẩu. Liên kết sẽ hết hạn sau 1 ngày vì lý do bảo mật.</p>';
                $output .= '<p>Cảm ơn bạn luôn đồng hành cùng MeGo,</p>';
                $output .= '<p>MeGo Team</p>';
                // var_dump($email);die;
                $body = $output;
                $subject = "Khôi phục mật khẩu - Mego";
                $email_to = $email;
                $error = "Gửi không thành công";
                // dd($content);
                $mail = new PHPMailer(true);
                try {
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username = 'noiconsong@gmail.com';
                    $mail->Password = 'qkxrjoenwrpshmhk';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    $mail->setFrom('vuduycuong996@gmail.com', 'Mego');

                    $mail->addAddress($email_to);
                    $mail->isHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body    = $body;
                    $mail->send();
                    header('location: ' . ADMIN_URL . '/forgot-password?error=' . "Mego vừa gởi thông tin vào email của bạn. Vui lòng kiểm tra email nhé!");
                    die;
                } catch (Exception $e) {
                    header('location: ' . ADMIN_URL . '/forgot-password?' . 'error=' . $error);
                    die;
                }
            }
        }
        header('location: ' . ADMIN_URL . '/forgot-password?' . 'error=' . $error);
    }

    public function resetPassword()
    {
        $token = isset($_GET['token']) ? $_GET['token'] : null;
        $email = isset($_GET['email']) ? $_GET['email'] : null;
        include_once './app/views/admin/reset-password.php';
    }

    public function submitResetPassword(){
      
                $token = isset($_POST['token']) == true ? $_POST['token']: "";
                $email = isset($_POST['email']) == true ? $_POST['email']: "";
                $error = "";
                // var_dump($token);die;
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $currentTime = date("Y-m-d H:i:s");
                // dd($currentTime);die;
                $user = User::where(['token', '=', $token])->andWhere(['email', '=', $email])->first();
                // dd($user);die;
                if($user == ""){
                    header('location: ' . ADMIN_URL . '/reset-password?error=' . "Không thành công, vui lòng nhập lại email để lấy lại mật khẩu"
                        );
        	        die;
                } else {

                    $reset_expired_time = $user->reset_expired_time;

                    if($reset_expired_time >= $currentTime ){
                        $password = isset($_POST['password']) == true ? $_POST['password']: "";
                        $cfpassword = isset($_POST['cfpassword']) == true ? $_POST['cfpassword']: "";
                        $email = isset($_POST['email']) == true ? $_POST['email']: "";
                        // var_dump($email); die;
                        // validate kiểm tra
                        if (isset($_SERVER['PHP_SELF'])){
                            $err_password = "";
                            if($password == "" || strlen($password) < 6 ){
                                $err_password = "Nhập lại mật khẩu";
                            }
                            $err_cfpassword = "";
                            if($cfpassword != $password){
                                $err_cfpassword = "Mật khẩu không trung nhau";
                            }
                            
                            dd($token);
                        // kiểm tra và hiện validation
                        if($err_password != ""){
                            header('location: ' . ADMIN_URL . '/reset-password?'
                                . '&token=' . $token   
                                . '&email=' . $email   
                                . '&err_password=' . $err_password        
                                    );
                            die;
                        }
                        } 

                        $hashpassword = password_hash($password, PASSWORD_DEFAULT);
                        $data = compact( 'email');
                        $data['password'] = $hashpassword;
                
                        $model = new User();
                        $user = User::where(['token', '=', $token])->andWhere(['email', '=', $email])->first();
                        $model->id = $user->id;
                        $model->update($data);
                
                        header('location: ' . ADMIN_URL . '/reset-password?' . 'error=' . $error);
                    } else {
                        $error = "Liên kết đã hết hạn. Bạn đang cố gắng sử dụng liên kết đã hết hạn, chỉ có hiệu lực trong 24 giờ (1 ngày sau khi yêu cầu)";
                    }
                }

                if($error != ""){
                    header('location: ' . ADMIN_URL . '/reset-password?' . 'error=' . $error);
                    die;
                }

           

        
        //  xác thực email kết thúc

  
    }
}
