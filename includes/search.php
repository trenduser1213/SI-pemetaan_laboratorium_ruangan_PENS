<?php
require_once 'func.inc.php';
$search = strtoupper($_POST['search']);
$con = koneksiDB();
$sql = "SELECT r.nomor, r.ruang, r.keterangan, j.jurusan, p.nama AS kepala FROM RUANGBARU r LEFT JOIN jurusan j ON j.nomor = r.jurusan  LEFT JOIN pegawai p ON p.nomor = r.kepala WHERE ruang like '%$search%'";
$hasil = query_getAll($con, $sql);
oci_fetch_all($hasil, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
// var_dump($rows);
$no= 1 ;
?>
<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="text-primary font-weight-bold m-0">Hasil Pencarian
            <!-- <button class="btn btn-primary rounded-pill" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus"></i></button> -->
        </h6>
    </div>
    <div class="card-body">
        <div class="scroll">
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
                <tbody >
                <?php foreach ($rows as $hasil) { ?>
                <tr>
                    <td scope="row"><?php echo  $no;?></th>
                    <td><a href="index.php?halaman=detailRuangLab&id=<?php echo $hasil['NOMOR'] ?>"><?php echo $hasil['RUANG'] ?> </a></td>
                    <td><?php echo $hasil['KETERANGAN'] ?></td>
                    <td><?php echo $hasil['JURUSAN'] ?></td>
                    <td><?php echo $hasil['KEPALA'] ?></td>
                </tr>
                <?php
                $no++;} ?>
                </tbody>                                            
            </table>
        </div>
    </div>
</div>