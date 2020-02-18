<?php

    session_start();
    include("../main/cons/config.php");
    if(isset($_SESSION['user']))
    {
        $id=$_SESSION['id'];
        $email=$_SESSION['email'];
        $sql = "SELECT * FROM userinfo WHERE user_id='$id' ";
        $result = mysqli_query($conn, $sql);
        
        echo $id;
    }
    if(isset($_POST['logout']))
    {
        header("location:../FacebookLogin/logout.php");
    }   
?>

<html>
    <form action="" method="POST">
        <input type="submit" value="Log Out" name="logout">
    </form>
</html>