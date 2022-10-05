<?php
class Oauth {
    public function login($email, $password) {
        require_once 'includes/func.inc.php';
        
        $header=array("netid: $email","password: ".base64_encode($password));
        $data = curl_init();
        curl_setopt($data, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($data, CURLOPT_HTTPHEADER, $header);
        curl_setopt($data, CURLOPT_URL, "https://login.pens.ac.id/auth/");
        curl_setopt($data, CURLOPT_TIMEOUT, 9);

        $hasil = curl_exec($data);
        $dataDcode=json_decode($hasil);
        // $x =substr($dataDcode,0,5);

        if($hasil == "auth error"){
            echo "<script>alert('Login Gagal');</script>";
        }else{
        //    session_start();
            
            // var_dump($dataDcode->NRP);
            $con=koneksiDB();
            if(isset($dataDcode->NRP)){
                $_SESSION['ID_user'] = $dataDcode->NRP;
                $_SESSION['StatusPengguna'] = "Mahasiswa";
                $detail=$dataDcode->NRP;
                $sql="select M.nomor AS nomor_mahasiswa, M.*,K.kode as nama_kelas,J.jurusan as nama_jurusan, K.* 
                from mahasiswa M JOIN kelas K on M.kelas = K.nomor
                JOIN jurusan J on K.jurusan = J.nomor WHERE nrp = '$detail'";
                $hasil=query_getAll($con, $sql);
                oci_fetch_all($hasil, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
                $_SESSION['Jurusan']=$rows[0]['NAMA_JURUSAN'];
                $_SESSION['ID_Jurusan']=$rows[0]['JURUSAN'];
                $_SESSION['Nama_Kelas']=$rows[0]['NAMA_KELAS'];
                $_SESSION['Wali_Kelas']=$rows[0]['WALI_KELAS']; 
            }else{
                $_SESSION['ID_user'] = $dataDcode->NIP;
                $detail=$dataDcode->NIP;
                $sql="select P.*, J.jurusan as nama_jurusan from pegawai P JOIN jurusan J on P.jurusan = J.nomor where NIP = '$detail'";
                $hasil=query_getAll($con, $sql);
                oci_fetch_all($hasil, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
                $_SESSION['Jurusan']=$rows[0]['NAMA_JURUSAN'];
                $_SESSION['ID_Jurusan']=$rows[0]['JURUSAN'];
                if($dataDcode->Name == "EEPIS Network Administrator"){
                    $_SESSION['StatusPengguna'] = "admin";
                }else{
                    $_SESSION['StatusPengguna'] = "Pegawai";
                }
            }
            $_SESSION['Nama'] = $dataDcode->Name;
            $_SESSION['Status'] = $dataDcode->Status;
            $_SESSION['Netid'] = $dataDcode->netid;
            $_SESSION['Group'] = $dataDcode->Group;


            // var_dump($dataDcode);
            echo "<script>alert('Login Berhasil');</script>";
            echo "<script>window.location.href='index.php';</script>";

        }
        curl_close($data);
        
    }
    public function logout() {
        $data = curl_init();
        curl_setopt($data, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($data, CURLOPT_URL, "https://login.pens.ac.id/auth/logout");
        curl_setopt($data, CURLOPT_TIMEOUT, 9);

        $hasil = curl_exec($data);
        curl_close($data);
    }
    
    // function detailMahasiswa($detail){
    //     $sql="select M.nomor AS nomor_mahasiswa, M.*,K.kode as nama_kelas,J.jurusan, K.* 
    //             from mahasiswa M JOIN kelas K on M.kelas = K.nomor
    //             JOIN jurusan J on K.jurusan = J.nomor WHERE nrp = '$detail'";
    //     $con=koneksiDB();
    //     $hasil=query_getAll($con, $sql);
    //     oci_fetch_all($hasil, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
    //     return $rows;
    // }
}
