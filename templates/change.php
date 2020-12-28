<?php
    $user = $_GET["username"];
    $data = mysqli_query($conn, "SELECT*FROM admin WHERE username = '$user'");

    while ($d = mysqli_fetch_assoc($data)) {
        $id = $d["id"];
        $username = $d["username"];
        $password = $d["password"];
        $foto = $d["foto"];
    }
?>
    <div class="row">
        <div class="container-fluid">
            <h2>Change Profile</h2>
        </div>
    </div>

    <div class="row">
        <img src="uploads/<?= $foto ?>" alt="" class="rounded mx-auto d-block ">
    </div>
    <div class="row">
        <div class="container-fluid">
            <form action="proses/proses.php?a=change" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="form-group">
                    <label for="username">Username :</label>
                    <input type="text" class="form-control" id="username" name="username" required value="<?= $username ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" class="form-control" id="password" name="password" required value="<?= $password ?>">
                </div>

                <div class="form-group">
                    <label for="foto" class="float-left">foto :</label>
                    <input type="file" class="float-left ml-3" id="foto" name="foto" >
                    <input type="hidden" name="old_pic" value="<?= $foto ?>">
                </div>
                
                <div class="clearfix"></div>

                <button type="submit" name="simpan" class="btn btn-primary mt-2">Simpan</button>
            </form>
        </div>
    </div>