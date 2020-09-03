<?php
    require_once('connection.php');

    $storesq = "SELECT * from loja";

    $getStores = mysqli_query($conn, $storesq);

    if(mysqli_num_rows($getStores) == 0){
        echo json_encode(array('status'=> 404));
    }else{
        while($row = mysqli_fetch_assoc($getStores)){
            $data[] = $row;
        }

        echo json_encode(array('store'=>$data, 'status'=> 200));
    }
?>