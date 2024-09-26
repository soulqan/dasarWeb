<?php
        $poin = 550;

        $hadiahTambahan = ($poin > 500) ? 'YA' : 'TIDAK';

        echo "Total skor pemain adalah: " . number_format($poin) . "<br>";
        echo "Apakah pemain mendapatkan hadiah tambahan? " . $hadiahTambahan;
    ?>