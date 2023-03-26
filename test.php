<?php
session_start();
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
    $id = "id = '".$row['id']."' || ";
}
$id = rtrim($id, '||');
/* */
if(!empty($id)) {
    $id = "|| ".$id;
    $id = rtrim($id, '|| ');
}
$sql = "select * from board where id='$_SESSION[loginID]' ".$id." order by reg_date desc";
echo $sql;
echo "<br>";
echo $friend ;
?>