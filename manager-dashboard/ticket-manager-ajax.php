<?php require_once('../includes/config.php') ?>
<?php require_once('../includes/mustlogin.php') ?>
<?php include('views/ticket-view.php'); ?>
<?php

    foreach($today_ticket_list as $today_ticket_item) { 
        $route_id = $today_ticket_item['route_id'];
        $origin = $today_ticket_item['origin'];
        $destination = $today_ticket_item['destination'];
        $total = $today_ticket_item['total'];

        echo    "<div class='col-xl-4 col-md-6 mb-4'>
                    <div class='card border-left shadow h-100 py-2'>
                        <div class='card-body'>
                            <div class='row no-gutters align-items-center'>
                                <div class='col mr-2'>
                                    <div class='text-xs font-weight-bold text-primary text-uppercase mb-1'>
                                        $origin - $destination
                                    </div>
                                    <div class='h5 mb-0 font-weight-bold text-gray-800'>
                                        <span class='count'>
                                            $total
                                        </span>
                                    </div>
                                </div>
                                <div class='col-auto'>
                                    <i class='fas fa-id-card fa-2x text-gray-300'></i>
                                </div>
                            </div>
                            <a href='view-buses-on-route.php?route_id=$route_id'>
                                <div class='card-footer d-flex justify-content-center'>
                                    <h6>View Buses</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>";
    }
 
?>