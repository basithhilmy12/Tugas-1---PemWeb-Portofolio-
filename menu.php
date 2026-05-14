<?php $page = $_GET['page'] ?? 'home'; ?>

<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container">

    <a class="navbar-brand" href="index.php">
      <i class="bi bi-braces-asterisk"></i> Voulte'.
    </a>

    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">

      <ul class="navbar-nav ms-auto gap-1">

        <li class="nav-item">
          <a class="nav-link <?= $page=='home'?'active-link':'' ?>" href="index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= $page=='about'?'active-link':'' ?>" href="?page=about">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= $page=='contact'?'active-link':'' ?>" href="?page=contact">Contact</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= ($page=='level'||$page=='studies')?'active-link':'' ?>" data-bs-toggle="dropdown">
            Studies
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?page=level">Level</a></li>
            <li><a class="dropdown-item" href="?page=studies">Studies</a></li>
          </ul>
        </li>

        <?php if(isset($_SESSION['user'])): ?>
          <li class="nav-item">
            <span class="nav-link user-name-nav"><i class="bi bi-person-circle"></i> <?= $_SESSION['user']['nama']; ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-link logout-link" href="logout.php">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item ms-2">
            <a class="btn btn-login-nav" href="?page=login">Login</a>
          </li>
        <?php endif; ?>

      </ul>

    </div>
  </div>
</nav>