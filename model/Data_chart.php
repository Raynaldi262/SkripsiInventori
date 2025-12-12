<?php
require('../connect/conn.php');

$sql1 = "SELECT * FROM gudang";
$result1 = mysqli_query($conn, $sql1);

$labels = [];
$values = [];

while ($row = mysqli_fetch_assoc($result1)) {
    $labels[] = $row['nama_barang'];
    $values[] = $row['jumlah'];
}

echo json_encode([
    "labels" => $labels,
    "values" => $values
]);