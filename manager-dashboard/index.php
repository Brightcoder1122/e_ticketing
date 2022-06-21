<?php $title = "User-dashboard" ?>

<?php include('includes/sidebar.php'); ?>
<?php include('views/route-view.php'); ?>
<?php include('views/driver-view.php'); ?>
<?php include('views/buses-view.php'); ?>

<div class="main_container">
    <?php include('includes/messages.php') ?>
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Driver</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <span class="count">
                                       <?php echo  $count_driver ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Buses</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                   <span class="count"><?php echo $count_buses ?></span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Available Route
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> 
                                            <span class="count"><?php echo $count_route ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php include('includes/footer.php'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
                }, {
                    duration: 1000,
                    easing: 'swing',
                        step: function (now) {
                            $(this).text(Math.ceil(now));
                        }
                });
            });
    })
</script>
