<?php $title = "Today Valid Ticket" ?>
<?php include('includes/sidebar.php'); ?>
<?php include('views/ticket-view.php'); ?>

<div class="main_container">
    <?php if($today_ticket_count > 0): ?>
        <div id="data" class="row"></div>
    <?php else: ?>
        <div class="info">
            <p> <i class="fa fa-info-circle text-danger"></i> No data Available </p>
        </div>
    <?php endif ?>
    <!-- <div id="data"></div> -->
</div>
<?php include('includes/footer.php'); ?>
<script>
    $(document).ready(function() {
        setInterval(function () {
            console.log("success");
            $.ajax({
                type: "GET",
                url: "ticket-manager-ajax.php",
                dataType: "html",
                success: function(data) {
                    $("#data").html(data)
                }
            })
        }, 1000);
    })
</script>