<?php

$souce_code = "0011010111";
$result = "begin";

function build_b ($source, $pos) {
	$source = str_split($source);
	$source_temp = array_chunk($source, $pos, true);

	array_push($source_temp[0], "");

	if ($source_temp === null) $source_temp = "return null :(";

	return $source_temp;
}

$result = build_b($souce_code, 3);

print_r($result);
?>
<style>
	body {
		white-space: pre;
	}
</style>