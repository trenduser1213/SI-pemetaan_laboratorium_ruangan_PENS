<?php
require_once "includes/func.inc.php";

//tambahkan pengumuman
function tambahPengumuman($idRuang, $isi) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "INSERT INTO pengumuman (RUANG, ISI ) VALUES ( '$idRuang','$isi')";
    $hasil = query_insert($con, $sql);
    return $hasil;
}

?>