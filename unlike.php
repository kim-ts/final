<?php
    session_start();
    $idpost = $_POST['id'];
    $regdatepost = $_POST['reg_date'];
    $connect = mysqli_connect("localhost", "root", "1234");
    $database = mysqli_select_db($connect,"snsdb");

    $query1 = "select * from ".$idpost."_like_".$regdatepost." where id='$_SESSION[loginID]'";
    $mysql1 = mysqli_fetch_array(mysqli_query($connect, $query1));

    $query = "delete from ".$idpost."_like_".$regdatepost." where id='$_SESSION[loginID]'";
    $mysql = mysqli_fetch_array(mysqli_query($connect, $query));

    
    echo $idpost;
    echo $regdatepost;
?>