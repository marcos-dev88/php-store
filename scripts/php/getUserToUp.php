<?php
    require_once('connection.php');

    $_POST = file_get_contents('php://input');
    $jsonData = json_decode($_POST);

    $idUser = $jsonData->idUserJ;

    $sqlUser = "SELECT * FROM usuario WHERE id = '".$idUser."'";
    
    $getAllUser = mysqli_query($conn, $sqlUser);
    
    while($row = mysqli_fetch_assoc($getAllUser)){
        $data[] = $row;
    }

    echo json_encode(array('upuser' => $data));

?>