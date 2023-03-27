<?php
  session_start();
  $id = $_SESSION['loginID'];
  $connect = mysqli_connect("localhost", "root", "1234");
  $database = mysqli_select_db($connect,"snsdb");
  $sql = "select * from ".$id."profile order by reg_date desc"; 
  $result = mysqli_fetch_array(mysqli_query($connect,$sql));
  $profile = $result['file'];
  if($profile == ""){
      $profile = "defaultprofile.jpg";
    }
  $echo = 0;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home | Insta Kilogram</title>
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
            $sql_sidpro = "select * from member where id = '$_SESSION[loginID]'";
            $result_sidpro = mysqli_fetch_array(mysqli_query($connect, $sql_sidpro));
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


	<!-- The scrolling feed of posts in the middle -->
	<div class="feed">
		<!-- Example posts -->
		
        <div class="posttop">
			<?php  
                /* 팔로우 한 사람 가져오기 */
                $friend1 = "select * from ".$_SESSION['loginID']."_follow";
                $friendquery1 = mysqli_query($connect,$friend1);
                
                while($row1 = mysqli_fetch_array($friendquery1)){
                    $id1 = $row1['id'];
                
                $posttopfriend = "select * from ".$id1."profile order by reg_date desc"; 
                $posttopfriendquery = mysqli_fetch_array(mysqli_query($connect,$posttopfriend));
                $profiletim = $posttopfriendquery['file'];
                if($profiletim == ""){
                    $profiletim = "defaultprofile.jpg";
                }
            ?>
                <button type="button" class="btn btn-white" >
                    <a href="/profile.php?id=<?php echo $id1; ?>">
                        <div class="top-profile-image">
                        
                            <img src="/upload/<?php echo $profiletim; ?>" alt="Button Image" style="max-width: 100%; max-height: 100%;">
                        </div>
                    </a>
                </button>
            <?php }?>
		</div>
		
        <?php
            $connect = mysqli_connect("localhost","root","1234");
            if(!$connect){
                echo "dbms connect fail";
                exit;
            }
            mysqli_select_db($connect, "snsdb");
            /* 팔로우 한 사람 가져오기 */
            $friend = "select * from ".$_SESSION['loginID']."_follow";
            $friendquery = mysqli_query($connect,$friend);
            $id = '';
            while($row = mysqli_fetch_array($friendquery)){
                $id .= "id = '".$row['id']."' || ";
            }
            $id = rtrim($id, '||');
            if(!empty($id)) {
                $id = "|| ".$id;
                $id = rtrim($id, '|| ');
            }
            /* */

            $sql = "select * from board where id='$_SESSION[loginID]' ".$id." order by reg_date desc";
            $return = mysqli_query($connect, $sql);
            $sqltest = "select * from board where id='$_SESSION[loginID]' ".$id." order by reg_date desc";
            $testquery = mysqli_fetch_array(mysqli_query($connect, $sqltest));
            if($testquery['no'] == ""){
                $echo = 1;
            }
            $count = 0;
