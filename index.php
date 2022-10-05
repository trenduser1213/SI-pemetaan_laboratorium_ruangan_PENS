<?php
require_once ('includes/Oauth.php');
require_once ('includes/func.inc.php');
require_once ('includes/jurusan.php');
$dataJurusan=dataJurusan();
$obj = new Oauth();
session_start();
// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
if($_SESSION == null)
{
  header('Location: login.php');
}
// $user = $_SESSION['user'];
// print_r(gettype($user));
// print_r($user);

if(isset($_GET['logout']))
{
  $obj->logout();
  session_destroy();
  header('Location: login.php');
}
// $user = $_SESSION['user'];
// if($_SESSION['user'] != null){
//     echo $user;
// }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - PENS</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"> -->
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">


    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/> -->
    <link rel="stylesheet" href="leaflet/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="">
    <script src="leaflet/leaflet-src.js" integritas="sha512-Uj3ED3j6dg1xxMgtj4kF4W60Tc1HGboQ5gweT+hG1z8sBIc0ncFuoh3qV5XZF8ZqlEGlV9mt9E6MZhLN3zFDJg=="></script>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <!-- <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script> -->
    
    <script src="assets/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/> -->

    <!-- <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script> -->

    <style>
        #map { height: 180px; }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.php">
                    <div class="sidebar-brand-icon"><img class="img-fluid" src="assets/img/Logo_PENS_putih.png" width="50 px"></div>
                    <div class="sidebar-brand-text mx-3"><span>PENS</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="index.php?halaman=lab"><i class="fa fa-flask"></i><span>Ruang Laboratorium</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?halaman=RuangKuliah"><i class="fa fa-building-o"></i><span>Ruang Kuliah</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?halaman=RuangAdmin"><i class="fa fa-money"></i><span>Ruang Administrasi dan lain</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?halaman=RuangPegawai"><i class="fa fa-mortar-board"></i><span>Informasi Dosen Dan Pegawai</span></a></li>
                    <li class="nav-item"></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ml-auto">
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $_SESSION['Nama'] ?></span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <form method="get"><div class="dropdown-divider"></div><button name="logout" class="dropdown-item" href=""><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</button></form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <?php
                                include('jumlahGedung.php');        
                            ?>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <?php 
                                include('jumlahLab.php');
                            ?>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <?php
                                include('jumlahRuangan.php');
                            ?>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <?php 
                                include('jumlahDosen.php');
                            ?>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                    <!-- <div class="row"> -->
                    
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-6 col-xl-6 offset-xl-3">
                            <div class="pb-0 pt-2"><!-- <div> -->
                                <div class="col">
                                    <div class="align-items-center form-row">
                                        <div class="form-group col-sm">
                                            <form action="" method="post"><input id="txtsearch" type="text" class="form-control pl-4 pr-4 rounded-pill" name="search" placeholder="Search..."></form>
                                        </div>
                                        <div class="form-group col-sm-auto text-right">
                                            <button onclick="search()" class="btn btn-primary pl-4 pr-4 rounded-pill" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="hasilSearch" class="div"></div>
                    <div class="row">
                      <?php 
                          if(isset($_GET['halaman'])){
                            if($_GET['halaman'] == 'lab'){
                              include 'lab.php';
                            
                            }elseif($_GET['halaman'] == 'RuangKuliah'){
                              include 'rKuliah.php';
                            }elseif($_GET['halaman'] == 'RuangPegawai'){
                                include 'rPegawai.php';
                            }elseif($_GET['halaman'] == 'RuangAdmin'){
                                include 'rAdmin.php';
                            }elseif ($_GET['halaman'] == 'detailRuangLab') {
                                include 'profileRuang.php';
                            }elseif ($_GET['halaman'] == 'detailRuangan') {
                                include 'profileRuang.php';
                            }
                            elseif($_GET['halaman'] == 'dashboard'){
                              include 'dashboard.php';
                            }
                          }else{
                            include 'dashboard.php';
                          }
                      ?>
                       
                        <div class="col">
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © PENS 2021</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script>
        function search(){
            // alert('oke');
            var x = document.getElementById("txtsearch").value;
            console.log(x);
            $.ajax({
                url:"includes/search.php",
                method:"POST",
                data:{
                    search : x
                },
                success:function(data){
                    console.log(data);
                    $("#hasilSearch").html(data)
                }
            })
        }
    </script>
</body>

</html>