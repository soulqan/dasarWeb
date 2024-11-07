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
    if (isset($_POST['kodeBarang']) && isset($_POST['nama']) && isset($_POST['tglMasuk']) && isset($_POST['jmlBarang'])) {
        $kodeBarang = $_POST['kodeBarang'];
        $namaBarang = $_POST['nama'];
        $tglMasuk = $_POST['tglMasuk'];
        $jmlBarang = $_POST['jmlBarang'];

        $sql = "UPDATE dbo.dataMasuk SET NamaBarang = ?, TanggalMasuk = ?, JumlahBarang = ? WHERE kodeBarang = ?";
        $params = [$namaBarang, $tglMasuk, $jmlBarang, $kodeBarang];

        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            $statusMessage = "<p>Error saat mengupdate data: " . print_r(sqlsrv_errors(), true) . "</p>";
        } else {
            $statusMessage = "<p>Data berhasil diupdate!</p>";
        }
    } else {
        $statusMessage = "<p>Silakan lengkapi semua field sebelum mengupdate data.</p>";
    }
}

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

        <?php echo $statusMessage; ?>

        <br>
    <a href="index.html">
        <button type="button">Kembali ke Beranda</button>
    </a>
    </div>
</body>
</html>
