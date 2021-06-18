<?php
include_once(__DIR__."/../main.php");

// if(!session_id()) session_start();
// if(!exists($_SESSION, "user"))
// 	header("Location: ./login/");
if(exists($_GET, "user")) {
	$_SESSION["user"] = htmlspecialchars($_GET["user"]);
}

header("Connection: keep-alive");
set_time_limit(0);

if(ob_get_level() < 1) ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/style.css">
	<link rel="stylesheet" href="../CSS/chat.css">
	<link rel="stylesheet" href="../CSS/colors.php">
</head>
<body>
	<ul>
		<?php
		if(($h = fopen($FILE["msg"], "r"))) {
			$last = 0;
			while(true) {
				showMsgs($h, $last);

				// echo "<div>index: $i, last: $last, count: $MSGScount</div>";
				echo "\n";
				ob_flush();
				flush();
				if(connection_status() !== 0) {
					break;
					removeUser($_SESSION["user"]);
				}
				if($RELOAD > 0) sleep($RELOAD);
			}
			fclose($h);
		}
		?>
	</ul>
</body>
</html>