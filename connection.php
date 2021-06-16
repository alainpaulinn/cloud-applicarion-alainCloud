<?php

    $con=mysqli_connect('localhost','root','','alaincloud');

    if(!$con)
    {
        die(' Please Check Your Connection'.mysqli_error($con));
    }
?>