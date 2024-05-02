<?php
// $_SESSION['admin_b'] = null;
include "top_menu.php";
if(isset($_POST['submit'])){
$id = $_POST['id'];
$pass = $_POST['pass'];
$conn = new mysqli('localhost','root','iiitn','railway');
if($conn->connect_error){
    echo "connection failed";
}
else{
    $sql = "select * from admin where id = ? and password = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$id,$pass);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $_SESSION['name'] = "ADMIN ID : ".$id;
            ?> <script>window.location.href = 'admin_home.php';</script>
        <?php
        }
    }
    else{
        $err = "invalid email/password";
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>
    

<div class = "loginform">
        <form action="admin.php" method = 'post'>
        <p>

</p>
<div class="form-floating">
<input type="text" class="form-control" id="name" name = "id">
<label for="name">ENTER ADMIN ID</label>
</div>
<p>

</p>
<div class="form-floating">
<input type="password" class="form-control" id="pass" name = "pass">
<label for="pass">PASSWORD</label>
</div><p>

</p>
            <center> <input type="submit" action = "admin.php" method = "post" id="" name = 'submit'></center>
        </form>
    </div>
    </body>
</html>
