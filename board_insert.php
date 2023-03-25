<?php
    session_start();
    $now = date('Y_m_d_H_i_s');

    if($_FILES == ""){
        echo "<script>alert('사진없음');history.back();</script>";
        exit;
    }
    $name = $_FILES['chooseFile']['name'];  //webhard.php 에서 <input type="file" name="upfile">를 보면 upfile 이라는 이름으로 전달되어오기 때문에 앞의 괄호에는 그 파일을 읽겟다는 의미, 그중 name을 읽겟단뜻
    $tmp_name = $_FILES['chooseFile']['tmp_name']; //그중 tmp_name 을 읽겠단뜻

    if(preg_match("/.py|.sh|.php|.html/",$name)){  
        echo "<script>alert('지원하지 않는 형식의 파일입니다.!');history.back();</script>";
        exit;
    }

    $content = $_POST['content'];

    

    //if($_SERVER['HTTP_REFERER'] != "http://www.kyo.com/board.php"){
    //    echo "address not board! u r hakkk er!!";
    //    exit;
    //}

    // xss filter
    //$subject = str_replace("<script>","",$subject);   // <script> 라는 문자가 있다면 , 빈 공간으로 치환하라, $subject 에서
    //$content = str_replace("<script>","",$content);

    ///$subject = str_replace("<script","",$subject);  // html 은 <> 가 닫히기만하면되고 그안에는 여러 옵션들을 넣을 수 있으므로 <script > 처럼 >를 띄면 우회가능하므로 <script까지만 필터적용
    //$content = str_replace("<script","",$content);  // 대소문자를 섞으면 우회됨

    //$subject = preg_replace("/<script/i","",$subject);  // 패턴 지정해주는 함수 여기서 i 는 대소문자 구분 안한다는뜻
   // $content = preg_replace("/<script/i","",$content);  //<scr<scriptipt>  이런식으로 중간에 없어지는부분을 채워넣으면 우회가능하다.

    //$subject = str_replace("<","&lt",$subject);  // 모든태그와 위와같은 우회를 막기위해 인코딩값으로 바꿔주기
    //$content = str_replace("<","&lt",$content); 

    //$subject = strip_tags($subject,"<h1> <br>");    //모든 태그들을 없애는 명령어, 뒤에 " " 사이는 예외태그 설정이다.
    //$content = strip_tags($content,"<h1> <br>");

    //$subject = htmlspecialchars($subject);    //모든 태그들을 문자로 치환해주는 함수
    //$content = htmlspecialchars($content);

    $connect = mysqli_connect("localhost", "root", "1234");
    if(!$connect){
        echo "<script>
                        alert('DB connect fail');
                        history.back();
                </script>";
        exit;
    }

    $database = mysqli_select_db($connect, "snsdb");
    if(!$database){
        echo "<script>
                        alert('Database select fail');
                        history.back();
                </script>";
        exit;
    }

    
    if($_SESSION['loginID'] == ""){
        exit;
    }else{
        $id = $_SESSION['loginID'];
    }

    $sql = "insert into board set
            id = '$id',
            content = '$content',
            file = '$name',
            sum_like = 0,
            sum_comment = 0,
            reg_date = '$now'";

    $return = mysqli_query($connect,$sql);

    $createboardlike = "call create_boardlike_table('$id','$now')";
    $createboardcomum = "call create_boardcomnum_table('$id','$now')";
    $createboardcomment = "call create_comment_table('$id','$now')";
    $cominserttrigger = "create trigger ".$id.$now."_com_ins_t after insert on ".$id."_comnum_".$now." for each row  update board set sum_comment = sum_comment + 1;";
    $comdeltrigger = "create trigger ".$id.$now."_com_del_t after delete on ".$id."_comnum_".$now." for each row  update board set sum_comment = sum_comment - 1;";
    $likeinserttrigger = "create trigger ".$id.$now."_com_l_t after insert on ".$id."_like_".$now." for each row  update board set sum_like = sum_like + 1;";
    $likedeltrigger = "create trigger ".$id.$now."_com_d_t after delete on ".$id."_like_".$now." for each row  update board set sum_like = sum_like - 1;";

    if($return){
        $move_result = move_uploaded_file($tmp_name, "./upload/$name");
        mysqli_query($connect,$createboardlike);
        mysqli_query($connect,$createboardcomum);
        mysqli_query($connect,$createboardcomment);
        mysqli_query($connect,$cominserttrigger);
        mysqli_query($connect,$comdeltrigger);
        mysqli_query($connect,$likeinserttrigger);
        mysqli_query($connect,$likedeltrigger);
        echo "<script>
                        alert('글 등록 성공');
                        history.back();
                </script>";
    }else{
        echo "<script>
                        alert('글 등록 실패');
                        history.back();
                </script>";
        echo mysqli_error($connect);
    }
    
    mysqli_close($connect);
?>
<head>
    <style>
        body{
            background-color: skyblue;
        }
    </style>
</head>