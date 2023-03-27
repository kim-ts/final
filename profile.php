<?php
  session_start();
  $id = $_GET['id'];
  $connect = mysqli_connect("localhost", "root", "1234");
  $database = mysqli_select_db($connect,"snsdb");
  $sql = "select * from ".$id."profile order by reg_date desc"; 
  $result = mysqli_fetch_array(mysqli_query($connect,$sql));
  $profile = $result['file'];
  if($profile == ""){
      $profile = "defaultprofile.jpg";
    }
  $counta = "select * from ".$id."_account";
  $countquery = mysqli_fetch_array(mysqli_query($connect,$counta));
  
  $board_count = "SELECT COUNT(*) as count FROM board where id='$id'";
  $board_count_query = mysqli_fetch_array(mysqli_query($connect,$board_count));
  $countboard = $board_count_query['count'];
  $countfollow = $countquery['follow'];
  $countfollower = $countquery['follower'];
  
  $callname = "select * from member where id = '$id'";
  $callnamequery = mysqli_fetch_array(mysqli_query($connect,$callname));
  $name = $callnamequery['name'];
  $nickname = $callnamequery['nickname'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile | Insta Kilogram</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
        <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-3e3T8hqGZhg9tBc48J0HYVTtH8oapWz0vEPJQ2tTZNqzZ8bnp+X1vjbYlhJGi/DCs/s8BwCnHzv+BAz06kmGJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-DpOqP7kJDkzIimdI0QK5TxoRUsVVGHdLJ+6V7Ov1iCG0z7GQveEUoTpBvI9WDWY/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
	

</head>
<body>
        
        <?php
        session_start();
        if($_SESSION['loginID'] !=""){
            $connect = mysqli_connect("localhost","root","1234");
            mysqli_select_db($connect, "snsdb");
            $sql = "select * from member where id = '$_SESSION[loginID]'";
            $result = mysqli_fetch_array(mysqli_query($connect, $sql));
        }
        else{
            exit();
        }
        ?>

	<!-- The menu on the left -->
	<div class="menu">
        <div class="logo">
          <button type="button" class="btn btn-white" >
            <a href="/testhome.php">
                <img src="/upload/logo.jpeg" alt="Button Image" style="max-width: 100%; max-height: 100%;" >
            </a>
          </button>
        </div>
        <div class="iconn">
            <a href="testhome.php" class="icon-link">
                <i class="bi bi-house"></i>
                <span>Home</span>
            </a>
            <a href="#" class="icon-link">
                <i class="bi bi-search"></i>
                <span>검색</span>
            </a>
            <a href="board.php" class="icon-link">
                <i class="bi bi-plus-square"></i>
                <span>만들기</span>
            </a>
            <a href="profile.php?id=<?php echo $_SESSION['loginID']; ?>" class="icon-link">
                <i class="bi bi-person-circle"></i>
                <span>프로필</span>
            </a>
        </div>
        <div class="morelist">
            <div class="btn-group dropup">
                <button type="button" id="morebtn" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i  class="bi bi-list"> 더 보기</i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="setting.html">설정<i class="bi bi-gear-fill"></i></a></li>
                    <li><a class="dropdown-item" href="save.html">저장됨 <i class="bi bi-bookmark"></i></a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#wentimodal">문제 신고<i class="bi bi-exclamation-square"></i></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">계정전환</a></li>
                    <li><a class="dropdown-item" href="snslogout.php">로그아웃</a></li>
                </ul>
              </div>
            
        </div>
	</div>
    <!-- 문제 신고 modal -->
    <div class="modal fade" id="wentimodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">문제 신고</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="wenti.php" method="post">
                  <div class="mb-3">
                    <textarea class="form-control" id="content" name="content" rows="6" required placeholder="내용을 입력하세요"></textarea>
                </div>
                <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">OK</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--  계정전환modal  -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">계정 전환</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input">
                    <form method="post" action="b.php">
                        <div class="form-group">
                            <!--<label for="id">아이디</label>-->
                            <input type="text" class="form-control" id="id" name="id" placeholder="아이디를 입력하세요">
                        </div>
                        <div class="form-group">
                            <!--<label for="pass">비밀번호</label>-->
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="비밀번호를 입력하세요">
                        </div>
                    
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">OK</button>
            </form>
            </div>
          </div>
        </div>
      </div>


	<!-- 프로필 상단 -->
	<div class="p_feed">
		<div class="p_post">
      <div class="cont">
        <div class="p_lefttext">
        <form action="snsup_file.php" method="post" enctype="multipart/form-data" id="upload-form">
          <div class="form-group">
          <?php if($_SESSION['loginID'] ==  $id = $_GET['id']){?>
            <label for="upfile">
                <div class="profile-image">
                  <img src="/upload/<?php echo $profile; ?>" alt="Button Image" style="max-width: 100%; max-height: 100%;">
                </div>
            </label>
            <input type="file" class="form-control-file" id="upfile" name="upfile" style="display: none;" onchange="submitForm()">
            <?php  }else{?>
                <div class="profile-image">
                  <img src="/upload/<?php echo $profile; ?>" alt="Button Image" style="max-width: 100%; max-height: 100%;">
                </div>
              <?php  }?>
          </div>
        </form>
        
        <script>
          function submitForm() {
            document.getElementById("upload-form").submit();
          }
        </script>
        
        </div>
        
        <div class="p_righttext">
          <div class="p_rt">
            <?php echo $name; ?>
          
          <div class="follow">
            <?php if($_SESSION['loginID'] != $id){ ?>
            <!-- 팔로우 버튼 -->
            <form method="post" action="follow.php">
              <?php
              echo '<input type="hidden" name="id" value="'.$id.'">';
              // 이미 팔로우한 상태인 경우
              $check_query = "SELECT * FROM ".$_SESSION['loginID']."_follow WHERE id='$id'";
              $check_result = mysqli_query($connect, $check_query);

              if(mysqli_num_rows($check_result) > 0) {
                echo '<button type="submit" name="follow" class="btn btn-blue" id="unfollow">언팔로우</button>';
              }
              else {
                echo '<button type="submit" name="follow" class="btn btn-white" id="unfollow">팔로우</button>';
              }
              ?>
            </form>
            <?php } ?>
          </div>
          </div>
            
          
          <div class="p_rm">
            <div class="rm-1"><?php echo "게시물 ".$countboard; ?></div>
            
            <div class="rm-2">
              <button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#followermodal" >
                <?php echo "팔로워 ".$countfollower; ?>
              </button>
            </div>
            <div class="rm-3">
              <button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#followmodal" >
                <?php echo "팔로우 ".$countfollow; ?>
              </button>
            </div>
          </div>
          <div class="p_rd">
            <?php echo $nickname; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="profile_under">

    </div>
  </div>
  <!-- 팔로워 목록 -->
      <div class="modal fade" id="followermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <?php
                
                 $followerid = "select * from ".$id."_follower order by no desc"; 
                 $followeridquery = mysqli_query($connect,$followerid); 
                 while($follower = mysqli_fetch_array($followeridquery)){
                echo $follower['id'] . '<br>';
                }?>
            </div>
          </div>
        </div>
      </div>
      <!-- 팔로우 목록 -->
      <div class="modal fade" id="followmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <?php
                
                 $followid = "select * from ".$id."_follow order by no desc"; 
                 $followidquery = mysqli_query($connect,$followid); 
                 while($follow = mysqli_fetch_array($followidquery)){
                echo $follow['id'] . '<br>';
                }?>
            </div>
          </div>
        </div>
      </div>
</body>
</html>