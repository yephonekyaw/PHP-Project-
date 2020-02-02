<?php

    include("D:/xampp/htdocs/Shinn-Kya-Mal---Final-master/main/cons/config.php");
    if(isset($_POST['sign-in-submit']))
    {
        $user_email=mysqli_real_escape_string($conn, $_POST['user_email']);
        $user_passwrod=mysqli_real_escape_string($conn, $_POST['user_password']);
        
        if(empty($user_email) || empty($user_passwrod))
        {
            header("location: signinPage.php?login=empty");
        }
        else if(empty($user_email))
        {   
            header("location: signinPage.php?emial=empty");
        }
        else if(empty($user_passwrod))
        {
            header("location: signinPage.php?password=empty");
        }
        else
        {
            if(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $user_email))
            {
                $sql = "SELECT * FROM userinfo WHERE user_email=? ";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("location: signinPage.php?error=sqlerror");
                }
                else 
                {
                    mysqli_stmt_bind_param($stmt, "s", $user_email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    {
                        if($row = mysqli_fetch_assoc($result))
                        {
                            if($row['mail_confirmation'] == 1)
                            {
                                $pwdCheck = password_verify($user_passwrod, $row['user_password']);
                                if($pwdCheck == false)
                                {
                                    header("location: signinPage.php?error=wrongpassword");
                                }
                                else if($pwdCheck == true)
                                {
                                    session_start();
                                    $_SESSION['id'] = $row['user_id'];
                                    $_SESSION['email'] = $row['user_email'];
                                    $_SESSION['user'] = true;

                                    // Get the current month
                                    $month = date('m', time());
                                    header("location: incomeMainPage.php?month=$month");
                                }
                            }
                            else if($row['mail_confirmation'] == 0)
                            {
                                header("location: signinPage.php?error=noconfirm");
                            }
                        }
                        else 
                        {
                            header("location: signinPage.php?error=nouser");
                        }
                    }
                }
            }
            else
            {
                header("location: signinPage.php?email=invalid");
            }
        }
    }
?>