

<?php
include "top_menu.php";
    $conn = new mysqli('localhost','root','iiitn','railway');
?>

    <div class = "loginform">
        <form action="booking.php" method = "post">
            <P>
                
            </P>
            <div class="form-floating">
  <input type="text" class="form-control" id="SOURCE" name = "source">
  <label for="SOURCE">ENTER SOURCE</label>
</div>
<P>

</P>
<div class="form-floating">
  <input type="text" class="form-control" id="DEST" name = "dest">
  <label for="DEST">ENTER DESTINATION</label>
</div>
            <p>
                
            </p>
            <center><input type="submit" id="" action = "booking.php" method = "post" name = 'submit'></center>
        </form>
    </div><p>

    </p>
    <?php
        if(isset($_SESSION["nobalance"])){
    if($_SESSION["nobalance"] == 1){?>
    <center><p style = "color : red"> <?php echo "NO SUFFICIENT BALANCE"; ?></p></center>
    <?php 
    $_SESSION["nobalance"] = 0;    
} 
  } ?>