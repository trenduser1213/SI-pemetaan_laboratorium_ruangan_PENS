<?php
require_once ('includes/func.inc.php');
class dosen extends func.inc.php {
    function __construct(){
        $db_user = "pa_example";
        $db_pass = "123";
        $con = konekDb($db_user, $db_pass);
    }
    //menghitung jumlah dosen
    function jumlahDosen(){
        $sql="SELECT COUNT(*) FROM pegawais";
        $hasil=query_select($con,$sql);
        $row=mysqli_fetch_row($hasil);
        $jumlah=$row[0];
        return $jumlah;
    }    
}

?>