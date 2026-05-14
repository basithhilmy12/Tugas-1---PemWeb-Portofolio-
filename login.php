<?php
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($query);
    if($data){
        $_SESSION['user'] = $data;
        header("Location: index.php");
    } else {
        echo "<div class='alert alert-danger'><i class='bi bi-exclamation-triangle'></i> Login gagal</div>";
    }
}
?>

<section class="page-section">
  <div class="container" style="max-width:440px;">

    <div class="glass-card login-card">
      <div class="login-icon"><i class="bi bi-shield-lock-fill"></i></div>
      <h4 class="login-title">Welcome Back</h4>
      <p class="login-subtitle">Masuk ke akun kamu</p>

      <form method="POST">
        <div class="mb-3">
          <label>Username</label>
          <input type="text" name="username" class="form-control" placeholder="Masukkan username">
        </div>
        <div class="mb-4">
          <label>Password</label>
          <input type="password" name="password" class="form-control" placeholder="Masukkan password">
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">
          <i class="bi bi-box-arrow-in-right"></i> Login
        </button>
      </form>
    </div>

  </div>
</section>