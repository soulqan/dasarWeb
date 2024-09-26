<?php
        $hargaAwal = 120000;
        $diskonPersen = 20;

        if ($hargaAwal > 100000) {
            $nilaiDiskon = ($diskonPersen / 100) * $hargaAwal;
            $hargaSetelahDiskon = $hargaAwal - $nilaiDiskon;
        } else {
            $hargaSetelahDiskon = $hargaAwal;
        }

        echo "Harga produk awal: Rp " . number_format($hargaAwal) ."<br>" ;
        echo "Persentase diskon: " . $diskonPersen ."<br>";
        echo "Harga setelah diskon: Rp " . number_format($hargaSetelahDiskon) ."<br>";
    ?>