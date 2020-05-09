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
$recipeIDPHP = $_GET['link'];
$sql = "SELECT idDB, titleDB, descriptionDB, ingredientsDB, processDB, tipsDB, photoDB, videoDB, author FROM recipe WHERE idDB = " . $recipeIDPHP . ";";
if($result = $conn->query($sql)) {
	$row = $result->fetch_assoc();
	$titlePHP = $row['titleDB'];
	$descriptionPHP = $row['descriptionDB'];
	$ingredientsPHP = $row['ingredientsDB'];
	$ingListPHP = explode (",", $ingredientsPHP);
	$processPHP = $row['processDB'];
	$processListPHP = explode("\n", $processPHP); 
	$tipsPHP = $row['tipsDB'];
	$photoPHP = $row['photoDB'];
	$videoPHP = $row['videoDB'];
	$authorPHP = $row['author'];
}
else {
	echo '<p>No recipes found</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title><!--RECIPE--> | Mother's Recipe Portal</title>
<link rel="stylesheet" href="../styles/style.css" />
<link rel="stylesheet" href="../styles/style2.css" />
<link rel="stylesheet" href="../styles/style3.css" />
<!--<link rel="stylesheet" href="../styles/style6.css" />-->
<style>
body {
	background-image: url('<?php echo $photoPHP; ?>');
}
h2 {
	margin-left: 0;
	text-align: center;
}
p, li {
	font-family: Segoe UI Light;
	font-size: 1.5em;
}
hr {
	width: 50%;
}
.content {
	margin: 2em 0 0 20em;
	padding: 2em;
	background-color: #fff;
	width: 50%;
	box-shadow: 0 0 0.25em 0.25em #aaa;
}
.author-username {
	text-decoration: none;
	color: #000;
}
.author-username:hover {
	color: darkcyan;
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
<div class="content">
<h2><?php echo $titlePHP; ?></h2>
<p style="text-align: center;"><?php echo $descriptionPHP; ?></p>
<hr />
<p style="text-align: center; font-size: 1em;">by <a class="author-username" href="userProfile.php?link=<?php echo $row["author"]; ?>"><?php echo $authorPHP; ?></a></p>
<p style="color: darkcyan; text-align: center;">Ingredients</p>
<?php
echo '<ul>';
foreach($ingListPHP as $key => $value)
	echo '<li>' . $value . '</li>';
echo '</ul>';
?>
<p style="color: darkcyan; text-align: center;">Process</p>
<?php
echo '<ol>';
foreach($processListPHP as $key => $value)
	echo '<li>' . $value . '</li>';
echo '</ol>';
?>
<p style="color: darkcyan; text-align: center;">Video Tutorial</p>
<center><iframe width="560" height="315" src="<?php echo $videoPHP; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></center>
<p style="color: darkcyan; text-align: center;">Tips / Precautions</p>
<p><?php echo $tipsPHP; ?></p>
</div>
</body>
</html>
<?php
$pageTitle = $titlePHP;
$pageContents = ob_get_contents ();
ob_end_clean ();
echo str_replace ('<!--RECIPE-->', $pageTitle, $pageContents);
?>