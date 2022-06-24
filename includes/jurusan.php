<?php
require_once "includes/func.inc.php";

function dataJurusan() {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT nomor, jurusan_lengkap FROM jurusan";
    $hasil = query_getAll($con, $sql);
    return $hasil;
}
