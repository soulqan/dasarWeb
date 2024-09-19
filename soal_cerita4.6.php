<?php
        
        $nilaiSiswa = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];

        
        $max1 = $max2 = PHP_INT_MIN; 
        $min1 = $min2 = PHP_INT_MAX;

       
        foreach ($nilaiSiswa as $nilai) {
        
            if ($nilai > $max1) {
                $max2 = $max1;
                $max1 = $nilai;
            } elseif ($nilai > $max2) {
                $max2 = $nilai;
            }

            if ($nilai < $min1) {
                $min2 = $min1;
                $min1 = $nilai;
            } elseif ($nilai < $min2) {
                $min2 = $nilai;
            }
        }
        $totalNilai = 0;
        foreach ($nilaiSiswa as $nilai) {
            if ($nilai != $max1 && $nilai != $max2 && $nilai != $min1 && $nilai != $min2) {
                $totalNilai += $nilai;
            }
        }

        echo "<p>Total nilai yang digunakan (setelah mengabaikan dua nilai tertinggi dan dua nilai terendah) adalah: $totalNilai</p>";
    ?>