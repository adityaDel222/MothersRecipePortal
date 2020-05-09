<?php
session_start();
if(empty($_SESSION)) {
	header("Location: ../index.php");
}
$host = "localhost";
$user = "root";
$pass = "";
$database = "iwp_project";
$conn = new mysqli($host, $user, $pass, $database) or die("Connection failed: %s\n".$conn->error);
$usernamePHP = $_SESSION['username'];
$passwordPHP = $_SESSION['password'];
$delUserPHP = $_GET['link1'];
$sql = 'DELETE FROM users WHERE usernameDB = "' . $delUserPHP . '";';
if($result = $conn->query($sql)) {
	//echo '<script>alert("Account deleted successfully.");</script>';
	sleep(2);
	header("Location: userLogout.php");
}
?>