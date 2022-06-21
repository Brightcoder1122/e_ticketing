<?php $title = "Delete Driver-List" ?>
<?php include('includes/sidebar.php'); ?>
<?php include('manager_admin_access.php') ?>
<?php include('views/driver-view.php'); ?>
<?php include('views/buses-view.php'); ?>
<div class="main_container">
    <!-- Page Heading -->
    <div class="row animated--grow-in">
        <div class="col-xl-12">
            <div class="card card-body">
              
                <?php include('includes/messages.php'); ?>
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover dt-responsive display nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Fisrt Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
                                <th>Sex</th>
                                <th>Region</th>
                                <th>Destrict</th>
                                <th>Address</th>
                                <th>Activate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sn = 1;foreach ($deleted_driver_list as $driver_item):?>
                                <tr class="text-dark">
                                    <td><?php echo $sn++ ?></td>
                                    <td><?php echo $driver_item['fname'] ?></td>
                                    <td><?php echo $driver_item['lname'] ?></td>
                                    <td><?php echo $driver_item['phone'] ?></td>
                                    <td><?php echo $driver_item['sex'] ?></td>
                                    <td><?php echo $driver_item['region'] ?></td>
                                    <td><?php echo $driver_item['district'] ?></td>
                                    <td><?php echo $driver_item['address'] ?></td>
                                    
                                    <td>
                                        <form method="POST" action="driver-logic.php">
                                            <input hidden type="number" name="user_id" value="<?php echo $driver_item['id'] ?>">
                                            <input type="submit" name="restore_driver" value="Activate" class="btn btn-success">
                                        </form>
                                    </td>
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
