<?php
require_once "includes/ruang.php";
require_once "includes/jurusan.php";
$dataRuang = viewLaboratorium();
$jurusan = dataJurusan();
?>
                        <div class="col-lg-12 col-xl-12">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary font-weight-bold m-0">Laboratorium
                                        <button class="btn btn-primary rounded-pill" type="submit"><i class="fa fa-search"></i></button>
                                    </h6>
                                    <div class="pb-0 pt-2">
                                        <div class="align-items-center form-row">
                                            <div class="form-group col-sm"><select class="form-control pl-4 pr-4 rounded-pill">
                                                    <optgroup label="Jurusan">
                                                        <?php
                                                        oci_fetch_all($jurusan, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
                                                        $no = 1;
                                                        foreach ($rows as $rowJurusan) {

                                                        ?>
                                                        <option value="<?php echo $rowJurusan['NOMOR'] ?>" selected=""><?php echo $rowJurusan['JURUSAN_LENGKAP'] ?></option>
                                                        <?php
                                                        } ?>
                                                    </optgroup>
                                                </select></div>
                                            <div class="form-group col-sm-auto text-right"><button class="btn btn-primary pl-4 pr-4 rounded-pill" type="submit"><i class="fa fa-search"></i></button></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="scroll">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="table-primary">
                                            <th scope="col">#</th>
                                            <th scope="col">Nama laboratorium</th>
                                                <th scope="col">Lokasi</th>
                                            <th scope="col">Nama Ketua</th>
                                            <th scope="col">Jumlah Anggota</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody class="">

                                            <?php
                                            oci_fetch_all($dataRuang, $rows, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
                                             $no = 1;
                                            foreach ($rows as $hasil) {

                                                ?>
                                            <tr>
                                            <th scope="row"><?php echo  $no;?></th>
                                            <td><a href="index.php?halaman=detailRuang&id=<?php echo $hasil['NOMOR'] ?>"><?php echo $hasil['RUANG'] ?> </a></td>
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
                        </div>
                        <div class="loginPopup">
                            <div class="formPopup" id="myPopup">
                                <form action="/action_page.php" class="formContainer">
                                <h2>Please Log in</h2>
                                <label for="email">
                                    <strong>E-mail</strong>
                                </label>
                                <input type="text" id="email" placeholder="Your Email" name="email" required>
                                <label for="psw">
                                    <strong>Password</strong>
                                </label>
                                <input type="password" id="psw" placeholder="Your Password" name="psw" required>
                                <button type="submit" class="btn">Log in</button>
                                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                                </form>
                            </div>
                        </div>
                        <script>
                        var myModal = document.getElementById('myModal')
                        var myInput = document.getElementById('myInput')

                        myModal.addEventListener('shown.bs.modal', function () {
                        myInput.focus()
                        })
                            </script>