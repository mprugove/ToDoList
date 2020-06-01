<?php include APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/navbar.php'; ?>
<div class="display-5 font-weight-bold form-control" input="text">Account information</div>
<?php if(isset($_SESSION['user_id'])) : ?>
        <div class="bg-light">
            <i class="display-4"> Welcome 
              <b><?php echo $_SESSION['user_name']; ?></b>
            </i>
        </div>
        <br>
        <div class="bg-light p-2 mb-3">
        <hr class="bg-primary">
          <div class="form-group w-50 float-left px-2"> Username :
            <input type="text" class = "form-control" readonly value="<?php echo $_SESSION['user_name']; ?>">
          </div>
          <div class="form-group w-50 float-right px-2"> Email :
            <input type="text" class = "form-control" readonly value="<?php echo $_SESSION['user_email']; ?>">
          </div>
          <form class="pull-right delete" action="<?php echo URLROOT; ?>/users/delete/<?php echo $data['user_id']; ?>" method="post">
    <input type="submit" value="Delete user" class="btn btn-danger">
  </form>
        </div>
<?php endif;?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
