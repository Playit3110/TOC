<?php
include_once(__DIR__."/../main/main.php");

if(!session_id()) session_start();
if(exists($_SESSION, "user"))
	header("Location: ../");

if(exists($_POST, "user")) {
	$name = htmlspecialchars($_POST["user"]);
	$_SESSION["user"] = $user;
	header("Location: ../");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="../main/CSS/style.css" />
	<link rel="stylesheet" href="../main/CSS/login.css" />
</head>
<body>
	<form class="login" action="." method="POST">
		<h1>Login</h1>
		<label for="user">Username: </label>
		<input type="text" name="user" id="user">
		<button type="submit">send</button>
	</form>
</body>
</html>