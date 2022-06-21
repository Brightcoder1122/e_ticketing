<?php require_once('../includes/config.php') ?>
<?php require_once('../includes/mustlogin.php') ?>
<?php require_once('access.php') ?>
<?php include('new-driver-notification.php') ?>

<?php

	if (isset($_POST['change_route'])) {

	    $bus_id = $_POST['bus_id'];
        $route = $_POST['route'];

        //query driver and its bus
        $driver_sql = "SELECT tbl_user.phone,tbl_user.lname, tbl_user.fname, tbl_driver.bus FROM tbl_user, tbl_driver
        WHERE tbl_user.id = tbl_driver.user
        AND tbl_driver.bus = :bus_id";
        $driver_stmt = $dbconnect->prepare($driver_sql);
        $driver_stmt->execute(["bus_id"=>$bus_id]);
		$driver_detail =  $driver_stmt->fetch(PDO::FETCH_ASSOC);

        $route_sql = "SELECT origin, destination FROM tbl_route WHERE route_id  = :route_id ";
        $route_stmt = $dbconnect->prepare($route_sql);
        $route_stmt->execute(["route_id"=>$route]);
        $route_detail =  $route_stmt->fetch(PDO::FETCH_ASSOC);

        //message paramiters
        $fullname = $driver_detail['fname']." ".$driver_detail['lname'];
        $route_name = $route_detail['origin']."-".$route_detail['destination'];
        $phone = $driver_detail['phone'];
        $body = "Dear $fullname Your Route has Changed please to $route_name";

        //update bus route
	    $change_route = $dbconnect->prepare("UPDATE tbl_bus SET route = :route WHERE bus_id=:bus_id");
    	$change_route->execute(['route'=>$route, 'bus_id'=>$bus_id]);

	    if ($change_route) {
            //notify driver
            newDriverNotification($phone, $body);
	        $_SESSION['success'] = "Successfully  $fullname route changed";
	        header('location:ticket-manager.php');
	    } 
	    else {
	        $_SESSION['error'] = "Fail please try again";
	        header('location:ticket-manager.php');
            echo "error";
	    }
	}

?>