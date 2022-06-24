<?php
require_once 'includes/func.inc.php';

function joinLab($idAnggota, $idRuang, $idStatus, $idKeanggotaan) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "INSERT INTO ANGGOTALAB (NOMOR, RUANG, ANGGOTA, STATUSANGGOTA , KEANGGOTAAN) VALUES (ai.nextval, $idRuang, $idAnggota, $idStatus, $idKeanggotaan )";
    $hasil = query_insert($con, $sql);
    return $hasil;
}
//fungsi untuk cek anggota di kelas
function cekAnggota($idAnggota, $idRuang) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT * FROM ANGGOTALAB WHERE RUANG = $idRuang AND ANGGOTA = $idAnggota";
    $hasil = query_getAll($con, $sql);
    return $hasil;
}

//fungsi untuk mengambil data anggota ruang
function anggotaRuang($idRuang) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT * FROM ANGGOTALAB WHERE RUANG = $idRuang";
    $hasil = query_getAll($con, $sql);
    return $hasil;
}

//fungsi untuk menghitung data anggota ruang
function countAnggotaRuang($idRuang) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT COUNT(*) AS jumlah FROM ANGGOTALAB WHERE RUANG = $idRuang";
    $hasil = query_count($con, $sql);
    $row = oci_fetch_array($hasil);
    return $row['JUMLAH'];
}


?>