<?php
require_once ('includes/func.inc.php');
class dosen {
    // $db_user = "pa0021";
    // $db_pass = "375300";
    // function konekDb() {
    //     $con=oci_connect($db_user,$db_pass,"10.252.209.213/orcl.mis.pens.ac.id");
    //     if(!$con) {
    //         responseError('ERR-DB');
    //     }
    //     return $con;
    // }
    function __construct(){
    }
    //menghitung jumlah dosen
    function jumlahDosen(){
        $db_user = "pa_example";
        $db_pass = "123";
        $con = konekDb($db_user, $db_pass);
        $sql = "SELECT COUNT(*) FROM barang";
        $hasil = query_getAll($con, $sql, $data);
        $row = oci_fetch_array($hasil);
        return $row[0];
    }    
}

?>