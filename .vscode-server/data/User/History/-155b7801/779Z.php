<?php
class Oauth {
    public function login($email, $password) {
        
        $header=array("netid: $email","password: ".base64_encode($password));
        $data = curl_init();
        curl_setopt($data, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($data, CURLOPT_HTTPHEADER, $header);
        curl_setopt($data, CURLOPT_URL, "https://login.pens.ac.id/auth/");
        curl_setopt($data, CURLOPT_TIMEOUT, 9);

        $hasil = curl_exec($data);
        var_dump($hasil);
        // $dataDcode=json_decode($hasil);
        // $x =substr($dataDcode,0,5);

        // if($hasil == "auth error"){
        //     echo "<script>alert('Login Gagal');</script>";
        // }else{
        // //    session_start();
            
        //     // var_dump($dataDcode->NRP);
        //     if(isset($dataDcode->NRP)){
        //         $_SESSION['ID_user'] = $dataDcode->NRP;
        //         $_SESSION['StatusPengguna'] = "Mahasiswa";
        //     }else{
        //         $_SESSION['ID_user'] = $dataDcode->NIP;
        //         if($dataDcode->Name == "Idris Winarno"){
        //             $_SESSION['StatusPengguna'] = "admin";
        //         }else{
        //             $_SESSION['StatusPengguna'] = "Pegawai";
        //         }
        //     }
        //     $_SESSION['Nama'] = $dataDcode->Name;
        //     $_SESSION['Status'] = $dataDcode->Status;
        //     $_SESSION['Netid'] = $dataDcode->netid;
        //     $_SESSION['Group'] = $dataDcode->Group;


        //     // var_dump($dataDcode);
        //     echo "<script>alert('Login Berhasil');</script>";
        //     echo "<script>window.location.href='index.php';</script>";

        // }
        // curl_close($data);
        
    }
    public function logout() {
        $data = curl_init();
        curl_setopt($data, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($data, CURLOPT_URL, "https://login.pens.ac.id/auth/logout");
        curl_setopt($data, CURLOPT_TIMEOUT, 9);

        $hasil = curl_exec($data);
        curl_close($data);
    }
}
