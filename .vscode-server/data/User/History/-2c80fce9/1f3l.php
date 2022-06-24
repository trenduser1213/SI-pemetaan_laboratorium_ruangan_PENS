<?php
require_once "func.inc.php";

//fungsi untuk menambahkan penelitian
function createPenelitian($judulPenelitian, $idRuang, $idPeneliti, $idDosbim1, $idDosbim2, $idDosbim3){
    $con = koneksiDB();
    $sql = "INSERT INTO penelitian(nomor, judul, ruang, peneliti, dosbim1, dosbim2, dosbim3, statuspenelitian) VALUES (ai.nextval, $judulPenelitian, $idRuang, $idPeneliti, $idDosbim1, $idDosbim2, $idDosbim3)";
    $hasil = query_insert($con, $sql);
    return $hasil;
}

//fungsi untuk menampilkan penelitian
function dataPenelitian($idRuang){
    $con = koneksiDB();
    $sql = "SELECT nomor, judul, ruang, peneliti, dosbim1, dosbim2, dosbim3, statusanggota FROM penelitian WHERE ruang = $idRuang";
    $rows = query_getAll($con, $sql);
    oci_fetch_all( $rows, $hasil, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
    return $hasil;
}


?>