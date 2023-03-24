<!DOCTYPE html>
<html>
    <head>
        <style>
            body{
                background-color: skyblue;
            }
        </style>
    </head>
    <body>
    <?php
    $id = $_POST['id'];
    $pass = $_POST['pass'];
    $pass_re = $_POST['pass_re'];
    $name = $_POST['name'];
    $nickname = $_POST['nickname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];

    $connect = mysqli_connect("localhost", "root", "1234");
    if(!$connect){
        echo "<script>
                        alert('DB connect fail');
                        history.back();
                </script>";
        
        echo mysqli_error($connect);
        exit;
    }

    $database = mysqli_select_db($connect,"snsdb");
    if(!$database){
        echo "<script>
                        alert('Database select fail');
                        history.back();
                </script>";
        echo mysqli_error($connect);
        exit;
    }

    $sql = "insert into member set
            id = '$id',
            pass = '$pass',
            name = '$name',
            nickname = '$nickname',
            mobile = '$mobile',
            email = '$email',
            reg_date = now()";

    

    $return = mysqli_query($connect,$sql);
    if($return){
                echo "<script>
                        alert('회원가입 성공');
                        location.href='/';
                </script>";

    }else{
    echo "<script> alert('회원가입 실패 \\n관리자에게 문의하세요');  history.back(); </script>"; // php 내에서 스크립트작성할때 줄바꿈은 \\n 으로 \를 두번써줘야한다.
    }           
    mysqli_close($connect);
?>
    </body>
</html>