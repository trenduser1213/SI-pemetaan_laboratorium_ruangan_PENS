                                        <?php require_once 'includes/anggotaRuang.php' ;?>
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3 d-flex justify-content-between">
                                                <p class="text-primary m-0 font-weight-bold">Anggota laboratorium ( <?php $jumlahAnggotaRuang = countAnggotaRuang($idRuang); echo $jumlahAnggotaRuang ?> )</p>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive-lg scroll">
                                                <table class="table table-hover">
                                                    <thead class="text-light bg-primary">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>nama</th>
                                                            <th>NO.INDUK</th>
                                                            <th>Status</th>
                                                            <th colspan="2" class="center">action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $noAnggota = 1;
                                                        $anggotaPegawai = anggotaPegawaiPerRuang($idRuang);
                                                        foreach ($anggotaPegawai as $anggota) { ?>
                                                        <tr>
                                                            <td><?php echo $noAnggota ?></td>
                                                            <td><?php echo $anggota['NAMA'] ?></td>
                                                            <td><?php echo $anggota['ANGGOTA'] ?></td>
                                                            <?php $idAnggota=$anggota['ANGGOTA'];?>
                                                            <?php $nomor = $anggota['NOMOR']; ?>
                                                            <td>Pegawai</td>
                                                            <?php 
                                                            if($anggota['KEANGGOTAAN'] == '1'){
                                                                ?>
                                                                <td><form method="POST"><button name="terima" class="btn btn-success">terima</button></td>
                                                                <td><form  method="POST"><button name="delete" class="btn btn-warning">tolak</button></form></td>
                                                            <?php 
                                                            }else{
                                                                ?>
                                                            <td colspan="2"><form method="POST"><button name="delete" class="btn btn-danger">keluarkan</button></form></td>
                                                            <?php } ?>
                                                        </tr>
                                                        <?php 
                                                        $noAnggota++;
                                                            }; 
                                                        ?>
                                                        <?php
                                                        $anggotaMahasiswa = anggotaMahasiswaPerRuang($idRuang);
                                                        oci_fetch_all($anggotaMahasiswa, $rowsss , 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
                                                        foreach($rowsss as $anggotaLab){
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $noAnggota ?></td>
                                                            <td><?php echo $anggotaLab['NAMA'] ?></td>
                                                            <td><?php echo $anggotaLab['ANGGOTA'] ?></td>
                                                            <?php $idAnggota=$anggotaLab['ANGGOTA'];?>
                                                            <?php $nomor = $anggotaLab['NOMOR']; ?>
                                                            <td>Mahasiswa</td>
                                                            <?php 
                                                            if($anggotaLab['KEANGGOTAAN'] == "1"){
                                                                ?>
                                                                <td><form method="POST"><button name="terima" class="btn btn-success">terima</button></td>
                                                                <td><form method="POST"><button name="delete" class="btn btn-warning">tolak</button></form></td>
                                                            <?php 
                                                            }else{
                                                                ?>
                                                            <td><form method="POST"><button name="delete" class="btn btn-danger">keluarkan</button></form></td>
                                                            <?php } ?> 
                                                        </tr>
                                                        <?php
                                                        $noAnggota++;
                                                        } ?>                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                        <?php
                                        
                                        if(isset($_POST['delete'])){
                                            
                                            $hasil = deleteAnggotaRuang($idRuang, $idAnggota, $nomor);
                                            var_dump($hasil);
                                            if($hasil){
                                                echo "<script>alert('Anggota berhasil dihapus');</script>";
                                                echo "<script>window.location.href='index.php?halaman=detailRuang&id=$idRuang';</script>";
                                            }
                                        }elseif(isset($_POST['terima'])){
                                            $status = 2;
                                            $hasil = konfirmasiAnggotaRuang($status, $idRuang, $idAnggota, $nomor);
                                            if($hasil){
                                                echo "<script>alert('Anggota berhasil diterima');</script>";
                                                echo "<script>window.location.href='index.php?halaman=detailRuang&id=$idRuang';</script>";
                                            }
                                        }
                                        
                                        ?>



<!--                                                <button class="btn btn-primary rounded-pill" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus"></i></button>-->
<!--                                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">-->
<!--                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">-->
<!--                                                        <div class="modal-content">-->
<!--                                                            <div class="modal-header">-->
<!--                                                                <h5 class="modal-title" id="staticBackdropLabel">Tambah Laboratorium</h5>-->
<!--                                                                <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--                                                            </div>-->
<!--                                                            <div class="modal-body">-->
<!--                                                                <form action="includes/tambahLab.php" method="POST">-->
<!--                                                                    <div class="form-group">-->
<!--                                                                        <label for="namaLab">Nama Laboratorium</label>-->
<!--                                                                        <input type="text" class="form-control" id="namaLab" name="namaLab" placeholder="Nama Laboratorium">-->
<!--                                                                        <label class="pt-2" for="lokasi">lokasi</label>-->
<!--                                                                        <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="lokasi">-->
<!--                                                                        <label class="pt-2" for="jurusan">Jurusan</label>-->
<!--                                                                        <select class="form-control" id="jurusan" name="jurusan">-->
<!--                                                                            <option value="">Pilih Jurusan</option>-->
<!--                                                                            --><?php //foreach ($jurusan as $jur) : ?>
<!--                                                                                <option value="--><?//= $jur['id_jurusan'] ?><!--">--><?//= $jur['nama_jurusan'] ?><!--</option>-->
<!--                                                                            --><?php //endforeach; ?>
<!--                                                                        </select>-->
<!--                                                                        <label class="pt-2" for="ketua">ketua</label>-->
<!--                                                                        <select class="form-control" id="ketua" name="ketua">-->
<!--                                                                            <option value="">Pilih Ketua</option>-->
<!--                                                                            --><?php //foreach ($dataRuang as $ruang) : ?>
<!--                                                                                <option value="--><?//= $ruang['id_ruang'] ?><!--">--><?//= $ruang['nama_ruang'] ?><!--</option>-->
<!--                                                                            --><?php //endforeach; ?>
<!--                                                                        </select>-->
<!--                                                                    </div>-->
<!--                                                                </form>-->
<!--                                                            </div>-->
<!--                                                            <div class="modal-footer">-->
<!--                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
<!--                                                                <button type="button" class="btn btn-primary">Understood</button>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                </div>-->