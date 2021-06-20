<?php
include_once(__DIR__."/../main.php");
header("Content-Type: text/css");

function theme($color) {
	$color = substr($color, 1);
	$color = str_split($color, 2);
	$weight = [0.299, 0.587, 0.114];
	foreach ($color as $i=>$c) {
		$color[$i] = hexdec($c) * $weight[$i];
	}
	$color = array_sum($color);
	$color /= 256;
	return $color;
}

$USERS = getUsers();
foreach($USERS as $user) {
	if($user["color"] == false) continue;
	// echo "/* ".theme($user["color"])." */\n";
?>
.msgbox._<?php echo hash("sha256", $user["name"]); ?> {
	background-color: <?php echo $user["color"]; ?>;
<?php
	if(theme($user["color"]) > 0.5) echo "\tcolor: black;\n";
?>
}

<?php } ?>