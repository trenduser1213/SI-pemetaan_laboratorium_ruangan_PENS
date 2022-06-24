<?php
require_once "includes/func.inc.php";

function jadwalRuang($id) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT * FROM jadwal WHERE ruang = '$nomor'";
    $hasil = query_getAll($con, $sql);
    return $hasil;
}
?>