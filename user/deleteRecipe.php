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
$delRecipeIDPHP = $_GET['link1'];
$sql = 'DELETE FROM recipe WHERE idDb = ' . $delRecipeIDPHP . ';';
$result = $conn->query($sql);
header("Location: userProfile.php?link=".$usernamePHP);
?>