<?php
  session_start();
  if (!isset($_SESSION["login"])) {
    header('Location: log/');
    exit;
  }
  include('db/koneksi.php');
  include('templates/header.php');
  include('templates/sidebar.php');
  
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
<?php
  if (isset($_GET["page"])) {
    switch ($_GET["page"]) {
      case 'data':
        require_once 'templates/data.php';
        break;
      
      case 'tambah':
        require_once 'templates/tambah.php';
        break;

      case 'edit':
        require_once 'templates/edit.php';
        break;

      case 'change':
        require_once 'templates/change.php';
        break;
      
      default:
        require_once 'templates/not_found.php';
        break;
    }
  }else{
?>
<div class="container">
  <div class="row ml-1">
    <h2>Selamat Datang Admin</h2>
  </div>
  <div class="row mt-3">
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <?php
            $data = mysqli_query($conn, "SELECT*FROM kunjungan");
            $jumlahData = mysqli_num_rows($data);
          ?>
          <h3><?= $jumlahData ?></h3>

          <p>Jumlah Data Kunjungan</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="?page=data" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
      <?php
        $dataPerhari = mysqli_query($conn, "SELECT * FROM `kunjungan` WHERE MONTH(`tanggal`) = MONTH(CURRENT_DATE()) AND DAY(`tanggal`) = DAY(CURRENT_DATE())");
        $hasilDataPerhari = mysqli_num_rows($dataPerhari);
      ?>
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3><?= $hasilDataPerhari ?></h3>

          <p>Data Hari ini</p>
        </div>
        <div class="icon">
        <i class="fas fa-calendar-day"></i>
        </div>
        <a href="?page=data" class="small-box-footer">More Info<i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
      <?php
        $dataPerbulan = mysqli_query($conn, "SELECT * FROM `kunjungan` WHERE MONTH(`tanggal`) = MONTH(CURRENT_DATE()) ");
        $hasilDataPerbulan = mysqli_num_rows($dataPerbulan);
      ?>
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3><?= $hasilDataPerbulan ?></h3>

          <p>Data Bulan ini</p>
        </div>
        <div class="icon">
        <i class="fas fa-calendar-alt"></i>
        </div>
        <a href="?page=data" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    
  </div>
  
</div>
<!-- /.content -->

<?php } ?>
  </div><!-- /.container-fluid -->
  </section>
  <!-- /.content-wrapper -->
<?php
  include('templates/footer.php');
?>
