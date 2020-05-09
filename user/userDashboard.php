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
$sql = "SELECT * FROM users WHERE usernameDB = '".$usernamePHP."' && passwordDB = '".$passwordPHP."';";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$n = $row['nameDB'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Home | Mother's Recipe Portal</title>
<link rel="stylesheet" href="../styles/style.css" />
<link rel="stylesheet" href="../styles/style2.css" />
<style>
h2 {
	margin-right: 2em;
	margin-bottom: 1em;
	float: right;
	font-family: Segoe UI Light;
	font-size: 2em;
	text-shadow: 0.01em 0.01em 0.1em #aaa;
}
#userProfile {
	text-decoration: none;
	color: #000;
}
#userProfile:hover {
	color: darkcyan;
}
.cards {
	position: absolute;
	z-index: 2;
	margin-top: 7em;
	margin-left: 5em;
}
.cards-a {
	z-index: 2;
	display: inline-block;
	width: 5em;
	height: 4em;
	text-align: center;
	vertical-align: middle;
	margin: 0 0 0 2em;
	background-color: #80c5c5;
	padding: 3em 0.5em 0em 0.5em;
	font-family: Segoe UI Light;
	font-size: 2em;
	color: #fff;
	text-decoration: none;
	border: 0.1em solid darkcyan;
	border-radius: 0.3em;
	transition: transform 0.5s;
}
.cards-a:hover {
	transform: scale(1.1,1.1);
}
</style>
</head>
<body>
<div class="header">
	<a class="logout" href="userLogout.php">Log Out</a>
	<h1>Mother's Recipe Portal</h1>
</div>
<?php echo '<h2>Welcome back, <a id="userProfile" href="userProfile.php?link='.$usernamePHP.'">' . explode(" ", $n)[0] . '!</h2>'; ?>
<div class="cards">
	<a class="cards-a" href="viewAllRecipes.php">Browse Recipes</a>
	<a class="cards-a" href="addNewRecipe.php">Add a new Recipe</a>
	<a class="cards-a" href="viewAuthors.php">View Contributors</a>
	<a class="cards-a" href="aboutUs.php"><br />About Us</a>
</div>
<img style="position: absolute; margin: 1em 0 0 1em; width: 50em; opacity: 0.33;" src="../img1.png" />
</body>
</html>
<?php
$conn->close();
?>