<?php
$serverName = "localhost";
$connectionOptions = [
    "Database" => "Web_DB",
    "Uid" => "SA",
    "PWD" => "quickly1"
];
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

$sql = "SELECT * FROM dbo.dataMasuk";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Read Data</title>
    <link rel="stylesheet" href="style_read.css">

</head>
<body>
    <h2>Data Barang</h2>
    <table border="1">
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Tanggal Masuk</th>
            <th>Jumlah Barang</th>
            <th>Action</th>
        </tr>
        <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo $row['kodeBarang']; ?></td>
            <td><?php echo $row['NamaBarang']; ?></td>
            <td><?php echo $row['TanggalMasuk']->format('Y-m-d'); ?></td>
            <td><?php echo $row['JumlahBarang']; ?></td>
            <td>
                <a href="update_data.php?kodeBarang=<?php echo $row['kodeBarang']; ?>">Update</a> |
                <a href="delete_data.php?kodeBarang=<?php echo $row['kodeBarang']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <a href="index.html">
        <button type="button">Kembali ke Beranda</button>
    </a>
</body>
</html>


<?php
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
