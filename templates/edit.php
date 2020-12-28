<?php
    $id = $_GET["id"];
    $data = mysqli_query($conn, "SELECT*FROM kunjungan WHERE id = $id");

    while ($d = mysqli_fetch_assoc($data)) {
        $id = $d["id"];
        $nama = $d["nama"];
        $keperluan = $d["keperluan"];
        $instansi = $d["instansi"];
        $foto = $d["foto"];
        $tanggal = $d["tanggal"];
    }
?>
<div class="row">
<div class="container-fluid">
    <h1>Edit data</h1>

    <form action="proses/proses.php?a=edit" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="form-group">
            <label for="nama">Nama :</label>
            <input type="text" class="form-control" id="nama" name="nama" required value="<?= $nama ?>">
        </div>

        <div class="form-group">
            <label for="keperluan">Keperluan :</label>
            <textarea class="form-control" id="keperluan" name="keperluan" rows="3" required><?= $keperluan ?></textarea>
        </div>

        <div class="form-group">
            <label for="instansi">Instansi :</label>
            <input type="text" class="form-control" id="instansi" name="instansi" required value="<?= $instansi ?>">
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal :</label> <br>
            <input type="date" class="form-control-date" id="tanggal" name="tanggal" required value="<?= $tanggal ?>">
        </div>

        <div class="form-group"> 
            <label for="foto" class="float-left">Foto :</label>
            <input type="file" class="float-left ml-3" id="foto" name="foto">
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <input type="hidden" name="old_foto" value="<?= $foto ?>">
            <img src="uploads/<?= $foto ?>" alt="" width="200">
        </div>
        <button type="submit" name="edit" class="btn btn-primary float-right mb-3">Edit</button>
    </form>
        
</div><!-- /.container-fluid -->
</div>