
<?php 

    $route_sql = "SELECT * FROM tbl_route"; 
    $route_query = $dbconnect->prepare($route_sql);
    $route_query->execute();
    $route_list = $route_query->fetchAll(PDO::FETCH_ASSOC);
    $count_route = $route_query->rowCount(); 
?>