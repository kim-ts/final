<?php
    session_start();

    $content = $_POST['content'];



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

    $connect = mysqli_connect("localhost", "root", "");
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

    session_start();
    if($_SESSION['loginID'] == ""){
        $user = "not login";
    }else{
        $user = $_SESSION['loginID'];
    }

    $sql = "insert into wenti set
            content = '$content',
            user = '$user',
            reg_date = now()";

    

    $return = mysqli_query($connect,$sql);
    if($return){
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