<?php
    require_once('connection.php');

    $_POST = file_get_contents('php://input');
    $jsonData = json_decode($_POST);

    $sqlUser = "DELETE FROM usuario WHERE id = '".$jsonData."'";

    $deleteUser = mysqli_query($conn, $sqlUser);

    if(!$deleteUser){
        echo json_encode(array('status' => 500));
    }else{
        echo json_encode(array('status' => 200));
    }
    
?>