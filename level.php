<?php
if(!isset($_SESSION['user'])){
    echo "<div class='container' style='max-width:800px;padding-top:60px;'><div class='alert alert-danger'><i class='bi bi-exclamation-triangle'></i> Silakan login terlebih dahulu</div></div>";
    return;
}
if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    mysqli_query($conn, "INSERT INTO level (nama) VALUES ('$nama')");
    header("Location: index.php?page=level");
}
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM level WHERE id='$id'");
    header("Location: index.php?page=level");
}
$edit = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM level WHERE id='$id'"));
}
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    mysqli_query($conn, "UPDATE level SET nama='$nama' WHERE id='$id'");
    header("Location: index.php?page=level");
}
?>

<section class="page-section">
  <div class="container" style="max-width:800px;">

    <h2 class="section-title"><i class="bi bi-layers"></i> Data Level</h2>

    <div class="glass-card mb-4">
      <form method="POST">
        <?php if($edit): ?>
          <input type="hidden" name="id" value="<?= $edit['id']; ?>">
        <?php endif; ?>
        <div class="input-group">
          <input type="text" name="nama" class="form-control" placeholder="Nama Level"
              value="<?= $edit ? $edit['nama'] : '' ?>" required>
          <?php if($edit): ?>
            <button type="submit" name="update" class="btn btn-warning">Update</button>
            <a href="index.php?page=level" class="btn btn-secondary">Batal</a>
          <?php else: ?>
            <button type="submit" name="simpan" class="btn btn-primary" style="border-radius:0 10px 10px 0!important;">
              <i class="bi bi-plus-lg"></i> Tambah
            </button>
          <?php endif; ?>
        </div>
      </form>
    </div>

    <div class="glass-card">
      <div class="table-responsive">
        <table class="table mb-0">
          <thead>
            <tr><th>No</th><th>Nama Level</th><th width="180">Aksi</th></tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          $data = mysqli_query($conn, "SELECT * FROM level");
          while($row = mysqli_fetch_assoc($data)):
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $row['nama']; ?></td>
              <td>
                <a href="index.php?page=level&edit=<?= $row['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <a href="index.php?page=level&hapus=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
          <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</section>