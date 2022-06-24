<?php
require_once 'includes/inventaris.php';
$id =$_GET['id'];

//echo $id;
$inventarisRuang= inventarisRuang($id);

?>
<div class="card-body">
    <div class="table-responsive-lg scroll">
        <table class="table table-hover">
            <thead class="text-light bg-primary">
                <tr>
                    <th>No</th>
                    <th>Nama barang</th>
                    <th>Spek</th>
                    <th>Kode</th>
                    <th>Pabrik</th>
                    <th>Tahun Peroleh</th>
                </tr>
            </thead>
            <tbody>
            <?php
            oci_fetch_all($inventarisRuang, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
            $no = 1;
            foreach ($rows as $hasil) {

            ?>
                <tr>
                    <td><?php echo $no?></td>
                    <td><?php echo $hasil['NAMA']?></td>
                    <td><?php echo $hasil['SPEK']?></td>
                    <td><?php echo $hasil['KODE']?></td>
                    <td><?php echo $hasil['PABRIK']?></td>
                    <td><?php echo $hasil['TAHUN']?></td>
            </tr>
            <?php
            $no++;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>