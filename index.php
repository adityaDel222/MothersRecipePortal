<?php
session_start();
if(!empty($_SESSION)) {
	header("Location: user/userDashboard.php");
}
$host = "localhost";
$user = "root";
$pass = "";
$database = "iwp_project";
$conn = new mysqli($host, $user, $pass, $database) or die("Connection failed: %s\n".$conn->error);
if(isset($_POST["submit"])) {
	$usernamePHP = $_POST["username"];
	$passwordPHP = $_POST["password"];
	$passwordPHPhash = md5($passwordPHP);
	$sql = "SELECT usernameDB, passwordDB FROM users WHERE usernameDB = '".$usernamePHP."' && passwordDB = '".$passwordPHPhash."';";
	$result = $conn->query($sql);
	if($result->num_rows == 1) {
		$_SESSION['username'] = $usernamePHP;
		$_SESSION['password'] = $passwordPHPhash;
		header("Location: user/userDashboard.php");
	}
	else {
		echo '<script>alert("Incorrect username or password.");</script>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Mother's Recipe Portal | User Sign In</title>
<link rel="stylesheet" href="styles/style.css?<?php echo time(); ?>" />
<link rel="stylesheet" href="styles/style1.css?<?php echo time(); ?>" />
<style>
img {
	margin: 1em 0 0 1em;
	width: 50em;
	opacity: 0.33;
}
.slogan {
	margin: 4em 0 0 2em;
	font-family: Forte;
	font-size: 3em;
	width: 45%;
	color: #333;
	text-shadow: 0.01em 0.01em 0.1em #777;
	z-index: 2;
}
p {
	position: absolute;
	margin: 19em 0 0 43.5em;
	font-family: Segoe UI Light;
	font-size: 1.25em;
}
p a {
	text-decoration: none;
	color: #000;
}
p a:hover {
	color: darkcyan;
}
</style>
</head>
<body>
<div class="header">
	<!--<div class="top_links">
		<a href="index.php" style="margin-right: 2em; border-top: 0.2em solid #fff;">User</a>
		<a href="adminSignIn.php" style="margin-right: 5em;">Admin</a>
	</div>-->
	<h1>Mother's Recipe Portal</h1>
</div>
<p class="slogan">A Destination to Relish the Nostalgia of Home-made Food</p>
<form action="" method="POST">
	<h2>Sign in to your account</h2>
	<input type="text" name="username" placeholder="Username" required autofocus />
	<input type="password" name="password" placeholder="Password" required />
	<input type="submit" name="submit" value="Sign In" />
</form>
<p>Don't have an account? <a href="createAccount.php">Create one here.</a></p>
<img src="img1.png" />
</body>
</html>
<?php
$conn->close();
?>