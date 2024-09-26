<?php
$a = 10;
$b = 5;

$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a / $b;
$sisaBagi = $a % $b;
$pangkat = $a ** $b;
$hasilSama = $a == $b;
$hasilTidakSama = $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;
$hasilAnd = $a && $b;
$hasilOr = $a || $b;
$hasilNotA = !$a;
$hasilNotB = !$b;
$hasilIdentik = $a === $b;
$hasilTidakIdentik = $a !== $b;




echo("hasil pertambahan = $hasilTambah <br>");
echo("hasil pengurangan = $hasilKurang <br>");
echo("hasil perkalian = $hasilKali <br>");
echo("hasil pembagian = $hasilBagi <br>");
echo("hasil sisa bagi = $sisaBagi <br>");
echo("hasil pangkat = $pangkat <br>");
echo("hasil Sama = $hasilSama <br>");
echo("hasil Tidak Sama = $hasilTidakSama <br>");
echo("hasil Lebih Kecil= $hasilLebihKecil <br>");
echo("hasil Lebih Besar = $hasilLebihBesar <br>");
echo("hasil Lebih Kecil Sama dengan = $hasilLebihKEcilSama <br>");
echo("hasil Lebih Besar Sama dengan = $hasilLebihBesarSama <br>");
echo("hasil dari And = $hasilAnd <br>");
echo("hasil dari Or = $hasilOr <br>");
echo("hasil Not A = $hasilNotA <br>");
echo("hasil Not B = $hasilNotB <br>");
$a += $b;
$hasilTambahA = $a;
echo("Hasil A adalah = $hasilTambahA<br>");

$a -= $b;
$hasilKurangA = $a;
echo("Hasil A adalah = $hasilKurangA<br>");

$a *= $b;
$hasilKaliA = $a;
echo("Hasil A adalah = $hasilKaliA<br>");

$a /= $b;
$hasilBagiA = $a;
echo("Hasil A adalah = $hasilBagiA<br>");

$a %= $b;
$hasilModulusA = $a;
echo("Hasil A adalah = $hasilModulusA<br>");

echo("Hasil Identik = $hasilIdentik<br>");
echo("Hasil Tidak Identik = $hasilTidakIdentik<br>");
?>