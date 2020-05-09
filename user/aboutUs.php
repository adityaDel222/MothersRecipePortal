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
if(isset($_POST["submit"])) {
	$titlePHP = $_POST["title"];
	$descriptionPHP = $_POST["description"];
	$ingredientsPHP = $_POST["ingredients"];
	$processPHP = $_POST["process"];
	$tipsPHP = $_POST["tips"];
	$photoPHP = $_POST["photo"];
	$videoPHP = $_POST["video"];
	$sql = "INSERT INTO recipe (titleDB, descriptionDB, ingredientsDB, processDB, tipsDB, photoDB, videoDB, author) VALUES ('" . $titlePHP . "', '" . $descriptionPHP . "', '" . $ingredientsPHP . "', '" . $processPHP . "', '" . $tipsPHP . "', '" . $photoPHP . "', '" . $videoPHP . "', '" . $usernamePHP . "');";
	if ($conn->query($sql)) {
		echo "<script>alert('Recipe added successfully!');</script>";
	}
	else {
		echo "<script>alert('Error adding recipe: " . $conn->error . "');</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Add a new Recipe | Mother's Recipe Portal</title>
<link rel="stylesheet" href="../styles/style.css" />
<link rel="stylesheet" href="../styles/style2.css" />
<link rel="stylesheet" href="../styles/style3.css" />
<link rel="stylesheet" href="../styles/style4.css" />
<style>
p {
	margin-top: 1.5em;
	font-family: Segoe UI Light;
	color: darkcyan;
}
input, textarea {
	margin-top: 0.5em;
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
	<a href="aboutUs.php" style="background-color: #aaa;" />About Us</a>
</div>
<h2>About Us</h2>
<p style="font-size: 1.5em; color: #000; margin-left: 2.5em;">A Destination to Relish the Nostalgia of Home-made Food</p>
</body>
</html>
<?php
$conn->close();
?>