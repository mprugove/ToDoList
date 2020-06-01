<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/navbar.php'; ?>
<a href="<?php echo URLROOT; ?>/tasks" class="btn btn-primary"><i class="fa fa-backward"></i> Back</a>
<br>
<div id="fade" class="bg-secondary text-white p-2 my-3">
     <?php echo $data['task']->created_at; ?>
</div>
<p><?php echo $data['task']->body; ?></p>

<?php if($data['task']->user_id == $_SESSION['user_id']) : ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/tasks/edit/<?php echo $data['task']->id; ?>" class="btn btn-dark">Edit</a>

  <form class="pull-right" action="<?php echo URLROOT; ?>/tasks/delete/<?php echo $data['task']->id; ?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>



