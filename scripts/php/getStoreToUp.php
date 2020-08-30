<?php
    require_once('connection.php');

    $_POST = file_get_contents('php://input');
    $jsonData = json_decode($_POST);
    
    $queryStore = "SELECT * FROM loja WHERE id = '".$jsonData."'";

    $updateStore = mysqli_query($conn, $queryStore);

    while($row = mysqli_fetch_assoc($updateStore)){
        $data[] = $row;
    }

    echo json_encode(array('upstore'=>$data));
?>