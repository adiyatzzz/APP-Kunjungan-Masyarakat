<?php
session_start();
include('../db/koneksi.php');

if (!isset($_GET["a"])) {
    header("Location: ../");
}
$aksi = $_GET["a"];

// tambah data
if ($aksi == 'tambah') {
    $nama = $_POST["nama"];
    $keperluan = $_POST["keperluan"];
    $instansi = $_POST["instansi"];

    // Upload File
    $foto = $_FILES["foto"]["name"];
    $ekstensi_diperbolehkan	= array('png','jpg', 'jpeg');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name']; 

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        $pic_name = uniqid($foto);
        move_uploaded_file($file_tmp, '../uploads/'.$pic_name);
        // masukkan berita
        $query = mysqli_query($conn, "INSERT INTO kunjungan VALUES('', now(), '$nama', '$keperluan', '$instansi','$pic_name')");
        

        if (mysqli_affected_rows($conn) > 0) {
            echo "
            <script>
            window.location.href = '../?page=data';
            </script>";
            return $_SESSION["flash"] = "Ditambahkan";
        }else {
            echo "
            <script>
            alert('Upload Failed');
            window.location.href = '../?page=tambah';
            </script>";
        }
    }else {
        echo "
            <script>
            alert('Ekstensi file harus PNG,JPG,JPEG');
            window.location.href = '../?page=tambah';
            </script>
        ";
        return false;
    }    
}


// hapus data
if ($aksi == 'del') {
    $id = $_GET["id"];
    $query = mysqli_query($conn, "DELETE FROM kunjungan WHERE id = $id ");
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
            window.location.href = '../?page=data';
            </script>
        ";
        return $_SESSION["flash"] = "Dihapus";
    }
}

// edit data
if ($aksi == "edit") {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $keperluan = $_POST["keperluan"];
    $instansi = $_POST["instansi"];
    $old_pic = $_POST["old_foto"];
    $tanggal = $_POST["tanggal"];

    // Upload File
    $foto = $_FILES["foto"]["name"];
    $ekstensi_diperbolehkan	= array('png','jpg', 'jpeg');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name']; 

    if ($foto == true) {
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            $pic_name = uniqid($foto);
            move_uploaded_file($file_tmp, '../uploads/'.$pic_name);
            $query = mysqli_query($conn, "UPDATE kunjungan SET tanggal = '$tanggal', nama='$nama', keperluan='$keperluan', instansi='$instansi', foto='$pic_name' WHERE id = $id");
    
            if (mysqli_affected_rows($conn) > 0) {
                echo "
                <script>
                window.location.href = '../?page=data';
                </script>";
                return $_SESSION["flash"] = "Di Edit";
            }else {
                echo "
                <script>
                alert('Edit Failed');
                window.location.href = '../?page=data';
                </script>";
            }
        }else {
            echo "
                <script>
                alert('Ekstensi file harus PNG,JPG,JPEG');
                window.location.href = '../?page=edit';
                </script>
            ";
            return false;
        }    
    }else {
        mysqli_query($conn, "UPDATE kunjungan SET tanggal = '$tanggal', nama='$nama', keperluan='$keperluan', instansi='$instansi', foto='$old_pic' WHERE id = $id");
    
            if (mysqli_affected_rows($conn) > 0) {
                echo "
                <script>
                window.location.href = '../?page=data';
                </script>";
                return $_SESSION["flash"] = "Di Edit";
            }else {
                echo "
                <script>
                alert('Edit Failed');
                window.location.href = '../?page=data'
                </script>";
            }
               
    }
}

//Login
if ($aksi == "login") {
    $username = $_POST["username"];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT*FROM admin WHERE username = '$username' AND password = '$password' ");
    if (mysqli_num_rows($result) > 0) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION["user"] = $username;
            header("Location: ../");
    }else{
        echo "
        <script>
        window.location.href = '../log/?er=1'
        </script>";
        
    }
}

//Logout
if ($aksi == 'out') {
    session_destroy();
    header("Location: ../");
}

// change profile
if ($aksi == "change") {
    $id = $_POST["id"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $old_pic = $_POST["old_pic"];
    
    // Upload File
    $foto = $_FILES["foto"]["name"];
    $ekstensi_diperbolehkan	= array('png','jpg', 'jpeg');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name']; 

    if ($foto == true) {
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            $pic_name = uniqid($foto);
            move_uploaded_file($file_tmp, '../uploads/'.$pic_name);
            $query = mysqli_query($conn, "UPDATE admin SET username = '$username', password='$password', foto='$pic_name' WHERE id = $id");
    
            if (mysqli_affected_rows($conn) > 0) {
                echo "
                <script>
                window.location.href = '../';
                </script>";
                return $_SESSION["user"] = $username;
            }else {
                echo "
                <script>
                alert('Edit Failed');
                window.location.href = '../';
                </script>";
            }
        }else {
            echo "
                <script>
                alert('Ekstensi file harus PNG,JPG,JPEG');
                window.location.href = '../';
                </script>
            ";
            return false;
        }    
    }else {
        mysqli_query($conn, "UPDATE admin SET username = '$username', password='$password', foto='$old_pic' WHERE id = $id");
    
            if (mysqli_affected_rows($conn) > 0) {
                echo "
                <script>
                window.location.href = '../';
                </script>";
                return $_SESSION["user"] = $username;
            }else {
                $user = $_SESSION["user"];
                echo "
                <script>
                alert('Username / Password Belum di Ganti!');
                window.location.href = '../?page=change&username=$user'
                </script>";
            }     
    }
}





?>