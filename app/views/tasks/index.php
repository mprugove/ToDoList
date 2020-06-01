<?php include APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/navbar.php'; ?>
<?php flash('post_message'); ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Daily list of tasks </h1>
        </div>
        <div class="col-md-6">
            <a href = "<?php echo URLROOT; ?>/tasks/add" class = "btn btn-primary pull-right">
                <i class= "fa fa-pencil"> </i> Add task
            </a>
        </div>
    </div>    
    <?php foreach($data['task'] as $task) :?>
        <?php if(!isset($_SESSION['user_id'])) : ?>
            <?php else : ?>
            <div class="container-fluid">
                <table class="table table-primary table-sm">
                    <thead class="table table-dark">
                        <tr>
                            <th colspan="4">
                                <b><?php echo $task->taskId; ?></b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Added by <?php echo $task->name; ?> 
                            </td>
                            <td>
                                <?php echo $task->body; ?>
                            </td>
                            <td>
                                Task created at <?php echo $task->taskCreated; ?></p>
                            </td>
                            <td>
                                <a href="<?php echo URLROOT; ?>/tasks/show/<?php echo $task->taskId;?>" class="btn btn-dark">Show more</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    
<?php require APPROOT . '/views/inc/footer.php'; ?>
