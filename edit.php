<?php
include 'oop.php';

$db = new Database();

if (isset($_POST['update'])) {
    $id = $_POST['id_transaksi'];
    $masuk = $_POST['masuk'];
    $keluar = $_POST['keluar'];
    $tanggal = $_POST['tanggal'];
    $pencatat = $_POST['pencatat'];

    $db->editData($id, $masuk, $keluar, $tanggal, $pencatat);

    // Redirect to studikasus.php after updating data
    header("Location: input_keuangan.php");
    exit();
}

if (isset($_GET['id_transaksi'])) {
    $id = $_GET['id_transaksi'];

    // Fetch the data for the selected masuk
    $stmt = $db->conn->prepare("SELECT * FROM uang WHERE id_transaksi = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check if the data exists
    if (!$row) {
        echo "Data tidak ditemukan.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Keuangan</title>
    <link rel="icon" href="logo.png" type="image/x-icon">
    <style>
        /* CSS untuk desain tampilan */
        body {
            font-family: Arial, sans-serif;
            background-color: grey;
        }

        h1 {
            text-align: center;
            color: white;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            color: black;
            background-color: white;
        }

        input[type="submit"] {
            background-color: #87B749;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: green;
        }
    </style>
</head>

<body>
    <h1>Edit Siswa</h1>
    <form method="POST">
    <input type="text" name="id_transaksi" id="id_transaksi" value="<?= $row['id_transaksi']; ?>" placeholder="Id Transaksi" required><br>
        <input type="text" name="masuk" value="<?= $row['masuk']; ?>" placeholder="Uang Masuk" required><br>
        <input type="text" name="keluar" value="<?= $row['keluar']; ?>" placeholder="Uang Keluar" required><br>
        <input type="date" name="tanggal" value="<?= $row['tanggal']; ?>" placeholder="Tanggal" required><br>
        <input type="text" name="pencatat" value="<?= $row['pencatat']; ?>" placeholder="Pencatat" required><br>
        <input type="submit" name="update" value="Update Data">
    </form>
</body>

</html>