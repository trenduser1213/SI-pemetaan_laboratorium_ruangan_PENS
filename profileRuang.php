<?php
//https://youtu.be/y3GIgsRUYsU
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
// var_dump($cekRulesKepalaRuang);
$cekRulesAsistenRuang = RulesAsistenRuang($statusPengguna, $idRuang, $idAnggota);
// var_dump($cekRulesAsistenRuang);
$cekRulesTeknisiRuang = RulesTeknisiRuang($statusPengguna, $idRuang, $idAnggota);
// var_dump($cekRulesTeknisiRuang);
$cekRulesAnggotaRuang =  rulesAnggotaRuang($statusPengguna, $idRuang, $idAnggota);
// var_dump($cekRulesAnggotaRuang);
?>
<?php
$detailRuang = detailRuang($idRuang);

oci_fetch_all($detailRuang, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
//$no = 1;
foreach ($rows as $hasil) {

?>
    <?php
    if($_GET['halaman'] == 'detailRuangLab'){
    ?>
        <div class="container-fluid">
            <h3 class="text-dark mb-4">Profile <?php echo $hasil['RUANG'];?> </h3>
            <div class="row mb-3">
                <div class="col-lg-4 text-capitalize text-primary">
                    <?php include 'viewCardVirtual.php'?>
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
    <?php }elseif($_GET['halaman'] == 'detailRuangan'){ ?>
        <div class="container-fluid">
            <h3 class="text-dark mb-4">Profile <?php echo $hasil['RUANG'];?> </h3>
            <div class="row mb-3">
                <div class="col-lg-4 text-capitalize text-primary">
                    <?php include 'viewCardVirtual.php'?>
                    <?php// include "viewPengumuman.php" ?>
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
<?php } ?>
