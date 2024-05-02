<?php
include "top_menu.php";
include "earnings.php";
if(isset($_POST['fadd'])){
    $conn = new mysqli('localhost','root','iiitn','railway');
    $sql2 = "insert into train values(?,?,?,?,?,?);";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("issisi",$_POST['tno'],$_POST['from'],$_POST['dest'],$_POST['seats'],$_POST['name'],$_POST['price']);
    $stmt2->execute();
    ?><script>window.location.href = 'admin_t.php';</script><?php
}


if(isset($_POST['tnumber'])){
    $tn = $_POST['tnumber'];
    $conn = new mysqli('localhost','root','iiitn','railway');
    $sql1 = "delete from train where TRAIN_NUMBER = ?;";
    $stmt = $conn->prepare($sql1);
    $stmt->bind_param("i",$tn);
    $stmt->execute();
}



$conn = new mysqli('localhost','root','iiitn','railway');
    $sql = "select * from train";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
?>

<div style = "width : 54%;height :420px;  position : absolute; right : 300px; top : 200px; 
    border: 1px solid rgba(255, 255, 255, 0.555);
    border-radius: 10px;
    filter:blur(2);border-radius : 12px;">
   <?php if(isset($_POST['add'])){ ?>
    <div class = "loginform" style = "position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); height : 415px ">
    <form action = "admin_t.php" method = "post">
            <p>
            </p>
        <div class="form-floating">
        <input type="number" class="form-control" id="name" name = "tno">
        <label for="name">ENTER TRAIN NO.</label>
</div>
            <p>
            </p>
        <div class="form-floating">
        <input type="text" class="form-control" id="name" name = "name">
        <label for="name">ENTER NAME</label>
</div>
            <p>
            </p>
        <div class="form-floating">
        <input type="text" class="form-control" id="name" name = "from">
        <label for="name">FROM</label>
</div>
            <p>
            </p>
        <div class="form-floating">
        <input type="text" class="form-control" id="name" name = "dest">
        <label for="name">TO DESTINATION</label>
</div>
            <p>
            </p>
            <div class="form-floating">
        <input type="number" class="form-control" id="name" name = "price">
        <label for="name">PRICE OF TICKET</label>
</div><p>
</p>
        <div class="form-floating">
        <input type="text" class="form-control" id="name" name = "seats">
        <label for="name">SEATS</label>
</div><P>

</P>
<center><input type="submit" value = "add" name = "fadd"></center>
    </form>    

   <?php }
    else{ ?>
        <h1>TRAINS
    </h1>
   <div style = "height: 340px;overflow:auto;
    border: 1px solid rgba(255, 255, 255, 0.555);
    border-radius: 10px;
    filter:blur(2);border-radius : 12px;">
    <table>
        <tr>
        <th>TRAIN NAME</th>
        <th>SOURCE STATION</th>
        <th>DESTINATION STATION</th>
        <th>TRAIN NUMBER</th>
        <th>AVAILABLE SEATS</th>
        <th>COST</th>
        <th>REMOVE</th>
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
                <td><form method = "post" action = "admin_t.php"><input type="hidden" value = "<?php echo $row['TRAIN_NUMBER']; ?>" name = "tnumber"><input type="submit" action = "admin_t.php" method = "post" value = "remove" name = "remove"></form></td>  
            </tr><?php
            }
            ?>
    </table>
    <p>

    </p>
    </form>
</div> 
<form action = "admin_t.php" method = "post">
            <center><input type="submit" value = "ADD TRAIN" name = "add"></center>
            <?php } ?>
</div>