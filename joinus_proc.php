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

    $sqlid = "select * from member where id='$id'"; 
    $resultid = mysqli_fetch_array(mysqli_query($connect,$sqlid));
    if($resultid['id'] == $id){
        echo "<script>
                alert('이미 있는 아이디입니다.');
                history.back();
            </script>";
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

    $createaccount = "call create_account_table('$id')";
    $accountfollow = "call create_account_follow('$id')";
    $accountfollower = "call create_account_follower('$id')";
    $followinserttrigger = "create trigger ".$id."_follow_insert_trigger after insert on ".$id."_follow for each row  update ".$id."_account set follow = follow + 1;";
    $followdeletetrigger = "create trigger ".$id."_follow_delete_trigger after delete on ".$id."_follow for each row  update ".$id."_account set follow = follow - 1;";
    $followerinserttrigger = "create trigger ".$id."_follower_insert_trigger after insert on ".$id."_follower for each row  update ".$id."_account set follower = follower + 1;";
    $followerdeletetrigger = "create trigger ".$id."_follower_delete_trigger after delete on ".$id."_follower for each row  update ".$id."_account set follower = follower - 1;";  

    $return = mysqli_query($connect,$sql);
    if($return){
                mysqli_query($connect,$createaccount);
                mysqli_query($connect,$accountfollow);
                mysqli_query($connect,$accountfollower);
                mysqli_query($connect,$followinserttrigger);
                mysqli_query($connect,$followdeletetrigger);
                mysqli_query($connect,$followerinserttrigger);
                $a = mysqli_query($connect,$followerdeletetrigger);
                if(!$a){
                    echo mysqli_error($connect);
                }else{

                
                echo "<script>
                        alert('회원가입 성공');
                        location.href='/';
                </script>";
                mysqli_query($connect,"call create_profile_table('$id')");
                mysqli_query($connect,"insert into ".$id."_account set follow=0;");
                }
    }else{
    echo "<script> alert('회원가입 실패 \\n관리자에게 문의하세요');  history.back(); </script>"; // php 내에서 스크립트작성할때 줄바꿈은 \\n 으로 \를 두번써줘야한다.
    }           
    mysqli_close($connect);
?>
    </body>
</html>