<?php $title = "Driver-List" ?>
<?php include('includes/sidebar.php'); ?>
<?php include('manager_admin_access.php') ?>
<?php include('views/driver-view.php'); ?>
<?php include('views/buses-view.php'); ?>
<div class="main_container">
    <!-- Page Heading -->
    <div class="row animated--grow-in">
        <div class="col-xl-12">
            <div class="card card-body">
                <div class="info">
                    <i class="fa fa-info"></i>
                    Once you switch off driver account bus will be taken off from a given driver
                </div>
                <div class="d-sm-flex align-items-center justify-content-end mb-4">
                    <button class="d-none d-sm-inline-block btn btn-info btn-sm shadow-sm" data-toggle="modal" data-target="#newDriver">Add New Driver <i class="fa fa-plus fa-sm"></i> 
                    </button>
                </div>
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
                                <th>Bus</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sn = 1;foreach ($driver_list as $driver_item):?>
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
                                        <?php if($driver_item['plate_no'] == "visual bus"): ?>
                                            <a class="badge bg-success text-white" type="button" data-target="#allocate<?php echo $driver_item['driver_id'] ?>" data-toggle="modal">
                                                Allocate Driver</a>
                                        <?php else: ?>
                                            <?php echo $driver_item['plate_no'] ?>
                                        <?php endif ?>
                                    </td>
                                    <td><?php echo $driver_item['type'] ?></td>
                                    <td>
                                        <form method="POST" action="driver-logic.php">
                                            <input hidden type="number" name="user_id" value="<?php echo $driver_item['id'] ?>">
                                            <?php if ($driver_item['is_active']) : ?>
                                                <!-- <button type="submit" name="switch_off" class="text-white btn btn-primary btn-sm">
                                                    On
                                                </button>  -->
        
                                            <?php else : ?>
                                                <button type="submit" name="switch_on" class="text-white btn btn-warning btn-sm">
                                                    Off
                                                </button> 
                                            <?php endif ?>
                                            <input hidden type="number" name="bus" value="<?php echo $driver_item['bus'] ?>">
                                            
                                            <!-- delete driver button  -->
                                            <a class="btn btn-sm btn-danger text-white" type="button" data-target="#driver_id<?php echo $driver_item['driver_id'] ?>" data-toggle="modal">
                                                <i class="fa fa-trash"></i> </a>
                                        </form>
                                    </td>
                                </tr>

                                <!-- delete driver modal  -->
                                <div class="modal fade" id="driver_id<?php echo $driver_item['driver_id'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                               <h5 class="text-white"> Delete <?php echo "$driver_item[fname] $driver_item[lname]" ?></h5>
                                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="text-white">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="driver-logic.php">
                                                    <p>Are sure do you want to delete <strong><?php echo "$driver_item[fname] $driver_item[lname]" ?> </strong>
                                                        But you will have chance to restore this Driver</p>
                                                    <input hidden type="number" name="bus" value="<?php echo $driver_item['bus'] ?>">
                                                    <input hidden type="number" name="user_id" value="<?php echo $driver_item['id'] ?>">
                                                    <button type="submit" name="delete" class="text-white btn btn-danger btn-sm btn-block">
                                                        Yes Delete
                                                    </button> 
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <!-- allocate modal  -->
                                <div class="modal fade" id="allocate<?php echo $driver_item['driver_id'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info">
                                                <h5 class="text-white"><?php echo "$driver_item[fname] $driver_item[lname]" ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="text-white">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="driver-logic.php" method="post">
                                                    <input hidden type="text" name="driver_id" value=<?php echo $driver_item['driver_id'] ?>>
                                                    <select data-live-search="true" class="form-control w-100 border" name="bus_id" required>
                                                        <option value="">---Select Bus---</option>
                                                        <?php foreach($free_buses_list as $free_buses_item) : ?>
                                                            <option value="<?php echo $free_buses_item['bus_id'] ?>">
                                                                <?php echo $free_buses_item['plate_no'] ?>        
                                                            </option>;
                                                        <?php endforeach ?>
                                                    </select>
                                                    <button class="btn btn-info btn-block mt-3" type="submit" name="allocate_driver">Save Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newDriver" tabindex="-1" role="dialog" aria-labelledby="newDriver" aria-hiden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="user">Add New Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="driver-logic.php" method="POST" enctype="multipart/form-data">
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

                    <div class="row mt-3">
                        <div class="col-xl-6">
                            <label>Select Bus</label>
                            <div class="select_search">
                                <select data-live-search="true" class="form-control w-100 border" name="bus" class="form-control" required>
                                    <option value="">---Select Bus---</option>
                                    <?php foreach($free_buses_list as $free_buses_item) : ?>
                                        <option value="<?php echo $free_buses_item['bus_id'] ?>">
                                            <?php echo $free_buses_item['plate_no'] ?>        
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <label>Licence Number</label>
                            <input required type="text" name="licence_no" class="form-control" placeholder="Licence Number">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="register" class="btn btn-info">Save Driver</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
