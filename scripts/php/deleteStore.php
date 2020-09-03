<?php
    require_once('connection.php');

    $_POST = file_get_contents('php://input');
    $jsonData = json_decode($_POST);

    $sqlStore = "DELETE FROM loja WHERE id = '".$jsonData."'";

    $deleteStore = mysqli_query($conn, $sqlStore);

    if(!$deleteStore){
        echo json_encode(array('status'=>500));
    }else{
        echo json_encode(array('status'=>200));
    }
?>