<?php
include "top_menu.php";
include "earnings.php";
$conn = new mysqli('localhost','root','iiitn','railway');
$sql = "select * from passenger";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<div style = "height: 340px;overflow:auto;
    border: 1px solid rgba(255, 255, 255, 0.555);
    border-radius: 10px;
    filter:blur(2);border-radius : 12px;">
<table cellpadding="0" cellspacing="0" border="0">
  <tbody>
    <tr>
    <th> NAME</th>
    <th>AGE</th>
    <th>GENDER</th>
    <th>BALANCE</th>
    <th>SOURCE</th>
    <th>DESTINATION</th>
    <th>TRAIN NUMBER</th>
    <!-- <th>CANCEL</th> -->
    </tr>
    <?php
        while($row = mysqli_fetch_assoc($result)){
            ?>
             <tr> <td><?php echo $row['NAME']?></td>
            <td><?php echo $row['AGE']?></td>   
            <td><?php echo $row['GENDER']?></td> 
            <td><?php echo $row['balance']?></td>
            <?php
            $sql1 = "select * from train where TRAIN_NUMBER = ?";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param("i",$row['train_no']);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            $row1 = $result1->fetch_assoc();
            ?>
            <?php if(isset($row['train_no'])){?>
                <td><?php echo $row1['SOURCE']?></td>
            <td><?php echo $row1['DESTINATION']?></td>
            <td><?php echo $row['train_no']?></td>
           <?php }else{ ?>
            <td>NO BOOKING</td>
            <td>NO BOOKING</td>
            <td>NO BOOKING</td>
            <?php }?>
            
            <!-- <td>
    <form action="cancel_booking.php" method="post">
        <input type="hidden" value="" name="delete">
        <input type="submit" value="Cancel" name="Cancel">
    </form>
</td> -->
        </tr><?php
        }
        ?>
    </tbody>
</table><br>
</div>


    </form>