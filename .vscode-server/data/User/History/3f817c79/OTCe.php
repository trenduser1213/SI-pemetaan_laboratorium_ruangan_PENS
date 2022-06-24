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
        $db_user = "pa_example";
        $db_pass = "123";
        $con = konekDb($db_user, $db_pass);
    }
    //menghitung jumlah dosen
    function jumlahDosen(){
        $sql = "SELECT COUNT(*) AS jumlah FROM barang";
        $hasil = query_count($con, $sql, $data);
        $row = oci_fetch_array($hasil);
        return $row['JUMLAH'];
    }


    
    //memanggil data dosen
    function dataDosen(){
        $sql = "SELECT * FROM pegawa";
        $hasil = query_view($con, $sql, $data);
        return $hasil;
    }
     //memanggil data dosen berdasarkan id
     function dataDosenById($id){
        $sql = "SELECT * FROM pegawai WHERE id = $id";
        $hasil = query_view($con, $sql, $data);
        return $hasil;
    }
    //menambahkan data dosen
    function tambahDosen($nama, $alamat, $telp){
        $sql = "INSERT INTO pegawai (nama, alamat, telp) VALUES ('$nama', '$alamat', '$telp')";
        $hasil = query_insert($con, $sql, $data);
        return $hasil;
    }
    //mengubah data dosen
    function ubahDosen($id, $nama, $alamat, $telp){
        $sql = "UPDATE pegawai SET nama = '$nama', alamat = '$alamat', telp = '$telp' WHERE id = $id";
        $hasil = query_update($con, $sql, $data);
        return $hasil;
    }
    //menghapus data dosen
    function hapusDosen($id){
        $sql = "DELETE FROM pegawai WHERE id = $id";
        $hasil = query_delete($con, $sql, $data);
        return $hasil;
    }
    //mencari data dosen berdasarkan nama
    function cariDosen($nama){
        $sql = "SELECT * FROM pegawai WHERE nama LIKE '%$nama%'";
        $hasil = query_view($con, $sql, $data);
        return $hasil;
    }


}

?>