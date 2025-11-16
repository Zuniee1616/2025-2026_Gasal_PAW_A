<?php
include 'koneksi.php';

$start = $_GET['start'] ?? null;
$end   = $_GET['end'] ?? null;

$data = [];
$totalPelanggan = 0;
$totalPendapatan = 0;

if ($start && $end) {
    $query = "SELECT tanggal, COUNT(pelanggan) AS pelanggan, SUM(total) AS pendapatan
              FROM transaksi 
              WHERE tanggal BETWEEN '$start' AND '$end'
              GROUP BY tanggal";

    $result = mysqli_query($koneksi, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
        $totalPelanggan += $row['pelanggan'];
        $totalPendapatan += $row['pendapatan'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<h2>Filter Laporan</h2>
<form method="GET">
    Tanggal awal: <input type="date" name="start" required>
    Tanggal akhir: <input type="date" name="end" required>
    <button type="submit">Cari</button>
</form>

<hr>

<?php if ($start && $end): ?>

<h3>Grafik Penerimaan</h3>
<div style="width: 500px; height: 300px;">
    <canvas id="myChart"></canvas>
</div>


<script>
const labels = <?= json_encode(array_column($data, 'tanggal')) ?>;
const values = <?= json_encode(array_column($data, 'pendapatan')) ?>;

new Chart(document.getElementById('myChart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Pendapatan',
            data: values
        }]
    }
});
</script>

<hr>

<h3>Rekap Tabel</h3>
<table border="1" cellpadding="7">
    <tr>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Pendapatan</th>
    </tr>
    <?php foreach ($data as $d): ?>
    <tr>
        <td><?= $d['tanggal'] ?></td>
        <td><?= $d['pelanggan'] ?></td>
        <td><?= $d['pendapatan'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<hr>

<h3>Total</h3>
<p><b>Total Pelanggan:</b> <?= $totalPelanggan ?></p>
<p><b>Total Pendapatan:</b> Rp <?= number_format($totalPendapatan) ?></p>

<hr>

<a href="print.php?start=<?= $start ?>&end=<?= $end ?>" target="_blank">Print</a> |
<a href="excel.php?start=<?= $start ?>&end=<?= $end ?>">Export Excel</a>

<?php endif; ?>

</body>
</html>
