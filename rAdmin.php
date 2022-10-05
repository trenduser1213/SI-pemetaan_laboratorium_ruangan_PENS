<?php
require_once('includes/ruang.php');
$dataRuangAdmin = dataRuangAdmin();
$dataRuangan = dataRuangan();
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
                                    <h6 class="text-primary font-weight-bold m-0">Ruang Administrasi dan Lainya
                                    <?php
                                    if($_SESSION['StatusPengguna']=="admin"){
                                    ?>
                                        <button class="btn btn-primary rounded-pill" type="submit" data-bs-toggle="modal" data-bs-target="#tambahRuang"><i class="fa fa-plus"></i></button>
                                    <?php }
                                    ?>
                                    </h6>
                                    <div class="pb-0 pt-2">
                                        <div class="align-items-center form-row">
                                            <div class="form-group col-sm">
                                                <!-- <select class="form-control pl-4 pr-4 rounded-pill">
                                                    <optgroup label="Gedung">
                                                        <option value="12" selected="">Pasca Sarjana</option>
                                                        <option value="13">This is item 2</option>
                                                        <option value="14">This is item 3</option>
                                                    </optgroup>
                                                </select> -->
                                            </div>
                                            <!-- <div class="form-group col-sm-auto text-right"><button class="btn btn-primary pl-4 pr-4 rounded-pill" type="submit"><i class="fa fa-search"></i></button></div> -->
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="tambahRuang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <form action="" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Ruang</h5>
                                                        <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <!-- <input type="hidden" id="idRuang-<?php// echo $hasil['NOMOR']?>" value="<?php// echo $hasil['NOMOR']?>"> -->
                                                                    <label for="namaLab">Nama ruang</label>
                                                                    <input type="text" class="form-control" id="namaLab" name="namaLab" placeholder="Nama Laboratorium" value="<?php //echo $hasil['KETERANGAN']?>">
                                                                    <label class="pt-2" for="lokasi">lokasi</label>
                                                                    <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="lokasi" value="<?php //echo $hasil['RUANG']?>">
                                                                    <label class="pt-2" for="lokasi">telp</label>
                                                                    <input type="text" class="form-control" id="telp" name="telp" placeholder="telp" value="<?php //echo $hasil['TELP']?>">
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="pt-2" for="ketua">ketua</label>
                                                                    <select class="form-control" id="ketua" name="ketua">
                                                                        <option value="">Pilih Ketua</option>
                                                                        <?php foreach($daftarDosen as $DaftarDosen){?>                                        
                                                                        <option  value="<?php echo $DaftarDosen['NOMOR']?>"><?php echo $DaftarDosen['NAMA']?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <label class="pt-2" for="asisten">asisten</label>
                                                                    <select class="form-control" id="asisten" name="asisten">
                                                                        <option value="">Pilih Asisten</option>
                                                                        <?php foreach($daftarDosen as $DaftarDosen){ ?>                                                     
                                                                                <option value="<?php echo $DaftarDosen['NOMOR']?>"><?php echo $DaftarDosen['NAMA']?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <label class="pt-2" for="teknisi">teknisi</label>
                                                                    <select class="form-control" id="teknisi" name="teknisi">
                                                                        <option value="">Pilih Asisten</option>
                                                                        <?php foreach($daftarDosen as $DaftarDosen){ ?>                                                     
                                                                                <option value="<?php echo $DaftarDosen['NOMOR']?>"><?php echo $DaftarDosen['NAMA']?></option>                                                    
                                                                        <?php } ?>
                                                                    </select>
                                                                    <label class="pt-2" for="virtual">virtual</label>
                                                                    <textarea name="virtual" id="virtual" cols="10" rows="3" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" id="createRuang" name="createRuang">create</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if(isset($_POST['createRuang'])){
                                        $namaLab = $_POST['namaLab'];
                                        $lokasi = $_POST['lokasi'];                                        
                                        $ketua = $_POST['ketua'];
                                        $asisten = $_POST['asisten'];
                                        $teknisi = $_POST['teknisi'];
                                        $telp = $_POST['telp'];
                                        $virtual = $_POST['virtual'];
                                        var_dump($namaLab);
                                        var_dump($lokasi);
                                        // var_dump($jurusan);
                                        var_dump($ketua);
                                        var_dump($asisten);
                                        var_dump($teknisi);
                                        var_dump($telp);
                                        var_dump($virtual);
                                        $hasil = tambahRuangAdmin($namaLab, $lokasi, $ketua, $asisten, $teknisi, $telp, $virtual);
                                        // var_dump($hasil);
                                        
                                    }
                                    ?>
                                </div>
                                <div class="card-body">
                                    <div class="scroll">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">#</th>                
                                                <th scope="col">Nama Ruangan</th>
                                                <th scope="col">Nama Ruangan</th>
                                                <?php if($_SESSION['StatusPengguna']=="admin"){ ?>
                                                <th colspan="2">action</th>          
                                                <?php } ?>                                  
                                            </tr>
                                        </thead>
                                        
                                        <tbody class="">
                                        <?php
                                        oci_fetch_all($dataRuangAdmin, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
                                        $no = 1;
                                        foreach ($rows as $hasil) {

                                        ?>
                                            <tr>
                                            <th scope="row"><?php echo $no ?> </th>
                                            <td><a href="index.php?halaman=detailRuang&id=<?php echo $hasil['NOMOR'] ?>"><?php echo $hasil['KETERANGAN']?></a></td>
                                                <td><?php echo $hasil['RUANG']?></td>
                                                <?php if($_SESSION['StatusPengguna']=="admin"){ ?>
                                            <td><button type="button" class="btn btn-warning">edit</button></td>
                                            <td><button type="submit" id="hapusRuang" name="hapusRuang" class="btn btn-danger">hapus</button></td>
                                            <?php } ?>
                                            </tr>
                                        <?php $no++ ; } 
                                        foreach ($dataRuangan as $row) {
                                            ?>
                                        <tr>
                                            <th scope="row"><?php echo $no ?> </th>
                                            <td><a href="index.php?halaman=detailRuang&id=<?php echo $row['NOMOR'] ?>"><?php echo $hasil['KETERANGAN']?></a></td>
                                            <td><?php echo $row['RUANG']?></td>
                                            <?php
                                            if($_SESSION['StatusPengguna']=="admin"){
                                            ?>
                                                <!-- <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#tambahkelas<?php// echo $hasil['NOMOR']?>">edit</button></td>
                                                <td><button type="submit" id="hapusRuang" name="hapusRuang" class="btn btn-danger">hapus</button></td> -->
                                                <td><button type="button" class="btn btn-warning">edit</button></td>
                                                <td><button type="submit" id="hapusRuang" name="hapusRuang" class="btn btn-danger">hapus</button></td>
                                            <?php }
                                            ?>
                                        </tr>
                                            <?php $no++ ; }?>
                                        </tbody>
                                        
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>