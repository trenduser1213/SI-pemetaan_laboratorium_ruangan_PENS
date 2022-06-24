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

//fungsi untuk mengambil data mahasiswa per ruang
function anggotaMahasiswaPerRuang($idRuang) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "select A.nomor, X.nama, A.anggota, A.statusanggota, A.keanggotaan from anggotaLab A INNER JOIN mahasiswa X on A.anggota = X.nrp WHERE RUANG = $idRuang";
    $hasil = query_getAll($con, $sql);
    return $hasil;
}
function MahasiswaPerRuang($idRuang) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "select A.nomor, X.nama, A.anggota, A.statusanggota, A.keanggotaan from anggotaLab A INNER JOIN mahasiswa X on A.anggota = X.nrp WHERE RUANG = $idRuang AND A.KEANGGOTAAN = 2";
    $hasil = query_getAll($con, $sql);
    return $hasil;
}
//fungsi untuk mengambil data pegawai per ruang
function anggotaPegawaiPerRuang($idRuang) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "select A.nomor, X.nama, A.anggota, A.statusanggota, A.keanggotaan from anggotaLab A INNER JOIN pegawai X on A.anggota = X.nip WHERE RUANG = '$idRuang'";
    $hasil = query_getAll($con, $sql);
    oci_fetch_all($hasil, $rows , 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
    return $rows;
    // select P.nama from pegawai P INNER JOIN anggotalab A On P.nip = A.anggota WHERE A.ruang = 87
}
function PegawaiPerRuang($idRuang) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "select A.nomor, X.nama, A.anggota, A.statusanggota, A.keanggotaan from anggotaLab A INNER JOIN pegawai X on A.anggota = X.nip WHERE RUANG = '$idRuang' AND A.KEANGGOTAAN = 2";
    $hasil = query_getAll($con, $sql);
    oci_fetch_all($hasil, $rows , 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
    return $rows;
}
//fungsi untuk menghitung data anggota ruang
function countAnggotaRuang($idRuang) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT COUNT(*) AS jumlah FROM ANGGOTALAB WHERE RUANG = $idRuang AND KEANGGOTAAN = 2";
    $hasil = query_count($con, $sql);
    $row = oci_fetch_array($hasil);
    return $row['JUMLAH'];
}

//fungsi untuk menghapus data anggota ruang
function deleteAnggotaRuang($idRuang, $idAnggota, $nomor) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "DELETE FROM ANGGOTALAB WHERE RUANG = $idRuang AND ANGGOTA = $idAnggota AND NOMOR = $nomor";
    $hasil = query_delete($con, $sql);
    return $hasil;
}

//fungsi untuk konfirmasi diterima atau tidak
function konfirmasiAnggotaRuang($status, $idRuang, $idAnggota, $nomor) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "UPDATE ANGGOTALAB SET KEANGGOTAAN = $status WHERE RUANG = $idRuang AND ANGGOTA = $idAnggota AND NOMOR = $nomor";
    $hasil = query_update($con, $sql);
    return $hasil;
}
//fungsi untuk menampilkan semua jumlah anggota ruang
function jumlahAnggotaRuang() {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT COUNT(*) AS jumlah FROM ANGGOTALAB";
    $hasil = query_count($con, $sql);
    $row = oci_fetch_array($hasil);
    return $row['JUMLAH'];
}

?>