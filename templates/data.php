<div class="container-fluid">
    <h1>Data Kunjungan Masyarakat</h1>

    <div class="row mt-4">
        <div class="col-md-6">
            <a href="?page=tambah" class="btn btn-primary"><i class="fa fa-user-plus"></i> Tambah Data</a>
        </div>

        <div class="col-md-6">
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari...." name='keyword' autofocus="">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2" name='cari'><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>

    <?php if(isset($_SESSION["flash"])): ?>
    <div class="row mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data telah berhasil <strong><?= $_SESSION["flash"] ?></strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <?php 
    unset($_SESSION["flash"]);
    endif; ?>

    <div class="row mt-3">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Instansi</th>
                    <th>Keperluan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Pagination
                    $halaman = 10; //batasan halaman
                    $page = isset($_GET['halaman'])? (int)$_GET["halaman"]:1;
                    $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;

                    if (isset($_POST["cari"])) {
                        $keyword = $_POST["keyword"];
                        $data = mysqli_query($conn, "SELECT*FROM kunjungan WHERE tanggal LIKE '%$keyword%' OR
                                                                                 nama LIKE '%$keyword%' OR
                                                                                 keperluan LIKE '%$keyword%' OR
                                                                                 instansi LIKE '%$keyword%' LIMIT $mulai, $halaman");
                    }else{
                        $data = mysqli_query($conn, "SELECT*FROM kunjungan ORDER BY id DESC LIMIT $mulai, $halaman");
                    }
                    $sql = mysqli_query($conn,"SELECT * FROM kunjungan");
                    $total = mysqli_num_rows($sql);
                    $pages = ceil($total/$halaman);

                    if (mysqli_num_rows($data) == 0) :
                ?>
                <tr >
                    <td colspan="7">
                        <div class="alert alert-danger" role="alert">
                        Maaf, Data Tidak Ditemukan !
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
                <?php
                    $no = 1;
                    while ($d = mysqli_fetch_assoc($data)) {
                ?>
                <tr>
                    <td><?= $no++?></td>
                    <td><img src="uploads/<?= $d["foto"] ?>" alt="" width="170" height="100"></td>
                    <td><?= $d["nama"] ?></td>
                    <td><?= date('l, d F Y', strtotime($d["tanggal"]))  ?></td>
                    <td><?= $d["instansi"] ?></td>
                    <td><?= $d["keperluan"] ?></td>
                    <td>
                        
                        <a href="proses/proses.php?a=del&id=<?= $d["id"] ?>" class="btn btn-danger btn-sm tombol-hapus" ><i class="fa fa-trash"></i></a>
                        <a href="?page=edit&id=<?= $d["id"] ?>" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a>
                    </td>
                </tr>
                    <?php } ?>
            </tbody>
        </table>

        <!-- Nav Page -->
        <ul class="pagination"> 
                      
            <?php if( $page > 1 ) : ?>
            <li class="page-item">
            <a class="page-link" href="?page=data&halaman=<?php echo $page-1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
            </li>
            <?php endif;?>

            <?php for ($i = 1; $i <= $pages; $i++) : ?>
                <?php if ($i == $page) :?>
                    <li class="page-item active"><a class="page-link " href="?page=data&halaman=<?= $i;?> "><?php echo $i; ?></a></li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link" href="?page=data&halaman=<?= $i;?> "><?php echo $i; ?></a></li>
                <?php endif; ?>
            <?php endfor;?>

            <?php if( $page < $pages ) : ?>
            <li class="page-item">
            <a class="page-link" href="?page=data&halaman=<?php echo $page+1; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
            </li>
            <?php endif;?>

        </ul>
    </div>
    
</div>