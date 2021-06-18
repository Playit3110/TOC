<?php
function getColor() {
	$c = "";
	for($i = 0; $i < 3; $i++) {
		$c .= dechex(random_int(0, 255));
	}
	return $c;
}
?>