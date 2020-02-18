<?php
    include("../main/cons/config.php");
    session_start();

    if(isset($_SESSION['user']))
    {
        $id=$_SESSION['id'];
        $email=$_SESSION['email'];

        if(isset($_POST['add-cat']))
        {
            $newCat = mysqli_real_escape_string($conn,$_POST['extra_cat']);
            $existedCat = false;

            //Check the new category that already exists or not 
            $sqlCat = "SELECT * from incomecat where income_categories_name='$newCat' and extra_cat_on_user_id in (0, '$id') ";
            $resultCat = mysqli_query($conn, $sqlCat);
            $rowCat = $resultCat->fetch_assoc();
            if($rowCat > 0){

                $existedCat = true;
            } else {

                $existedCat = false;
            }

            //Add new Categories
            if($existedCat == false){

                $addCat = "INSERT into incomecat (income_categories_id, income_categories_name, extra_cat_on_user_id) values (null, '$newCat', '$id') ";
                mysqli_query($conn, $addCat);
            }
            else {

                echo "That category already exists";
            }
        }

        if(isset($_POST['log-out']))
        {
            session_start(); 
            unset($_SESSION['user']); 
            header("location:signin.php");
        }
    }
?>
<html>
    <head>
        <title>Add Categories By Id</title>
    </head>
    <body>
        <h1>Add Categories By Id</h1>
        <form action="" method="POST">
            <input type="text" name="extra_cat"><br><br>
            <button type="submit" name="add-cat">Add Category</button>
            <button type="submit" name="log-out">Log Out</button>
        </form>

    </body>
</html>