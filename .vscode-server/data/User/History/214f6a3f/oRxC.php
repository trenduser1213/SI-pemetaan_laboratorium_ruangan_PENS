<?php
require_once "includes/func.inc.php";

$db_user = "pa0021";
$db_pass = "375300";

function jumlahLaboratorium() {
    $con = konekDb($db_user, $db_pass);
    $sql = "SELECT COUNT(*) AS jumlah FROM ruang";
    $hasil = query_count($con, $sql);
    $row = oci_fetch_array($hasil);
    return $row['JUMLAH'];
}
