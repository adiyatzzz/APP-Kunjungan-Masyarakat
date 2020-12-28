<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php
      //ambil data admin
      if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
      }
      
      $data = mysqli_query($conn, "SELECT*FROM admin WHERE username='$user'");
      while ($d = mysqli_fetch_assoc($data)) {
        $username = $d["username"];
        $password = $d["password"];
        $foto = $d['foto'];
      }
    ?>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="uploads/<?= $foto; ?>" class="img-circle elevation-2" alt="User Image" >
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= strtoupper($username) ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="index.php" class="nav-link">
                  <i class="fa fa-home nav-icon"></i>
                  <p>Home</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="?page=data" class="nav-link">
                  <i class="fa fa-table nav-icon"></i>
                  <p>Data</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="?page=tambah" class="nav-link">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Tambah Data</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cog"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="?page=change&username=<?= $username ?>" class="nav-link">
                        <i class="fas fa-user-edit nav-icon"></i>
                        <p>Change Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="proses/proses.php?a=out" class="nav-link">
                        <i class="fa fa-power-off nav-icon"></i>
                        <p>Log Out</p>
                        </a>
                    </li>
                </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>