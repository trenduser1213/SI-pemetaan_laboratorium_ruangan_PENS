<?php
require_once ('includes/ruang.php');
$dataKelas = dataKelas();
require_once "includes/jurusan.php";
require_once ('includes/pegawai.php');
$dataPegawai = dataPegawai();
$jurusan = dataJurusan();
$daftarDosen = dataNamaDosen();
oci_fetch_all($jurusan, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
?>
<div class="col-lg-12 col-xl-12">
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="text-primary font-weight-bold m-0">
                Ruang Kuliah
                <?php if($_SESSION['StatusPengguna'] == "admin"){ ?>
                <button class="btn btn-primary rounded-pill" type="submit" data-bs-toggle="modal" data-bs-target="#tambahkelas"><i class="fa fa-plus"></i></button>
            <?php } ?>
            </h6>
            <div class="pb-0 pt-2">
                <div class="align-items-center form-row">
                    <div class="form-group col-sm">
                    </div>
                    <div class="form-group col-sm-auto text-right">
                    </div>
                </div>
            </div>
        </div>
            <!-- Modal -->
            <div class="modal fade" id="tambahkelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <form action="" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Tambah Ruang</h5>
                                <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- <div class="row"> -->
                                    <!-- <div class="col-md-6"> -->
                                        <div class="form-group">
                                            <!-- <input type="hidden" id="idRuang-<?php// echo $hasil['NOMOR']?>" value="<?php// echo $hasil['NOMOR']?>"> -->
                                            <label for="namaLab">Nama kelas</label>
                                            <input type="text" class="form-control" id="namaLab" name="createnamaLab" placeholder="Nama Laboratorium" value="<?php //echo $hasil['KETERANGAN']?>">
                                            <label class="pt-2" for="lokasi">lokasi</label>
                                            <input type="text" class="form-control" id="lokasi" name="createlokasi" placeholder="lokasi" value="<?php //echo $hasil['RUANG']?>">
                                            <label class="pt-2" for="virtual">virtual</label>
                                            <textarea name="virtual" id="createvirtual" cols="10" rows="3" class="form-control"></textarea>
                                        </div>
                                    <!-- </div> -->
                                <!-- </div> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="createRuang" name="createRuang">create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        <div class="card-body">
            <div class="scroll">
            <table class="table table-hover">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">#</th>
                        <th scope="col">Nama Ruangan</th>
                        <th scope="col">Lokasi Gedung</th> 
                        <?php
                if($_SESSION['StatusPengguna']=="admin"){
                ?>
                    <th colspan="2">action</th>                                               
                <?php }
                ?>
                    </tr>
                </thead>
                
                <tbody class="">
                <?php
                oci_fetch_all($dataKelas, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
                $no = 1;
                foreach ($rows as $hasil) {

                ?>
                    <tr>
                    <th scope="row"><?php echo $no ?></th>
                        <td><a href="index.php?halaman=detailRuangan&id=<?php echo $hasil['NOMOR'] ?>"><?php echo $hasil['RUANG']?></a></td>
                        <td><?php echo $hasil['KETERANGAN']?></td>
                        <?php
                        if($_SESSION['StatusPengguna']=="admin"){
                        ?>
                            <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#tambahkelas<?php echo $hasil['NOMOR']?>">edit</button></td>
                            <td><button type="submit" id="hapusRuang" name="hapusRuang" class="btn btn-danger">hapus</button></td>
                        <?php }
                        ?>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="tambahkelas<?php echo $hasil['NOMOR']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <form action="" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Ruang</h5>
                                        <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- <div class="row"> -->
                                            <!-- <div class="col-md-6"> -->
                                                <div class="form-group">
                                                    <input type="hidden" id="idRuang" value="<?php echo $hasil['NOMOR']?>" name="id_ruang">
                                                    <label for="namaLab">Nama kelas</label>
                                                    <input type="text" class="form-control" id="UPnamaLab" name="UPnamaLab" placeholder="Nama Laboratorium" value="<?php echo $hasil['KETERANGAN']?>">
                                                    <label class="pt-2" for="lokasi">lokasi</label>
                                                    <input type="text" class="form-control" id="UPlokasi" name="UPlokasi" placeholder="lokasi" value="<?php echo $hasil['RUANG']?>">
                                                    <label class="pt-2" for="UPvirtual">virtual</label>
                                                    <textarea name="UPvirtual" id="UPvirtual" cols="10" rows="3" class="form-control"><?php echo $hasil['VIRTUAL']?></textarea>
                                                </div>
                                            <!-- </div> -->
                                        <!-- </div> -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="updateRuang" name="updateRuang">create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                $no++;
                } ?>

                </tbody>
                
            </table>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST['updateRuang'])){
    $id_Lab = $_POST['id_ruang'];
    $namaLab = $_POST['UPnamaLab'];
    $lokasi = $_POST['UPlokasi'];
    $virtual = $_POST['UPvirtual'];
    $hasil = updateRuangKelas($namaLab, $lokasi, $virtual, $id_Lab);
}
if(isset($_POST['createRuang'])){
    $namaLab = $_POST['createnamaLab'];
    $lokasi = $_POST['createlokasi'];
    $virtual = $_POST['createvirtual'];
    $hasil = tambahRuangKelas($namaLab, $lokasi, $virtual);
}
?>
