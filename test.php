
<?php 
$query = "SELECT COUNT(*) as count FROM na_like_2023_03_28_15_04_32 where id='admin'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];
echo "Value: " . strval($count);
?>

