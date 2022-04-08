<?php
include("dbConnect.php");
include("action.php");
session_start();

$id = $_GET['id'];

// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM students WHERE id=$id");

while($student = mysqli_fetch_array($result))
{
    $fname = $student['fname'];
    $mname =$student['mname'];
    $lname =$student['lname'];
    $birthday =$student['birthday'];
    $age = $student['age'];
    $add1 =$student['address1'];
    $add2 =$student['address2'];
    $regCode =$student['region'];
    $cityCode =$student['city'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Student</title>
</head>
<link rel="stylesheet" type="text/css" href="sideStyle.css">
<link rel="stylesheet" type="text/css" href="blockStyle.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


<body>
    <div class="sidenav">
        <a href="index.php">SIMPLE CRUD</a>
        <p id="error_check"></p>
    </div>

    <div class="main">
        <div class = "block">
            <div class = "block-header">Update Student</div>
            <div class = "block-content-1">
            <form action="create.php" method="post" name="profile-form">
                <div class ="form-group row">
                    <div class = "field">
                        <label for="fname">First Name</label><br>
                        <input class = "input-control" type="text" name="fname" value = "<?php echo $fname;?>"" required>
                    </div>
                    <div class = "field">
                        <label for="middlename">Middle Name</label><br>
                        <input class = "input-control" type="text" name="mname" value = "<?php echo $mname;?>"" required>
                    </div>
                    <div class = "field">
                        <label for="lastname">Last Name</label><br>
                        <input class = "input-control" type="text" name="lname" value = "<?php echo $lname;?>"" required>
                    </div>
                </div>
                <div class = "form-group row">
                    <div class = "field">
                        <label for="bday">Birthday</label><br>
                        <input class = "input-control" type = "date" name="bday" id="bday" value = "<?php echo $birthday;?>" required>
                    </div>
                    <div class = "field-1">
                        <label for="age">Age</label><br>
                        <input class = "input-control" type = "text" name="age" id="age" value = "<?php echo $age;?>" disabled>

                    </div>
                </div>
                <div class = "form-group">
                    <div style = "margin-bottom: 25px;" class = "field-2">
                        <label for="add1">Address 1</label><br>
                        <input class = "input-control-1" type="text" name="add1" value = "<?php echo $add1;?>" required>
                    </div>
                    <div class = "field-2">
                        <label for="add2">Address 2</label><br>
                        <input class = "input-control-1" type="text" name="add2" value = "<?php echo $add2;?>" required>
                    </div>
                </div>
                <div class = "form-group row">
                    <div class = "field-3">
                        <label for="region">Region</label><br>
                        <select class = "input-control-2" name="region" id="region" value = "<?php echo $regCode;?>" required>
                            <option value = "" selected hidden>--- SELECT PROVINCE ---</option>
                        <?php
                            $regresult = mysqli_query($mysqli, "SELECT * FROM regions");
                            while ($region = $regresult->fetch_assoc()){
                                if($regCode == $region['regCode']){
                                    echo "<option value=\"".$region['regCode']."\" selected>".$region['regDesc']. "</option>";
                                } else{
                                    echo "<option value=\"".$region['regCode']."\">".$region['regDesc']. "</option>";    
                                }
                            }
                        ?>
                        </select>
                    </div>
                    <div class = "field-4">
                        <label for="city">Province</label><br>
                        <select class = "input-control-2" name="city" id="city" required>
                            <?php
                                $cityresult = mysqli_query($mysqli, "SELECT * FROM cities WHERE regCode =".$regCode);
                                while ($city = $cityresult->fetch_assoc()){
                                    if($cityCode == $city['cityCode']){
                                        echo "<option value=\"".$city['cityCode']."\" selected>".$city['cityDesc']. "</option>";
                                    } else{
                                        echo "<option value=\"".$city['cityCode']."\">".$city['cityDesc']. "</option>";    
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class = "btn-align">
                    <input type="hidden" name="id" value=<?php echo $id;?>>
                    <input class="button1" type="submit" name="update" onclick="alert('Student Successfully Updated!')" value="Update">
                    <a href="index.php"><input class="button4" type="button" name="cancel" value="Cancel"></a>
                </div>
            </form>
            </div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    try{
        $(document).ready(function(){

            //function for getting the age based on birthday
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

            $("#region").on("click",function(){
                var checkCode = $("#city").val();
                if(checkCode != ""){
                    $("#city").val(checkCode);
                }

            //For dropdown of the city based on region
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
          });
    } catch(err){
        document.getElementById("error_check").innerHTML = err.message;
    }
</script>