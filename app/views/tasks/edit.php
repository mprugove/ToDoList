<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/navbar.php'; ?>
    <a href="<?php echo URLROOT;?>/tasks" class="btn btn-primary"><i class="fa fa-backward"> Go back </i></a>
    <div class="card card-body bg-light mt-5">
        <?php flash('register_success'); ?>
        <h2>Edit or update your task</h2>
        <p>You are editing task </p>
        <form action="<?php echo URLROOT; ?>/tasks/edit/<?php echo $data['id']; ?>" method="post">
        
            <div class="form-group">
                <label for="body">Body</label>
                    <textarea name="body" placeholder="Your text here" name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
                <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
            </div> 
            <input type="submit" value="Submit" class="btn btn-success">   
        </form>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>