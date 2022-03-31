<?php
include_once("dbConnect.php");

$id = $_GET['id'];

$result = mysqli_query($mysqli, "DELETE FROM students WHERE id=$id");

echo '<script language="javascript">';
echo 'alert("Record Deleted Successfully!")';
echo '</script>';

if($result){
	header("Location:index.php");
}
?>