<?php
session_start();
include "earnings.php";
$admini = 0;
if(isset($_SESSION['name']) && isset($_SESSION['balance'])){
  $conn= new mysqli("localhost","root","iiitn","railway");
  $sql = "select * from passenger where name = ?";
  $statement = $conn->prepare($sql);
  $statement->bind_param("s",$_SESSION['name']);
  $statement->execute();
  $result = $statement->get_result();
  $row = $result->fetch_assoc();
  $_SESSION['balance'] = $row['balance'];
  if(isset($_SESSION['admin_b'])){
    $admini = 1;
  }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Unicons CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Google Fonts Import Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #c1f7f5;
}
.nav-links{
    position: absolute;
    right : 100px;
    top : 13px;
  display: flex;
  align-items: center;
  background: #fff;
  padding: 20px 15px;
  border-radius: 12px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.2);
}
.nav-links li{
  list-style: none;
  margin: 0 12px;
}
.nav-links li a{
  position: relative;
  color: #333;
  font-size: 20px;
  font-weight: 500;
  padding: 6px 0;
  text-decoration: none;
}
.nav-links li a:before{
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  height: 3px;
  width: 0%;
  background: #34efdf;
  border-radius: 12px;
  transition: all 0.4s ease;
}
.nav-links li a:hover:before{
  width: 100%;
}
.nav-links li.center a:before{
  left: 50%;
  transform: translateX(-50%);
}
.nav-links li.upward a:before{
  width: 100%;
  bottom: -5px;
  opacity: 0;
}
.nav-links li.upward a:hover:before{
  bottom: 0px;
  opacity: 1;
}
.nav-links li.forward a:before{
  width: 100%;
  transform: scaleX(0);
  transform-origin: right;
  transition: transform 0.4s ease;
}
.nav-links li.forward a:hover:before{
  transform: scaleX(1);
  transform-origin: left;
}
.nav{
  display: flex;
  align-items: center;
  background: #4a98f7;
  padding: 20px 15px;
  border-radius: 12px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    height : 100px;
    width : 95%;
    
}
.logo{
    text-decoration : none;
    font-family: 'Poppins', sans-serif;
    font-size: 22px;
    font-weight: 500;
    color: #fff;
}

.profile{
    background-color: rgba(255, 255, 255, 0.555);
    border: 1px solid rgba(255, 255, 255, 0.555);
    border-radius: 10px;
    filter:blur(2);
    position : absolute;
    height : 480px;
    width : 250px;
    left : 40px;
    top : 160px;
    border-radius : 12px;
}

.loginform{
    background-color: rgba(255, 255, 255, 0.555);
    border: 1px solid rgba(255, 255, 255, 0.555);
    border-radius: 10px;
    filter:blur(2);
    position : absolute;
    top : 160px;
    height : 500px;
    width : 350px;
    display: flex;
    justify-content: center;
    border-radius : 12px;
}


h1{
  font-size: 30px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
}
.booking {
  position: absolute;
  overflow : auto;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

table {
  width: 800px;
  border-collapse: collapse;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

th,
td {
  padding: 15px;
  background-color: rgba(255,255,255,0.2);
  color: #fff;
}

th {
  text-align: left;
}

thead {
  th {
    background-color: #55608f;
  }
}

tbody {
  tr {
    &:hover {
      background-color: rgba(255,255,255,0.3);
    }
  }
  td {
    position: relative;
    &:hover {
      &:before {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: -9999px;
        bottom: -9999px;
        background-color: rgba(255,255,255,0.2);
        z-index: -1;
      }
    }
  }
}


/* demo styles */

@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
body{
  background: -webkit-linear-gradient(left, #25c481, #25b7c4);
  background: linear-gradient(to right, #25c481, #25b7c4);
  font-family: 'Roboto', sans-serif;
}
section{
  margin: 50px;
}


    </style>
    <title>INDIAN RAILWAY</title>
</head>
<body>
<nav class = "nav">
<h1><a href="index.php" class = "logo">INDIAN RAILWAYS</a></h1>
  <ul class="nav-links">
  <?php if(isset($_SESSION['name'])){?>
    <li class="center"><a href="booki.php">BOOK A TRAIN</a></li>
    <li class="upward"><a href="logout.php">LOGOUT</a></li>
  <?php } 
  else{?>
    <li><a href="admin.php">ADMIN</a></li>
    <li class="center"><a href="login.php">LOGIN</a></li>
    <li class="upward"><a href="regi.php">REGISTER</a></li>
    <li class="forward"><a href="login.php">BOOK A TRAIN</a></li>
    <?php }?>
  </ul>
</nav>

<div class = "profile">
    <p>
      
    </p>
<center><h1> WELCOME <br><b><?php if(isset($_SESSION['name'])){ ?><center><img src="9131529.png" alt="" style = "position : relative; top: 20px;height : 80px; width : 80px;"></center><br><?php echo $_SESSION['name'];} ?></b>  </h1></center>
       <center> <span > <h3>CURRENT BOOKING :<?php if(isset($_SESSION['train'])){echo $_SESSION['train']."    -"; ?><?php if(isset($_SESSION['tname'])){
            echo $_SESSION['tname'];} ?><p>
            </p>
            <?php
            }else{ echo "NO BOOKINGS YET";}?></h3> </span></center>
            <p>

            <?php if(isset($_SESSION['name']) && $admini == 1){
            if($_SESSION['balance'] >= 5000){ ?>
              <center><h5 style = "color : green"> <?php echo $_SESSION['balance']; ?></h5></center>
           <?php } ?>
           <?php if($_SESSION['balance'] >= 2000 && $_SESSION['balance'] < 5000){ ?>
            <center><h5 style = "color : yellow"> <?php echo $_SESSION['balance']; ?></h5></center>
           <?php } ?>
           <?php if($_SESSION['balance'] < 2000){ ?>
            <center> <h5 style = "color : red"> <?php echo $_SESSION['balance']; ?></h5></center>
           <?php } ?>
           <center><a href="addmoney.php"><button style = "border-radius : 5px; padding : 5px 10px; color : white; background-color : #496989;">ADD BALANCE</button></a></center><?php } ?>
            </p>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>