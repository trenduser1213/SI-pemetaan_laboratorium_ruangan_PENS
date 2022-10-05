<?php
require_once "includes/func.inc.php";


function jumlahLaboratorium() {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT COUNT(*) AS jumlah FROM RUANGBARU WHERE kode = 'L'";
    $hasil = query_count($con, $sql);
    $row = oci_fetch_array($hasil);
    return $row['JUMLAH'];
}

function jumlahRuang() {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT COUNT(*) AS jumlah FROM RUANGBARU";
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
function countLabOFJurusan($jurusan){
    $con= koneksiDB();
    $sql="select count(*) as jumlah from ruangbaru r LEFT JOIN jurusan j ON j.nomor = r.jurusan  LEFT JOIN pegawai p ON p.nomor = r.kepala WHERE kode = 'L' AND j.jurusan = '$jurusan'";
    $hasil = query_getAll($con, $sql);
    oci_fetch_all($hasil, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
    return $rows;
}

function viewLaboratorium($jurusan) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT r.nomor, r.ruang, r.keterangan, j.jurusan, p.nama AS kepala, r.asisten, r.teknisi, r.telp FROM RUANGBARU r LEFT JOIN jurusan j ON j.nomor = r.jurusan  LEFT JOIN pegawai p ON p.nomor = r.kepala WHERE kode = 'L' AND j.jurusan = '$jurusan' ORDER BY r.Ruang";
    $hasil = query_getAll($con, $sql);
    oci_fetch_all($hasil, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
    return $rows;
}

function viewLaboratoriumNULL() {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT r.nomor, r.ruang, r.keterangan, j.jurusan, p.nama AS kepala, r.asisten, r.teknisi, r.telp FROM RUANGBARU r LEFT JOIN jurusan j ON j.nomor = r.jurusan  LEFT JOIN pegawai p ON p.nomor = r.kepala WHERE kode = 'L' AND r.jurusan is null ORDER BY r.Ruang";
    $hasil = query_getAll($con, $sql);
    oci_fetch_all($hasil, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
    return $rows;
}

function dataKelas() {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "select * from RUANGBARU where kode ='K'";
    $hasil = query_getAll($con, $sql);
    return $hasil;
}

function dataRuangAdmin()
{
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "select * from RUANGBARU where kode != 'L' and kode != 'K'";
    $hasil = query_getAll($con, $sql);
    return $hasil;
}

function dataRuangan()
{
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "select * from RUANGBARU where kode is null";
    $hasil = query_getAll($con, $sql);
    oci_fetch_all($hasil, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
    return $rows;
}

function detailRuang($id) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "Select r.nomor,r.ruang, r.keterangan, r.telp, x.nama AS KEPALA,  xx.nama AS ASISTEN, xxx.nama AS TEKNISI, FOTO_LAB, FOTO_DENAH from RUANGBARU r LEFT JOIN pegawai x ON r.kepala = x.nomor LEFT JOIN pegawai xx ON r.asisten = xx.nomor LEFT JOIN pegawai xxx ON r.teknisi = xxx.nomor WHERE r.nomor = '$id'";
    $hasil = query_getAll($con, $sql);
    return $hasil;
}

function kode(){
    $con = koneksiDB();
    $sql = "SELECT distinct kode FROM RUANGBARU";
    $rows = query_getAll($con, $sql);
    oci_fetch_all( $rows, $hasil, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
    return $hasil;
}

function tambahRuangLab($namaLab, $lokasi, $jurusan, $ketua, $asisten, $teknisi, $telp, $virtual){
    $kode ='L';
    $con = koneksiDB();
    var_dump($namaLab);
    var_dump($lokasi);
    var_dump($jurusan);
    var_dump($ketua);
    var_dump($asisten);
    var_dump($teknisi);
    var_dump($telp);
    var_dump($virtual);
    // var_dump();
    $sql = "INSERT INTO RUANGBARU(nomor, ruang, keterangan, kepala, asisten, teknisi, jurusan, kode, telp, foto_lab) values (ruangAI.nextVal, '$lokasi', '$namaLab', '$ketua', '$asisten', '$teknisi', '$jurusan', '$kode', '$telp', '$virtual')";
    $hasil = query_insert($con, $sql);
    if($hasil == "Success Insert"){
        echo "<script>alert('Success Insert');</script>";
        echo "<script>window.location.href='index.php?halaman=lab';</script>";
    }
}

function tambahRuangKelas($namaLab, $lokasi, $virtual){
    $kode ='K';
    $con = koneksiDB();
    $sql = "INSERT INTO RUANGBARU(nomor, ruang, keterangan, kode,  foto_lab) values (ruangAI.nextVal, '$lokasi', '$namaLab', '$kode', '$virtual')";
    $hasil = query_insert($con, $sql);
    if($hasil == "Success Insert"){
        echo "<script>alert('Success Insert');</script>";
        echo "<script>window.location.href='index.php?halaman=RuangKuliah';</script>";
    }
}

function tambahRuangAdmin($namaLab, $lokasi, $ketua, $asisten, $teknisi, $telp, $virtual){
    $kode = null;
    $con = koneksiDB();
    $sql = "INSERT INTO RUANGBARU(nomor, ruang, keterangan, kepala, asisten, teknisi,  kode, telp, foto_lab values (ruangAI.nextVal, '$lokasi', '$namaLab', '$ketua', '$asisten', '$teknisi', '$kode', '$telp', '$virtual')";
    $hasil = query_insert($con, $sql);
    if($hasil == "Success Insert"){
        echo "<script>alert('Success Insert');</script>";
        echo "<script>window.location.href='index.php?halaman=lab';</script>";
    }
}

function updateRuangKelas($namaLab, $lokasi, $virtual, $id_Lab){
    $con = koneksiDB();
    $sql = "UPDATE RUANGBARU SET ruang='$lokasi', keterangan='$namaLab', foto_lab='$virtual' WHERE NOMOR ='$id_Lab'";
    $hasil = query_update($con, $sql);
    var_dump($hasil);
    if($hasil == "Success Update"){
        echo "<script>alert('Success Update');</script>";
        echo "<script>window.location.href='index.php;</script>";
    }
}
function updateFoto($foto_lab,$foto_denah,$idRuang){
    $con = koneksiDB();
    $sql= "UPDATE RUANGBARU SET foto_lab='$foto_lab', foto_denah ='$foto_denah' WHERE nomor='$idRuang'";
    $hasil = query_update($con, $sql);
    // var_dump($hasil);
    return $hasil;
    
}
//Select r.nomor, r.ruang , CONCAT(CONCAT(x.nama, ','), CONCAT(CONCAT( xx.nama, ',' ), xxx.nama)) AS anggota from ruang r
//LEFT JOIN pegawai x ON r.kepala = x.nomor
//LEFT JOIN pegawai xx ON r.asisten = xx.nomor
//LEFT JOIN pegawai xxx ON r.teknisi = xxx.nomor ;
