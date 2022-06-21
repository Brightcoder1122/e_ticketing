<?php $title = "Booking History" ?>

<?php include('includes/sidebar.php'); ?>

<?php

    $ticket_sql = "SELECT tbl_user.fname, tbl_user.lname, tbl_user.phone, tbl_ticket.*, tbl_route.* FROM tbl_route, tbl_ticket, tbl_user 
        WHERE tbl_ticket.passanger = tbl_user.id 
        AND tbl_ticket.route = tbl_route.route_id 
        AND tbl_ticket.passanger = :user";

    $ticket_query = $dbconnect->prepare($ticket_sql);
    $ticket_query->execute(['user'=>$_SESSION['UserID']]);
    $ticket_list = $ticket_query->fetchAll(PDO::FETCH_ASSOC);

    $route_sql = "SELECT * FROM tbl_route WHERE active = 1";
    $route_query = $dbconnect->prepare($route_sql);
    $route_query->execute();
    $route_list = $route_query->fetchAll(PDO::FETCH_ASSOC);
    $count = $route_query->rowCount();

?>

<script src="vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    // $('body').hide();
    $('#route').on('change',function(){
        var route_id = $(this).val();
        if(route_id){
            $.ajax({
                type:'POST',
                url:'ajaxFile.php',
                data:'route_id='+route_id,
                success:function(html){
                    $('.station').html(html);
                }
            }); 
        }
        else{
            $('.station').html('<option value="">Select Route first</option>');
        }
    });
    
});
</script>

<div class="main_container">
    <?php include('includes/messages.php') ?>
    <?php if($wallet_rows == 1): ?>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="card card-body">
                    <div class="d-sm-flex align-items-center justify-content-end mb-3">
                        <button class="d-sm-inline-block btn btn-secondary btn-sm shadow-sm mt-2 mr-2"> Current balance Tsh.<?php echo $wallet_detail['balance'] ?>/= 
                        </button>

                        <button class="d-sm-inline-block btn btn-warning btn-sm shadow-sm mt-2" data-toggle="modal" data-target="#newTicket">New Ticket <i class="fa fa-plus fa-sm"></i> 
                        </button>

                        <button class="d-sm-inline-block btn btn-info btn-sm shadow-sm ml-2 mt-2" data-toggle="modal" data-target="#credit_wallet"> Credit Wallet <i class="fa fa-plus fa-sm"></i> 
                        </button>
                        
                    </div>
                    <div class="table-responsive">
                        <table  class="table table-striped table-hover dt-responsive display nowrap" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Ticket Number</th>
                                    <th>Route</th>
                                    <th>Expire Date</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sn = 1; foreach($ticket_list as $ticket_item): ?>
                                    <?php
                                        $ticket_time = strtotime($ticket_item['trip_time']);
                                        $now_time = strtotime(date('H:i:s', time()+60*60*2));
                                        $today_date = date('Y-m-d');
                                        $trip_date = $ticket_item['trip_date'];
                                        $expire_time = strtotime($ticket_item['expire_time']);

                                    ?>
                                    <tr>
                                        <td><?php echo $sn++ ?></td>
                                        <td><?php echo $ticket_item['ticket_number'] ?></td>
                                        <td><?php echo "$ticket_item[origin] $ticket_item[destination]" ?></td>
                                        <td>
                                            <span class="badge bg-danger text-white"><?php echo "$ticket_item[trip_date] $ticket_item[expire_time] "?></span>
                                        </td>
                                        <td><?php echo $ticket_item['price'] ?></td>
                                        <td>
                                            <?php if($ticket_time <= $now_time && $now_time <= $expire_time && $trip_date == $today_date): ?>
                                                <span class="badge bg-success text-white" >Ticket valid</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger text-white" >Invalid</span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <form action="view-ticket.php" method="POST">
                                                <input type="number" hidden name="ticket_id" value="<?php echo $ticket_item['ticket_id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> </button>
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
    <?php else: ?>
        <div class="info">
            You can't do anything on the system untill you generate wallet and debit it;
        </div>
        <a href="wallet-generate.php?key=generateWallet" class="btn btn-info">Generate wallet</a>
    <?php endif?>
</div>
<?php include('includes/footer.php'); ?>

<div class="modal fade" id="newTicket" tabindex="-1" role="dialog" aria-labelledby="newTicket" aria-hiden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="user">Create Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="create-ticket.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                   
                    <div class="row mt-1">
                        <div class="col-xl-12">
                            <select name="route" class="form-control" id="route">
                                <option value="">---Select Route---</option>
                                <?php if($count > 0): ?>
                                    <?php foreach($route_list as $route_item) : ?>
                                        <?php $route_id=$route_item['route_id']?>
                                        <?php $route_name="$route_item[origin] - $route_item[destination]"; ?>
                                        <option value='<?php echo $route_id ?>'>
                                            <?php echo $route_name ?>        
                                        </option>;
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <option value="">Route not available</option>;
                                <?php endif ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-xl-12">
                            <label><b>Starting Station</b></label>
                            <select name="starting" class="form-control station">
                                <option value="">Select Route first</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-xl-12">
                            <label><b>Ending Station</b></label>
                            <select name="ending" class="form-control station">
                                <option value="">Select Route first</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-xl-12">
                            <label><b>Trip Time</b></label>
                            <input type="time" name="trip_time" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-xl-12">
                            <label><b>Trip Date</b></label>
                            <input type="date" name="date" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="create_ticket" class="btn btn-info">Create Ticket</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="credit_wallet" tabindex="-1" role="dialog" aria-labelledby="credit_wallet" aria-hiden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="user">Credit Wallet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="credit-wallet.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row mt-1">
                        <div class="col-xl-12">
                            <input type="number" name="wallet_number" class="form-control" placeholder="Enter Wallet Number">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-xl-12">
                            <input type="number" name="balance" class="form-control" placeholder="Enter Amount">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="credit_wallet" class="btn btn-info">Credit Wallet</button>
                </div>
            </form>
        </div>
    </div>
</div>


