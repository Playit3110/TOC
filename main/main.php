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

function setMsgs($MSGS) {
	global $FILE;
	foreach($MSGS as $i=>$msg) {
		$MSGS[$i] = json_encode($msg, true);
	}
	$MSGS = implode("\n", $MSGS);
	file_put_contents($FILE["msg"], "$MSGS\n");
}
?>