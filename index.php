<?php
include_once(__DIR__."/main/main.php");

if(!session_id()) session_start();
if(!exists($_SESSION, "user"))
	header("Location: ./login/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat</title>
	<link rel="stylesheet" href="./main/CSS/style.css">
	<link rel="stylesheet" href="./main/CSS/dark.css">
</head>
<body>
	<iframe class="send" src="./main/pages/send.php" frameborder="0"></iframe>
	<iframe class="chat" src="./main/pages/chat.php?user=<?php echo $_SESSION["user"]["name"]; ?>" frameborder="0"></iframe>
</body>
</html>