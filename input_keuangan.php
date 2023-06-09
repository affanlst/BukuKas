<?php
require_once('oop.php');
$db = new Database();
$hasil = $db->tampilData();


if (isset($_POST['id_transaksi'])) {
    $id = $_POST['id_transaksi'];
    $masuk = $_POST['masuk'];
    $keluar = $_POST['keluar'];
    $tanggal = $_POST['tanggal'];
    $pencatat = $_POST['pencatat'];
    $sql = "SELECT * FROM uang WHERE id_transaksi = '$id'";
    $result = $db->conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<script>alert('ID Sudah Terpakai');</script>";
    } else {
        $db->tambahData($id,$masuk, $keluar, $tanggal, $pencatat);
        header("refresh:0;url=".$_SERVER['PHP_SELF']);
    }
}
?>
<!DOCTYPE html>
<style>
    svg {
        width: 30px;
        height: 30px;
    }
    input[type="text"],
    input[type="date"] {
        width: 70%;
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
        margin-left: 20px;
    }

    input[type="submit"]:hover {
        background-color: green;
    }

    input[type="date"] {
        color: black;
    }

    label {
        margin-left: 20px;
        color: white;
    }

    table {
        margin: auto;
        border-collapse: collapse;
    }
    a{
        text-decoration: none;
    }
    a:visited{
        color: blue;
    }
    a:hover{
        color: red;
    }
    th,
    td {
        border: 2px solid white;
        padding: 10px;
    }
</style>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sono:wght@200;300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="input.css" />
    <title>BukuKas</title>
    <link rel="icon" type="img/png" href="logo.png" sizes="32x32" />
</head>

<body>
    <div class="navbar">
        <nav class="tabel">
            <div class="brand">
                <div class="firstname">PAGE: </div>
                <div class="lastname">Data Input</div>
                <span id="clock" class="clock-center"></span>
            </div>
            <ul class="navigation">
                <li><img src="logonav.png" alt=""></li>
                <li><a href="home.php">Home</a></li>
                <li><a href="input_keuangan.php">Data Input</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </div> 
    <div class="container">
    <form method="post">
        <label for="id">Id Transaksi : </label> <input type="text" name="id_transaksi" id="id_transaksi" placeholder="ex : 11223344" required> <br>
        <label for="masuk">Uang Masuk : </label> <input type="text" name="masuk" placeholder="ex : Rp.100.000" required> <br>
        <label for="keluar">Uang Keluar : </label><input type="text" name="keluar" placeholder="ex : Rp.100.000" required> <br>
        <label for="tanggal">Tanggal : </label><input type="date" name="tanggal" required> <br>
        <label for="pencatat">Pencatat : </label><input type="text" name="pencatat" placeholder="ex : Udin" required> <br>
        <input type="submit" name="input" id="input" value="TAMBAH">
    </form>
    <table>
        <tr style="background-color: black;">
            <th>Id Transaksi</th>
            <th>Uang Masuk</th>
            <th>Uang Keluar</th>
            <th>Tanggal</th>
            <th>Pencatat</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($hasil as $row) : ?>
            <tr>
                <td>
                    <?= $row['id_transaksi'];?>
                </td>
                <td>
                    <?= $row['masuk']; ?>
                </td>
                <td>
                    <?= $row['keluar']; ?>
                </td>
                <td>
                    <?= $row['tanggal']; ?>
                </td>
                <td>
                    <?= $row['pencatat']; ?>
                </td>
                <td>
                    <a href="edit.php?id_transaksi=<?= $row['id_transaksi'];?>"><svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125" x="0px" y="0px"><title>Artboard 33</title><path d="M77.17,24.29A15.49,15.49,0,0,0,65.51,19,15.45,15.45,0,0,0,54.4,23.7l-31,31A14.9,14.9,0,0,0,19,65.31V71A10,10,0,0,0,29,81h5.69a14.91,14.91,0,0,0,10.6-4.39l31-31a15.87,15.87,0,0,0,4.56-9A15.52,15.52,0,0,0,77.17,24.29ZM39.64,71a7,7,0,0,1-4.95,2H29a2,2,0,0,1-2-2V65.31a7,7,0,0,1,2-4.95L51.88,37.54,62.46,48.12Zm33.3-35.44a7.8,7.8,0,0,1-2.29,4.43l-2.52,2.52L57.54,31.88l2.52-2.52A7.46,7.46,0,0,1,65.51,27,7.49,7.49,0,0,1,72.93,35.51Z"/><text x="0" y="115" fill="#000000" font-size="5px" font-weight="bold" font-family="'Helvetica Neue', Helvetica, Arial-Unicode, Arial, Sans-serif"></text><text x="0" y="120" fill="#000000" font-size="5px" font-weight="bold" font-family="'Helvetica Neue', Helvetica, Arial-Unicode, Arial, Sans-serif"></text></svg></a>
                    <a onclick="return confirm('Apakah Anda yakin ingin menghapus Data Keuangan?')" href="hapus.php?id_transaksi=<?= $row['id_transaksi']; ?>"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:serif="http://www.serif.com/" viewBox="0 0 32 40" version="1.1" xml:space="preserve" style="" x="0px" y="0px" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"><g transform="matrix(1,0,0,1,0,-240)"><path d="M26,249C26,248.448 25.552,248 25,248L7,248C6.448,248 6,248.448 6,249L6,266C6,268.209 7.791,270 10,270L22,270C24.209,270 26,268.209 26,266C26,260.419 26,249 26,249ZM24,250L24,266C24,267.105 23.105,268 22,268C22,268 10,268 10,268C8.895,268 8,267.105 8,266C8,266 8,250 8,250L24,250ZM19,253L19,265C19,265.552 19.448,266 20,266C20.552,266 21,265.552 21,265L21,253C21,252.448 20.552,252 20,252C19.448,252 19,252.448 19,253ZM11,253L11,265C11,265.552 11.448,266 12,266C12.552,266 13,265.552 13,265L13,253C13,252.448 12.552,252 12,252C11.448,252 11,252.448 11,253ZM15,253L15,265C15,265.552 15.448,266 16,266C16.552,266 17,265.552 17,265L17,253C17,252.448 16.552,252 16,252C15.448,252 15,252.448 15,253ZM12,245L5,245C4.448,245 4,245.448 4,246C4,246.552 4.448,247 5,247L27,247C27.552,247 28,246.552 28,246C28,245.448 27.552,245 27,245L20,245C20,243.343 18.657,242 17,242L15,242C14.204,242 13.441,242.316 12.879,242.879C12.316,243.441 12,244.204 12,245ZM18,245C18,244.448 17.552,244 17,244C17,244 15,244 15,244C14.735,244 14.48,244.105 14.293,244.293C14.105,244.48 14,244.735 14,245L18,245Z"/></g><text x="0" y="47" fill="#000000" font-size="5px" font-weight="bold" font-family="'Helvetica Neue', Helvetica, Arial-Unicode, Arial, Sans-serif">Created by Mila Karmila</text><text x="0" y="52" fill="#000000" font-size="5px" font-weight="bold" font-family="'Helvetica Neue', Helvetica, Arial-Unicode, Arial, Sans-serif"></text></svg></a>
                    
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
    </div>
        <footer class="Copyright">Copyright@Lister || 223307088</footer>
</body>
</html>