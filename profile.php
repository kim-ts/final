<?php
  session_start();
  $id = $_SESSION['loginID'];
  $connect = mysqli_connect("localhost", "root", "kyokyo!@#3");
  $database = mysqli_select_db($connect,"home");
  $sql = "select * from member where id='$id'"; 
  $result = mysqli_fetch_array(mysqli_query($connect,$sql));
  $profile = $result['profile'];
  if($profile == ""){
      $profile = "asdf.jpg";
    }
  $countboard = 0;
  $countfollow = 0;
  $countfollower = 0;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Insta Kilogram</title>
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
    
	<style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css");
		/* Style for the menu on the left */
        .btn:active, .btn:focus {
            outline:none !important;
            box-shadow:none !important;}
		.menu {
			width: 16%;
			position: fixed;
			top: 0%;
			left: 0;
            border-right: 0.1px solid #b8b8b8;
			background-color: #ffffff;
			height: 100%;
            
		}

		/* Style for the scrolling feed of posts in the middle */
		      .feed {
            background-color: #ffffff;
			      width: 80%;
			      margin-left: 10%;
			      height: 100%;
			      overflow-y: scroll;       
		      }
        .feed {
            -ms-overflow-style: none; /* IE and Edge */
            scrollbar-width: none; /* Firefox */
            
        }
        .feed::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera*/
        }

		/* Style for individual posts in the feed */
		    .post {
		    	margin-left: 20%;
		    	padding: 10px;
		    	background-color: #fff;
		    	width: 100%;
		    	height: 250px;
		    	display: inline-block;
		    	vertical-align: top;
          left: 20%;
          border-bottom: 1px solid #a6a6a6;
		    }
        .logo{
            position: absolute;
            top: 8%;
            left: 40%;
            width: 100%;
            transform: translate(-50%, -50%);
            font-size: 25px;
            font-style: italic;
            padding-left: 22px;
            font-weight: 500;
            overflow: hidden;
        }
        .iconn{
            position: absolute;
            align-items: center;
            top: 12%;
            width: 100%;
            min-height: 10px;
            padding-left: 20px;
            overflow: hidden;
        }
        .icon-link {
              border-radius: 20px;
              left: 30%;
              width: 90%;
              color: black;
              display: inline-block;
              margin-top: 15px;
              padding-top: 10px;
              padding-bottom: 10px;
              overflow: hidden;
        }
        
        .icon-link:hover {
          background-color: #f5f5f5;
        }
        
        .icon-link i {
          margin-right: 20px;
        }
        
        .icon-link span {
          font-size: 20px;
        }
        .bi-house{
            font-size: 25px;
            line-height: 25px;
            color:rgb(0, 0, 0);
        }
        .bi-search{
            font-size: 25px;
            line-height: 25px;
            color:rgb(0, 0, 0);
        }
        .bi-plus-square{
            font-size: 25px;
            line-height: 25px;
            color:rgb(0, 0, 0);
        }
        .bi-person-circle{
            font-size: 25px;
            line-height: 25px;
            color:rgb(0, 0, 0);
        }
        .morelist{
            position: absolute;
            bottom: 3%;
            left: 10%;
        }
        .bi-list{
            color: #1c1c1c;
            font-size: x-large;
            font-weight: bolder;
            overflow: hidden;
            font-style: normal;
        }
        
        .cont{
          width: 100%;
          height: 100%;
          display: flex;
          flex-direction: row;
        }
        .lefttext{
          width: 200px;
          height: 200px;
          margin-left: 50px;
          margin-right: 50px;
        }
        .righttext{
          width: 500px;
          height: 200px;
          
        }
        .rt{
          width: 100%;
          height: 50px;
          font-size: 20px;
          margin-top: 20px;
        }
        .rm{
          width: 100%;
          height: 30px;
          margin-top: 10px;
          
          display: flex;
          flex-direction: row;
        }
        .rd{
          width: 100%;
          height: 40px;
          margin-top: 15px;
          font-weight: 700;
          
        }
        .rm-1{
          margin-right: 50px;
        }
        .rm-2{
          margin-right: 50px;
        }
        .rm-3{
          margin-right: 50px;
        }
	</style>

</head>
<body>
        
        <?php
        session_start();
        if($_SESSION['loginID'] !=""){
            $connect = mysqli_connect("localhost","root","kyokyo!@#3");
            mysqli_select_db($connect, "home");
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
                <img src="/upload/E53084D5-A27D-4271-A610-5C83B9B0E661.jpeg" alt="Button Image" style="max-width: 100%; max-height: 100%;" >
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
            <a href="#" class="icon-link">
                <i class="bi bi-plus-square"></i>
                <span>만들기</span>
            </a>
            <a href="profile.php" class="icon-link">
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
                    <form method="post" action="snslogin_proc.php">
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
		<div class="post">
      <div class="cont">
        <div class="lefttext">
          <button type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#imagemodal">
            <img src="/upload/<?php echo $profile; ?>" alt="Button Image" style="max-width: 100%; max-height: 100%;">
          </button>
        </div>
        <div class="righttext">
          <div class="rt">
            <?php echo $result['id']; ?>
          </div>
          <div class="rm">
            <div class="rm-1"><?php echo "게시물 ".$countboard; ?></div>
            <div class="rm-2"><?php echo "팔로워 ".$countfollower; ?></div>
            <div class="rm-3"><?php echo "팔로우 ".$countfollow; ?></div>
            
          </div>
          <div class="rd">
            <?php echo $result['nickname']; ?>
          </div>
        </div>
    </div>
  </div>
  <!-- 사진업로드 modal -->
    <div class="modal fade" id="imagemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">사진 업로드</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="snsup_file.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="upfile">파일 선택</label>
                      <input type="file" class="form-control-file" id="upfile" name="upfile">
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
</body>
</html>