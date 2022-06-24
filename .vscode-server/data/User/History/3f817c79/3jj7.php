<?php
require_once ('includes/func.inc.php');
class dosens{
    function __construct(){
        $db_user = "pa_example";
        $db_pass = "123";
        $con = konekDb($db_user, $db_pass);
    }
    //menghitung jumlah dosen
    function jumlahDosen(){
        $sql = "SELECT COUNT(*) AS jumlah FROM pegawai WHERE staff = 4 ";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        return $row['jumlah'];
    }    
}

?>