<?php
$input = 111000;
$opsi = 'Bayar Listrik';

if ($opsi === 'Bayar Listrik') {
    $i = 50000;
    $j = 100000;
    $kelipatan = 2000;
    $p1 = 1;
    $p2 = 2;
} else {
    $i = 10000;
    $j = 30000;
    $kelipatan = 1000;
    $p1 = 1;
    $p2 = 2;
}

if ($input<=$i) {
    $x = 0;
}
if ($input>$i && $input<=$j) {
    $a = $input - $i;
    $x = ($a / $kelipatan)*$p1;
}
if ($input>$j) {
    $b = $input-$j;
    $x = ($b / $kelipatan * $p2) + ($j-$i)/$kelipatan;
}
echo 'Total '.$opsi.' '.number_format($input,0,',','.').' : <br>';
echo '<b>'.$x.'</b>';







