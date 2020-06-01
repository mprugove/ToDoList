<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/navbar.php'; ?>
    <a href="<?php echo URLROOT;?>" class="btn btn-primary"><i class="fa fa-backward"> Go back </i></a>
    <div class="card card-body bg-light mt-5">
        <?php flash('register_success'); ?>
        <p class="display-4">Add new Task</p>
        <form action="<?php echo URLROOT; ?>/tasks/add" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" placeholder="Your text here" name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
                <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
            </div>
            <div class="form-group">
            <input type="submit" class="btn btn-primary"  name="upload" value="Submit">
        </form>
    </div
    
<?php require APPROOT . '/views/inc/footer.php'; ?>