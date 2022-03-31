<?php
// Include the database connection file
include('dbConnect.php');

function getAge($bday){
    $dob = new DateTime($bday);
    $current = new DateTime(date('m.d.y'));
    if($dob > $current){
      return "Invalid Birthday! Please Enter your Correct Birthday!";
    }
    $age = $current->diff($dob);
    return "".$age->y;
  }

if(isset($_POST['regCode']) && !empty($_POST['regCode'])) {

    // Fetch Province based on Region Code;
    $result = mysqli_query($mysqli, "SELECT * FROM cities WHERE regCode = ".$_POST['regCode']);

    if ($result->num_rows > 0) {
    echo "<option value = '' selected hidden>--- SELECT CITY  ---</option>";
    while ($row = $result->fetch_assoc()) {
        echo '<option value="'.$row['cityCode'].'">'.$row['cityDesc'].'</option>';
    }
}
}

if(isset($_POST['create'])) {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $birthday = $_POST['bday'];
    $age = getAge($_POST['bday']);
    $add1 = $_POST['add1'];
    $add2 = $_POST['add2'];
    $regCode = $_POST['region'];
    $cityCode = $_POST['city'];

    // Insert student data into table
    $result = mysqli_query($mysqli, "INSERT INTO students(fname, mname, lname,birthday, age, address1, address2,region, city) VALUES('$fname', '$mname', '$lname','$birthday', '$age', '$add1', '$add2', '$regCode','$cityCode')");

    if($result){
        header("location: index.php");
    } else {
        echo "Unsuccessful";
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $birthday = $_POST['bday'];
    $age = getAge($_POST['bday']);
    $add1 = $_POST['add1'];
    $add2 = $_POST['add2'];
    $regCode = $_POST['region'];
    $cityCode = $_POST['city'];

 
    $result = mysqli_query($mysqli, "UPDATE students SET fname='$fname', mname='$mname', lname='$lname', birthday='$birthday', age='$age', address1 = '$add1', address2 = '$add2', region = '$regCode', city = '$cityCode' WHERE id=$id");

    if($result){
        $_SESSION['status']="SUCCESS";
        header("location: index.php");
    } else {
        echo "Unsuccessful";
    }
}

?>