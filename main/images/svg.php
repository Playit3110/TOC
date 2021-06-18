<?php
$files = glob(__DIR__."/*.svg");
$l = array_key_last($files);
$svgs = "{\n";
foreach($files as $i=>$file) {
	$fname = pathinfo($file)["filename"];
	$svgs .= "\t\"$fname\": `".file_get_contents($file)."`";
	if($l !== $i) $svgs .= ",";
	$svgs .= "\n";
}
$svgs .= "}";
// var_dump($svgs);
// $svgs = json_encode($svgs);
echo $svgs;
?>