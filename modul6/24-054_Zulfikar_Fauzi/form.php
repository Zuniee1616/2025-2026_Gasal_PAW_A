<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Transaksi Master Detail</title>
</head>
<body>
<h2>Form Input Transaksi (Nota & Barang)</h2>

<form method="post" action="proses_simpan.php">
    <fieldset>
        <legend>Data Nota (Master)</legend>
        No Nota: <input type="text" name="no_nota" required><br>
        Tanggal: <input type="date" name="tanggal" required><br>
        Nama Pelanggan: <input type="text" name="nama_pelanggan" required><br>
    </fieldset>
    <br>

    <fieldset>
        <legend>Data Barang (Detail)</legend>
        <table border="1" cellpadding="5">
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
            <tr>
                <td><input type="text" name="nama_barang[]"></td>
                <td><input type="number" name="jumlah[]"></td>
                <td><input type="number" step="0.01" name="harga[]"></td>
            </tr>
            <tr>
                <td><input type="text" name="nama_barang[]"></td>
                <td><input type="number" name="jumlah[]"></td>
                <td><input type="number" step="0.01" name="harga[]"></td>
            </tr>
        </table>
        <p>→ Kamu bisa tambahkan baris input tambahan sesuai kebutuhan.</p>
    </fieldset>
    <br>
    <input type="submit" value="Simpan Transaksi">
</form>

</body>
</html>