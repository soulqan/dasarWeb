<?php
$nilaiSiswa = [
    ['Alice', 85],
    ['Bob', 92],
    ['Charlie', 78],
    ['David', 64],
    ['Eva', 90],
];

$totalNilai = 0;
$jumlahSiswa = count($nilaiSiswa);

foreach ($nilaiSiswa as $siswa) {
    $totalNilai += $siswa[1];
}

$rataRataKelas = $totalNilai / $jumlahSiswa;

echo "Rata-rata kelas: " . number_format($rataRataKelas, 2) . "<br>";

echo "Daftar siswa dengan nilai di atas rata-rata:<br>";

foreach ($nilaiSiswa as $siswa) {
    if ($siswa[1] > $rataRataKelas) {
        echo "Nama: {$siswa[0]}, Nilai: {$siswa[1]}<br>";
    }
}
?>
