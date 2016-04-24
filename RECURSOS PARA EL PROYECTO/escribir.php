<?php
$num = fopen('num.txt', 'r');
$desc = fopen('campos.txt', 'r');
$sal = fopen('cduData.txt', 'w');

while(!feof($num))
{
	$vnum = rtrim(fgets($num), "\n");
	$vdes = rtrim(fgets($desc));
	$vdes = rtrim($vdes, '.');
	$salida = $vnum . '|' . $vdes . "\n";
	fwrite($sal, $salida);
}



fclose($num);
fclose($desc);
fclose($sal);
