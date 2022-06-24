<?php
require_once "includes/func.inc.php";
//rules kepala ruang
function rulesKepalaRuang($idRuang, $idAnggota){
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "Select x.nip AS NIP  from ruang r INNER JOIN pegawai x ON r.kepala = x.nomor WHERE r.nomor = '$idRuang'";
    $row = query_getAll($con, $sql);
    
}

?>