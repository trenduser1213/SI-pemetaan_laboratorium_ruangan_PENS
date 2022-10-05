<?php
require_once "includes/ruang.php";
require_once "includes/jurusan.php";
require_once ('includes/pegawai.php');
$dataPegawai = dataPegawai();
$jurusan = dataJurusan();
$daftarDosen = dataNamaDosen();
oci_fetch_all($jurusan, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
?>
<div class="col-lg-12 col-xl-12" onload="">
    <!-- <input type="hidden" name="" value="$_SESSION[']"> -->
    <!-- <input type="hidden" name="" value="$_SESSION[']"> -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="text-primary font-weight-bold m-0">Laboratorium
                <?php
                if($_SESSION['StatusPengguna']=="admin"){
                ?>
                    <button class="btn btn-primary rounded-pill" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus"></i></button>
                <?php }
                ?>
            </h6>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                            <label for="namaLab">Nama Laboratorium</label>
                                            <input type="text" class="form-control" id="namaLab" name="namaLab" placeholder="Nama Laboratorium" value="<?php //echo $hasil['KETERANGAN']?>">
                                            <label class="pt-2" for="lokasi">lokasi</label>
                                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="lokasi" value="<?php //echo $hasil['RUANG']?>">
                                            <label class="pt-2" for="lokasi">telp</label>
                                            <input type="text" class="form-control" id="telp" name="telp" placeholder="telp" value="<?php //echo $hasil['TELP']?>">
                                            <label class="pt-2" for="jurusan">Jurusan</label>
                                            <select class="form-control" id="jurusan" name="jurusan">
                                                <option value="">Pilih Jurusan</option>
                                            <?php foreach ($rows as $rowJurusan) :  ?>
                                                <option value="<?php echo $rowJurusan['NOMOR'] ?>"><?php  echo $rowJurusan['JURUSAN']  ?></option>
                                            <?php endforeach; ?>
                                            </select>
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
            <div class="pb-0 pt-2">
                <div class="align-items-center form-row">
                    <div class="form-group col-sm">
                        <form action="" method="post">
                            <select class="form-control pl-4 pr-4 rounded-pill" name="jurusan" id="jurusanSelect" label="jurusan" type="submit" onchange="selectJurusan()" >
                                <optgroup label="Jurusan">
                                    <?php                                    
                                    $no = 1;
                                    foreach ($rows as $rowJurusan) {
                                    ?>
                                    <?php if( $rowJurusan['JURUSAN']==$_SESSION['Jurusan'] ){ ?>
                                        <option selected  value="<?php echo $rowJurusan['JURUSAN'] ?>"><?php echo $rowJurusan['JURUSAN_LENGKAP'] ?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $rowJurusan['JURUSAN'] ?>"><?php echo $rowJurusan['JURUSAN_LENGKAP'] ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                    <option value="kosong">Lab yang Tidak memiliki jurusan</option>
                                </optgroup>
                            </select>
                        </form>
                    </div>
                    <!-- <div class="form-group col-sm-auto text-right"><button class="btn btn-primary pl-4 pr-4 rounded-pill" type="submit"><i class="fa fa-search"></i></button></div> -->
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="scroll" id="ans">
                <table class="table table-hover">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">#</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Nama laboratorium</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Nama Ketua</th>
                        </tr>
                    </thead>                                            
                    <tbody class="" >
                        <?php 
                        $hasil=viewLaboratorium($_SESSION['Jurusan']);
                        $no=1;
                        foreach ($hasil as $rowHasil){
                         ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><a href="index.php?halaman=detailRuangLab&id=<?=$rowHasil['NOMOR'];?>"><?= $rowHasil['RUANG']; ?></a></td>
                            <td><?= $rowHasil['KETERANGAN']; ?></td>
                            <td><?= $rowHasil['JURUSAN']; ?></td>
                            <td><?= $rowHasil['KEPALA']; ?></td>
                        </tr>
                        <?php $no++; 
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>  
<?php
if(isset($_POST['jurusan'])){
    $selectJurusan = $_POST['jurusan'];
    echo "<script>window.location.href='index.php?halaman=lab;</script>";
    // var_dump($selectJurusan);
}
// if(isset($_POST['createRuang'])){
//     $namaLab = $_POST['namaLab'];
//     $lokasi = $_POST['lokasi'];
//     $jurusan = $_POST['jurusan'];
//     $ketua = $_POST['ketua'];
//     $asisten = $_POST['asisten'];
//     $teknisi = $_POST['teknisi'];
//     $telp = $_POST['telp'];
//     $virtual = $_POST['virtual'];
//     var_dump($namaLab);
//     var_dump($lokasi);
//     var_dump($jurusan);
//     var_dump($ketua);
//     var_dump($asisten);
//     var_dump($teknisi);
//     var_dump($telp);
//     var_dump($virtual);
//     $hasil = tambahRuangLab($namaLab, $lokasi, $jurusan, $ketua, $asisten, $teknisi, $telp, $virtual);
    // var_dump($hasil);
    
// }
?>
<script>
    function selectJurusan(){
        var x = document.getElementById("jurusanSelect").value;
        var sesionPengguna = <?= json_encode($_SESSION['StatusPengguna']) ?>;
        console.log(x);
        console.log(sesionPengguna);
        $.ajax({
            url:"viewDataLab.php",
            method:"POST",
            data:{
                id : x,
                status : sesionPengguna
            },
            success:function(data){
                console.log(data);
                $("#ans").html(data)
            }
        })
    }
</script>