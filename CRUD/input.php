<?php
// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Variabel pesan untuk menyimpan status penyimpanan
$statusMessage = "";

// Konfigurasi koneksi ke database
$serverName = "localhost"; // Ganti dengan nama server Anda
$connectionOptions = [
    "Database" => "Web_DB", // Ganti dengan nama database Anda
    "Uid" => "SA", // Ganti dengan username Anda
    "PWD" => "quickly1" // Ganti dengan password Anda
];

// Koneksi ke database
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Periksa koneksi
if ($conn === false) {
    die("<p>Koneksi gagal: " . print_r(sqlsrv_errors(), true) . "</p>");
}

// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $kodeBarang = isset($_POST['kodeBarang']) ? trim($_POST['kodeBarang']) : null;
    $namaBarang = isset($_POST['nama']) ? trim($_POST['nama']) : null;
    $tglMasuk = isset($_POST['tglMasuk']) ? trim($_POST['tglMasuk']) : null;
    $jmlBarang = isset($_POST['jmlBarang']) ? trim($_POST['jmlBarang']) : null;

    // Debugging output
    if (empty($kodeBarang) || empty($namaBarang) || empty($tglMasuk) || empty($jmlBarang)) {
        $statusMessage = "<p>Semua field harus diisi. Kode Barang, Nama, Tanggal Masuk, dan Jumlah Barang tidak boleh kosong.</p>";
    } else {
        // Periksa apakah kode barang sudah ada
        $checkSql = "SELECT * FROM dbo.dataMasuk WHERE kodeBarang = ?";
        $checkStmt = sqlsrv_query($conn, $checkSql, [$kodeBarang]);

        if ($checkStmt === false) {
            $statusMessage = "<p>Error saat memeriksa kode barang: " . print_r(sqlsrv_errors(), true) . "</p>";
        } elseif (sqlsrv_fetch_array($checkStmt, SQLSRV_FETCH_ASSOC)) {
            // Kode barang sudah ada
            $statusMessage = "<p>Gagal menyimpan data: Kode Barang '$kodeBarang' sudah ada. Silakan gunakan kode barang yang berbeda.</p>";
        } else {
            // Query untuk memasukkan data ke tabel
            $sql = "INSERT INTO dbo.dataMasuk (kodeBarang, NamaBarang, TanggalMasuk, JumlahBarang) VALUES (?, ?, ?, ?)";
            $params = [$kodeBarang, $namaBarang, $tglMasuk, $jmlBarang];

            // Eksekusi query
            $stmt = sqlsrv_query($conn, $sql, $params);

            // Cek hasil eksekusi
            if ($stmt === false) {
                $statusMessage = "<p>Error saat menyimpan data: " . print_r(sqlsrv_errors(), true) . "</p>";
            } else {
                $statusMessage = "<p>Data berhasil disimpan!</p>";
            }
        }
        sqlsrv_free_stmt($checkStmt); // Bebaskan statement
    }
}

// Tutup koneksi
sqlsrv_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Barang</title>
    <link rel="stylesheet" href="style_input.css">
</head>
<body>
    <div>
    <h2>Input Barang</h2>
        <!-- Form Input -->
        <form action="input.php" method="POST">
            <label for="kodeBarang">Kode Barang: </label>
            <input type="number" name="kodeBarang" id="kodeBarang" required>
            
            <label for="nama">Nama Barang: </label>
            <input type="text" name="nama" id="nama" required>
            
            <label for="tglMasuk">Tanggal Masuk: </label>
            <input type="date" id="tglMasuk" name="tglMasuk" required>
            
            <label for="jmlBarang">Jumlah Barang: </label>
            <input type="number" id="jmlBarang" name="jmlBarang" required>

            <input type="submit" name="submit" value="Submit">
        </form>

        <!-- Menampilkan status penyimpanan -->
        <?php echo $statusMessage; ?>

        <br>
        <a href="index.html">
            <button type="button">Kembali ke Beranda</button>
        </a>
    </div>
</body>
</html>
