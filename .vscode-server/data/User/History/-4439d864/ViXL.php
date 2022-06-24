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
                        <input class="form-control" type="text" name="judulPenelitian" id="judulPenelitian">
                        <!-- <textarea class="form-control" id="pengumuman" name="pengumuman" rows="3"></textarea> -->
                        <label for="dosbim1">Dosen  Pembimbing 1</label>
                        <select class="form-control" name="dosbim1" id="dosbim1">
                            <optgroup value="dosbim">dosbim</optgroup>
                            <?php foreach($daftarDosen as $DaftarDosen){?>
                                <option value="<?php echo $DaftarDosen['NOMOR']?>"><?php echo $DaftarDosen['NAMA']?></option>
                            <?php } ?>
                        </select>
                        <label for="dosbim2">Dosen  Pembimbing 2</label>
                        <select class="form-control" name="dosbim2" id="dosbim2">
                            <optgroup value="dosbim">dosbim</optgroup>
                            <?php foreach($daftarDosen as $DaftarDosen){?>
                                <option value="<?php echo $DaftarDosen['NOMOR']?>"><?php echo $DaftarDosen['NAMA']?></option>
                            <?php } ?>
                        </select>
                        <label for="dosbim3">Dosen  Pembimbing 3</label>
                        <select class="form-control" name="dosbim3" id="dosbim3">
                            <optgroup value="dosbim">dosbim</optgroup>
                            <?php foreach($daftarDosen as $DaftarDosen){?>
                                <option value="<?php echo $DaftarDosen['NOMOR']?>"><?php echo $DaftarDosen['NAMA']?></option>
                            <?php } ?>
                        </select>                                        
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