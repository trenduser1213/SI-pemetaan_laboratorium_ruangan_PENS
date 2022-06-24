<?php
require_once "includes/func.inc.php";

function jadwalRuang($id) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT h.hari , j.jam , m.matakuliah, p.nama AS dosen, ke.kode AS kelas FROM kuliah K INNER JOIN hari h ON k.hari = h.nomor INNER JOIN jam j ON k.jam = j.nomor INNER JOIN matakuliah m ON k.matakuliah = m.nomor INNER JOIN pegawai p ON k.dosen = p.nomor INNER JOIN kelas ke ON k.kelas = ke.nomor WHERE ruang = $id ORDER BY  k.hari , j.jam";
    $hasil = query_getAll($con, $sql);
    return $hasil;
}
?>