/*  while 문 시작    */
            while($result = mysqli_fetch_array($return)){
                $count++;
                $post_id = $result['no'];
                $i_name = "i_".$post_id;
                $j_name = "j_".$post_id;
                
                $idpost = $result['id'];
                $callprofile = "select * from ".$idpost."profile order by reg_date desc"; 
                    /* 프로필 사진 가져오기 */
                     $callprofilequery = mysqli_fetch_array(mysqli_query($connect,$callprofile));
                     $profileim = $callprofilequery['file'];
                     if($profile == ""){
                         $profile = "defaultprofile.jpg";
                        }
        ?>
		<div class="post">
            <div class="ppt" id="post_<?php echo $post_id; ?>">
                <div>
                    <button type="button" class="btn btn-white" >
                        <a href="/profile.php?id=<?php echo $idpost; ?>">
                        <div class="home-profile-image">
                            <img src="/upload/<?php echo $profileim; ?>" alt="Button Image" style="max-width: 100%; max-height: 100%;">
                        </div>
                        </a>
                    </button>
                    
                </div>
                <div class="pptr">
                    <p><?php echo $idpost; echo "<br>"; echo $result['reg_date'] ?> </p>
                </div>
            </div>
            <div class="ppm" id="post_<?php echo $post_id; ?>">
                <?php if($result['file'] != ''){
                    $image = $result['file'];
                }else{
                    $image = "defaultboardimage.jpg";
                }
                ?>
                <img src="/upload/<?php echo $image; ?>" alt="Button Image" style="max-width: 100%; max-height: 100%;">
            </div>
            <div class="ppd" id="post_<?php echo $post_id; ?>">
                <div class="heart">
                <button type="button" class="btn btn-white" data-post-id="<?php echo $result['no']; ?>">
                    <i class="bi bi-heart"></i>
                </button>
                </div>
                <div class="chat">
                    <button type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#chatingmodal" data-post-id="<?php echo $result['no']; ?>">
                        <i class="bi bi-chat"></i>
                    </button>
                </div>
                <div class="send">
                <button type="button" class="btn btn-white" data-post-id="<?php echo $result['no']; ?>">
                    <i class="bi bi-send"></i>
                </button>
                </div>
                <div id="pontinside" class="book">
                <button type="button" class="btn btn-white" data-post-id="<?php echo $result['no']; ?>">
                    <i class="bi bi-bookmark"></i>
                </button>
                </div>
            </div>
            <div class="ppdd" id="post_<?php echo $post_id; ?>">
                <div class="ppddtop">
                    <div class="likenum" id="post_<?php echo $post_id; ?>">
                        <?php  
                            $sum = "select * from board where no='$post_id'";
                            $sumresult = mysqli_fetch_array(mysqli_query($connect, $sum));
                            echo "좋아요 ".$sumresult['sum_like']."개";
                        ?>
                    </div>
                    <div class="commentnum" id="post_<?php echo $post_id; ?>">
                        <?php 
                            
                            echo "댓글 ".$sumresult['sum_comment']."개";
                        ?>
                    </div>
                </div>
                <div class="displaycontent">

                </div>
                <div class="comment">

                </div>
            </div>
        </div>
        <script>
            var <?php echo $i_name; ?> = 0;
            var <?php echo $j_name; ?> = 0;
            $('.btn-white[data-post-id="<?php echo $post_id; ?>"]').on('click', function() {
                var post_id = $(this).data('post-id');
                if($(this).find('.bi-heart').length > 0) {
                    <?php echo $i_name; ?> = 1;
                    $(this).find('.bi-heart').removeClass('bi-heart').addClass('bi-heart-fill');
                } else {
                    <?php echo $i_name; ?> = 0;
                    $(this).find('.bi-heart-fill').removeClass('bi-heart-fill').addClass('bi-heart');
                }
                if($(this).find('.bi-bookmark').length > 0) {
                    <?php echo $j_name; ?> = 1;
                    $(this).find('.bi-bookmark').removeClass('bi-bookmark').addClass('bi-bookmark-fill');
                } else {
                    <?php echo $j_name; ?> = 0;
                    $(this).find('.bi-bookmark-fill').removeClass('bi-bookmark-fill').addClass('bi-bookmark');
                }
            });
        </script>
            
            <?php if($echo == 1){
                ?>
                <div calss="posttop">
                    <div class="echo">
                        <p>게시물이 없습니다.</p>
                    </div>
                </div>
                <?php } ?>
            
            
            
        <!-- 댓글modal -->
        <div class="modal fade" id="chatingmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">댓글 입력</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="chat.php?no=<?php echo $result['no']; ?>&&id=<?php echo $idpost ?>" method="post">
                          <div class="mb-3">
                            <label for="message-text" class="col-form-label">댓글 내용:</label>
                            <textarea class="form-control" id="content" name="content" rows="6" required placeholder="내용을 입력하세요"></textarea>
                          </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">OK</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--    -->
        
        <?php    } ?><!-- while 문 끝 -->

    </div>
    
    <div class="sid">
        <div class="text">
            <div class="lefttext">
                <button type="button" class="btn btn-white">
                    <a href="/profile.php?id=<?php echo $_SESSION['loginID']; ?>">
                        <div class="home-left-profile-image">
                        <img src="/upload/<?php echo $profile; ?>" alt="Button Image" style="max-width: 100%; max-height: 100%;">
                        </div>
                    </a>
                </button>
            </div>
            <div class="righttext">
                <div class="rt">
                    <?php echo $result_sidpro['name']; ?>
                </div>
                <div class="rd">
                  <?php echo $result_sidpro['nickname']; ?>
                </div>
            </div>
        </div>
        <div class="under">
            <div class="under_top">
                <p>회원님을 위한 추천</p>
            </div>
            <?php 
                $connect = mysqli_connect("localhost","root","1234");
                $database = mysqli_select_db($connect,"snsdb");
                $member = "SELECT * FROM member ORDER BY RAND() LIMIT 5;"; 
                $memberquery = mysqli_query($connect,$member);
                

                while($row = mysqli_fetch_array($memberquery)){
                    $sql = "select * from ".$row['id']."profile order by reg_date desc"; 
                    $result_query = mysqli_query($connect,$sql); 
                    $fetch = mysqli_fetch_array($result_query);
                    $profile = $fetch['file'];
                    if($profile == ""){
                        $profile = "defaultprofile.jpg";
                    }
            ?>
                   
            <div class="un_text">
            <div class="un_lefttext">
                <button type="button" class="btn btn-white">
                    <a href="/profile.php?id=<?php echo $row['id']; ?>">
                        <div class="home-left-profile-image">
                            <img src="/upload/<?php echo $profile; ?>" alt="Button Image" style="max-width: 100%; max-height: 100%;">
                        </div>
                    </a>
                </button>
            </div>
            <div class="un_righttext">
                <div class="un_rt">
                    <?php echo $row['name']; ?>
                </div>
                <div class="un_rd">
                  <?php echo $row['nickname']; ?>
                </div>
            </div>
            <?php } ?>
        </div>
        </div>
    </div>
    
</body>