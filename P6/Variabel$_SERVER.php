<?php
echo $_SERVER['PHP_SELF'];        // Menampilkan nama file skrip yang sedang dieksekusi
echo "<br>";
echo $_SERVER['SERVER_NAME'];     // Menampilkan nama server (misalnya localhost)
echo "<br>";
echo $_SERVER['HTTP_HOST'];       // Menampilkan header Host dari permintaan saat ini
echo "<br>";
echo $_SERVER['HTTP_REFERER'];    // Menampilkan halaman referensi jika tersedia (bisa kosong jika tidak ada)
echo "<br>";
echo $_SERVER['HTTP_USER_AGENT']; // Menampilkan informasi user agent dari browser yang digunakan
echo "<br>";
echo $_SERVER['SCRIPT_NAME'];     // Menampilkan path skrip saat ini
?>
