<?php

include "top_menu.php";?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>REGISTER</title>
</head>
<body>
    <div class = "loginform">
        <form action="register.php" method = 'post'>
            <p>

            </p>
        <div class="form-floating">
  <input type="text" class="form-control" id="name" name = "name">
  <label for="name">ENTER NAME</label>
</div><p>

</p>
            
            <div class="form-floating">
  <input type="number" class="form-control" id="AGE" name = "age">
  <label for="AGE">ENTER AGE</label>
</div>
            <p>

            </p>
            <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="M" name = "gender">
  <label class="form-check-label" for="inlineCheckbox1">MALE</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="F" name = "gender">
  <label class="form-check-label" for="inlineCheckbox2">FEMALE</label>
</div><p>

</p>
            <div class="form-floating">
  <input type="password" class="form-control" id="pass" name = "pass">
  <label for="pass">ENTER PASSWORD</label>
</div>
            <br>
            <div class="form-floating">
  <input type="text" class="form-control" id="mail" name = "gmail">
  <label for="mail">ENTER EMAIL</label>
</div><p>

</p>
            <center><input type="submit" action = "register.php" method = "post" id="" name = "regisubmit"></center>
        </form>
    </div>
</body>
</html>