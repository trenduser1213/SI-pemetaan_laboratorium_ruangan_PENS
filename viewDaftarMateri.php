<?php require_once "includes/materi.php"?>
<div class="card shadow mb-3">
    <div class="card-header py-3">
        <!-- Materi Penunjang -->
        <?php
            if($cekRulesKepalaRuang != true && $cekRulesAsistenRuang != true && $cekRulesTeknisiRuang != true){?>
            <p class="text-primary m-0 font-weight-bold">
                Materi Penunjang
                <!-- <button class="btn btn-primary fa fa-plus rounded-pill" data-bs-toggle="modal" data-bs-target="#materi"></button> -->
            </p>
            <?php }else{ ?>
                <p class="text-primary m-0 font-weight-bold">
                    Materi Penunjang
                    <button class="btn btn-primary fa fa-plus rounded-pill" data-bs-toggle="modal" data-bs-target="#materi"></button>
                </p>
            <?php } ?>
    </div>
    <div class="card-body">
        <div class="table-responsive-lg scroll">
            <table class="table table-hover">
                <thead class="text-light bg-primary">
                <?php if($cekRulesKepalaRuang != true && $cekRulesAsistenRuang != true && $cekRulesTeknisiRuang != true){?>
                <tr>
                    <th>No</th>
                    <th>Judul Materi</th>
                    <th>Link Materi</th>
                    <!-- <th colspan="2">action</th> -->
                </tr>
                <?php }else{ ?>
                <tr>
                    <th>No</th>
                    <th>Judul Materi</th>
                    <th>Link Materi</th>
                    <th colspan="2">action</th>
                </tr>
                <?php } ?>
                </thead>
                <tbody>
                <?php $no = 1;
                $materi = materiPerRuang($idRuang);
                foreach ($materi as $Materi) {
                    $idmateri=$Materi['NOMOR']?>
                <?php if($cekRulesKepalaRuang != true && $cekRulesAsistenRuang != true && $cekRulesTeknisiRuang != true){?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php $judul = $Materi['JUDUL']; echo $judul ;?></td>
                    <td><?php $link = $Materi['LINK'];echo $link;  ?></td>
                    <!-- <td><?php //echo $idmateri;  ?></td> -->
                    <!-- <td>

                        <button name="" class="btn btn-warning fa fa-gear" data-bs-toggle="modal" data-bs-target="#edit<?php echo $Materi['NOMOR']?>">edit</button>
                    </td>
                    <td>
                        <form method="POST" >
                            <input type="hidden" name="id_Materi" value="<?php //echo $Materi['NOMOR']?>">
                            <button name="deleteMateri" class="btn btn-danger fa fa-trash">delete</button>
                        </form>
                    </td> -->
                </tr>
                <?php }else{ ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php $judul = $Materi['JUDUL']; echo $judul ;?></td>
                    <td><?php $link = $Materi['LINK'];echo $link;  ?></td>
                    <!-- <td><?php //echo $idmateri;  ?></td> -->
                    <td>

                        <button name="" class="btn btn-warning fa fa-gear" data-bs-toggle="modal" data-bs-target="#edit<?php echo $Materi['NOMOR']?>">edit</button>
                    </td>
                    <td>
                        <form method="POST" >
                            <input type="hidden" name="id_Materi" value="<?php echo $Materi['NOMOR']?>">
                            <button name="deleteMateri" class="btn btn-danger fa fa-trash">delete</button>
                        </form>
                    </td>
                </tr>
                <!-- MODAL EDIT MATERI  -->
                <div class="modal fade" id="edit<?php echo $Materi['NOMOR']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Tambah Materi</h5>
                                <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="updateJudul">Judul Mteri</label>
                                        <input type="text" id="updateJudul" class="form-control" required name="updateJudul" value="<?php echo $judul?>">
                                        <label for="updatelink">Materi</label>
                                        <textarea class="form-control" id="updateLink" name="updateLink" rows="3" required><?php echo $link?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer"><input type="hidden" name="id_Materi" value="<?php echo $Materi['NOMOR']?>">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="updateMateri">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH MATERI -->
<?php if($cekRulesKepalaRuang != true && $cekRulesAsistenRuang != true && $cekRulesTeknisiRuang != true){?>
    <div class="modal fade" id="materi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabell" aria-hidden="true"></div>
<?php }else{  ?>
    <div class="modal fade" id="materi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Materi</h5>
                    <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="Jjdul">Judul Mteri</label>
                            <input type="text" id="judul" class="form-control" required name="judul">
                            <label for="link">Materi</label>
                            <textarea class="form-control" id="link" name="link" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="kirimMateri">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<?php
if(isset($_POST['kirimMateri'])){
    $judul = $_POST['judul'];
    $link = $_POST['link'];
    $hasil = tambahMateri($idRuang, $judul, $link);
    // var_dump($hasil);
    if($hasil) {
        echo "<script>alert('berhasil ditambahkan');</script>";
        echo "<script>window.location.href='index.php?halaman=detailRuangLab&id=$idRuang';</script>";
    }
}elseif(isset($_POST['deleteMateri'])){
    $idMateri = $_POST['id_Materi'];    
    $hasil = deleteMateri($idRuang, $idMateri);
    if($hasil) {
        echo "<script>alert('SUCCESS DELETE');</script>";
        echo "<script>window.location.href='index.php?halaman=detailRuangLab&id=$idRuang';</script>";
    }
}elseif(isset($_POST['updateMateri'])){
    $updateJudul = $_POST['updateJudul'];
    $updateLink = $_POST['updateLink'];
    $idMateri = $_POST['id_Materi'];
    $hasil = updateMateri($idRuang, $idMateri, $updateJudul, $updateLink);
    // var_dump($hasil);
    if($hasil) {
        echo "<script>alert('SUCCESS DELETE');</script>";
        echo "<script>window.location.href='index.php?halaman=detailRuangLab&id=$idRuang';</script>";
    }
}
?>
