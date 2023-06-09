<?php
include 'koneksi.php';
if (isset($_GET['id_transaksi'])) {
    $id = $_GET['id_transaksi'];

    $sql = "DELETE FROM uang WHERE id_transaksi='$id'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    }
}
header("location:input_keuangan.php");
?>