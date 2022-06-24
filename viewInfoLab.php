
<div class="card shadow mb-3">
    <div class="card-header py-3">
        <p class="text-primary m-0 font-weight-bold">informasi Ruang <?php echo $hasil['RUANG'];?></p>
    </div>
    <div class="card-body">
        <form>
            <div class="form-row">
                <div class="col-4 col-lg-4">
                    <div class="form-group"><label for="username"><strong>Kepala laboratorium</strong><br></label>
                        <p><?php echo $hasil['KEPALA'];?></p>
                    </div>
                </div>
                <div class="col-4 col-lg-4">
                    <div class="form-group"><label for="username"><strong>asisten laboratorium</strong><br></label>
                        <p><?php echo $hasil['ASISTEN'];?></p>
                    </div>
                </div>
                <div class="col-4 col-lg-4">
                    <div class="form-group"><label for="username"><strong>Teknisi laboratorium</strong><br></label>
                        <p><?php echo $hasil['TEKNISI'];?></p>
                    </div>
                </div>
                <div class="col-4 col-lg-4">
                    <div class="form-group"><label for="email"><strong>No.Telp</strong><br></label>
                        <p><?php echo $hasil['TELP'];?></p>
                    </div>
                </div>
                <div class="col-4 col-lg-4">
                    <div class="form-group"><label for="email"><strong>Gedung</strong><br></label>
                        <p>Pasca sarjana</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    <div class="form-group"><label for="email"><strong>Deskripsi</strong><br></label>
                        <p><?php echo $hasil['KETERANGAN'];?><br></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>