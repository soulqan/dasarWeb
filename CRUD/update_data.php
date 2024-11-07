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
    // Periksa apakah semua input ada di $_POST
    if (isset($_POST['kodeBarang']) && isset($_POST['nama']) && isset($_POST['tglMasuk']) && isset($_POST['jmlBarang'])) {
        // Mengambil data dari form
        $kodeBarang = $_POST['kodeBarang'];
        $namaBarang = $_POST['nama'];
        $tglMasuk = $_POST['tglMasuk'];
        $jmlBarang = $_POST['jmlBarang'];

        // Query untuk mengupdate data ke tabel
        $sql = "UPDATE dbo.dataMasuk SET NamaBarang = ?, TanggalMasuk = ?, JumlahBarang = ? WHERE kodeBarang = ?";
        $params = [$namaBarang, $tglMasuk, $jmlBarang, $kodeBarang];

        // Eksekusi query
        $stmt = sqlsrv_query($conn, $sql, $params);

        // Cek hasil eksekusi
        if ($stmt === false) {
            $statusMessage = "<p>Error saat mengupdate data: " . print_r(sqlsrv_errors(), true) . "</p>";
        } else {
            $statusMessage = "<p>Data berhasil diupdate!</p>";
        }
    } else {
        $statusMessage = "<p>Silakan lengkapi semua field sebelum mengupdate data.</p>";
    }
}

// Jika kodeBarang diset, ambil data untuk ditampilkan
$existingData = null;
if (isset($_GET['kodeBarang'])) {
    $kodeBarang = $_GET['kodeBarang'];
    $sql = "SELECT * FROM dbo.dataMasuk WHERE kodeBarang = ?";
    $params = [$kodeBarang];
    $stmt = sqlsrv_query($conn, $sql, $params);
    
    if ($stmt) {
        $existingData = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
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
    <title>Update Data Barang</title>
    <link rel="stylesheet" href="style_input.css">
</head>
<body>
    <div>
        <h2>Update Data Barang</h2>
        <!-- Form Update -->
        <form action="update_data.php" method="POST">
            <label for="kodeBarang">Kode Barang: </label>
            <input type="number" name="kodeBarang" id="kodeBarang" required value="<?php echo $existingData['kodeBarang'] ?? ''; ?>" readonly>
            
            <label for="nama">Nama Barang: </label>
            <input type="text" name="nama" id="nama" required value="<?php echo $existingData['NamaBarang'] ?? ''; ?>">
            
            <label for="tglMasuk">Tanggal Masuk: </label>
            <input type="date" id="tglMasuk" name="tglMasuk" required value="<?php echo $existingData['TanggalMasuk'] ? $existingData['TanggalMasuk']->format('Y-m-d') : ''; ?>">
            
            <label for="jmlBarang">Jumlah Barang: </label>
            <input type="number" id="jmlBarang" name="jmlBarang" required value="<?php echo $existingData['JumlahBarang'] ?? ''; ?>">

            <input type="submit" name="submit" value="Update">
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
