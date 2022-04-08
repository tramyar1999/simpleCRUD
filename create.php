<?php
include("dbConnect.php");
include("action.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Simple CRUD</title>
</head>
<link rel="stylesheet" type="text/css" href="sideStyle.css">
<link rel="stylesheet" type="text/css" href="blockStyle.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<body>
    <div class="sidenav">
      <a href="index.php">SIMPLE CRUD</a>
    </div>

    <div class="main">
        <div class = "block">
            <div class = "block-header">Add New Student</div>
            <div class = "block-content-1">
            <form action="create.php" method="post" name="profile-form">
                <div class ="form-group row">
                    <div class = "field">
                        <label for="fname">First Name</label><br>
                        <input class = "input-control" type="text" name="fname" required>
                    </div>
                    <div class = "field">
                        <label for="middlename">Middle Name</label><br>
                        <input class = "input-control" type="text" name="mname" required>
                    </div>
                    <div class = "field">
                        <label for="lastname">Last Name</label><br>
                        <input class = "input-control" type="text" name="lname" required>
                    </div>
                </div>
                <div class = "form-group row">
                    <div class = "field">
                        <label for="bday">Birthday</label><br>
                        <input class = "input-control" type = "date" name="bday" id="bday" required>
                    </div>
                    <div class = "field-1">
                        <label for="age">Age</label><br>
                        <input class = "input-control" type = "text" name="age" id="age" required disabled>
                    </div>
                </div>
                <div class = "form-group">
                    <div style = "margin-bottom: 25px;" class = "field-2">
                        <label for="add1">Address 1</label><br>
                        <input class = "input-control-1" type="text" name="add1" required>
                    </div>
                    <div class = "field-2">
                        <label for="add2">Address 2</label><br>
                        <input class = "input-control-1" type="text" name="add2" required>
                    </div>
                </div>
                <div class = "form-group row">
                    <div class = "field-3">
                        <label for="region">Region</label><br>
                        <select class = "input-control-2" name="region" id="region" required>
                        <option value = "" selected hidden>--- SELECT REGION ---</option>
                        <?php
                            $regresult = mysqli_query($mysqli, "SELECT * FROM regions");
                            while ($region = $regresult->fetch_assoc()){
                                echo "<option value=\"".$region['regCode']."\">".$region['regDesc']. "</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class = "field-4">
                        <label for="city">City</label><br>
                        <select class = "input-control-2" name="city" id="city" required>
                            <option value = "" selected hidden>--- SELECT CITY ---</option>
                        </select>
                    </div>
                </div>
                <div class = "btn-align">   
                    <input class="button1" type="submit" name="create" onclick="alert('Student Successfully Added!')" value="Add">
                    <a href="index.php"><input class="button4" type="button" name="cancel" value="Cancel"></a>
                </div>
            </form>
            </div>
        </div>
    </div>
<p id="err"></p>
</body>
</html>

<script type="text/javascript">
  try{
    $(document).ready(function(){

    function getAge(dateString) {
        var today = new Date();
        var birthDate = new Date(dateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }

    // for Auto-age
    $("#bday").on("change",function(){
      var bday = $(this).val();
      $("#age").val(getAge(bday));
    });

    // Region dependent ajax
    $("#region").on("change",function(){
      var regCode = $(this).val();
      $.ajax({
        url :"action.php",
        type:"POST",
        cache:false,
        data:{regCode:regCode},
        success:function(data){
          $("#city").html(data);
        }
      });
    });
  
  });
  }catch(err){
    document.getElementById("err").innerHTML = err.message;
  }
</script>