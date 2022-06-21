<?php $title = "Today Valid Ticket" ?>
<?php include('includes/sidebar.php'); ?>
<?php include('views/route-view.php'); ?>
<?php 

    if(!isset($_GET['route_id'])) {
        echo "<script>windows.location='ticket-manager.php'</script>";
    }

    else {
       $route_id = $_GET['route_id'];
       $bus_route_sql = "SELECT * FROM tbl_bus WHERE tbl_bus.route = :route_id;";
       $bus_route_stmt = $dbconnect->prepare($bus_route_sql);
       $bus_route_stmt->execute(['route_id'=>$route_id]);
       $bus_route_list = $bus_route_stmt->fetchAll(PDO::FETCH_ASSOC);
       $count_bus = $bus_route_stmt->rowCount();
    }

?>

<div class="main_container">
    <?php include('includes/messages.php') ?>
    <?php if($count_bus > 0): ?>
        <div class="row">
            <?php foreach($bus_route_list as $bus_route_item): ?>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <?php echo "$bus_route_item[plate_no]" ?>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <span class="count">
                                            <?php echo "$bus_route_item[capacity]" ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-bus fa-2x text-gray-300"></i>
                                </div>
                            </div>
                            <div type="button" class="card-footer d-flex justify-content-between" data-target="#bus_id<?php echo $bus_route_item['bus_id'] ?>" data-toggle="modal">
                                <i class="fa fa-exchange fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="bus_id<?php echo $bus_route_item['bus_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="bus_id<?php echo $bus_route_item['bus_id'] ?>" aria-hiden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-white" id="user">Change Route For A Bus</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-white">&times;</span>
                                </button>
                            </div>
                            <form action="change-bus-route.php" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="row mt-3">
                                        <div class="col-xl-6">
                                            <input hidden type="text" name="bus_id" class="form-control" value="<?php echo $bus_route_item['bus_id'] ?>">
                                        </div>
                                        <div class="col-xl-12">
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
                                    <button type="submit" name="change_route" class="btn btn-info">Change Route</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php else: ?>
        <div class="info">
            <i class="fa fa-info"></i>
           No buss on this route please take bus on this route <a href="ticket-manager.php">Okey</a>
        </div>
    <?php endif ?>
</div>
<?php include('includes/footer.php'); ?>