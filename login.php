<?php
include "top_menu.php";
if(isset($_POST['submit'])){
$name = $_POST['name'];
$pass = $_POST['pass'];

$conn = new mysqli('localhost','root','iiitn','railway');
    $sql = "select * from passenger where name = ? and password = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$name,$pass);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $_SESSION['admin_b'] = 1;
            $row = $result->fetch_assoc();
            $_SESSION['balance'] = $row['balance'];
            $_SESSION['name'] = $name;
            $_SESSION['pass'] = $pass;
            if(isset($row['train_no'])){
            $_SESSION['train'] = $row['train_no'];}
            $_SESSION['gmail'] = $row['email'];
            if(isset($_SESSION['train'])){
            $sql1 = "select * from train where TRAIN_NUMBER = ?;";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param("i",$row['train_no']);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            $row1= $result1->fetch_assoc();
            $_SESSION['tname'] = $row1['TRAIN_NAME'];
            $stmt1->close();
        }
        ?> <script>window.location.href = 'index.php';</script>
        <?php
            $stmt->close();
            $conn->close();
        }
        else{
            $_SESSION['wrongpass'] = 1;
            ?> <script>window.location.href = 'login.php';</script>
        <?php
        }
    }
    
}

?> 

<div class = "loginform">
        <form action="login.php" method = 'post'>
            <p>

            </p>
        <div class="form-floating">
        <input type="text" class="form-control" id="name" name = "name">
        <label for="name">ENTER NAME</label>
</div>
<p>

</p>
<div class="form-floating">
  <input type="password" class="form-control" id="pass" name = "pass">
  <label for="pass">PASSWORD</label>
</div><p>

</p>
            <center> <input type="submit" action = "login.php" method = "post" id="" name = 'submit'></center>
        </form><br>
    </div><br>
    <?php if(isset($_SESSION['wrongpass'])){ ?>
        <center><p style = "color: red;">WRONG ID/PASSWORD!!! TRY AGAIN</p></center>
            <?php } ?>

