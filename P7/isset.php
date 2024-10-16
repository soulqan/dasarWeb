<?php
$umur;
if (isset($umur)&& $umur>=18) {
    echo "Anda sudah dewasa";
 } else {
        echo"Anda Belum Dewasa atau variabel 'umur' tidak ditemukan<br>";
    }

    
    $data = array("nama"=>"Jane","usia" => 25);
    if (isset($data["nama"])) {
        echo "Nama: " . $data["nama"];
     } else {
            echo"variabel nama tidak ditemukan di array";
        }
?>