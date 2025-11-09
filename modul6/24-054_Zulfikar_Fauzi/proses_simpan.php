<?php
$koneksi = mysqli_connect("localhost", "root", "", "toko");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
$no_nota = $_POST['no_nota'];
$tanggal = $_POST['tanggal'];
$nama_pelanggan = $_POST['nama_pelanggan'];

$sql_master = "INSERT INTO nota (no_nota, tanggal, nama_pelanggan) 
               VALUES ('$no_nota', '$tanggal', '$nama_pelanggan')";

if (mysqli_query($koneksi, $sql_master)) {
    $id_nota = mysqli_insert_id($koneksi); 

    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];

    for ($i = 0; $i < count($nama_barang); $i++) {
        if ($nama_barang[$i] != "") {
            $sql_detail = "INSERT INTO detail_nota (id_nota, nama_barang, jumlah, harga)
                           VALUES ('$id_nota', '{$nama_barang[$i]}', '{$jumlah[$i]}', '{$harga[$i]}')";
            mysqli_query($koneksi, $sql_detail);
        }
    }

    echo "Transaksi berhasil disimpan!";
} else {
    echo "Gagal menyimpan nota: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>