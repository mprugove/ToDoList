<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/navbar.php'; ?>
<div class="border rounded p-5">
  <h1><?php echo $data['description']; ?></h1>
  <hr>
  <?php echo $data['information']; ?>
  <p> Version : <strong><?php echo APPVERSION; ?></strong></php>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>