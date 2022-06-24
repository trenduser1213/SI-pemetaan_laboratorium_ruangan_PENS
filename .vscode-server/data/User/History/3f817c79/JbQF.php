<?php
require_once ('includes/func.inc.php');
class dosen {
    function __construct(){
        $db_user = "pa_example";
        $db_pass = "123";
        $con = konekDb($db_user, $db_pass);
    }
    //menghitung jumlah dosen
    function jumlahDosen(){
        $sql = "SELECT COUNT(*) AS jumlah FROM dosen";
        $hasil = query_view($con, $sql);
        $row = oci_fetch_array($hasil);
        return $row['JUMLAH'];
    }    
}

?>