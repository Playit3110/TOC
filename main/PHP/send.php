<?php
function addMsg($msg, $action = "encode") {
	global $FILE;
	if($action !== "plain") {
		$MSGS = getMsgs();
		if(checkDay($MSGS)) {
			addMsg([
				"type" => "date"
			], "plain");
		}
		$msg["type"] = "user";
	}
	$msg["date"] = gmdate("Y-m-d\TH:i:s");

	if(!is_file($FILE["msg"])) touch($FILE["msg"]);
	if(($h = fopen($FILE["msg"], "a")) == true) {
		$msg = format($msg, $action);
		$msg = json_encode($msg, true);
		fwrite($h, "$msg\n");
		fclose($h);
	}
}

function checkDay($MSGS) {
	if(count($MSGS) < 1) return true;
	$msg = array_pop($MSGS);
	if(!is_array($msg)) $msg = json_decode($msg, true);
	if(strtotime($msg["date"]) < strtotime("today")) {
		$log = strtotime($msg["date"])." < ".strtotime("today");
		$log .= " = ".(strtotime($msg["date"]) < strtotime("today") ? "true" : "false");
		$log .= "\n";
		error_log(
			$log,
			3,
			__DIR__."/test.log"
		);
	}
	return strtotime($msg["date"]) < strtotime("today");
}

// function target($name) {

// }
?>