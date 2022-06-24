<?php
require_once 'includes/ruang.php';
require_once 'includes/anggotaRuang.php';
require_once 'includes/rulesRuang.php';
// $id = $_GET['id'];
// print_r($id);var_dump($id);
$idAnggota = $_SESSION['ID_user'];
$idRuang = $_GET['id'];
if($_SESSION['StatusPengguna'] == 'Pegawai'){
    $idStatus = 1;
}elseif($_SESSION['StatusPengguna'] == 'admin'){
    $idStatus = 1;
}else{
    $idStatus = 2;
}
$statusPengguna = $_SESSION['StatusPengguna'];
$cekRulesKepalaRuang = RulesKepalaRuang($statusPengguna, $idRuang, $idAnggota);
var_dump($cekRulesKepalaRuang);
$cekRulesAsistenRuang = RulesAsistenRuang($statusPengguna, $idRuang, $idAnggota);
var_dump($cekRulesAsistenRuang);
$cekRulesTeknisiRuang = RulesTeknisiRuang($statusPengguna, $idRuang, $idAnggota);
var_dump($cekRulesTeknisiRuang);

?>
<?php
$detailRuang = detailRuang($idRuang);

oci_fetch_all($detailRuang, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
//$no = 1;
foreach ($rows as $hasil) {

?>
    <div class="container-fluid">
        <h3 class="text-dark mb-4">Profile <?php echo $hasil['RUANG'];?> </h3>
        <div class="row mb-3">
            <div class="col-lg-4 text-capitalize text-primary">
                <div class="card mb-3 shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold"><?php echo $hasil['RUANG'];?></p>
                    </div>
                    <div class="card-body text-center shadow"><img class="mb-3 mt-4" src="assets/img/7-e1522373974763.jpg" width="160" height="160">
                        <div class="mb-3">
                            
                            <h4 class="text-primary"></h4><button class="btn btn-virtual">Virtual Tour <?php echo $hasil['RUANG'];?><br></button>
                        </div>
                        <?php
                        if($cekRulesKepalaRuang != true && $cekRulesAsistenRuang != true && $cekRulesTeknisiRuang != true){
                            $cekRuang = cekAnggota($idAnggota, $idRuang);
                            //  var_dump($cekRuang);
                            oci_fetch_all($cekRuang, $rowss, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
                            // var_dump($rowss);
                            // $test = Array();
                            if(sizeof($rowss) == 0){
                                echo '<form method="POST"><button name="Join" class="btn btn-primary btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-flag"></i></span><span class="text-white text">Join</span></button></form>';
                            } else {
                                foreach ($rowss as $hasill) {
                                    if($hasill['KEANGGOTAAN'] == 2){
                                        $nomor = $hasill['NOMOR'];
                                        echo '<form method="POST"><button name="leave" class="btn btn-danger btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-flag"></i></span><span class="text-white text">Leave</span></button></form>';
                                    }elseif($hasill['KEANGGOTAAN'] == 1){
                                        echo '<button name="" class="btn btn-warning btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-flag"></i></span><span class="text-white text">with</span></button>';
                                    }
                                }
                            }
                        }                                    
                            ?>
                        <!-- <form method="POST"><button name="Join" class="btn btn-danger btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-flag"></i></span><span class="text-white text">LEAVE</span></button></form> -->
                            <?php
                            if(isset($_POST['Join'])){
                                $idKeanggotaan = 1;
                                $joinLab = joinLab($idAnggota, $idRuang, $idStatus, $idKeanggotaan);
                                if($joinLab){
                                    echo '<script>alert("Anda berhasil join ruang '.$hasil['RUANG'].'")</script>';
                                    echo '<script>window.location.href="index.php?halaman=detailRuang&id='.$idRuang.'"</script>';
                                }else{
                                    echo '<script>alert("Anda gagal join ruang '.$hasil['RUANG'].'")</script>';
                                    echo '<script>window.location.href="index.php?halaman=detailRuang&id='.$idRuang.'"</script>';
                                }
                            }elseif(isset($_POST['leave'])){
                                // $idKeanggotaan = 2;
                                $leaveLab = deleteAnggotaRuang($idRuang, $idAnggota, $nomor);
                                if($leaveLab){
                                    echo '<script>alert("Anda berhasil leave ruang '.$hasil['RUANG'].'")</script>';
                                    // var_dump($leaveLab);
                                    echo '<script>window.location.href="index.php?halaman=detailRuang&id='.$idRuang.'"</script>';
                                }else{
                                    echo '<script>alert("Anda gagal leave ruang '.$hasil['RUANG'].'")</script>';
                                    echo '<script>window.location.href="index.php?halaman=detailRuang&id='.$idRuang.'"</script>';
                                }
                            }
                            ?>
                    </div>
                </div>
                <?php include "viewPengumuman.php" ?>
            </div>
            <div class="col-lg-8 text-capitalize">
                <div class="row">
                    <div class="col">
                        <?php include 'viewInfoLab.php'?>
                        <?PHP include "jadwalRuang.php"; ?>
                        <?php include 'viewAnggotaRuang.php' ?>
                        <?php include 'viewDaftarMateri.php' ?>
                        <?php include 'viewPenelitian.php'?>
                        <?php include 'inventarisRuang.php'?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
