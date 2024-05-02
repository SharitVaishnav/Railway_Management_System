<?php 
    include "top_menu.php";
    $conn = new mysqli('localhost','root','iiitn','railway');
    $source = $_POST['source'];
    $dest = $_POST['dest'];
    $sql = "select * from train where SOURCE = ? and DESTINATION = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$source,$dest);
    $stmt->execute();
    $result = $stmt->get_result();
?>
<form action="book.php" method = 'post'>
  <div class="booking">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
        <tr>
        <th>TRAIN NAME</th>
        <th>SOURCE STATION</th>
        <th>DESTINATION STATION</th>
        <th>TRAIN NUMBER</th>
        <th>AVAILABLE SEATS</th>
        <th>COST</th>
        <th>BOOK</th>
        </tr>
        <?php
            while($row = mysqli_fetch_assoc($result)){
                ?>
                 <tr> <td><?php echo $row['TRAIN_NAME']?></td>
                <td><?php echo $row['SOURCE']?></td>   
                <td><?php echo $row['DESTINATION']?></td> 
                <td><?php echo $row['TRAIN_NUMBER']?></td>
                <td><?php echo $row['TOTAL_SEATS']?></td>
                <td><?php echo $row['cost']?></td>
                <td><input type="checkbox" name="book" id="" value="<?php echo $row['TRAIN_NUMBER']; ?>"></td>  
            </tr><?php
            }
            ?>
        </tbody>
    </table><br>
    <center><input type="submit" action = "book.php" method = "post" value = "book"></center>
  </div>
  
  
        </form>

