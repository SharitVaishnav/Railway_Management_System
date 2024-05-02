<?php
include "top_menu.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "src/Exception.php";
require "src/PHPMailer.php";
require "src/SMTP.php";


$book = $_POST['book'];
$conn = new mysqli('localhost','root','iiitn','railway');


    $sql1 = "select * from train where TRAIN_NUMBER = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("i",$book);
    if($stmt1->execute()){
        $result4 = $stmt1->get_result();
        $row4 = $result4->fetch_assoc();
        if($row4['cost'] > $_SESSION['balance']){
            $_SESSION["nobalance"] = 1;
            ?> <script>window.location.href = 'booki.php';</script>
    <?php
        }
        else{
        $conn->begin_transaction();
        $sql = "update passenger set TRAIN_NO = ? where name = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is",$book,$_SESSION['name']);
        $p = 0;
        if($stmt->execute()){$p = 1;}
        $sql_t = "update passenger set balance = balance - ? where name = ?;";
        $sql_e = "update earning set total = total + ?";
        $stmt_t = $conn->prepare($sql_t);
        $stmt_e = $conn->prepare($sql_e);
        $stmt_t->bind_param("is",$row4['cost'],$_SESSION['name']);
        $stmt_e->bind_param("i",$row4['cost']);
        $stmt_e->execute();

        $stmt_t->execute();
        $conn->commit();

if($p == 1){
    $sql2 = "update train set TOTAL_SEATS = TOTAL_SEATS - 1 where TRAIN_NUMBER = ?;";
    $state = $conn->prepare($sql2);
    $state->bind_param("i",$book);
    $state->execute();
    $_SESSION['tname'] = $row4['TRAIN_NAME'];
    $_SESSION['train'] = $book;
    $TNAME = $_SESSION['tname'];
    $src = $row4['SOURCE'];
    $dest = $row4['DESTINATION'];



    $mail = new PHPMailer(true);
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
        $mail->setFrom('From', 'RAILWAY REGISTRATION');
        $mail->addAddress($_SESSION['gmail']);     //Add a recipient             //Name is optional
        $mail->addReplyTo('FROM', 'Information');
    
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'BOOKING DONE';
        $mail->Body    = 'WELCOME  <b>'.$name.'</b>  TO INDIAN RAILWAYS <br>YOUR BOOKING FROM  <b>'.$src.'</b>  TO  <b>'.$dest.'</b>  BY  <b>'.$TNAME.'</b>  TRAIN NUMBER =  <b>'.$book.'</b>  IS DONE VIA ONLINE BOOKING <br> <b>HAPPY JOURNEY </b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();

    }

    ?> <script>window.location.href = 'index.php';</script>
    <?php
   echo "<html></html>";  // - Tell the browser there the page is done
   flush();               // - Make sure all buffers are flushed
   ob_flush();            // - Make sure all buffers are flushed
   exit;
}
    }
?>