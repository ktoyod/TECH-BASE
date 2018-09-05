<?php
$filename = 'mission_1-2_syadan.txt';
$fp = fopen($filename, 'r');
$line = fgets($fp);
echo $line;
fclose($fp);
?>
