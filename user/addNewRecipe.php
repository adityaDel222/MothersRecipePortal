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
	<a href="addNewRecipe.php" style="background-color: #aaa;" />Add Recipe</a>
	<a href="viewAuthors.php" />Contributors</a>
	<a href="aboutUs.php" />About Us</a>
</div>
<h2>Add a new Recipe</h2>
<form action="" method="POST">
	<p>Give a title to your recipe</p>
	<input type="text" name="title" placeholder="Title" maxlength="30" required autofocus />

	<p>Describe about your recipe in a few words</p>
	<textarea style="height: 2em;" name="description" placeholder="Description" required></textarea>

	<p>List the ingredients for your recipe each separated with a comma ( , )</p>
	<input type="text" name="ingredients" placeholder="Ingredients" required />

	<p>Write the procedure for your recipe in a systematic ordered manner</p>
	<textarea name="process" placeholder="Process" required></textarea>
	<p>OR</p>
	<input type="file" name="uploadprocess" value="Upload" />

	<p>Do you have any tips or precautions that must be taken into account? Mention here<p>
	<textarea style="height: 2em;" name="tips" placeholder="Tips / Precautions"></textarea>

	<p>Paste a photo link to appeal to the viewers more about your recipe</p>
	<input type="text" name="photo" placeholder="Paste photo link (if any)" />

	<p>Paste a video link containing step-by-step process of making your recipe</p>
	<input type="text" name="video" placeholder="Paste video link (if any)" />

	<input style="margin: 1.5em 0 5em 0;" type="submit" name="submit" value="Submit" />
</form>
</body>
</html>
<?php
$conn->close();
?>