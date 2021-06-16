<?php
require_once('connection.php');
session_start();
    if(isset($_POST['Login']))
    {
       if(empty($_POST['UName']) || empty($_POST['Password']))
       {
            header("location: index.php?Empty= Please Fill in the Blanks");
       }
       else
       {
            $query="select * from `users_info` where username='".$_POST['UName']."' and password='".$_POST['Password']."'";
            $result=mysqli_query($con,$query);

            if(mysqli_fetch_assoc($result))
            {
                $_SESSION['User']=$_POST['UName'];
                header("location: ".$_POST['UName']);
            }
            else
            {
                header("location:index.php?Invalid= Please Enter Correct User Name and Password ");
            }
       }
    }
    elseif (isset($_POST['Register'])) {
        if(empty($_POST['UName']) || empty($_POST['Password']))
       {
            header("location: register.php?Empty= Please Fill in the Blanks");
       }
       else
       {
        $username = $_POST['UName'];
        $password = $_POST['Password'];
        $directory = $username."/index.php";
            $checkquery = "SELECT `id`, `username`, `password`, `directory` FROM `users_info` WHERE `username`='".$_POST['UName']."'";
            $checkresult=mysqli_query($con,$checkquery);
            if(!mysqli_num_rows($checkresult) > 0){

                $sendquery="INSERT INTO `users_info`(`username`, `password`, `directory`) VALUES ('$username','$password','$directory')";
                if(mysqli_query($con,$sendquery)){
                    mkdir($username);
                    if(copy("admin/index.php", $directory)){
                        header("location:index.php?Invalid= Account successfully created! Login ");
                    }
                }

            }
            else {
                header("location:index.php?Invalid= Username already taken ");
            }
       }
    }
    elseif (isset($_POST['Logout'])){
        unset($_SESSION['User']);
        header("location:index.php?Invalid= Logged out Successfully ");
    }
    else
    {
        echo 'Not Working Now Guys';
    }

?>