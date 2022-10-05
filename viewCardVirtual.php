<div class="card mb-3 shadow">
                    <div class="card-header py-3">
                    <?php if($cekRulesKepalaRuang != true && $cekRulesAsistenRuang != true && $cekRulesTeknisiRuang != true ){?>
                        <p class="text-primary m-0 font-weight-bold">
                            <?php echo $hasil['RUANG'];?>
                            <!-- <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#photo"><i class="fa fa-gear"></i></button> -->
                        </p>
                    <?php }else{ ?>
                        <p class="text-primary m-0 font-weight-bold">
                            <?php echo $hasil['RUANG'];?>
                            <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#photo"><i class="fa fa-gear"></i></button>
                        </p>
                    <?php } ?>
                    </div>
                    <div class="card-body text-center shadow"><img class="mb-3 mt-4" src="foto_lab/<?php echo $hasil['FOTO_LAB'];?>" width="160" height="160">
                        <div class="mb-3">                            
                            <!-- <h4 class="text-primary"></h4> -->
                            <!-- <button class="btn btn-virtual" data-bs-toggle="modal" data-bs-target="#virtual">Virtual Tour <?php echo $hasil['RUANG'];?><br></button> -->
                            <button class="mt-2 btn btn-virtual" data-bs-toggle="modal" data-bs-target="#denah">Denah Ruang <?php echo $hasil['RUANG'];?><br></button>
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
                                    echo '<script>window.location.href="index.php?halaman=detailRuangLab&id='.$idRuang.'"</script>';
                                }else{
                                    echo '<script>alert("Anda gagal join ruang '.$hasil['RUANG'].'")</script>';
                                    echo '<script>window.location.href="index.php?halaman=detailRuangLab&id='.$idRuang.'"</script>';
                                }
                            }elseif(isset($_POST['leave'])){
                                // $idKeanggotaan = 2;
                                $leaveLab = deleteAnggotaRuang($idRuang, $idAnggota, $nomor);
                                if($leaveLab){
                                    echo '<script>alert("Anda berhasil leave ruang '.$hasil['RUANG'].'")</script>';
                                    // var_dump($leaveLab);
                                    echo '<script>window.location.href="index.php?halaman=detailRuangLab&id='.$idRuang.'"</script>';
                                }else{
                                    echo '<script>alert("Anda gagal leave ruang '.$hasil['RUANG'].'")</script>';
                                    echo '<script>window.location.href="index.php?halaman=detailRuangLab&id='.$idRuang.'"</script>';
                                }
                            }
                            ?>
                    </div>
                </div>
                            <!-- Modal denah -->
                            <div class="modal fade" id="denah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Denah PENS</h5>
                                            <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img class="mb-3 mt-4" src="foto_denah/<?php echo $hasil['FOTO_DENAH'];?>" width="100%" height="100%">
                                        <!-- <iframe width="100%" height="640" style="width: 100%; height: 640px; border: none; max-width: 100%;" allow="xr-spatial-tracking; vr; gyroscope; accelerometer; fullscreen; autoplay; xr" scrolling="no" allowfullscreen="true"  frameborder="0" src="https://webobook.com/public/62c2f12a99730e30c041e1f2,en?ap=true&si=true&sm=false&sp=true&sfr=false&sl=false&sop=false&" allowvr="yes" ></iframe> -->
                                        </div>                                            
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Virtual Tour -->
                            <!-- <div class="modal fade" id="virtual" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Virtual Tour</h5>
                                            <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <iframe width="100%" height="640" style="width: 100%; height: 640px; border: none; max-width: 100%;" allow="xr-spatial-tracking; vr; gyroscope; accelerometer; fullscreen; autoplay; xr" scrolling="no" allowfullscreen="true"  frameborder="0" src="https://webobook.com/public/62c2f12a99730e30c041e1f2,en?ap=true&si=true&sm=false&sp=true&sfr=false&sl=false&sop=false&" allowvr="yes" ></iframe>
                                        </div>                                            
                                    </div>
                                </div>
                            </div> -->
                            <!-- Modal Photo -->
                            <div class="modal fade" id="photo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Virtual Tour</h5>
                                            <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                    <!-- <div class="form-group col-sm"> -->
                                                        <label for="foto_lab">Foto Lab</label><br>
                                                        <input  accept="image/png, image/gif, image/jpeg" type="file" name="foto_lab" id="foto_lab" class="formFile"><br>
                                                        <label for="foto_denah">Denah Lab</label><br>
                                                        <input  accept="image/png, image/gif, image/jpeg" type="file" name="foto_denah" id="foto_denah" class="formFile">
                                                    <!-- </div> -->
                                            </div>      
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" type="submit" name="kirim_foto">kirim</button>
                                            </div>                                      
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                            // require_once 'includes/func.inc.php';
                            // $con=koneksiDB();
                            if(isset($_POST['kirim_foto'])){
                                $foto_lab=$_FILES['foto_lab']['name'];
                                $lokasi_foto_lab=$_FILES['foto_lab']['tmp_name'];		
                                move_uploaded_file($lokasi_foto_lab,"foto_lab/".$foto_lab);
                                $foto_denah=$_FILES['foto_denah']['name'];
                                $lokasi_foto_denah=$_FILES['foto_denah']['tmp_name'];		
                                move_uploaded_file($lokasi_foto_denah,"foto_denah/".$foto_denah);
                                $hasil=updateFoto($foto_lab,$foto_denah,$idRuang);
                                if($hasil == "Success Update"){
                                    echo "<script>alert('Success Update');</script>";
                                    echo "<script>window.location.href='index.php;</script>";
                                }
                                // $sql="UPDATE ";
                                // echo "<script>alert('SUCCESS');</script>";

                            }
                            ?>