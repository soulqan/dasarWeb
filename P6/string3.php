<?php
 
$pesan = "Saya arek malang";
// echo strrev($pesan)."<br>";

$pesanPerKata = explode(" ", $pesan); 

$pesanPerKata = array_map(fn($kata) => strrev($kata), $pesanPerKata); 

$pesan = implode(" ", $pesanPerKata);

echo $pesan . "<br>";
?>