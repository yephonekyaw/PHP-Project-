<?php

    //index.php

    include('../FacebookLogin/config.php');
    include('../main/cons/config.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '..\PHPMailer-master\src\Exception.php';
    require '..\PHPMailer-master\src\PHPMailer.php';
    require '..\PHPMailer-master\src\SMTP.php';

    $mail = new PHPMailer(TRUE);

    $facebook_helper = $facebook->getRedirectLoginHelper();

    if(isset($_GET['code']))
    {
        if(isset($_SESSION['access_token']))
        {
            $access_token = $_SESSION['access_token'];
        }
        else
        {
            $access_token = $facebook_helper->getAccessToken();

            $_SESSION['access_token'] = $access_token;

            $facebook->setDefaultAccessToken($_SESSION['access_token']);
        }

        $_SESSION['user_name'] = '';
        $_SESSION['user_email_address'] = '';
        $_SESSION['user_image'] = '';

        $graph_response = $facebook->get("/me?fields=name,email", $access_token);

        $facebook_user_info = $graph_response->getGraphUser();

        if(!empty($facebook_user_info['id']))
        {
            $_SESSION['user_image'] = 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
        }

        if(!empty($facebook_user_info['name']))
        {
            $_SESSION['user_name'] = $facebook_user_info['name'];
        }

        if(!empty($facebook_user_info['email']))
        {
            $_SESSION['user_email_address'] = $facebook_user_info['email'];
        }
    
        if(isset($_SESSION['access_token']))
        {
            $oauth_provider = 'facebook';
            $user_name = $_SESSION['user_name'];
            $user_email = $_SESSION['user_email_address'];
            $user_picture = $_SESSION['user_image'];
            $user_password = substr( password_hash( 'dupa.8', PASSWORD_DEFAULT ), 8, 15 );

            // cretae token
            $token = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()/';
            $token = str_shuffle($token);
            $token = substr($token,0,10);

            // Hashing the password
            $user_hashedPwd = password_hash($user_password, PASSWORD_DEFAULT);

            // Check this account already exists or not
            $checkSql = "SELECT * from userinfo where oauth_provider='$oauth_provider' and user_email='$user_email' ";
            $resultCheckSql = mysqli_query($conn, $checkSql);
            $rowCheckSql = $resultCheckSql->fetch_assoc();
            if($rowCheckSql > 0)
            {
                // Destroy entire session data
                session_destroy();

                session_start();
                $_SESSION['id'] = $rowCheckSql['user_id'];
                $_SESSION['email'] = $rowCheckSql['user_email'];
                $_SESSION['user'] = true;

                // Get the current month
                $month = date('m', time());
                // header("location:../main/profilePage.php?"); 
                //header("location:testing.php?");
                header("location:../main/incomeMainPage.php?month=$month");
            }
            else 
            {
                // No existing account so this is to insert the account
                $sql = "INSERT INTO userinfo (oauth_provider, user_name, user_email, user_password, token, created_date, mail_confirmation, one_time_password) VALUES ('$oauth_provider', '$user_name', '$user_email', '$user_hashedPwd', '$token', now(), 1, 0 )";
                mysqli_query($conn, $sql);
                
                // log in with existed account
                session_destroy();

                session_start();
                $_SESSION['id'] = $rowCheckSql['user_id'];
                $_SESSION['email'] = $rowCheckSql['user_email'];
                $_SESSION['user'] = true;

                // Get the current month
                $month = date('m', time());
                header("location:testing.php?");
            }
        }
    }
?>