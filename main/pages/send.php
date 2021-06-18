<?php
if(!session_id()) session_start();
include_once(__DIR__."/../main.php");

if(!exists($_SESSION, "user"))
	header("Location: ./login/");

if(exists($_POST, "msg")) {
// if(exists($_POST, ["msg", "to"])) {
	$msg = array_merge($_POST, $_SESSION);
	addMsg($msg);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Send</title>
	<link rel="stylesheet" href="../CSS/style.css">
	<link rel="stylesheet" href="../CSS/send.css">
</head>
<body>
	<form class="send" action="send.php" method="POST">
		<label>
			<span>Message: </span>
			<input type="text" name="msg">
		</label>
		<!-- <label>
			<span>To: </span>
			<select name="to" id="to">
				<option value="All">All Users</option>
				<?php
				/* $USERS = getUsers();
				foreach($USERS as $user) {
				?>
				<option value="<?php echo $user["id"]; ?>"><?php echo $user["user"]; ?></option>
				<?php }*/ ?>
			</select>
		</label> -->
		<button type="submit">send</button>
	</form>
</body>
</html>