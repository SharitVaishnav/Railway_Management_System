<?php

$conn = new mysqli('localhost','root','iiitn','railway');
$sql = "select * from earning;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$earning = $row['total'];

?>





<div style = "width : 10%; position : absolute; top : 130px;right : 50px; background-color : rgba(255, 255, 255, 0.555);
    border: 1px solid rgba(255, 255, 255, 0.555);
    border-radius: 10px;
    filter:blur(2);border-radius : 12px;" >
<center>Total Railway Earnings</center>
<center><?php echo $earning; ?></center>
</div>