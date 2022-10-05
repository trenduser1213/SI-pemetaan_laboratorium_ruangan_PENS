                                    <?php 
                                    require_once 'includes/anggotaRuang.php' ;
                                    $idRuang = $_GET['id_ruang'];
                                    header("Content-type: application/vnd-ms-excel");
                                    header("Content-Disposition: attachment; filename=Anggota Ruang.xls");
                                    
                                    ?>
                                    <!DOCTYPE html>
                                    <html>

                                    <head>
                                        <meta charset="utf-8">
                                        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
                                        <title>Dashboard - PENS</title>
                                        <style>
                                            table, th, td {
                                            border: 1px solid black;
                                            border-collapse: collapse;
                                            }
                                        </style>
                                    </head>

                                    <body id="page-top">
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3 d-flex justify-content-between">
                                                <p class="text-primary m-0 font-weight-bold">Anggota laboratorium ( <?php $jumlahAnggotaRuang = countAnggotaRuang($idRuang); echo $jumlahAnggotaRuang ?> )</p>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive-lg scroll">
                                                <table class="table table-hover">
                                                        <thead class="text-light bg-primary">
                                                            <tr>
                                                                <th>NO</th>
                                                                <th>nama</th>
                                                                <th>NO.INDUK</th>
                                                                <th>Status</th>
                                                                <th class="center">status</th>
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
                                                            if($anggota['KEANGGOTAAN'] == "1"){
                                                                ?>
                                                                    <td>Belum Diterima</td>
                                                            <?php 
                                                            }else{
                                                                ?>
                                                                    <td>Sudah Diterima</td>
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
                                                            <?php// $idAnggota=$anggotaLab['ANGGOTA'];?>
                                                            <?php// $nomor = $anggotaLab['NOMOR']; ?>
                                                            <td>Mahasiswa</td>
                                                            <?php 
                                                            if($anggotaLab['KEANGGOTAAN'] == "1"){
                                                                ?>
                                                                    <td>Belum Diterima</td>
                                                            <?php 
                                                            }else{
                                                                ?>
                                                                    <td>Sudah Diterima</td>
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
                                    </body>
                                    </html>