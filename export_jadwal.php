<?php
require_once 'includes/jadwal.php';
$id = $_GET['jadwalRuang'];
$jadwalRuang = jadwalRuang($id);
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Jadwal Ruang.xls");

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
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Jadwal Ruang</p>
        </div>
        <div class="card-body">
            <div class="table-responsive-lg scroll">
                <table class="table table-hover jadwalRuang">
                    <thead class="text-light bg-primary">
                    <tr>
                        <th>no</th>
                        <th>hari</th>
                        <th>jam</th>
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Kelas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    oci_fetch_all($jadwalRuang, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
                    foreach ($rows as $hasil) {

                    ?>
                    <tr>
                        <td><?php echo $no?></td>
                        <td><?php echo $hasil['HARI']?></td>
                        <td><?php echo $hasil['JAM']?></td>
                        <td><?php echo $hasil['MATAKULIAH']?></td>
                        <td><?php echo $hasil['DOSEN']?><br></td>
                        <td><?php echo $hasil['KELAS']?></td>
                    </tr>
                    <?php
                    $no++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

