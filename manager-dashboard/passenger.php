<?php $title = "User list" ?>
<?php include('includes/sidebar.php'); ?>
<?php include('manager_admin_access.php') ?>
<?php include('views/passenger-view.php'); ?>
<div class="main_container">
    <!-- Page Heading -->
    <div class="row animated--grow-in">
        <div class="col-xl-12">
            <div class="card card-body">
                <?php if($user_profile['type'] == "admin"): ?>
                    <div class="d-sm-flex align-items-center justify-content-end mb-4">
                        <!-- <button class="d-none d-sm-inline-block btn btn-info btn-sm shadow-sm" data-toggle="modal" data-target="#newUser">Add New user <i class="fa fa-plus fa-sm"></i> 
                        </button> -->
                    </div>
                <?php endif ?>
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
                                <th>Type</th>
                                <?php if($user_profile['type'] == "admin"): ?>
                                <th>Action</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sn = 1;foreach ($user_list as $user_item):?>
                            <tr class="text-dark">
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $user_item['fname'] ?></td>
                                <td><?php echo $user_item['lname'] ?></td>
                                <td><?php echo $user_item['phone'] ?></td>
                                <td><?php echo $user_item['sex'] ?></td>
                                <td><?php echo $user_item['region'] ?></td>
                                <td><?php echo $user_item['district'] ?></td>
                                <td><?php echo $user_item['address'] ?></td>
                                <td><?php echo $user_item['type'] ?></td>
                                <?php if($user_profile['type'] == "admin"): ?>
                                <td>
                                  <form method="POST" action="user-logic.php">
                                        <input hidden type="number" name="user_id" value="<?php echo $user_item['id'] ?>">
                                        <?php if ($user_item['is_active']) : ?>
                                            <button type="submit" name="switch_off" class="text-white btn btn-primary btn-sm">
                                                On
                                            </button> 
    
                                        <?php else : ?>
                                            <button type="submit" name="switch_on" class="text-white btn btn-warning btn-sm">
                                                Off
                                            </button> 
                                        <?php endif ?>
                                    </form>
                                </td>
                                <?php endif ?>
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


<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="newUser" aria-hiden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <!-- <h5 class="modal-title text-white" id="user">Add New User</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="user-logic.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-xl-6">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" placeholder="First name">
                        </div>
                        <div class="col-xl-6">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Last name">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-xl-6">
                            <label>Sex</label>
                            <select name="sex" class="form-control" required>
                                <option value="">---Select Sex---</option>
                                <option value="F">Female</option>
                                <option value="M">Male</option>
                            </select>
                        </div>
                        <div class="col-xl-6">
                            <label>Phone</label>
                            <input type="number" name="phone" class="form-control" placeholder="Phone Number">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-xl-6">
                            <label>Region</label>
                            <input type="text" name="region" class="form-control" placeholder="Region">
                        </div>
                        <div class="col-xl-6">
                            <label>District</label>
                            <input type="text" name="district" class="form-control" placeholder="District">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-xl-6">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Example P.O.Box 972">
                        </div>
                        <div class="col-xl-6">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Usename">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="register" class="btn btn-info">Credit Wallet</button>
                </div>
            </form>
        </div>
    </div>
</div>