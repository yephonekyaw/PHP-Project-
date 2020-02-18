<?php   
    session_start();
    include("../main/cons/config.php");
    if(isset($_SESSION['user']))
    {
        $id=$_SESSION['id'];
        $email=$_SESSION['email'];
        $sql = "SELECT * FROM userinfo WHERE user_id='$id' ";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
            echo $row;
        }
    }
?>