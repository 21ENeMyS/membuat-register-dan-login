<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= SITENAME;?></title>
  <link rel="stylesheet" href="<?= BASEURL; ?>/public/css/style.css">
</head>
<body>
  
  <nav class="top-nav">
    <ul>
      <li>
        <a href="<?= BASEURL; ?>/pages">Home</a>
      </li>
      <li>
        <a href="<?= BASEURL; ?>/pages/about">About</a>
      </li>
      <li>
        <a href="<?= BASEURL; ?>/pages/contact">Contact</a>
      </li>
      <li class="btn-login">
      <!-- jika login benar button login akan berubah menjadi logout -->
      <?php if(isset($_SESSION['id'])) : ?>
                <a href="<?php echo BASEURL; ?>/users/logout">Log out</a>
            <?php else : ?>
                <a href="<?php echo BASEURL; ?>/users/login">Login</a>
            <?php endif; ?>
      </li>
    </ul>
  </nav>