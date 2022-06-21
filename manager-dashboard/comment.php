<?php $title = "User-dashboard" ?>

<?php include('includes/sidebar.php'); ?>

<?php include('manager_admin_access.php') ?>

<?php

    $comment_list_sql = "SELECT tbl_user.fname, tbl_user.lname, tbl_user.phone, tbl_comment.comment, tbl_comment.comment_date
        FROM tbl_user, tbl_comment 
        WHERE tbl_comment.user = tbl_user.id";

    $comment_list_query = $dbconnect->prepare($comment_list_sql);
    $comment_list_query->execute();
    $comment_list = $comment_list_query->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="main_container">
    <?php include('includes/messages.php') ?>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="card card-body">
                    <div class="table-responsive">
                        <table  class="table table-striped table-hover dt-responsive display nowrap" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sn = 1; foreach($comment_list as $comment_item): ?>
                                    <tr>
                                        <td><?php echo $sn++ ?></td>
                                        <td><?php echo $comment_item['fname'] ?></td>
                                        <td><?php echo $comment_item['lname'] ?></td>
                                        <td><?php echo $comment_item['comment'] ?></td>
                                        <td><?php echo $comment_item['comment_date'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php include('includes/footer.php'); ?>

<div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="comment" aria-hiden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="user">Write Comments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="save-comment.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row mt-1">
                        <div class="col-xl-12">
                            <textarea name="comment" class="form-control" placeholder="Write Your Comment here" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="save_comment" class="btn btn-info">Save Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>


