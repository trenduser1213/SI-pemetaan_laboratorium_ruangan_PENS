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
        $dataDcode=json_decode($hasil);
        // $x =substr($dataDcode,0,5);

        if($hasil == "auth error"){
            echo "<script>alert('Login Gagal');</script>";
        }else{
           session_start();
            
            // var_dump($dataDcode->NRP);
            if(isset($dataDcode->NRP)){
                $_SESSION['user'] = $dataDcode->NRP;
            }else{
                $_SESSION['user'] = $dataDcode->NIP;
            }
            $_SESSION['nama'] = $dataDcode->name;

            var_dump($dataDcode);
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
}
