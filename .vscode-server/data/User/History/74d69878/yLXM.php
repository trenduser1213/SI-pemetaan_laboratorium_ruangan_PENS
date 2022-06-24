<?php
require_once ('func.inc.php');

    function jumlahDosen(){
        $db_user = "pa0021";
        $db_pass = "375300";
        $con = konekDb($db_user, $db_pass);
        $sql = "SELECT COUNT(*) AS jumlah FROM pegawai WHERE staff = '4'";
        $hasil = query_count($con, $sql);
        $row = oci_fetch_array($hasil);
        return $row['JUMLAH'];
    }
    function dataPegawai(){
        $db_user = "pa0021";
        $db_pass = "375300";
        $con = konekDb($db_user, $db_pass);
        $sql = "SELECT p.nomor, p.nip, CONCAT(CONCAT(p.gelar_dpn, ' '), CONCAT(CONCAT( p.nama, ' ' ),p.gelar_blk)) AS NAMA, s.staff as jabatan,  CONCAT(CONCAT( x.ruang, '-- '), CONCAT(CONCAT( xx.ruang, '-- ' ),xxx.ruang)) AS ruangan FROM pegawai p LEFT JOIN staff s ON p.staff = s.nomor LEFT JOIN ruang x ON p.nomor = x.kepala LEFT JOIN ruang xx ON p.nomor = xx.asisten LEFT JOIN ruang xxx ON p.nomor = xxx.teknisi";
        $hasil = query_getAll($con, $sql);
        return $hasil;
    }
?>