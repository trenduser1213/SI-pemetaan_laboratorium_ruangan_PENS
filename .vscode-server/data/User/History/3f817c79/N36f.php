<?php
// require_once ('includes/func.inc.php');
class dosen {
    function __construct($db_user, $db_pass) {
        $db_user = "pa0021";
        $db_pass = "375300";
        $con=oci_connect($db_user,$db_pass,"10.252.209.213/orcl.mis.pens.ac.id");
        if(!$con) {
            responseError('ERR-DB');
        }
        return $con;
    }
    // function __construct(){
    //     $db_user = "pa0021";
    //     $db_pass = "375300";
    //     $con = konekDb($db_user, $db_pass);
    // }
    //menghitung jumlah dosen
    function jumlahDosen(){
        $sql = "SELECT COUNT(*) AS jumlah FROM pegawai WHERE staff='4'";
        $hasil = query_view($con, $sql);
        $row = oci_fetch_array($hasil);
        return $row['JUMLAH'];
    }    
}

?>