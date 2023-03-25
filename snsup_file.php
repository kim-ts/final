<?php
    $name = $_FILES['upfile']['name'];  //webhard.php 에서 <input type="file" name="upfile">를 보면 upfile 이라는 이름으로 전달되어오기 때문에 앞의 괄호에는 그 파일을 읽겟다는 의미, 그중 name을 읽겟단뜻
    $tmp_name = $_FILES['upfile']['tmp_name']; //그중 tmp_name 을 읽겠단뜻
    $size = $_FILES['upfile']['size'];  // 그중 size를 읽겟단뜻

    if(preg_match("/.py|.sh|.php|.html/",$name)){  
        echo "<script>alert('지원하지 않는 형식의 파일입니다.!');history.back();</script>";
        exit;
    }

    $connect = mysqli_connect("localhost", "root", "1234");
    if(!$connect){
        echo "<script>alert('DB connect fail');history.back();</script>";
        exit;
    }

    $database = mysqli_select_db($connect,"snsdb");
    if(!$database){
        echo "<script>alert('Database select fail');history.back();</script>";
        echo mysqli_error($connect);
        exit;
    }
    
    session_start();
    //$sql = "insert into file set name='$name',
    //                             user= '$_SESSION[loginID]',
     //                            size='$size',
     //                            reg_date=now()";

    $sql = "insert into ".$_SESSION['loginID']."profile set id = '$_SESSION[loginID]' , file = '$name', reg_date=now()";

    $result = mysqli_query($connect, $sql);

    if($result){
        // insert 성공
        $move_result = move_uploaded_file($tmp_name, "./upload/$name");
        if($move_result){
            echo "<script>alert('upload success');history.back();</script>";

        }else{
            echo "<script>alert('upload fail \\n파일 업로드 실패:  ".$_FILES["upfile"]["error"]."');history.back();</script>";
        }
    }else{
        echo "<script>alert('insert fail');history.back();</script>";

        echo mysqli_error($connect);
    }

    mysqli_close($connect);
?>