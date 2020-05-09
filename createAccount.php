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
	$namePHP = $_POST["name"];
	$emailPHP = $_POST["email"];
	$agePHP = $_POST["age"];
	$genderPHP = $_POST["gender"];
	$usernamePHP = $_POST["username"];
	$passwordPHP = $_POST["password"];
	$passwordPHP = md5($passwordPHP);
	$sql = "INSERT INTO users (nameDB, emailDB, ageDB, genderDB, usernameDB, passwordDB) VALUES ('" . $namePHP . "', '" . $emailPHP . "', '" . $agePHP . "', '" . $genderPHP . "', '" . $usernamePHP . "', '" . $passwordPHP . "');";
	if($result = $conn->query($sql)) {
		echo '<script>alert("Account created successfully!");</script>';
		$_SESSION['username'] = $usernamePHP;
		$_SESSION['password'] = $passwordPHP;
		header("Location: user/userDashboard.php");
	}
	else {
		echo '<script>alert("There was a problem creating your account.");</script>';
	}
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Mother's Recipe Portal | Create an Account</title>
<link rel="stylesheet" href="styles/style.css?<?php echo time(); ?>" />
<link rel="stylesheet" href="styles/style1.css?<?php echo time(); ?>" />
<style>
img {
	margin: 1em 0 0 1em;
	width: 50em;
	opacity: 0.5;
}
form {
	z-index: 1;
	background-color: #fff;
	position: absolute;
	margin: 2.5em 0 5em 28em;
	padding: 2.5em 5em;
	box-shadow: 0 0 0.5em 0.1em #aaa;
}
span {
	font-family: Segoe UI Light;
	font-size: 1.25em;	
	color: #555;
}
.age {
	margin-left: 1.25em;
}
select {
	margin-left: 1em;
	font-size: 1.25em;
	font-family: Segoe UI Light;
	padding: 0.25em;
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
		<a href="index.php" style="margin-right: 2em;">User</a>
		<a href="adminSignIn.html" style="margin-right: 5em; border-top: 0.2em solid #fff;">Admin</a>
	</div>-->
	<h1>Mother's Recipe Portal</h1>
</div>
<form action="" method="POST">
	<h2>Create an Account</h2>
	<input id="nameID" type="text" name="name" placeholder="Name" required autofocus />
	<input id="emailID" type="text" name="email" placeholder="Email" required />
	<span class="age">Age:</span>
	<select name="age">
		<option>Below 10</option>
		<option>1 - 15</option>
		<option>15 - 20</option>
		<option selected>20 - 25</option>
		<option>25 - 30</option>
		<option>Above 30</option>
	</select>
	<br /><br />
	<input style="display: inline-block; margin: 0 0.5em 0 1.5em;" type="radio" name="gender" value="Male" /><span>Male</span>
	<input style="display: inline-block; margin: 0 0.5em 0 0.5em;" type="radio" name="gender" value="Female" /><span>Female</span>
	<input style="display: inline-block; margin: 0 0.5em 0 0.5em;" type="radio" name="gender" value="Other" /><span>Other</span>
	<input id="usernameID" type="text" name="username" placeholder="Username" required />
	<input id="passwordID" type="password" name="password" placeholder="Password" required />
	<input type="submit" name="submit" value="Sign Up" />
<p style="font-family: Segoe UI Light; font-size: 1.25em;">Already have an account? <a href="index.php">Log in</a> instead.</p>
</form>
<img src="img1.png" />
</body>
</html>
<?php
$conn->close();
?>