<?php
    require_once 'includes/func.inc.php';
    $nomor=$_POST['nomor'];
    $idRuang=$_POST['idRuang'];
    $con = koneksiDB();
    $sql ="DELETE FROM RUANGBARU WHERE NOMOR = $idRuang";
    $hasil = query_delete($con,$sql);
    if($hasil == "Success Delete"){
        echo "<script>alert('Success Delete');</script>";
        echo "<script>window.location.href='index.php';</script>";
    }