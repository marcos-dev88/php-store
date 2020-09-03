<?php
    require_once('connection.php');

    $_POST = file_get_contents('php://input');
    $jsonData = json_decode($_POST);

    $idStore = $jsonData->idStoreInputJ;
    $nameStore = $jsonData->nameStoreInputJ;
    $socialReason = $jsonData->socialReasonJ;
    $cnpj = $jsonData->cnpjJ;
    $cityStore = $jsonData->cityStoreJ;
    $stateStore = $jsonData->stateStoreJ;

    if($idStore != 0 && $idStore != null){
        $sqlStoreU = "UPDATE loja 
        SET nome = '".$nameStore."', 
        razao_social = '".$socialReason."', 
        cidade = '".$cityStore."', 
        estado = '".$stateStore."' WHERE id = '".$idStore."';";

        $updateStore = mysqli_query($conn, $sqlStoreU);

        if(!$updateStore){
            echo json_encode(array('status'=> 501));
        }else{
            echo json_encode(array('status'=> 201));
        }
    }else{
        $sqlStoreI = "INSERT INTO loja(nome, razao_social, cnpj, cidade, estado)
            VALUES
        ('".$nameStore."', '".$socialReason."', '".$cnpj."', '".$cityStore."', '".$stateStore."')";

        $insertStore = mysqli_query($conn, $sqlStoreI);

        if(!$insertStore){
            echo json_encode(array('status'=> 500));
        }else{
            echo json_encode(array('status'=> 200));
        }
    }
    
?>