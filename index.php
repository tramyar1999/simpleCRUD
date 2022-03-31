<?php
session_start();
include("dbConnect.php");

?>
<html>
<head>
    <title>Simple CRUD</title>
</head>
<link rel="stylesheet" type="text/css" href="css/sideStyle.css">
<link rel="stylesheet" type="text/css" href="css/blockStyle.css">
<link rel="stylesheet" type="text/css" href="css/tableStyle.css">
<body>
    <div class="sidenav">
      <a href="#.php">SIMPLE CRUD</a>
    </div>

    <div class="main">
        <div class="block">
            <div class="block-header">
                <div>Student List</div>
                <div class="btn-align">
                    <a href="create.php"><input class="button1" type="button" name="create" value="Add New Student"></a>
                </div>
            </div>
            <div class="block-content">
                <table id="students">
                    <tr>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Birthday</th>
                        <th>Age</th>
                        <th>Address 1</th>
                        <th>Address 2</th>
                        <th>Region</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $studList = mysqli_query($mysqli, "SELECT students.id, students.fname, students.mname, students.lname, students.birthday, students.age, students.address1, students.address2, regions.regDesc, cities.cityDesc FROM students INNER JOIN regions ON regions.regCode=students.region INNER JOIN cities ON cities.cityCode=students.city ORDER BY students.id");
                    while($student = $studList->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$student['fname']."</td>";
                        echo "<td>".$student['mname']."</td>";
                        echo "<td>".$student['lname']."</td>";
                        echo "<td>".$student['birthday']."</td>";
                        echo "<td>".$student['age']."</td>";
                        echo "<td>".$student['address1']."</td>";
                        echo "<td>".$student['address2']."</td>";
                        echo "<td>".$student['regDesc']."</td>";
                        echo "<td>".$student['cityDesc']."</td>";
                        echo "<td><div class = \"field-1 row\"><a href = 'update.php?id=$student[id]'><input class = \"button2\" type=\"button\" name=\"update\" value=\"Update\"></a>
                        <a href = 'delete.php?id=$student[id]' onclick=\"return confirm('Are you sure you want to delete this student record?');\"><input class = \"button3\" type=\"button\" name=\"delete\" value=\"Delete\"></a></div></td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>