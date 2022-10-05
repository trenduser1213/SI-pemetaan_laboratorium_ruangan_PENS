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
//    $sql = "SELECT * FROM penelitian WHERE ruang = $idRuang";
    $sql = "SELECT P.nomor, P.judul, P.ruang, M.nama AS PENELITI , X.nama AS dosbim1, XX.nama AS dosbim2, XXX.nama AS dosbim3, P.statusanggota FROM penelitian P LEFT JOIN mahasiswa M ON M.nrp = P.peneliti LEFT JOIN pegawai X ON X.nomor = P.dosbim1 LEFT JOIN pegawai XX ON XX.nomor = P.dosbim2 LEFT JOIN pegawai XXX ON XXX.nomor = P.dosbim3 WHERE ruang = $idRuang";
    $rows = query_getAll($con, $sql);
    oci_fetch_all( $rows, $hasil, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
//    var_dump($hasil);
    return $hasil;
}

//SELECT P.nomor, P.judul, P.ruang, M.nama AS PENELITI , X.nama AS dosbim1, XX.nama AS dosbim2, XXX.nama AS dosbim3, P.statusanggota FROM penelitian P INNER JOIN mahasiswa M ON M.nrp = P.peneliti INNER JOIN pegawai X ON X.nomor = P.dosbim1 INNER JOIN pegawai XX ON XX.nomor = P.dosbim2 INNER JOIN pegawai XXX ON XXX.nomor = P.dosbim3 WHERE ruang = $idRuang//fungsi untuk delete penelitian
function deletePenelitian($nomorPenelitian, $idRuang){
    $con = koneksiDB();
    $sql = "DELETE FROM penelitian WHERE nomor = $nomorPenelitian and ruang = $idRuang";
    $hasil = query_delete($con, $sql);
    if($hasil == "Success Delete"){
        echo "<script>alert('Success Delete');</script>";
        echo "<script>window.location.href='index.php?halaman=detailRuangLab&id=$idRuang';</script>";
    }
}

function updatePenelitian($judulPenelitian, $idRuang, $idPeneliti, $idDosbim1, $idDosbim2, $idDosbim3, $nomorPenelitian){
    $con = koneksiDB();
    $sql = "UPDATE penelitian SET judul= '$judulPenelitian' , dosbim1 = $idDosbim1, dosbim2 = $idDosbim2, dosbim3 = $idDosbim3 WHERE ruang = $idRuang AND nomor = $nomorPenelitian";
    $hasil = query_update($con, $sql);
    var_dump($hasil);
}




?>