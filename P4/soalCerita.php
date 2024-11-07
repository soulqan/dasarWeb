<?php
        $totalKursi = 45;
        $kursiTerisi = 28;
        $kursiKosong = $totalKursi - $kursiTerisi;

        $persentaseKosong = ($kursiKosong / $totalKursi) * 100;

        echo "<p>Dari total $totalKursi kursi, sebanyak $kursiKosong kursi masih kosong.</p>";
        echo "<p>Persentase kursi yang masih kosong adalah " . number_format($persentaseKosong, 2) . "%.</p>";
    ?>