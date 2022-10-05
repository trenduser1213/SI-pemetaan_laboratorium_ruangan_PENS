<?php
    require_once 'includes/func.inc.php';
    $nomor=$_POST['nomor'];
    $idRuang=$_POST['idRuang'];
    $namaLab=$_POST['namaLab'];
    $lokasi=$_POST['lokasi'];
    $telp=$_POST['telp'];
    $jurusan=$_POST['jurusan'];
    $ketua=$_POST['ketua'];
    $asisten=$_POST['asisten'];
    $teknisi=$_POST['teknisi'];
    $virtual=$_POST['virtual'];
    $con = koneksiDB();
    $sql = "UPDATE RUANGBARU SET ruang='$lokasi', keterangan='$namaLab', jurusan='$jurusan', telp='$telp', kepala='$ketua', asisten='$asisten', teknisi='$teknisi', virtual='$virtual' WHERE NOMOR ='$nomor'";
    $hasil = query_update($con, $sql);
    var_dump($hasil);
    if($hasil == "Success Update"){
        echo "<script>alert('Success Update');</script>";
        echo "<script>window.location.href='index.php';</script>";
    }
?>