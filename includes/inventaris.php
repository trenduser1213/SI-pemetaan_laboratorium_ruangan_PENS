<?php
require_once 'includes/func.inc.php';

function inventarisRuang($id){
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "select DISTINCT(spek), nama , kode, pabrik, tahun from inventaris where ruang = '$id' order by nama";
    $hasil = query_getAll($con, $sql);
    return $hasil;
}


?>