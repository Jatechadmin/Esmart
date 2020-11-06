<?php
$bulan=9;
$tgl=date('Y');
$number = cal_days_in_month(CAL_GREGORIAN, $bulan, $tgl); // 31
echo "There were {$number} days in {$bulan} {$tgl}";
?>