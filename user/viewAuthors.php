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
$sql = "SELECT nameDB, emailDB, ageDB, genderDB, usernameDB, photoDB FROM users;";
$result = $conn->query($sql);
if($result->num_rows > 0) {
	echo '<table class="outer-table"><tr><td>';
	while ($row = $result->fetch_assoc()) {
		echo '<table class="inner-table">';
		if(strlen($row["photoDB"]) > 0)
			echo '<tr><td class="td-img"><center><a href="userProfile.php?link=' . $row["usernameDB"] . '"><img src="' . $row["photoDB"] . '" alt="' . $row["nameDB"] . '" /></a></center></td></tr>';
		else
			echo '<tr><td class="td-img"><center><a href="userProfile.php?link=' . $row["usernameDB"] .'"><div style="width: 10em; height: 10em; border-radius: 50%; background-color: #aaa;"></div></a></center></td></tr>';
		echo '<tr><td class="td-title"><center><a href="userProfile.php?link=' . $row["usernameDB"] . '">' . $row["nameDB"] . '</center></a></td></tr>';
		echo '<tr><td class="td-desc"><center>' . $row["genderDB"] . ', ' . $row["ageDB"] . '</center></td></tr>';
		echo '</center></table>';
	}
	echo '</table></tr></td>';
}
else {
	echo '<p style="position: absolute; font-family: Segoe UI Light; font-size: 3em; color: darkcyan; margin: 6em 0 0 1.25em;">No contributors yet.</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>View Contributors | Mother's Recipe Portal</title>
<link rel="stylesheet" href="../styles/style.css" />
<link rel="stylesheet" href="../styles/style2.css" />
<link rel="stylesheet" href="../styles/style3.css" />
<!--<link rel="stylesheet" href="../styles/style6.css" />-->
<style>
.outer-table {
	position: absolute;
	margin: 20em 0 0 5em;
}
.inner-table {
	position: relative;
	display: inline-block;
	box-shadow: 0 0 0.1em 0.1em #aaa;
	margin-left: 3em;
	margin-bottom: 2em;
}
td {
	padding: 0.5em;
	font-family: Segoe UI Light;
}
img {
	width: 10em;
	height: 10em;
	border-radius: 50%;
}
.td-title {
	font-size: 1.5em;
	color: darkcyan;
}
.td-desc {
	width: 11em;
}
a {
	text-decoration: none;
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
	<a href="viewAuthors.php" style="background-color: #aaa;" />Contributors</a>
	<a href="aboutUs.php" />About Us</a>
</div>
<h2>Browse all Contributors</h2>
</body>
</html>
<?php
$conn->close();
?>