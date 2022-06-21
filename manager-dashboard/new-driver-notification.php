<?php
    $api_key='a83c65a6b9466f21';
    $secret_key = 'YjdhYzg4OTkzNDNjOTY3N2I4YmE5Y2ZmYWRjNWVhNTI0NDBkMzgyMGNhYjVjY2I2MmU4ZGIyNzY0NmZmNWVlNw==';
    
    function newDriverNotification($phone, $body) {
        global $api_key, $secret_key;
        $id = random_int(1, 88);
        $phone = "$phone";
        $postData = array(
            'source_addr' => 'e-ticketing',
            'encoding'=>0,
            'schedule_time' => '',
            'message' => $body,
            'recipients' => [array('recipient_id' => $id,'dest_addr'=>$phone)]
        );

        $Url ='https://apisms.beem.africa/v1/send';

        $ch = curl_init($Url);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $response = curl_exec($ch);

        if($response === FALSE){
            echo $response;
            die(curl_error($ch));
        }
        var_dump($response);
        echo "$phone<br>";
        echo "$body";
    }