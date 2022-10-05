
<?php
require_once "includes/ruang.php";
require_once "includes/jurusan.php";
$jurusan = dataJurusan();
require_once ('includes/pegawai.php');
$daftarDosen = dataNamaDosen();
oci_fetch_all($jurusan, $rowsJUR, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
$jurusan = $_POST['id'];
if($jurusan == "kosong"){
    $rows = viewLaboratoriumNULL();
}else{
    $rows = viewLaboratorium($jurusan);
    $rowss = countLabOFJurusan($jurusan);
}
$no = 1;?>
<div class="row">
    <div class="" id="maap" style="margin:0 auto; height:40vh; width:100%;"></div>
</div>
<div class="row"><div class="h2">Total laboratorium jurusan <?=$jurusan?> adalah <?=$rowss[0]['JUMLAH']?></div></div>
<div class="row">
    <table class="table table-hover">
        <thead>
            <tr class="table-primary">
                <th scope="col">#</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Nama laboratorium</th>
                <th scope="col">Jurusan</th>
                <th scope="col">Nama Ketua</th>
                <?php
                if($_POST['status']=="admin"){
                ?>
                    <th scope="col">action</th>
                <?php } ?>
            </tr>
        </thead>                                            
        <tbody class="" >
            <?php 
            foreach ($rows as $hasil) {
                ?>
                <tr>
                    <td scope="row"><?php echo  $no;?></th>
                    <td ><a href="index.php?halaman=detailRuangLab&id=<?php echo $hasil['NOMOR'] ?>"><?php echo $hasil['RUANG'] ?> </a></td>
                    <td><?php echo $hasil['KETERANGAN'] ?></td>
                    <td><?php echo $hasil['JURUSAN'] ?></td>
                    <td><?php echo $hasil['KEPALA'] ?></td>
                    <?php
                    if($_POST['status']=="admin"){
                    ?>
                    <td><button class="btn btn-primary fa fa-gear rounded-pill" data-bs-toggle="modal" data-bs-target="#actionLab<?php echo $hasil['NOMOR']?>"></button></td>
                    <?php } ?>
                </tr>
                <!-- modal button edit pengumuman -->
                <div class="modal fade" id="actionLab<?php echo $hasil['NOMOR']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit Pengumuman</h5>
                                <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">
                                    <button type="button" class="btn btn-warning" name="modal"  data-bs-toggle="modal" data-bs-target="#editRuang<?php echo $hasil['NOMOR']?>">Edit</button>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id_Pengumuman" value="<?php echo $hasil['NOMOR']?>">
                                        <button type="submit" class="btn btn-danger" name="deleteRuang" onclick="DeleteRuang(<?php echo $hasil['NOMOR'];?>)">DELETE</button>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal edit Pengumuman -->
                <div class="modal fade" id="editRuang<?php echo $hasil['NOMOR']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Update Materi</h5>
                                <button type="button" class="btn btn-danger fa fa-close rounded-pill" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="hidden" id="idRuang-<?php echo $hasil['NOMOR']?>" value="<?php echo $hasil['NOMOR']?>">
                                                <label for="namaLab">Nama Laboratorium</label>
                                                <input type="text" class="form-control" id="UpnamaLab-<?php echo $hasil['NOMOR']?>" name="namaLab" placeholder="Nama Laboratorium" value="<?php echo $hasil['KETERANGAN']?>">
                                                <label class="pt-2" for="lokasi">lokasi</label>
                                                <input type="text" class="form-control" id="Uplokasi-<?php echo $hasil['NOMOR']?>" name="lokasi" placeholder="lokasi" value="<?php echo $hasil['RUANG']?>">
                                                <label class="pt-2" for="lokasi">telp</label>
                                                <input type="text" class="form-control" id="Uptelp-<?php echo $hasil['NOMOR']?>" name="telp" placeholder="telp" value="<?php echo $hasil['TELP']?>">
                                                <label class="pt-2" for="jurusan">Jurusan</label>
                                                <select class="form-control" id="Upjurusan-<?php echo $hasil['NOMOR']?>" name="jurusan">
                                                    <option value="">Pilih Jurusan</option>
                                                    <?php foreach ($rowsJUR as $rowJurusan) {  ?>
                                                        <?php if($rowJurusan['JURUSAN'] == $hasil['JURUSAN'] ) {?>
                                                            <option selected="selected" value="<?php echo $rowJurusan['NOMOR'] ?>"><?php echo $rowJurusan['JURUSAN']?></option>
                                                        <?php }else{ ?>
                                                            <option value="<?php echo $rowJurusan['NOMOR'] ?>"><?php  echo $rowJurusan['JURUSAN']?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="" for="ketua">ketua</label>
                                                <select class="form-control" id="UpKetua-<?php echo $hasil['NOMOR']?>" name="ketua">
                                                    <option value="">Pilih Ketua</option>
                                                    <?php foreach($daftarDosen as $DaftarDosen){ ?>
                                                        <?php if($DaftarDosen['NAMA'] == $hasil['KEPALA']){?>  
                                                            <option selected="selected" value="<?php echo $DaftarDosen['NOMOR']?>"><?php echo $DaftarDosen['NAMA']?></option>
                                                        <?php }else{?>
                                                            <option value="<?php echo $DaftarDosen['NOMOR']?>"><?php echo $DaftarDosen['NAMA']?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <label class="pt-2" for="asisten">asisten</label>
                                                <select class="form-control" id="UpAsisten-<?php echo $hasil['NOMOR']?>" name="asisten">
                                                    <option value="">Pilih Asisten</option>
                                                    <?php foreach($daftarDosen as $DaftarDosen){ ?> 
                                                        <?php if($DaftarDosen['NOMOR'] == $hasil['ASISTEN']){?>  
                                                            <option selected="selected" value="<?php echo $DaftarDosen['NOMOR']?>"><?php echo $DaftarDosen['NAMA']?></option>
                                                        <?php }else{?>
                                                            <option value="<?php echo $DaftarDosen['NOMOR']?>"><?php echo $DaftarDosen['NAMA']?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <label class="pt-2" for="teknisi">teknisi</label>
                                                <select class="form-control" id="UpTeknisi-<?php echo $hasil['NOMOR']?>" name="teknisi">
                                                    <option value="">Pilih Asisten</option>
                                                    <?php foreach($daftarDosen as $DaftarDosen){ ?> 
                                                        <?php if($DaftarDosen['NOMOR'] == $hasil['TEKNISI']){?>  
                                                            <option selected="selected" value="<?php echo $DaftarDosen['NOMOR']?>"><?php echo $DaftarDosen['NAMA']?></option>
                                                        <?php }else{?>
                                                            <option value="<?php echo $DaftarDosen['NOMOR']?>"><?php echo $DaftarDosen['NAMA']?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <label class="pt-2" for="virtual">virtual</label>
                                                <textarea name="virtual" id="virtual-<?php echo $hasil['NOMOR']?>" cols="10" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                                <div class="modal-footer">
                                    <input type="hidden" name="id_Pengumuman" value="<?php echo $hasil['NOMOR']?>">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="UpRuang" id="UpRuang" onclick="UpdateRuang(<?php echo $hasil['NOMOR'];?>)">Kirim</button>
                                </div>
                        </div>
                    </div>
                </div>
                <div id="hasilUpdate"></div>
                
            <?php
            $no++;} ?>
            <?php
    if(isset($_POST['deleteRuang'])){
        echo "<script>alert('Success Delete');</script>";
        // var_dump($deskripsi);
        // $hasil = tambahRuangLab($namaLab, $lokasi, $jurusan, $ketua, $asisten, $teknisi);
        // var_dump($hasil);
    }
    ?>
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/bootstrap/js/bootstrap.min.js"></script>
            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script> -->
            <script src="assets/js/script.min.js"></script>
            <script>
                function UpdateRuang(nomor){
                    var idRuang = document.getElementById(`idRuang-${nomor}`).value;
                    var namaLab = document.getElementById(`UpnamaLab-${nomor}`).value;
                    var lokasi = document.getElementById(`Uplokasi-${nomor}`).value;
                    var telp = document.getElementById(`Uptelp-${nomor}`).value;
                    var jurusan = document.getElementById(`Upjurusan-${nomor}`).value;
                    var ketua = document.getElementById(`UpKetua-${nomor}`).value;
                    var asisten = document.getElementById(`UpAsisten-${nomor}`).value;
                    var teknisi = document.getElementById(`UpTeknisi-${nomor}`).value;
                    var virtual = document.getElementById(`virtual-${nomor}`).value;
                    console.log(nomor);
                    console.log(idRuang);     
                    console.log(namaLab);
                    console.log(lokasi);
                    console.log(telp);
                    console.log(jurusan);
                    console.log(ketua);
                    console.log(asisten);
                    console.log(teknisi);
                    console.log(virtual);
                    $.ajax({
                        url:"updateRuang.php",
                        method:"POST",
                        data:{
                            nomor : nomor,
                            idRuang : idRuang, 
                            namaLab : namaLab,
                            lokasi : lokasi,
                            telp : telp,
                            jurusan : jurusan,
                            ketua : ketua,
                            asisten : asisten,
                            teknisi : teknisi,
                            virtual : virtual,
                        },
                        success:function(data){
                            console.log(data);
                            $("#hasilUpdate").html(data)
                        }
                    });
                }
                function DeleteRuang(nomor){
                    var idRuang = document.getElementById(`idRuang-${nomor}`).value;
                    console.log(idRuang);
                    console.log(nomor);
                    $.ajax({
                        url:"deleteRuang.php",
                        method:"POST",
                        data:{
                            nomor : nomor,
                            idRuang : idRuang,                         
                        },
                        success:function(data){
                            console.log(data);
                            $("#hasilUpdate").html(data)
                        }
                    });
                }
            </script>
    
        </tbody>                                            
    </table>
</div>
<script>

	var map = L.map('maap').setView([-7.276730416931179, 112.79398368529063], 18);

	var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		// attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);

	// var marker_gedung_D4 = L.marker([-7.276730416931179, 112.79398368529063]).addTo(map).bindPopup('Gedung D3').openPopup();
	var marker_gedung_D3 = L.marker([-7.276556147174405, 112.79469849248298]).addTo(map).bindPopup('Laboratorium Jurusan').openPopup();
	var marker_gedung_D3 = L.marker([-7.276945925994565, 112.79309587416766]).addTo(map).bindPopup('Laboratorium Jurusan').openPopup();
	// var marker_gedung_D3 = L.marker([-7.275873700865577, 112.79451744486612]).addTo(map).bindPopup('Gedung EIC').openPopup();

	// var circle = L.circle([-7.276730416931179, 112.79398368529063], {
	// 	color: 'red',
	// 	fillColor: '#f03',
	// 	fillOpacity: 0.5,
	// 	radius: 100
	// }).addTo(map);

	var gedung_D4 = L.polygon([
		[-7.276345293984807, 112.79476085383213],
		[-7.276792276019379, 112.79475012499992],
		[-7.2767962669283515, 112.7946368016765],
		[-7.276362587941166, 112.79465490658691]
		],{
			color: '#53BF9D',
			fillColor: '#D3EBCD',
			fillOpacity: 0.5,
		}).addTo(map);
	
	// var gedung_D3 = L.polygon([
	// 	[-7.27614774376013, 112.79451476265726],
	// 	[-7.277222628837746, 112.79446916510655],
	// 	[-7.277230610647995, 112.79350356991515],
	// 	[-7.27691931994296, 112.79352502758607],
	// 	[-7.27689803510053, 112.79328899320593],
	// 	[-7.27674371996279, 112.79328899320593],
	// 	[-7.27674371996279, 112.7934687011999],
	// 	[-7.276451053176462, 112.79346601899103],
	// 	[-7.2764271077036815, 112.79312537846516],
	// 	[-7.276102513391002, 112.7931226962563]
	// 	],{
	// 		color: '#1363DF',
	// 		fillColor: '#47B5FF',
	// 		fillOpacity: 0.5,
	// 	}).addTo(map);
	
	// var gedung_D4 = L.polygon([
	// 	[-7.277148131935209, 112.7934847944531],
	// 	[-7.277145471331323, 112.79292957721803],
	// 	[-7.276608029021953, 112.79294298826234],
	// 	[-7.276626653271171, 112.79322193798431],
	// 	[-7.276929962363788, 112.79325144228183],
	// 	[-7.276964550229749, 112.7934767478265]
	// 	],{
	// 		color: '#87805E',
	// 		fillColor: '#B09B71',
	// 		fillOpacity: 0.5,
	// 	}).addTo(map);

	// var gedung_eic = L.polygon([
	// 	[-7.276086549730226, 112.79465423751824],
	// 	[-7.275807185574657, 112.7946569197271],
	// 	[-7.275780579455536, 112.79423849514417],
	// 	[-7.2758949857565804, 112.79423849514417],
	// 	[-7.275921591868921, 112.79453085591045],
	// 	[-7.276078567899622, 112.79452280928385]
	// 	],{
	// 		color: 'red',
	// 		fillColor: '#f03',
	// 		fillOpacity: 0.5,
	// 	}).addTo(map);
</script>

