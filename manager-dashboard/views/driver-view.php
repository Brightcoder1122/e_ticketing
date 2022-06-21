<?php 

    $driver_sql = "SELECT * FROM tbl_user, tbl_driver, tbl_bus
    WHERE tbl_driver.user = tbl_user.id
    AND tbl_driver.bus = tbl_bus.bus_id
    AND tbl_user.is_deleted = 0
    AND tbl_user.type='driver'"; 

    $driver_query = $dbconnect->prepare($driver_sql);
    $driver_query->execute();
    $driver_list = $driver_query->fetchAll(PDO::FETCH_ASSOC);
    $count_driver = $driver_query->rowCount();

    $deleted_driver_sql = "SELECT * FROM tbl_user
    WHERE is_deleted = 1";

    $deleted_driver_query =  $dbconnect->prepare($deleted_driver_sql);
    $deleted_driver_query->execute();
    $deleted_driver_list = $deleted_driver_query->fetchAll(PDO::FETCH_ASSOC);
    $count_deleted_driver = $deleted_driver_query->rowCount();

    
?>