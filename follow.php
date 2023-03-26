<?php
    session_start();
  // 데이터베이스 연결 설정
  $host = "localhost";
  $username = "root";
  $password = "1234";
  $dbname = "snsdb";
  $connect = mysqli_connect($host, $username, $password, $dbname);

 
    $id = $_POST['id'];
  
    // id 값을 이용하여 팔로우 또는 언팔로우 처리하는 코드 작성
    $check_query = "SELECT * FROM ".$_SESSION['loginID']."_follow WHERE id='$id'";
    $check_result = mysqli_query($connect, $check_query);
    
    if(mysqli_num_rows($check_result) == 0) {
      // 팔로우 처리
      $followquery = "INSERT INTO ".$_SESSION['loginID']."_follow set id = '$id'";
      $followerquery = "INSERT INTO ".$id."_follower set id = '$_SESSION[loginID]'";
      $result = mysqli_query($connect, $followquery);
      mysqli_query($connect, $followerquery);
      if($result){
        echo "<script>
            alert('".$id."님을 팔로우 하였습니다.');
            location.href='/testhome.php';
        </script>";
        }
        else {
            echo "<script>
                alert('팔로우실패 ');
                history.back();
            </script>";
        }
    }
    else {
      // 언팔로우 처리
      $unfollowquery = "DELETE FROM ".$_SESSION['loginID']."_follow WHERE id='$id'";
      $unfollowerquery = "DELETE FROM ".$id."_follower where id = '$_SESSION[loginID]'";
      $result = mysqli_query($connect, $unfollowquery);
      mysqli_query($connect, $unfollowerquery);
      if($result){
            echo "<script>
                alert('".$id."님을 언팔로우 하였습니다.');
                location.href='/testhome.php';
            </script>";
        }
        else {
            echo "<script>
                alert('언팔로우실패');
                history.back();
            </script>";
        }
    }
  
  mysqli_close($connect);
 
?>
