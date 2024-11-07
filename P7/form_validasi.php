<!DOCTYPE html>
<html>
<head>
    <title>Form Input dengan Validasi</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Form Input dengan Validasi</h1>
    <form id="myForm" method="post" action="proses_validasi.php">
        <label for="nama">Nama: </label>
        <input type="text" id="nama" name="nama">
        <span id="nama-error" style="color: red;"></span><br>

        <label for="email">Email: </label>
        <input type="text" id="email" name="email">
        <span id="email-error" style="color: red;"></span><br>

        <label for="password">Password: </label>
        <input type="password" id="password" name="password">
        <span id="password-error" style="color: red;"></span><br>

        <input type="submit" value="Submit">
    </form>

    <div id="hasil" style="margin-top: 20px;"></div> <!-- Tempat untuk menampilkan hasil -->

    <script>
        $(document).ready(function () {
            $("#myForm").submit(function (event) {
                event.preventDefault(); // Mencegah pengiriman form secara default

                var nama = $("#nama").val();
                var email = $("#email").val();
                var password = $("#password").val(); // Ambil nilai password
                var valid = true;

                // Validasi Nama
                if (nama === "") {
                    $("#nama-error").text("Nama harus diisi.");
                    valid = false;
                } else {
                    $("#nama-error").text("");
                }

                // Validasi Email
                if (email === "") {
                    $("#email-error").text("Email harus diisi.");
                    valid = false;
                } else {
                    $("#email-error").text("");
                }

                // Validasi Password
                if (password.length < 8) {
                    $("#password-error").text("Password harus minimal 8 karakter.");
                    valid = false;
                } else {
                    $("#password-error").text("");
                }

                // Jika semua valid, kirim data menggunakan AJAX
                if (valid) {
                    $.ajax({
                        url: "proses_validasi.php",
                        type: "POST",
                        data: { nama: nama, email: email, password: password }, // Kirim password juga
                        success: function(response) {
                            $("#hasil").html(response); // Tampilkan hasil dari server
                        },
                        error: function() {
                            $("#hasil").html("Terjadi kesalahan saat mengirim data.");
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
