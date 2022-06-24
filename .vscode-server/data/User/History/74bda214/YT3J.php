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

function cekAnggota($idAnggota, $idRuang) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT * FROM ANGGOTALAB WHERE RUANG = $idRuang AND ANGGOTA = $idAnggota" ;
    $hasil = query_getAll($con, $sql);
    //cek apakah ada data yang sama
    if(oci_fetch_all($hasil, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW)) {
        //kalau ada data yang sama
        return true;
    } else {
        //kalau tidak ada data yang sama
        return false;
    }
}
    // return $hasil;
}  

?>