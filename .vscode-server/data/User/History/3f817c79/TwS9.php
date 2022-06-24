<?php
require_once ('includes/func.inc.php');
class dosen {
    function __construct(){
        $db_user = "pa0021";
        $db_pass = "375300";
        $con = konekDb($db_user, $db_pass);
    }
    //menghitung jumlah dosen
    function jumlahDosen(){
        $sql = "SELECT COUNT(*) FROM dosen";
        $hasil = query_view($con, $sql);
        $row = oci_fetch_array($hasil);
        return $row['JUMLAH'];
    }    
}

?>