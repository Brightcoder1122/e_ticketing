<?php $title = "Driver-List" ?>
<?php include('includes/sidebar.php'); ?>
<?php include('manager_admin_access.php') ?>
<?php include('views/route-view.php'); ?>
<?php include('views/buses-view.php'); ?>
<div class="main_container">
    <!-- Page Heading -->
    <div class="row animated--grow-in">
        <div class="col-xl-12">
            <div class="card card-body">
                <div class="d-sm-flex align-items-center justify-content-end mb-4">
                    <button class="d-none d-sm-inline-block btn btn-info btn-sm shadow-sm" data-toggle="modal" data-target="#newBus">Add New Bus <i class="fa fa-plus fa-sm"></i> 
                    </button>
                </div>
                <?php include('includes/messages.php'); ?>
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover dt-responsive display nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Plate Number</th>
                                <th>Capacity</th>
                                <th>Route</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sn = 1;foreach ($buses_list_2 as $buses_item):?>
                            <tr class="text-dark">
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $buses_item['plate_no'] ?></td>
                                <td><?php echo $buses_item['capacity'] ?></td>
                                <td><?php echo "$buses_item[origin] - $buses_item[destination]" ?></td>
                                <td>
                                    <form method="POST" action="buses-logic.php">
                                        <input hidden type="number" name="bus_id" value="<?php echo $buses_item['bus_id'] ?>">
                                       
                                        <button type="submit" name="delete" class="text-white btn btn-danger btn-sm"><i class="fas fa-trash fa-sm text-white"></i>
                                        </button> 
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


<div class="modal fade" id="newBus" tabindex="-1" role="dialog" aria-labelledby="newBus" aria-hiden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="user">Add New Bus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="buses-logic.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 mt-2">
                            <label>Plate Number</label>
                            <input type="text" name="plate_no" class="form-control" placeholder="Plate Number" required>
                        </div>
                        <div class="col-xl-12 mt-2">
                            <label>Capacity</label>
                            <input type="number" name="capacity" class="form-control" placeholder="Capacity" required>
                        </div>
                        <div class="col-xl-12 mt-2">
                            <label>Route</label>
                            <select class="form-control" name="route">
                                <option value="">---Select Route---</option>
                                <?php foreach ($route_list as $route_item):?>
                                    <option value="<?php echo $route_item['route_id'] ?>">
                                        <?php echo "$route_item[origin] - $route_item[destination]" ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" name="save_bus" class="btn btn-info">Save Bus</button>
                </div>
            </form>
        </div>
    </div>
</div>