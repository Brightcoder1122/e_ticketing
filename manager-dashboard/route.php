<?php $title = "Driver-List" ?>
<?php include('includes/sidebar.php'); ?>
<?php include('manager_admin_access.php') ?>
<?php include('views/route-view.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
<style>
    .select2-dropdown {
 top: 22px !important;
 left: 8px !important;
}
</style>
<div class="main_container">
    <!-- Page Heading -->
    <div class="row animated--grow-in">
        <div class="col-xl-12">
            <div class="card card-body">
                <div class="d-sm-flex align-items-center justify-content-end mb-4">
                    <button class="d-none d-sm-inline-block btn btn-info btn-sm shadow-sm" data-toggle="modal" data-target="#newRoute">Add New Route <i class="fa fa-plus fa-sm"></i> 
                    </button>
                    <button class="d-none d-sm-inline-block btn btn-secondary btn-sm shadow-sm ml-2" data-toggle="modal" data-target="#newStation">Add New Station <i class="fa fa-plus fa-sm"></i> 
                    </button>
                </div>
                <?php include('includes/messages.php'); ?>
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover dt-responsive display nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sn = 1;foreach ($route_list as $route_item):?>
                            <tr class="text-dark">
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $route_item['origin'] ?></td>
                                <td><?php echo $route_item['destination'] ?></td>
                                <td><?php echo $route_item['price'] ?></td>
                                <td>
                                    <form method="POST" action="route-logic.php">
                                        <input hidden type="number" name="route_id" value="<?php echo $route_item['route_id'] ?>">
                                        <?php if ($route_item['active']) : ?>
                                            <button type="submit" name="switch_off" class="text-white btn btn-warning btn-sm">
                                                Switch Off
                                            </button> 
    
                                        <?php else: ?>
                                            <button type="submit" name="switch_on" class="text-white btn btn-primary btn-sm">
                                                Switch On
                                            </button>
                                        <?php endif ?>
                                      
                                        <!-- <button class="btn btn-success btn-sm">
                                            <b><i class="fas fa-pencil-alt fa-sm"></i></b>
                                        </button> -->
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


<div class="modal fade" id="newRoute" tabindex="-1" role="dialog" aria-labelledby="newRoute" aria-hiden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="user">Add New Route</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="route-logic.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 mt-2">
                            <label>Origin</label>
                            <input type="text" name="origin" class="form-control" placeholder="Origin" required>
                        </div>
                        <div class="col-xl-12 mt-2">
                            <label>Destinantion</label>
                            <input type="text" name="destination" class="form-control" placeholder="Destinantion" required>
                        </div>
                        <div class="col-xl-12 mt-2">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" placeholder="Price" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" name="save_route" class="btn btn-info">Save Route</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="newStation" tabindex="-1" role="dialog" aria-labelledby="newStation" aria-hiden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="user">Add New Station</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="station-logic.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 mt-2">
                            <label>Station Name</label>
                            <input type="text" name="station_name" class="form-control" placeholder="Station Name" required>
                        </div>
                        <div class="col-xl-12 mt-2">
                            <label>Route</label>
                            <select name="route" class="form-control">
                                
                                <?php foreach ($route_list as $route_item_2):?>
                                    <option value=''>Select Route</option> 
                                    <option value="<?php echo $route_item_2['route_id'] ?>">
                                        <?php echo "$route_item_2[origin] - $route_item_2[destination]" ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="save_station" class="btn btn-info">Save Station</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
 $("#selRoute").select2( {
	placeholder: "Select Country",
	// allowClear: true
	} );
</script>
});
</script>