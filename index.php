<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Abdul Basith Hilmy - Portfolio">
<title>Abdul Basith Hilmy — Portfolio</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
</head>
<body>

<?php include "header.php"; ?>
<?php include "menu.php"; ?>

<main class="main-content">
  <?php
  $page = $_GET['page'] ?? 'home';
  switch($page){
    case 'about': include "about.php"; break;
    case 'contact': include "contact.php"; break;
    case 'login': include "login.php"; break;
    case 'level': include "level.php"; break;
    case 'studies': include "studies.php"; break;
    default: include "home.php"; break;
  }
  ?>
</main>

<?php include "footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>