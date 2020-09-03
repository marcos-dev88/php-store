<?php
    require_once('connection.php');
    
    $_POST = file_get_contents('php://input');
    
    $jsonData = json_decode($_POST);

    $idStore = $jsonData->idStoreInputJ;

    $sqlUser = "SELECT * FROM usuario WHERE id_loja = '".$idStore."'";

    $getUsers = mysqli_query($conn, $sqlUser);
    if(mysqli_num_rows($getUsers) == 0){
        echo json_encode(array('status'=> 404));
    }else{
        while($row = mysqli_fetch_assoc($getUsers)){
            $data[] = $row;
        }
        echo json_encode(array('user'=>$data, 'status'=> 200));
    }

?>