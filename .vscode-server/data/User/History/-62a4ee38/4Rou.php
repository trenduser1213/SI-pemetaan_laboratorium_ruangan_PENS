<?php
require_once 'func.inc.php';
//fungsi untuk menampilkan link materi per ruang
function materiPerRuang($idRuang){
    $con = koneksiDB();
    $sql = "SELECT * FROM materi WHERE ruang = '$idRuang'";
    $rows = query_getAll($con, $sql);
    oci_fetch_all( $rows, $hasil, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
    return $hasil;
}

// fungsi untuk menambahkan materi per ruang
function tambahMateri($idRuang, $judul, $link){
    $con = koneksiDB();
    $sql = "INSERT INTO MATERI ( NOMOR,RUANG, JUDUL, LINK ) VALUES ( ai.nextval, '$idRuang', '$judul', '$link')";
    $hasil = query_insert($con, $sql);
    return $hasil;
}

//fungsi untuk delete materi 
function deleteMateri($idRuang, $idMateri){
    $con = koneksiDB();
    $sql = "DELETE FROM materi WHERE RUANG = $idRuang AND nomor = $idMateri";
    $hasil = query_delete($con, $sql);
    return $hasil;
}

//fungsi untuk update materi
function updateMateri($idRuang, $idMateri, $updateJudul, $updateLink){
    $con = koneksiDB();
    $sql ="UPDATE materi SET judul = '$updateJudul' , link = '$updateLink' WHERE ruang = $idRuang AND nomor = $idMateri";
    $hasil = query_update($con, $sql);
    return $hasil;
}
//s







?>