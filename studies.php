<?php
if(!isset($_SESSION['user'])){
    echo "<div class='container' style='max-width:900px;padding-top:60px;'><div class='alert alert-danger'><i class='bi bi-exclamation-triangle'></i> Silakan login terlebih dahulu</div></div>";
    return;
}
if(isset($_POST['simpan'])){
    $nama=$_POST['nama']; $idlevel=$_POST['idlevel']; $ket=$_POST['keterangan']; $tahun=$_POST['tahun_lulus'];
    $foto=$_FILES['foto']['name']; $tmp=$_FILES['foto']['tmp_name'];
    if($foto) move_uploaded_file($tmp,"uploads/".$foto);
    mysqli_query($conn,"INSERT INTO studies (nama,idlevel,keterangan,tahun_lulus,foto_sekolah) VALUES ('$nama','$idlevel','$ket','$tahun','$foto')");
    header("Location: index.php?page=studies");
}
if(isset($_GET['hapus'])){
    mysqli_query($conn,"DELETE FROM studies WHERE id='".$_GET['hapus']."'");
    header("Location: index.php?page=studies");
}
$edit=null;
if(isset($_GET['edit'])){
    $edit=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM studies WHERE id='".$_GET['edit']."'"));
}
if(isset($_POST['update'])){
    $id=$_POST['id']; $nama=$_POST['nama']; $idlevel=$_POST['idlevel']; $ket=$_POST['keterangan']; $tahun=$_POST['tahun_lulus'];
    $foto=$_FILES['foto']['name']; $tmp=$_FILES['foto']['tmp_name'];
    if($foto){
        move_uploaded_file($tmp,"uploads/".$foto);
        mysqli_query($conn,"UPDATE studies SET nama='$nama',idlevel='$idlevel',keterangan='$ket',tahun_lulus='$tahun',foto_sekolah='$foto' WHERE id='$id'");
    } else {
        mysqli_query($conn,"UPDATE studies SET nama='$nama',idlevel='$idlevel',keterangan='$ket',tahun_lulus='$tahun' WHERE id='$id'");
    }
    header("Location: index.php?page=studies");
}
?>

<section class="page-section">
  <div class="container" style="max-width:960px;">

    <h2 class="section-title"><i class="bi bi-book"></i> Data Studies</h2>

    <div class="glass-card mb-4">
      <form method="POST" enctype="multipart/form-data">
        <div class="row g-3">
          <div class="col-md-6">
            <input type="text" name="nama" class="form-control" placeholder="Nama Sekolah" value="<?= $edit?$edit['nama']:'' ?>" required>
          </div>
          <div class="col-md-3">
            <select name="idlevel" class="form-select" required>
              <option value="">Pilih Level</option>
              <?php $level=mysqli_query($conn,"SELECT * FROM level"); while($l=mysqli_fetch_assoc($level)): ?>
              <option value="<?=$l['id']?>" <?=($edit&&$edit['idlevel']==$l['id'])?'selected':''?>><?=$l['nama']?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-md-3">
            <input type="number" name="tahun_lulus" class="form-control" placeholder="Tahun Lulus" value="<?=$edit?$edit['tahun_lulus']:''?>">
          </div>
          <div class="col-12">
            <textarea name="keterangan" class="form-control" placeholder="Keterangan" rows="2"><?=$edit?$edit['keterangan']:''?></textarea>
          </div>
          <div class="col-md-6">
            <input type="file" name="foto" class="form-control">
          </div>
          <?php if($edit&&$edit['foto_sekolah']): ?>
          <div class="col-md-2"><img src="uploads/<?=$edit['foto_sekolah']?>" width="70" class="rounded" style="border:2px solid var(--glass-border);"></div>
          <?php endif; ?>
          <div class="col-12">
            <?php if($edit): ?>
              <input type="hidden" name="id" value="<?=$edit['id']?>">
              <button name="update" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Update</button>
              <a href="index.php?page=studies" class="btn btn-secondary">Batal</a>
            <?php else: ?>
              <button name="simpan" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah</button>
            <?php endif; ?>
          </div>
        </div>
      </form>
    </div>

    <div class="glass-card">
      <div class="table-responsive">
        <table class="table mb-0">
          <thead>
            <tr><th>No</th><th>Foto</th><th>Nama</th><th>Level</th><th>Tahun</th><th>Aksi</th></tr>
          </thead>
          <tbody>
          <?php
          $no=1; $data=mysqli_query($conn,"SELECT studies.*,level.nama AS level_nama FROM studies JOIN level ON studies.idlevel=level.id");
          while($row=mysqli_fetch_assoc($data)):
          ?>
          <tr>
            <td><?=$no++;?></td>
            <td><?php if($row['foto_sekolah']):?><img src="uploads/<?=$row['foto_sekolah']?>" width="50" class="rounded"><?php else:?><span style="color:var(--text-muted)">—</span><?php endif;?></td>
            <td><?=$row['nama'];?></td>
            <td><?=$row['level_nama'];?></td>
            <td><?=$row['tahun_lulus'];?></td>
            <td>
              <a href="index.php?page=studies&edit=<?=$row['id']?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
              <a href="index.php?page=studies&hapus=<?=$row['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')"><i class="bi bi-trash"></i></a>
            </td>
          </tr>
          <?php endwhile;?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</section>