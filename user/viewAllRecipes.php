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
$sql = "SELECT idDB, titleDB, descriptionDB, photoDB FROM recipe;";
$result = $conn->query($sql);
$left = 0;
if($result->num_rows > 0) {
	echo '<table class="outer-table"><tr><td>';
	while ($row = $result->fetch_assoc()) {
		echo '<table class="inner-table">';
		if(strlen($row["photoDB"]) > 0)
			echo '<tr><td class="td-img"><a href="recipeProfile.php?link=' . $row["idDB"] . '"><img src="' . $row["photoDB"] . '" alt="' . $row["titleDB"] . '" /></a></td></tr>';
		else
			echo '<tr><td class="td-img"><a href="recipeProfile.php?link=' . $row["idDB"] .'"><div style="width: 13em; height: 12em; background-color: #aaa;"></div></a></td></tr>';
		echo '<tr><td class="td-title"><a href="recipeProfile.php?link=' . $row["idDB"] . '">' . $row["titleDB"] . '</a></td></tr>';
		echo '<tr><td class="td-desc">' . $row["descriptionDB"] . '</td></tr>';
		echo '</center></table>';
	}
	echo '</table></tr></td>';
}
else {
	echo '<p style="position: absolute; font-family: Segoe UI Light; font-size: 3em; color: darkcyan; margin: 6em 0 0 1.25em;">No recipes found.</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Browse all Recipes | Mother's Recipe Portal</title>
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
	width: 13em;
	height: 12em;
}
.td-title {
	font-size: 1.5em;
	color: darkcyan;
}
.td-desc {
	width: 13em;
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
	<a href="viewAllRecipes.php" style="background-color: #aaa;" />Browse Recipes</a>
	<a href="addNewRecipe.php" />Add Recipe</a>
	<a href="viewAuthors.php" />Contributors</a>
	<a href="aboutUs.php" />About Us</a>
</div>
<input type="text" name="search" placeholder="Search Recipe..." style="float: right; margin-right: 10em; margin-top: 3em; font-family: Segoe UI; font-size: 1em; padding: 0.5em; width: 20em;" />
<h2>Browse all Recipes</h2>
</body>
</html>
<?php
$conn->close();
?>