<?php
require_once ('includes/func.inc.php');
class dosens{
    function __construct(){
        $db_user = "pa_example";
        $db_pass = "123";
        $con = konekDb($db_user, $db_pass);
    }
}

?>