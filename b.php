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
        $connect = mysqli_connect("localhost", "root", "1234");
        $database = mysqli_select_db($connect,"snsdb");
        $sql = "select * from member where id='$id' and pass='$pass'"; 
        $result = mysqli_fetch_array(mysqli_query($connect,$sql));

        if($result){
            $sql1 = "call login_procedure('$id','$pass')"; 
            $result1 = mysqli_fetch_array(mysqli_query($connect,$sql1));
            if($result){
                
                session_start();
                $_SESSION['loginID'] = $id;
                $nickname = $result1['nickname'];
                echo "<script>
                        alert('".$nickname."으로 로그인하셨습니다.');
                        location.href='/testhome.php';
                    </script>";
            }
            else {
                echo "<script>
                        alert('비밀번호가 일치하지 않습니다.');
                         
                    </script>";
            }
        }
        else{
            echo "<script>
                    alert('존재하지 않는 아이디입니다.');
                    history.back();
                </script>";
        }
    ?>
</body>
</html>