<?php
function countMsgs() {
	global $FILE;
	$lc = 0;
	if(($h = fopen($FILE["msg"], "r")) !== false) {
		while(!feof($h)) {
			$l = fgets($h);
			$lc++;
		}
	}
	return $lc;
}

function showMsgs(&$h, &$last) {
	global $FILE;
	$MSGScount = countMsgs();
	if($MSGScount < $last) $last = $MSGScount;

	$i = -1;
	while(($msg = fgets($h)) !== false) {
		$i++;
		if($i < $last || !exists($msg)) continue;

		$msg = format($msg, "decode");

		if($msg["type"] == "date") {
			$user = "date";
		} else {
			$user = (exists($msg, "user") && $msg["user"] == @$_SESSION["user"]) ? "me" : "cl";
		}
		?>
		<li id="msg<?php echo $i; ?>" class="<?php echo $user; ?>">
			<?php if($user == "date") { ?>
			<div class="datebox">
				<span class="msg"><?php echo date("Y-m-d", $msg["date"]); ?></span>
			</div>
			<?php } else { ?>
			<div class="msgbox <?php echo "$user _".hash("sha256", $msg["user"]); ?>">
				<img src="../images/arrow-down.svg" class="icon">
				<div class="msgbox1">
					<?php if($user == "cl") { ?>
					<div class="user">
						<?php echo $msg["user"]; ?>
					</div>
					<?php } ?>
					<div class="msgbox2">
						<div class="msg">
							<?php echo $msg["msg"]; ?>
						</div>
						<div class="timebox">
							<div class="time">
								<?php echo (exists($msg, "date") ? date("H:i", $msg["date"]) : "00:00"); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</li>
		<?php
		$last++;
	}

	fseek($h, 0);
}
?>