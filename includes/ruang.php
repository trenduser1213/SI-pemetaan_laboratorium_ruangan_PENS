<?php
require_once "includes/func.inc.php";


function jumlahLaboratorium() {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT COUNT(*) AS jumlah FROM ruang WHERE kode = 'L'";
    $hasil = query_count($con, $sql);
    $row = oci_fetch_array($hasil);
    return $row['JUMLAH'];
}

function jumlahRuang() {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT COUNT(*) AS jumlah FROM ruang";
    $hasil = query_count($con, $sql);
    $row = oci_fetch_array($hasil);
    return $row['JUMLAH'];
}

function jumlahGedung(){
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT COUNT(*) AS jumlah FROM gedung";
    $hasil = query_count($con, $sql);
    $row = oci_fetch_array($hasil);
    return $row['JUMLAH'];
}

function viewLaboratorium() {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT r.nomor, r.ruang, r.keterangan, j.jurusan, p.nama AS kepala FROM ruang r INNER JOIN jurusan j ON j.nomor = r.jurusan  INNER JOIN pegawai p ON p.nomor = r.kepala WHERE kode = 'L' ORDER BY r.Ruang";
    $hasil = query_getAll($con, $sql);
    return $hasil;
}

function dataKelas() {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "select * from ruang where kode ='K'";
    $hasil = query_getAll($con, $sql);
    return $hasil;
}

function dataRuangAdmin()
{
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "select * from ruang where kode != 'L' and kode != 'K'";
    $hasil = query_getAll($con, $sql);
    return $hasil;
}

function detailRuang($id) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "Select r.nomor,r.ruang, r.keterangan, r.telp, x.nama AS KEPALA,  xx.nama AS ASISTEN, xxx.nama AS TEKNISI from ruang r LEFT JOIN pegawai x ON r.kepala = x.nomor LEFT JOIN pegawai xx ON r.asisten = xx.nomor LEFT JOIN pegawai xxx ON r.teknisi = xxx.nomor WHERE r.nomor = '$id'";
    $hasil = query_getAll($con, $sql);
    return $hasil;
}
//Select r.nomor, r.ruang , CONCAT(CONCAT(x.nama, ','), CONCAT(CONCAT( xx.nama, ',' ), xxx.nama)) AS anggota from ruang r
//LEFT JOIN pegawai x ON r.kepala = x.nomor
//LEFT JOIN pegawai xx ON r.asisten = xx.nomor
//LEFT JOIN pegawai xxx ON r.teknisi = xxx.nomor ;