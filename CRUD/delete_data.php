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

$kodeBarang = $_GET['kodeBarang'];

$sql = "DELETE FROM dbo.dataMasuk WHERE kodeBarang = ?";
$params = [$kodeBarang];
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Data berhasil dihapus!";
    header("Location: read_data.php"); 
    exit();
}

sqlsrv_close($conn);
?>

