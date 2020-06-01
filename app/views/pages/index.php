<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/navbar.php'; ?>
<div class="jumbotron jumbotron-fluid text-center">
  <div class="container">
    <h1 id="fade" class="display-4"><?php echo $data['title']; ?></h1>
    <div id="fadeSlow">
      <p class="lead"><?php echo $data['description']; ?></p>
      <p class="lead"><?php echo $data['information']; ?></p>
    </div>
    </div>
  </div>
 
<?php require APPROOT . '/views/inc/footer.php'; ?>