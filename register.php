<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "src/Exception.php";
require "src/PHPMailer.php";
require "src/SMTP.php";

$name = $_POST['name'];
$gender = $_POST['gender'];
$pass = $_POST['pass'];
$age = $_POST['age'];
$email = $_POST['gmail'];
setcookie("name",$name,time() + 14800,"/","",0);
setcookie("gender",$gender,time() + 14800,"/","",0);
setcookie("pass",$pass,time() + 14800,"/","",0);
setcookie("age",$age,time() + 14800,"/","",0);
setcookie("gmail",$email,time() + 14800,"/","",0);


if(!isset($_POST['otpsubmit'])){
$mail = new PHPMailer(true);
$gmail= $_POST['gmail'];
$send_otp = random_int(100000,999999);
setcookie("sentotp",$send_otp,time() + 7200,"/","",0);
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'FROM';                     //SMTP username
    $mail->Password   = 'rlfs htov ddsu egxt';                               //SMTP password
    $mail->SMTPSecure =  PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('FROM', 'RAILWAY REGISTRATION');
    $mail->addAddress($gmail);     //Add a recipient             //Name is optional
    $mail->addReplyTo('FROM', 'Information');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'ONE MORE STEP FOR REGISTRATION';
    $mail->Body    = 'WELCOME'.$name.' TO INDIAN RAILWAYS <br>USE THE OTP : '.$send_otp.' TO REGISTER INTO RAILWAY';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
}
if(isset($_POST['otpsubmit'])){
    $otp = $_POST['otp'];
if($_COOKIE['sentotp'] == $otp){
    $name = $_COOKIE['name'];
    $gender = $_COOKIE['gender'];
    $pass =$_COOKIE['pass'];
    $age = $_COOKIE['age'];
    $email = $_COOKIE['gmail'];

$conn = new mysqli('localhost','root','iiitn','railway');
if($conn->connect_error){
    echo "connection failed";
}
else{
    $stmt = $conn->prepare("insert into passenger(name,age,gender,password,email,balance) values(?,?,?,?,?,0)");
    $stmt->bind_param("sisss",$name,$age,$gender,$pass,$email);
    $stmt->execute();
    $stmt->close();
    ?><script>window.location.href = 'index.php';</script>
<?php
    $conn->close();
}
}
else{
    $_SESSION['wrongotp'] = 1;
    ?><script>window.location.href = 'register.php';</script>
<?php
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>REGISTERATION</title>
    <style>
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
 @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
body{
  background: -webkit-linear-gradient(left, #25c481, #25b7c4);
  background: linear-gradient(to right, #25c481, #25b7c4);
  font-family: 'Roboto', sans-serif;
}
    </style>
</head>
<body>
<div class = 'loginform'>
    <form action="register.php" method = "post">
        <p>

        </p>
        <div class="form-floating">
  <input type="text" class="form-control" id="name" name = "otp">
  <label for="name">ENTER OTP</label>
</div>
        <p>
            
        </p>
        <center><input type="submit" name = "otpsubmit"></center>
    </form>
</div>
<?php if(isset($_SESSION['wrongotp'])){ ?>
        <center><p style = "color: red;">WRONG OTP!!! NEW OTP HAS SENT</p></center>
            <?php } ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>