<?php
include_once(__DIR__."/conf.php");

function inc() {
	$files = glob(__DIR__."/PHP/*.php");
	foreach($files as $file) {
		include_once($file);
	}
}
inc();

function exists($vars, $keys = []) {
	if(!is_array($vars)) $vars = [$vars];
	if(count($vars) < 1) return false;
	if(!is_array($keys)) $keys = [$keys];
	if(count($keys) > 0) {
		foreach($keys as $key) {
			if(!empty($key) && !array_key_exists($key, $vars)) return false;
		}
	}
	foreach($vars as $k => $v) {
		if(!(isset($v) && !empty($v))) return false;
	}
	return true;
}


function format($msg, $action = "encode") {
	global $FORMATBL;
	if(!is_array($msg)) $msg = json_decode($msg, true);
	foreach($msg as $k=>$v) {
		if(!in_array($k, $FORMATBL) && $action == "encode") continue;
		switch($action) {
			case "plain":
				$v = htmlspecialchars($v);
				break;
			case "encode":
				$v = htmlspecialchars($v);
				$v = base64_encode($v);
				break;
			case "decode":
				if($k == "type") break;
				$v = ($k == "date" ? strtotime($v) : base64_decode($v));
				break;
		}
		$msg[$k] = $v;
	}
	return $msg;
}

/* === CHAT === */

function getMsgs() {
	global $FILE;
	$MSGS = @file_get_contents($FILE["msg"]);
	$MSGS = explode("\n", $MSGS);
	$MSGS = array_filter($MSGS);
	if(!is_array($MSGS)) $MSGS = [];
	foreach($MSGS as $i=>$msg) {
		$MSGS[$i] = json_decode($msg, true);
	}
	return $MSGS;
}

// function addMsg($msg, $action = "encode") {
// 	global $FILE;
// 	if($action !== "plain") {
// 		$MSGS = getMsgs();
// 		if(checkDay($MSGS)) {
// 			addMsg([
// 				"type" => "date"
// 			], "plain");
// 		}
// 		$msg["type"] = "user";
// 	}
// 	$msg["date"] = gmdate("Y-m-d\TH:i:s");

// 	if(!is_file($FILE["msg"])) touch($FILE["msg"]);
// 	if(($h = fopen($FILE["msg"], "a")) == true) {
// 		$msg = format($msg, $action);
// 		$msg = json_encode($msg, true);
// 		fwrite($h, "$msg\n");
// 		fclose($h);
// 	}
// }

function setMsgs($MSGS) {
	global $FILE;
	foreach($MSGS as $i=>$msg) {
		$MSGS[$i] = json_encode($msg, true);
	}
	$MSGS = implode("\n", $MSGS);
	file_put_contents($FILE["msg"], "$MSGS\n");
}

// function countMsgs() {
// 	global $FILE;
// 	$lc = 0;
// 	if(($h = fopen($FILE["msg"], "r")) !== false) {
// 		while(!feof($h)) {
// 			$l = fgets($h);
// 			$lc++;
// 		}
// 	}
// 	return $lc;
// }

/* === LOGIN === */

// function addUser($user) {
// 	global $FILE;
// 	if(($h = fopen($FILE["user"], "a")) !== false) {
// 		fclose($h);
// 	}
// }

// function checkUser($user) {
// 	global $FILE, $USERBL;
// 	if(($h = fopen($FILE["user"], "r")) !== false) {
// 		foreach($USERBL as $u) {
// 			if($u == $user) return false;
// 		}
// 	}
// 	return true;
// }

// function getColor() {
// 	$c = "";
// 	for($i = 0; $i < 3; $i++) {
// 		$c .= dechex(random_int(0, 255));
// 	}
// 	return $c;
// }

/* === SEND === */

// function checkDay($MSGS) {
// 	if(count($MSGS) < 1) return true;
// 	$msg = array_pop($MSGS);
// 	if(!is_array($msg)) $msg = json_decode($msg, true);
// 	if(strtotime($msg["date"]) < strtotime("today")) {
// 		$log = strtotime($msg["date"])." < ".strtotime("today");
// 		$log .= " = ".(strtotime($msg["date"]) < strtotime("today") ? "true" : "false");
// 		$log .= "\n";
// 		error_log(
// 			$log,
// 			3,
// 			__DIR__."/test.log"
// 		);
// 	}
// 	return strtotime($msg["date"]) < strtotime("today");
// }
?>