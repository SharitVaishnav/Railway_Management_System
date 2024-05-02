<?php
include "top_menu.php";

if(isset($_POST['submit'])){
    $conn = new mysqli('localhost','root','iiitn','railway');
    $conn->begin_transaction();
    $sql = "update passenger set balance = balance + ? where name = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is",$_POST['money'],$_SESSION['name']);
    $stmt->execute();
    $conn->commit();
    ?> <script>window.location.href = 'index.php';</script>
    <?php
}

?>

<div class = "loginform">
        <form action="addmoney.php" method = 'post'>
            <p>

            </p>
        <div class="form-floating">
        <input type="number" class="form-control" id="name" name = "money">
        <label for="name">ENTER AMOUNT</label>
</div><p>

</p>
            <center> <input type="submit" name = 'submit'></center>
        </form><br>
    </div>