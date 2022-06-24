<?php
require_once "func.inc.php";

//fungsi untuk menambahkan penelitian
function createPenelitian($judulPenelitian, $idRuang, $idPeneliti, $idDosbim1, $idDosbim2, $idDosbim3, $statusanggota){
    $con = koneksiDB();
    $sql = "INSERT INTO penelitian(nomor, judul, ruang, peneliti, dosbim1, dosbim2, dosbim3, statusanggota) VALUES (ai.nextval, '$judulPenelitian', $idRuang, $idPeneliti, $idDosbim1, $idDosbim2, $idDosbim3, $statusanggota)";
    $hasil = query_insert($con, $sql);
    return $hasil;
}

//fungsi untuk menampilkan penelitian
function dataPenelitian($idRuang){
    $con = koneksiDB();
    $sql = "SELECT P.nomor, P.judul, P.ruang, M.nama AS PENELITI , X.nama AS dosbim1, XX.nama AS dosbim2, XXX.nama AS dosbim3, P.statusanggota FROM penelitian P INNER JOIN mahasiswa M ON M.nrp = P.peneliti INNER JOIN pegawai X ON X.nomor = P.dosbim1 INNER JOIN pegawai XX ON XX.nomor = P.dosbim2 INNER JOIN pegawai XXX ON XXX.nomor = P.dosbim3 WHERE ruang = $idRuang";
    $rows = query_getAll($con, $sql);
    oci_fetch_all( $rows, $hasil, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
    return $hasil;
}


?>