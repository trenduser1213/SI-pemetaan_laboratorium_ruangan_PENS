<?php
require_once "includes/pengumuman.php";
if(isset($_POST['kirim'])) {
    $idRuang = $_GET['id'];
    $isi = $_POST['pengumuman'];
    $hasil = tambahPengumuman($idRuang, $isi);
    if($hasil) {
        echo "<script>alert('Pengumuman berhasil ditambahkan');</script>";
        echo "<script>window.location.href='index.php?halaman=detailRuang&id=$idRuang';</script>";
    }
}
?>

                            <div class="card mb-3 shadow">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 font-weight-bold">Pengumuman
                                        <button class="btn btn-primary fa fa-plus rounded-pill" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></button>
                                    </p>
                                </div>
                                <div class="card-body text-center shadow">
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
                                                    <button class="btn btn-primary rounded-pill fa fa-gear" name="" data-bs-toggle="modal" data-bs-target="#gearPengumuman"></button>
                                                    
                                                    <!-- <br> -->
                                                    <div class="modal fade" id="gearPengumuman" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Pengumuman</h5>
                                                                    <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="" method="POST">
                                                                    <div class="modal-body">
                                                                        <button type="button" class="btn btn-warning" name="modal"  data-bs-toggle="modal" data-bs-target="#editPengumuman">Edit</button>
                                                                        <form action="" method="POST"><button type="submit" class="btn btn-danger" name="deletePengumuman">DELETE</button></form>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="editPengumuman" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

                                                    <?php $no++;}
                                        if(isset($_POST['deletePengumuman'])) {
                                            // $nomor = $_POST['deletePengumuman'];
                                            // $idRuang = $_GET['id'];
                                            $hasil = deletePengumuman( $nomor);
                                            if($hasil) {
                                                echo "<script>alert('Pengumuman berhasil dihapus');</script>";
                                                echo "<script>window.location.href='index.php?halaman=detailRuang&id=$idRuang';</script>";
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