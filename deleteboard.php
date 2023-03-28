<?php
    session_start();
    /* 공백 제거 */
    $id =  trim($_GET['id']);
    $ssid = trim($_GET['ssid']);
    /* */
    if($ssid === $id){
        $date =  $_GET['reg_date'];
        
        $connect = mysqli_connect("localhost", "root", "1234");
        $database = mysqli_select_db($connect,"snsdb");

        $board = "delete from board where reg_date='$date' and id='$id'";
        $board_result = mysqli_fetch_array(mysqli_query($connect, $board));

        $board = "drop table ".$ssid."_comment_".$date."";
        mysqli_query($connect, $board);
        $board = "drop table ".$ssid."_comnum_".$date."";
        mysqli_query($connect, $board);
        $board = "drop table ".$ssid."_like_".$date."";
        $return = mysqli_query($connect, $board);
        if($return){
            echo "<script> alert('삭제성공.');history.back();</script>";
        }
        else{
            echo "<script> alert('query실패.');history.back();</script>";
        }
    }else{
        echo "<script> alert('내가 게시한 게시물이 아닙니다.');history.back();</script>";
       
    }

    $value1 = $_GET['ssid'];
    $value2 = $_GET['id'];
    $value1 =  trim($value1);
    $value2 = trim($value2)

?>
