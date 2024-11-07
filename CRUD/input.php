<?php
$statusMessage = "";
$serverName = "localhost";
$connectionOptions = [
    "Database" => "Web_DB", 
    "Uid" => "SA",
    "PWD" => "quickly1" 
];
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die("<p>Koneksi gagal: " . print_r(sqlsrv_errors(), true) . "</p>");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kodeBarang = isset($_POST['kodeBarang']) ? trim($_POST['kodeBarang']) : null;
    $namaBarang = isset($_POST['nama']) ? trim($_POST['nama']) : null;
    $tglMasuk = isset($_POST['tglMasuk']) ? trim($_POST['tglMasuk']) : null;
    $jmlBarang = isset($_POST['jmlBarang']) ? trim($_POST['jmlBarang']) : null;
    if (empty($kodeBarang) || empty($namaBarang) || empty($tglMasuk) || empty($jmlBarang)) {
        $statusMessage = "<p>Semua field harus diisi. Kode Barang, Nama, Tanggal Masuk, dan Jumlah Barang tidak boleh kosong.</p>";
    } else {
        $checkSql = "SELECT * FROM dbo.dataMasuk WHERE kodeBarang = ?";
        $checkStmt = sqlsrv_query($conn, $checkSql, [$kodeBarang]);
        if ($checkStmt === false) {
            $statusMessage = "<p>Error saat memeriksa kode barang: " . print_r(sqlsrv_errors(), true) . "</p>";
        } elseif (sqlsrv_fetch_array($checkStmt, SQLSRV_FETCH_ASSOC)) {
            $statusMessage = "<p>Gagal menyimpan data: Kode Barang '$kodeBarang' sudah ada. Silakan gunakan kode barang yang berbeda.</p>";
        } else {
            $sql = "INSERT INTO dbo.dataMasuk (kodeBarang, NamaBarang, TanggalMasuk, JumlahBarang) VALUES (?, ?, ?, ?)";
            $params = [$kodeBarang, $namaBarang, $tglMasuk, $jmlBarang];

            $stmt = sqlsrv_query($conn, $sql, $params);

            if ($stmt === false) {
                $statusMessage = "<p>Error saat menyimpan data: " . print_r(sqlsrv_errors(), true) . "</p>";
            } else {
                $statusMessage = "<p>Data berhasil disimpan!</p>";
            }
        }
        sqlsrv_free_stmt($checkStmt); 
    }
}
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

        <?php echo $statusMessage; ?>

        <br>
        <a href="index.html">
            <button type="button">Kembali ke Beranda</button>
        </a>
    </div>
</body>
</html>
