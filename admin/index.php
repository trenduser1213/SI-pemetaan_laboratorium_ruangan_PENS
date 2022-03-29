<?php
echo "Hello World";
//connect to database oracle
$conn = oci_connect('system', 'oracle', '//localhost/XE');

// hitung jumlah pegawai yang ada di database
$query = "SELECT COUNT(*) AS jumlah FROM pegawai";
$hasil = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($hasil);
echo "Jumlah Pegawai: ".$data['jumlah'];

?>