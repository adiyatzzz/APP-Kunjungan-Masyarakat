<div class="container-fluid">
    <h1>Tambah data</h1>

    <form action="proses/proses.php?a=tambah" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nama">Nama :</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="keperluan">Keperluan :</label>
            <textarea class="form-control" id="keperluan" name="keperluan" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="instansi">Instansi :</label>
            <input type="text" class="form-control" id="instansi" name="instansi" required>
        </div>

        <div class="form-group">
            <label for="foto">Foto</label>
            <input type="file" class="form-control-file" id="foto" name="foto" required>
        </div>

        <button type="submit" name="tambah" class="btn btn-primary float-right">Tambah</button>
    </form>
        
</div><!-- /.container-fluid -->