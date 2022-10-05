<?php
require_once "includes/pengumuman.php";
if(isset($_POST['kirim'])) {
    $idRuang = $_GET['id'];
    $isi = $_POST['pengumuman'];
    $hasil = tambahPengumuman($idRuang, $isi);
    if($hasil) {
        echo "<script>alert('Pengumuman berhasil ditambahkan');</script>";
        echo "<script>window.location.href='index.php?halaman=detailRuangLab&id=$idRuang';</script>";
    }
}
?>

                            <div class="card mb-3 shadow">
                                <div class="card-header py-3">
                                <?php if($cekRulesKepalaRuang != true && $cekRulesAsistenRuang != true && $cekRulesTeknisiRuang != true){?>
                                    <p class="text-primary m-0 font-weight-bold">
                                        Pengumuman
                                        <!-- <button class="btn btn-primary fa fa-plus rounded-pill" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></button> -->
                                    </p>
                                    <?php }else{ ?>
                                    <p class="text-primary m-0 font-weight-bold">
                                        Pengumuman
                                        <button class="btn btn-primary fa fa-plus rounded-pill" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></button>
                                    </p>
                                    <?php } ?>
                                </div>
                                <div class="card-body shadow">
                                    <table class="table">
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $pengumuman = pengumumanPerRuang($idRuang);
                                            foreach($pengumuman as $isi) {                                               
                                            ?>
                                                    <?php echo $no; ?>.
                                               
                                                    <?php echo $isi['ISI']; 
                                                    $nomor = $isi['NOMOR'];?>
                                                    <?php if($cekRulesKepalaRuang != true && $cekRulesAsistenRuang != true && $cekRulesTeknisiRuang != true){?>
                                                    <?php }else{ ?>
                                                    <button class="btn btn-primary rounded-pill fa fa-gear" name="" data-bs-toggle="modal" data-bs-target="#gearPengumuman"></button>
                                                    <br>
                                                    
                                                    <!-- modal button edit pengumuman -->
                                                    <div class="modal fade" id="gearPengumuman" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Pengumuman</h5>
                                                                    <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="" method="POST">
                                                                    <div class="modal-body">
                                                                        <button type="button" class="btn btn-warning" name="modal"  data-bs-toggle="modal" data-bs-target="#editPengumuman">Edit</button>
                                                                        <form action="" method="POST">
                                                                            <input type="hidden" name="id_Pengumuman" value="<?php echo $isi['NOMOR']?>">
                                                                            <button type="submit" class="btn btn-danger" name="deletePengumuman">DELETE</button>
                                                                        </form>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal edit Pengumuman -->
                                                    <div class="modal fade" id="editPengumuman" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Update Pengumuman</h5>
                                                                    <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="" method="POST">
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="updatePengumuman">Update Pengumuman</label>
                                                                            <textarea class="form-control" id="updatePengumuman" name="updatePengumuman" rows="3" required><?php echo $isi['ISI']; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="hidden" name="id_Pengumuman" value="<?php echo $isi['NOMOR']?>">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary" name="UpPengumuman">Kirim</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php } ?>
                                                    <?php $no++;} ?>
                                                    <?php
                                        if(isset($_POST['deletePengumuman'])) {
                                            $nomor = $_POST['id_Pengumuman'];
                                            $hasil = deletePengumuman( $nomor);
                                            if($hasil) {
                                                echo "<script>alert('Pengumuman berhasil dihapus');</script>";
                                                echo "<script>window.location.href='index.php?halaman=detailRuangLab&id=$idRuang';</script>";
                                            }else{
                                                echo "<script>alert('Failed');</script>";
                                            }
                                        }elseif(isset($_POST['UpPengumuman'])) {
                                            $updateIsi = $_POST['updatePengumuman'];
                                            $idRuang = $_GET['id'];
                                            $nomor = $_POST['id_Pengumuman'];
                                            // var_dump($nomor);
                                            // var_dump($updateIsi);
                                            $hasil = updatePengumuman($nomor, $idRuang, $updateIsi);
                                            if($hasil == "Success Update") {
                                                echo "<script>alert('Success Updete');</script>";
                                                echo "<script>window.location.href='index.php?halaman=detailRuangLab&id=$idRuang';</script>";
                                            }else{
                                                echo "<script>alert('Failed');</script>";
                                            }
                                        }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Pengumuman</h5>
                                            <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="POST">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="pengumuman">Pengumuman</label>
                                                    <textarea class="form-control" id="pengumuman" name="pengumuman" rows="3"></textarea>                                                                        
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="kirim">Kirim</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>