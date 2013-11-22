<?php
if (isset ($_POST["code"])) $code = $_POST ["code"];

$m = strlen($code);
// 1     2
// 2-4   3
// 5-11  4
// 12-26 5
// 27-57 6
if ($m>=27 && $m<=57) $k=6;
elseif ($m>=27 && $m<=57) $k=6;
elseif ($m>=12 && $m<=26) $k=5;
elseif ($m>=5 && $m<=11) $k=4;
elseif ($m>=2 && $m<=4) $k=3;
elseif ($m=1) $k=2;

/*
Pos 1: check 1 bit, skip 1 bit, check 1 bit, skip 1 bit, etc. (1,3,5,7,9,11,13,15,...)
Pos 2: check 2 bits, skip 2 bits, check 2 bits, skip 2 bits, etc. (2,3,6,7,10,11,14,15,...)
Pos 4: check 4 bits, skip 4 bits, check 4 bits, skip 4 bits, etc. (4,5,6,7,12,13,14,15,20,21,22,23,...)
Pos 8: check 8 bits, skip 8 bits, check 8 bits, skip 8 bits, etc. (8-15,24-31,40-47,...)
Pos 16: check 16 bits, skip 16 bits, check 16 bits, skip 16 bits, etc. (16-31,48-63,80-95,...)
Pos 32: check 32 bits, skip 32 bits, check 32 bits, skip 32 bits, etc. (32-63,96-127,160-191,...)
etc.
 */

$l= $m+$k;

for ($x=0; $x++<$l;) {
    $x_binary = base_convert($x, 10, 2) ;

	$x_binary = str_pad($x_binary, $k, "0", STR_PAD_LEFT);

    $table[] .= $x_binary;

    for ($i = 0; $i < $k; $i++) {

        $f = $x_binary[$i];

        $col[$i] .= $f;
    }
}

function calc_alpha($overStart) {
    global $l;
    $source = range(1, $l);
    $over = $overStart;
    for($i = $over; $i <= count($source); $i++) {
        if ($over > 0) {
            $dest[] = $i;
        }
        $over -= 1;
        if ($over == $overStart*(-1)) {$over = $overStart; }
    }
    return $dest;
}

$a1 = calc_alpha(1);
$a2 = calc_alpha(2);
$a3 = calc_alpha(4);
$a4 = calc_alpha(8);
$a5 = calc_alpha(16);

function build_b ($source, $pos) {

}

$array = array(
    "table" => $table,
    "alpha" => $array = array (
        "a1" => $a1,
        "a2" => $a2,
        "a3" => $a3,
        "a4" => $a4,
        "a5" => $a5
    ),
    "col" => $col,
);


echo json_encode($array);