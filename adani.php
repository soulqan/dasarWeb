<?php
// Konfigurasi database
$serverName = "localhost"; // Nama server biasanya emang localhost
$connectionOptions = [ //array berupa data yang mau di koneksikan 
    "Database" => "indoapril", // Nama database Anda
    "Uid" => "", // Ganti dengan username database Anda
    "PWD" => "" // Ganti dengan password database Anda
];

// Membuat koneksi ke database SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions); //jadi variabel conn itu memiliki fungsi sqlsrv_connect yang berfungsi untuk menghubungkan ke database
// parameter dari sqlsrv itu servername dan informasi login
if ($conn === false) {  //apabila variabel conn false atau gagal yang arti nya ga terhubung
    die(print_r(sqlsrv_errors(), true));//jadi die itu berguna untuk menghentikan eksekusi script php nya secara langsung
    //tapi bisa menampilkan pesan sebelum berhenti kalo dikasih padameter
    //parameter nya itu print_r(sqlsrv_errors(), true), jadi print_r it berguna untuk mencetak isi dari array dan sqlsrv_errors() itu informasi tentang eror
    //atau warning yang terjadi waktu operasi sqlsrv jadi ada isinya sendiri biar tau kenapa eror nya nah kenapa print_r karena informasi nya berupa array
    //terus parameter kedua itu true buat hasil outputnya dikembalikan sebagai string kalo
}

$statusMessage = ""; // Variabel untuk menyimpan pesan status

// Menambahkan member baru jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['kode_member']) && !empty($_POST['nama']) && !empty($_POST['email'])) {
    // jadi ini perintah untuk menginput 
    $kode_member = $_POST['kode_member'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    // Persiapan query untuk memasukkan data
    $sql = "INSERT INTO members (kode_member, nama, email) VALUES (?, ?, ?)";
    $params = [$kode_member, $nama, $email];

    // Eksekusi query
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        $statusMessage = "Gagal menambahkan data: " . print_r(sqlsrv_errors(), true);
    } else {
        $statusMessage = "Data berhasil ditambahkan!";
        sqlsrv_free_stmt($stmt); // Bebaskan sumber daya
    }
}

// Mengambil data member untuk ditampilkan dalam tabel
$sql = "SELECT * FROM members";
$result = sqlsrv_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Menambahkan Kode Member</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Form Menambahkan Kode Member</h1>

        <!-- Menampilkan pesan status -->
        <?php if (!empty($statusMessage)): ?>
            <p><?php echo $statusMessage; ?></p>
        <?php endif; ?>

        <!-- Form untuk menambahkan member baru -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="kode_member">Kode Member:</label>
                <input type="text" id="kode_member" name="kode_member" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit">Tambah Member</button>
        </form>

        <h2>Daftar Member</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Member</th>
                    <th>Nama</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['kode_member']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Menutup koneksi database
sqlsrv_free_stmt($result); // Bebaskan hasil statement
sqlsrv_close($conn); // Tutup koneksi
?>