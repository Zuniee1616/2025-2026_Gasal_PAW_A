<!-- excel.php -->
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan.xls");

include 'koneksi.php';

$start = $_GET['start'];
$end   = $_GET['end'];

$query = "SELECT tanggal, pelanggan, total FROM transaksi 
          WHERE tanggal BETWEEN '$start' AND '$end'";
$result = mysqli_query($koneksi, $query);
?>

<table border="1">
    <tr>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Pendapatan</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?= $row['tanggal'] ?></td>
        <td><?= $row['pelanggan'] ?></td>
        <td><?= $row['total'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>
