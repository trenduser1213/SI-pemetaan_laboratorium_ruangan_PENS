<?php
require_once ('includes/pegawai.php');
$dataPegawai = dataPegawai();
?>
    <div class="col-lg-12 col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0"><strong>Informasi Ruang Kerja Dosen Dan Pegawai</strong><br></h6>
                <div class="pb-0 pt-2">
                    <div class="align-items-center form-row">
                        <!-- <div class="form-group col-sm"><select class="form-control pl-4 pr-4 rounded-pill">
                                <optgroup label="Jabatan">
                                    <option value="12" selected="">Dosen</option>
                                    <option value="13">This is item 2</option>
                                    <option value="14">This is item 3</option>
                                </optgroup>
                            </select></div> -->
                        <!-- <div class="form-group col-sm-auto text-right"><button class="btn btn-primary pl-4 pr-4 rounded-pill" type="submit"><i class="fa fa-search"></i></button></div> -->
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg scroll">
                    <table class="table table-hover">
                        <thead class="text-light bg-primary">
                            <tr>
                                <th>no</th>
                                <th>Nama Pegawai</th>
                                <th>NIM</th>
                                <th>Jabatan</th>
                                <th>Ruang Kerja</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        
                        $no = 1;
                        foreach ($dataPegawai as $hasil) {

                        ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><a href="https://project.mis.pens.ac.id/mis118/index.php?halaman=detail-lecturer&id=<?=$hasil['NOMOR']?>" ><?php echo $hasil['NAMA'] ?></a></td>
                                <td><?php echo $hasil['NIP'] ?></td>
                                <td><?php echo $hasil['JABATAN'] ?></td>
                                <td><?php echo $hasil['RUANGAN'] ?></td>
                            </tr>
                        <?php $no++; } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
