<?php
    session_start();

    $number =  $_GET['no'];
    $userid = $_GET['id'];
    $connect = mysqli_connect("localhost", "root", "1234");
    $database = mysqli_select_db($connect,"snsdb");
    $board = "select * from board where no='$number'";
    $board_result = mysqli_fetch_array(mysqli_query($connect, $board));
    $reg_date = $board_result['reg_date'];
    $comnum = "insert into ".$userid."_comnum_".$reg_date." set id='$_SESSION[loginID]'"; 
    mysqli_query($connect,$comnum);
    $sql = "insert into ".$userid."_comment_".$reg_date." set id='$_SESSION[loginID]' ,  comm='$_POST[content]' , reg_date=now()"; 
    $result = mysqli_fetch_array(mysqli_query($connect,$sql));
    if(!$result){echo "<script>
            alert('댓글 등록 성공');
            location.href='/testhome.php';
        </script>";}else{
            echo "<script>
            alert('댓글 등록 실패');
            location.href='/testhome.php';
        </script>";
        }
?>