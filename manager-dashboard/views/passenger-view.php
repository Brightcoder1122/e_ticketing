<?php 

    $user_sql = "SELECT * FROM tbl_user WHERE type='passenger'"; 
    $user_query = $dbconnect->prepare($user_sql);
    $user_query->execute();
    $user_list = $user_query->fetchAll(PDO::FETCH_ASSOC);
    $count_user = $user_query->rowCount();
    
?>