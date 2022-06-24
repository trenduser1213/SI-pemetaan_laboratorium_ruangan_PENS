<?php
require_once "includes/func.inc.php";
//rules kepala ruang
function rulesKepalaRuang($statusPengguna, $idRuang, $idAnggota){
    if($statusPengguna == "Mahasiswa"){
        return false;
    }else{
        $db_user = "pa0021";
        $db_pass = "375300";
        $con = konekDb($db_user, $db_pass);
        $sql = "Select x.nip AS NIP  from ruang r INNER JOIN pegawai x ON r.kepala = x.nomor WHERE r.nomor = '$idRuang'";
        $row = query_getAll($con, $sql);
        oci_fetch_all($row, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        if($rows[0]['NIP'] == $idAnggota){
            return true;
        }else{
            return false;
        }   
    }
}
//rules asisten ruang
function rulesAsistenRuang($statusPengguna, $idRuang, $idAnggota){
    if($statusPengguna == "Mahasiswa" ){
        return false;
    }else{
        $db_user = "pa0021";
        $db_pass = "375300";
        $con = konekDb($db_user, $db_pass);
        $sql = "Select x.nip AS NIP  from ruang r INNER JOIN pegawai x ON r.asisten = x.nomor WHERE r.nomor = '$idRuang'";
        $row = query_getAll($con, $sql);
        // $hasil = deco
        oci_fetch_all($row, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        // var_dump($rows[0]['NIP']);
        if(isset($rows[0]['NIP'] )){
            return false;
        }elseif($rows[0]['NIP'] == $idAnggota){
            return true;
        }else{
            return false;
        }        
    }
}
//rules teknisi ruang
function rulesTeknisiRuang($statusPengguna, $idRuang, $idAnggota){
    if($statusPengguna == "Mahasiswa"){
        return false;
    }else{
        $db_user = "pa0021";
        $db_pass = "375300";
        $con = konekDb($db_user, $db_pass);
        $sql = "Select x.nip AS NIP  from ruang r INNER JOIN pegawai x ON r.teknisi = x.nomor WHERE r.nomor = '$idRuang'";
        $row = query_getAll($con, $sql);
        oci_fetch_all($row, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        if($rows[0]['NIP'] == $idAnggota){
            return true;
        }else{
            return false;
        }
    }
}

?>