<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?></title>
  <!-- Material Design Lite -->
  
  <!-- <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script> -->



  <?php 
  echo css('https://code.getmdl.io/1.2.1/material.blue_grey-blue.min.css');
  echo css('assets/css/app.css');
  ?>
  

</head>

<body>