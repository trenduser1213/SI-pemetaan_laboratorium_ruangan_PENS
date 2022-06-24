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
    // return $hasil;
    //jika data ada lebih dari 1 maka return false
    oci_fetch_all($hasil, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW) or die(oci_error()); 
        foreach ($rows as $row) {
            if ($row['ANGGOTA'] == $idAnggota) {
                return true;
            }elseif ($row['ANGGOTA'] != $idAnggota) {
                return false;  
            } 
        }
    
}

?>