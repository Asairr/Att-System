<?php 
$conn = mysqli_connect('localhost', 'root', '', 'Attendance');

if(!$conn){
	die("Connection failed: " . mysqli_connect_error());
}
