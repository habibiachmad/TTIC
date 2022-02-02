<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>TOKO TANI INDONESIA CENTRE</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">TTIC Stock Pangan</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>   
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock Pangan
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Pangan Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Pangan Keluar
                            </a>
                            <a class="nav-link" href="penerima.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Penerima
                            </a>
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Kelola Admin
                            </a>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Penerima Pangan</h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah Data
                            </button>
                            <a href="exportpenerima.php" class="btn btn-success">Export Data</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" id="mauexport">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Penerima</th>
                                            <th>NIK</th>
                                            <th>Tempat Tanggal Lahir</th>
                                            <th>Pekerjaan</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $ambilsemuadatapenerima = mysqli_query($conn,"select * from penerima");
                                        $i = 1;
                                        while($data=mysqli_fetch_array($ambilsemuadatapenerima)){
                                            $namapenerima= $data['namapenerima'];
                                            $nik = $data['nik'];
                                            $ttl = $data['ttl'];
                                            $pekerjaan = $data['pekerjaan'];
                                            $alamat = $data['alamat'];
                                            $telpon = $data['telpon'];
                                            $idp = $data['idpenerima'];
                                        
                                        ?>


                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$namapenerima;?></td>
                                            <td><?=$nik;?></td>
                                            <td><?=$ttl;?></td>
                                            <td><?=$pekerjaan;?></td>
                                            <td><?=$alamat;?></td>
                                            <td><?=$telpon;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idp;?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idp;?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="edit<?=$idp;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Penerima</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post">
                                                <div class="modal-body">
                                                <input type="text" name="namapenerima" value="<?=$namapenerima;?>" class="form-control" required>
                                                <br>
                                                <input type="text" name="nik" value="<?=$nik;?>" class="form-control" required>
                                                <br>
                                                <input type="text" name="ttl" value="<?=$ttl;?>" class="form-control" required>
                                                <br>
                                                <input type="text" name="pekerjaan" value="<?=$pekerjaan;?>" class="form-control" required>
                                                <br>
                                                <input type="text" name="alamat" value="<?=$alamat;?>" class="form-control" required>
                                                <br>
                                                <input type="text" name="telpon" value="<?=$telpon;?>" class="form-control" required>
                                                <br>
                                                <input type="hidden" name="idp" value="<?=$idp;?>">
                                                <button type="submit" class="btn btn-primary" name="updatepenerima">Submit</button>
                                                </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                        
                                        <div class="modal fade" id="delete<?=$idp;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data?</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post">
                                                <div class="modal-body">
                                                Apakah anda yakin ingin menghapus <?=$namapenerima;?>?
                                                <input type="hidden" name="idp" value="<?=$idp;?>">
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-danger" name="hapuspenerima">Hapus</button>
                                                </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>

                                        <?php
                                        };
                                        
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Pengelolaan Pangan &copy; Penerima Pangan</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Penerima</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form method="post">
            <div class="modal-body">
            <input type="text" name="namapenerima" placeholder="Nama Penerima" class="form-control" required>
            <br>
            <input type="text" name="nik" placeholder="NIK" class="form-control" required>
            <br>
            <input type="text" name="ttl" placeholder="Tempat Tanggal Lahir" class="form-control" required>
            <br>
            <input type="text" name="pekerjaan" placeholder="Pekerjaan" class="form-control" required>
            <br>
            <input type="text" name="alamat" placeholder="Alamat" class="form-control" required>
            <br>
            <input type="text" name="telpon" placeholder="Telepon" class="form-control" required>
            <br>
            <button type="submit" class="btn btn-primary" name="addpenerima">Submit</button>
            </div>
            </form>

            </div>
            </div>
        </div>

</html>
