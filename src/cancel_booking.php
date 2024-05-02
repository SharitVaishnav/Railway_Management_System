<?php
include "top_menu.php";
include "earnings.php";

$conn = new mysqli('localhost','root','iiitn','railway');
$sql = "update passenger set train_no = null where name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$_POST['delete']);
$stmt->execute();
?> <script>window.location.href = 'admin_p.php';</script>