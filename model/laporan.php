<?php
require('../connect/conn.php');
require('../session/session.php');


$sql = "SELECT * FROM  tb_supplier";
$supplier = mysqli_query($conn, $sql);


$sql = "SELECT * FROM  gudang";
$gudang = mysqli_query($conn, $sql);

?>