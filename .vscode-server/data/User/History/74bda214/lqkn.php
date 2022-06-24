<?php
require_once 'includes/func.inc.php';

function joinLab($idAnggota, $idRuang, $idStatus, $idKeanggotaan) {
    $db_user = "pa0021";
    $db_pass = "375300";
    $con = konekDb($db_user, $db_pass);
    $sql = "INSERT INTO ANGGOTALAB (NOMOR, RUANG, ANGGOTA, STATUS, KEANGGOTAAN) VALUES (ai.nextval, $idRuang, $idAnggota, $idStatus, $idKeanggotaan )";
    $hasil = query_insert($con, $sql);
    if($hasil == 1) {
        echo '<script>alert("Anda berhasil join ruang '.$hasil['RUANG'].'")</script>';
        echo '<script>window.location.href="profileRuang.php?id='.$idRuang.'"</script>';
        return $hasil;
    }else{
        echo '<script>alert("Anda gagal join ruang '.$hasil['RUANG'].'")</script>';
        echo '<script>window.location.href="profileRuang.php?id='.$idRuang.'"</script>';
    }      
}


?>