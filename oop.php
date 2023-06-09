<?php
class Database {
    private $host = "sql108.infinityfree.com";
    private $username = "if0_34371553";
    private $password = "bBntYqc43B";
    private $database = "if0_34371553_Bukukas";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    //uang
    public function tambahData($id,$masuk, $keluar, $tanggal, $pencatat) {
        $stmt = $this->conn->prepare("INSERT INTO uang (id_transaksi,masuk, keluar, tanggal, pencatat) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss",$id, $masuk, $keluar, $tanggal, $pencatat);
        $stmt->execute();
        $stmt->close();
    }
    

    public function tampilData() {
        $sql = "SELECT * FROM uang";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function editData($id,$masuk, $keluar, $tanggal, $pencatat) {
        $stmt = $this->conn->prepare("UPDATE uang SET id_transaksi=?, masuk=?, keluar=?, tanggal=?, pencatat=? WHERE id_transaksi=?");
        $stmt->bind_param("ssssss",$id, $masuk, $keluar, $tanggal, $pencatat,$id);
        $stmt->execute();
        $stmt->close();
    }    
    

    public function hapusData($id) {
        $stmt = $this->conn->prepare("DELETE FROM uang WHERE id_transaksi=?");
        $stmt->bind_param("ss", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function __destruct() {
        $this->conn->close();
    }
    public function cekIdTerpakai($id) {
        $sql = "SELECT * FROM uang WHERE id_transaksi = '$id'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // ID sudah terpakai
            echo "<script>alert('ID Sudah Terpakai');</script>";
        } else {
            header("refresh:0;url=".$_SERVER['PHP_SELF']);
        }
    }
}
?>
