<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php
/*****************
example code akses table oracle
contoh table BARANG dengan kolom sbb :
NOMOR NUMBER(10)
NAMA_BARANG VARCHAR2(100)
STOK NUMBER(2)
//*****************/

include "includes/func.inc.php";

$db_user = "pa0021";
$db_pass = "375300";
$con = konekDb($db_user, $db_pass);

//*****Data Barang Baru*******
// $Nomor = 1;
$Ruang = 96;
$Anggota = 2103191031;
$Status = 1 ;
$keanggotaan = 1;
//**************
echo "<strong>INSERT DATA BARANG</strong><br><br>";
// echo "Nomor : $Nomor<br>";
echo "Nama Barang : $Ruang<br>";
echo "anggota : $Anggota<br>";
echo "Status : $Status<br>";
echo "Keanggotaan :$keanggotaan <br><br>";
$sql = "INSERT INTO ANGGOTALAB (NOMOR, RUANG, ANGGOTA, STATUS, KEANGGOTAAN) VALUES (ai.nextval, $Ruang, $Anggota, $Status, $keanggotaan )";
$hasil = query_insert($con, $sql);

echo "Status Transaksi : $hasil";
?>
</body>
</html>
