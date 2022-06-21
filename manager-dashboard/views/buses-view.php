<?php 

    $buses_sql = "SELECT * FROM tbl_bus"; 
    $buses_query = $dbconnect->prepare($buses_sql);
    $buses_query->execute();
    $buses_list = $buses_query->fetchAll(PDO::FETCH_ASSOC);
    $count_buses = $buses_query->rowCount(); 

    $buses_sql_2 = "SELECT * FROM tbl_bus, tbl_route WHERE tbl_bus.route = tbl_route.route_id"; 
    $buses_query_2 = $dbconnect->prepare($buses_sql_2);
    $buses_query_2->execute();
    $buses_list_2 = $buses_query_2->fetchAll(PDO::FETCH_ASSOC);

    $free_buses_sql = "SELECT * FROM tbl_bus WHERE taken = 0"; 
    $free_buses_query = $dbconnect->prepare($free_buses_sql);
    $free_buses_query->execute();
    $free_buses_list = $free_buses_query->fetchAll(PDO::FETCH_ASSOC);
    $count_free_buses = $free_buses_query->rowCount(); 

?>