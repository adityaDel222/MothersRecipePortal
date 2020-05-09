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
$userIDPHP = $_GET['link'];
$sql = "SELECT nameDB, emailDB, ageDB, genderDB, usernameDB, photoDB FROM users WHERE usernameDB = '" . $userIDPHP . "';";
if($result = $conn->query($sql)) {
	$row = $result->fetch_assoc();
	$namePHP = $row['nameDB'];
	$emailPHP = $row['emailDB'];
	$agePHP = $row['ageDB'];
	$genderPHP = $row['genderDB'];
	$photoPHP = $row['photoDB'];
}
else {
	echo '<p style="position: absolute; font-family: Segoe UI Light; font-size: 3em; color: darkcyan; margin: 6em 0 0 1.25em;">User does not exist.</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title><!--USER--> | Mother's Recipe Portal</title>
<link rel="stylesheet" href="../styles/style.css" />
<link rel="stylesheet" href="../styles/style2.css" />
<link rel="stylesheet" href="../styles/style3.css" />
<!--<link rel="stylesheet" href="../styles/style6.css" />-->
<style>
#recipeList {
	text-decoration: none;
	color: #333;
}
#recipeList:hover {
	color: darkcyan;
}
#deleteAccount {
	text-decoration: none;
	font-family: Segoe UI Light;
	color: #fff;
	background-color: #a00;
	padding: 1em;
	float: right;
	margin: 1em 38em 5em 0;
}
#deleteAccount:hover {
	box-shadow: 0.05em 0.05em 0.05em 0.05em #100;
}
</style>
</head>
<body>
<div class="header">
	<a class="logout" href="userLogout.php">Log Out</a>
	<h1>Mother's Recipe Portal</h1>
</div>
<div class="nav_bar">
	<a href="userDashboard.php" style="margin-left: 2.5em;" />Home</a>
	<a href="viewAllRecipes.php" />Browse Recipes</a>
	<a href="addNewRecipe.php" />Add Recipe</a>
	<a href="viewAuthors.php" />Contributors</a>
	<a href="aboutUs.php" />About Us</a>
</div>
<div style="margin-bottom: 5em;">
<center>
<?php
if($photoPHP != '')
	echo '<img style="border-radius: 50%; margin-top: 3em; width: 10em; height: 10em;" src="' . $photoPHP . '" />';
else
	echo '<div style="border-radius: 50%; background-color: #ccc; margin-top: 3em; width: 12%; height: 9em; box-shadow: 0.1em 0.1em 0.1em 0.1em #aaa;"></div>';
?>
<p style="font-family: Segoe UI; font-size: 3em; color: #333; margin: 0;"><?php echo $namePHP; ?></p>
<p style="font-family: Segoe UI; font-size: 1.25em; color: #555; margin: 0.5em;"><?php echo $userIDPHP; ?></p>
<hr style="width: 7%;" />
<p style="margin-bottom: 0.5em; font-family: Segoe UI Light; font-size: 1.5em; color: darkcyan;"><?php echo explode(" ", $namePHP)[0]; ?>'s Recipes</p>
</center>
<?php
$sql1 = 'SELECT idDB, titleDB, descriptionDB, photoDB FROM recipe WHERE author = "' . $userIDPHP . '";';
$result1 = $conn->query($sql1);
if($result1->num_rows > 0) {
	while($row1 = $result1->fetch_assoc()) {
		$idPHP = $row1['idDB'];
		$titlePHP = $row1['titleDB'];
		$descriptionPHP = $row1['descriptionDB'];
		$photoPHP = $row1['photoDB'];
		if($usernamePHP != $userIDPHP) {
			echo '<table style="margin-left: 20em;">';
			echo '<tr><td style="font-family: Segoe UI; font-size: 1.5em; background-color: #cce6e6; width: 30em; padding: 0.5em;"><a id="recipeList" href="recipeProfile.php?link=' . $idPHP . '">' . $titlePHP . '</a><a style="float: right;"></td></tr>';
			echo '<tr><td style="font-family: Segoe UI Light; font-size: 1em; color: #555;">' . $descriptionPHP . '</td></tr>';
			echo '</table>';
		}
		else {
			echo '<table style="margin-left: 20em;">';
			echo '<tr><td style="font-family: Segoe UI; font-size: 1.5em; background-color: #cce6e6; width: 30em; padding: 0.5em;"><a id="recipeList" href="recipeProfile.php?link=' . $idPHP . '">' . $titlePHP . '</a><a style="float: right;" href="deleteRecipe.php?link1='.$idPHP.'" name="deleteRecipe"><img src="deleteRecipe.png" style="width: 1em; margin-top: 0.2em;" /></a></td></tr>';
			echo '<tr><td style="font-family: Segoe UI Light; font-size: 1em; color: #555;">' . $descriptionPHP . '</td></tr>';
			echo '</table>';
		}
	}
}
else {
	if($genderPHP == 'Female')
		$pronoun = 'hers';
	else if($genderPHP == 'Male')
		$pronoun = 'his';
	else
		$pronoun = 'theirs';
	echo '<p style="text-align: center; font-family: Segoe UI Light; font-size: 1.5em;">' . explode(" ", $namePHP)[0] . ' currently doesn\'t have a recipe of ' . $pronoun . '.</p>';
}
if($usernamePHP == $userIDPHP) {
	echo '<a id="deleteAccount" href="deleteUser.php?link1=' . $usernamePHP . '">Delete Account</a>';
}
?>
</div>
</body>
</html>
<?php
$pageTitle = $namePHP;
$pageContents = ob_get_contents ();
ob_end_clean ();
echo str_replace ('<!--USER-->', $pageTitle, $pageContents);
?>