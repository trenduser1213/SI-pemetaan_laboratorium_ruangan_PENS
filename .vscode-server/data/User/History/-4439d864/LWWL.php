<?php 
require_once 'includes/func.inc.php';
require_once 'includes/penelitian.php';
require_once 'includes/pegawai.php';
?>
<div class="card shadow mb-3">
    <div class="card-header py-3">
        <p class="text-primary m-0 font-weight-bold">penelitan PA dan Tesis 2021/2022
        <button class="btn btn-primary fa fa-plus rounded-pill" data-bs-toggle="modal" data-bs-target="#tambahPenelitian"></button>
        </p>
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
                        <th colspan="2">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $dataPenelitian = dataPenelitian($idRuang);
                    $no=1;
                    foreach($dataPenelitian as $DataPenelitian){
                        ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $DataPenelitian['JUDUL'] ?></td>
                        <td><?php echo $DataPenelitian['PENELITI'] ?></td>
                        <td><?php echo $DataPenelitian['DOSBIM1'] ?></td>
                        <td><?php echo $DataPenelitian['DOSBIM2'] ?></td>
                        <td><?php echo $DataPenelitian['DOSBIM3'] ?></td>
                        <td>
                            <button name="" class="btn btn-warning fa fa-gear" data-bs-toggle="modal" data-bs-target="#editPeneliti">edit</button>
                        </td>
                        <td>
                            <form method="POST" >
                                <input type="hidden" name="id_Penelitian" value="<?php echo $DataPenelitian['NOMOR']?>">
                                <button name="deletePenelitan" class="btn btn-danger fa fa-trash">delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php $no++; }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
$daftarDosen = dataNamaDosen();
?>
<div class="modal fade" id="tambahPenelitian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Pengumuman</h5>
                <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judulPenelitian">Penelitian</label>
                        <input class="form-control" type="text" name="judulPenelitian" id="judulPenelitian" required>
                        <!-- <textarea class="form-control" id="pengumuman" name="pengumuman" rows="3"></textarea> -->
                        <label for="dosbim1">Dosen  Pembimbing 1</label>
                        <select class="form-control" name="dosbim1" id="dosbim1" label="dosbim">
                            <optgroup label="dosbim">
                                <option value="null" >dosbim</option>
                                <?php foreach($daftarDosen as $DaftarDosen){?>
                                    <option value="<?php echo $DaftarDosen['NOMOR']?>"><?php echo $DaftarDosen['NAMA']?></option>
                                <?php } ?>
                            </optgroup>
                        </select>
                        <label for="dosbim2">Dosen  Pembimbing 2</label>
                        <select class="form-control" name="dosbim2" id="dosbim2">
                            <optgroup label="dosbim">
                                <option value="null" >dosbim</option>
                                <?php foreach($daftarDosen as $DaftarDosen){?>
                                    <option value="<?php echo $DaftarDosen['NOMOR']?>"><?php echo $DaftarDosen['NAMA']?></option>
                                <?php } ?>
                            </optgroup>
                        </select>
                        <label for="dosbim3">Dosen  Pembimbing 3</label>
                        <select class="form-control" name="dosbim3" id="dosbim3">
                            <optgroup label="dosbim">
                                <option value="null" >dosbim</option>
                                <?php foreach($daftarDosen as $DaftarDosen){?>
                                    <option value="<?php echo $DaftarDosen['NOMOR']?>"><?php echo $DaftarDosen['NAMA']?></option>
                                <?php } ?>
                            </optgroup>
                        </select>                                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="" method="post">
                        <button type="submit" class="btn btn-primary" name="kirimPenelitian">Kirim</button>
                    </form>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    if(isset($_POST['kirimPenelitian'])){
        $judulPenelitian= $_POST['judulPenelitian'];
        $idPeneliti = $_SESSION['ID_user'];
        $idDosbim1 = $_POST['dosbim1'];
        $idDosbim2 = $_POST['dosbim2'];
        $idDosbim3 = $_POST['dosbim3'];
        // var_dump($judulPenelitian);
        // var_dump($idRuang);
        // var_dump($idPeneliti);
        // var_dump($idDosbim1);
        // var_dump($idDosbim2);
        // var_dump($idDosbim3);
        if($_SESSION['StatusPengguna'] == "Mahasiswa"){
            $statusanggota = 1;
        }else{
            $statusanggota = 2;
        }
        $hasil = createPenelitian($judulPenelitian, $idRuang, $idPeneliti, $idDosbim1, $idDosbim2, $idDosbim3, $statusanggota);
        var_dump($hasil);
        // if($hasil == "Success Insert"){
        //     echo "<script>alert('Success Updete');</script>";
        //     echo "<script>window.location.href='index.php?halaman=detailRuangLab&id=$idRuang';</script>";
        // }
    }elseif(isset($_POST['deletePenelitan'])){
        $nomorPenelitian = $_POST['id_Penelitian'];
        var_dump($nomorPenelitian);
        $hasil = deletePenelitian($nomorPenelitian, $idRuang);
        var_dump($hasil);
        if($hasil == "Success Delete" ){
            echo "<script>alert('Success Delete');</script>";
            echo "<script>window.location.href='index.php?halaman=detailRuangLab&id=$idRuang';</script>";
        }
    }

?>
