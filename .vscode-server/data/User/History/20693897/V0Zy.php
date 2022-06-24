<?php
require_once "includes/func.inc.php";

//tambahkan pengumuman
function tambahPengumuman($idRuang, $isi) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "INSERT INTO pengumuman ( NOMOR,RUANG, ISI ) VALUES ( ai.nextval, '$idRuang', '$isi')";
    $hasil = query_insert($con, $sql);
    return $hasil;
}
//fungsi untuk mengambil data pengumuman per ruang
function pengumumanPerRuang($idRuang) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "select * from pengumuman where ruang = '$idRuang' order by nomor";
    $rows = query_getAll($con, $sql);
    oci_fetch_all( $rows, $hasil, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
    return $hasil;
}
//fungsi untuk delete data pengumuman per nomor
function deletePengumuman($nomor) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "delete from pengumuman where nomor = '$nomor'";
    $hasil = query_delete($con, $sql);
    return $hasil;
}
// fungsi untuk update pengumuman
function updatePengumuman($nomor, $idRuang, $updateIsi){
    $con = koneksiDB();
    $sql = "UPDATE pengumuman SET isi = '$updateIsi' WHERE nomor = '$nomor' AND ruang = '$idRuang'"
}

?>