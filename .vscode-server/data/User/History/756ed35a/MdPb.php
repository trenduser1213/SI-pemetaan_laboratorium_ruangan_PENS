<?php
require_once 'includes/ruang.php';
require_once 'includes/anggotaRuang.php';
// $id = $_GET['id'];
// print_r($id);var_dump($id);
$idAnggota = $_SESSION['ID_user'];
$idRuang = $_GET['id'];
if($_SESSION['StatusPengguna'] == 'Dosen'){
    $idStatus = 1;
}else{
    $idStatus = 2;
}

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
                                        $cekRuang = cekAnggota($idAnggota, $idRuang);
                                        //  var_dump($cekRuang);
                                        oci_fetch_all($cekRuang, $rowss, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
                                        // var_dump($rowss);
                                        // $test = Array();
                                        if(sizeof($rowss) == 0){
                                            echo '<form method="POST"><button name="Join" class="btn btn-primary btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-flag"></i></span><span class="text-white text">Join</span></button></form>';
                                        } else {
                                            foreach ($rowss as $hasill) {
                                                if($hasill['ANGGOTA'] == $idAnggota){
                                                    $nomor = $hasill['NOMOR'];
                                                    echo '<form method="POST"><button name="leave" class="btn btn-warning btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-flag"></i></span><span class="text-white text">Leave</span></button></form>';
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
                            <div class="card mb-3 shadow">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 font-weight-bold">PENGUMUMAN</p>
                                </div>
                                <div class="card-body text-center shadow">
                                    <div class="mb-3">
                                        <p>1. Paragraph</p>
                                        <button class="btn btn-primary fa fa-plus"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 text-capitalize">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">informasi Ruang <?php echo $hasil['RUANG'];?></p>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="form-row">
                                                    <div class="col-4 col-lg-4">
                                                        <div class="form-group"><label for="username"><strong>Kepala laboratorium</strong><br></label>
                                                            <p><?php echo $hasil['KEPALA'];?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-lg-4">
                                                        <div class="form-group"><label for="username"><strong>asisten laboratorium</strong><br></label>
                                                            <p><?php echo $hasil['ASISTEN'];?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-lg-4">
                                                        <div class="form-group"><label for="username"><strong>Teknisi laboratorium</strong><br></label>
                                                            <p><?php echo $hasil['TEKNISI'];?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-lg-4">
                                                        <div class="form-group"><label for="email"><strong>No.Telp</strong><br></label>
                                                            <p><?php echo $hasil['TELP'];?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-lg-4">
                                                        <div class="form-group"><label for="email"><strong>Gedung</strong><br></label>
                                                            <p>Pasca sarjana</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                                        <div class="form-group"><label for="email"><strong>Deskripsi</strong><br></label>
                                                            <p><?php echo $hasil['KETERANGAN'];?><br></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <?PHP include "jadwalRuang.php"; ?>
                                    <?php include 'viewAnggotaRuang.php' ?>

                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Materi Penunjang</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive-lg scroll">
                                                <table class="table table-hover">
                                                    <thead class="text-light bg-primary">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Judul Materi</th>
                                                            <th>Link Materi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Judul</td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>judul</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">penelitan PA dan Tesis 2021/2022</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive-lg scroll">
                                                <table class="table table-hover">
                                                    <thead class="text-light bg-primary">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Judul Penelitan&nbsp;</th>
                                                            <th>Nama mahasiswa</th>
                                                            <th>Desen pembimbing 1</th>
                                                            <th>Desen pembimbing 2</th>
                                                            <th>Desen pembimbing 3</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>SI website</td>
                                                            <td>Dimas triandi&nbsp;</td>
                                                            <td>desen</td>
                                                            <td>Dosen</td>
                                                            <td>Dosen</td>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>SI website</td>
                                                            <td>Dimas triandi&nbsp;</td>
                                                            <td>desen</td>
                                                            <td>Dosen</td>
                                                            <td>Dosen</td>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>SI website</td>
                                                            <td>Dimas triandi&nbsp;</td>
                                                            <td>desen</td>
                                                            <td>Dosen</td>
                                                            <td>Dosen</td>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>SI website</td>
                                                            <td>Dimas triandi&nbsp;</td>
                                                            <td>desen</td>
                                                            <td>Dosen</td>
                                                            <td>Dosen</td>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>SI website</td>
                                                            <td>Dimas triandi&nbsp;</td>
                                                            <td>desen</td>
                                                            <td>Dosen</td>
                                                            <td>Dosen</td>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>SI website</td>
                                                            <td>Dimas triandi&nbsp;</td>
                                                            <td>desen</td>
                                                            <td>Dosen</td>
                                                            <td>Dosen</td>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>SI website</td>
                                                            <td>Dimas triandi&nbsp;</td>
                                                            <td>desen</td>
                                                            <td>Dosen</td>
                                                            <td>Dosen</td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>judul</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Inventaris Ruangan</p>
                                        </div>
                                        <?php include 'inventarisRuang.php'?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php } ?>
