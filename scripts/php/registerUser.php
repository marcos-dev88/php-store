<?php
    require_once('connection.php');

    $_POST = file_get_contents('php://input');
    $jsonData = json_decode($_POST);

    $idUser = $jsonData->idUserInputJ;
    $idStore = $jsonData->idStoreInputJ;
    $nickName = $jsonData->nickNameJ;
    $roleInput = $jsonData->roleInputJ;
    $passwordInput = $jsonData->passwordInputJ;
    $birthDate = $jsonData->birthDateJ;
 
    if($idUser != 0 && $idUser != null){
        $sqlUserU = "UPDATE usuario 
        SET nick_name = '".$nickName."', 
        role = '".$roleInput."', 
        password = '".$passwordInput."', 
        data_nasc = '".$birthDate."' WHERE id = '".$idUser."';";

        $updateUser = mysqli_query($conn, $sqlUserU);

            if(!$updateUser){
                echo json_encode(array('status'=> 501));
            }else{
                echo json_encode(array('status'=> 201));
            }
    }else{
        $sqlUserS = "SELECT * FROM usuario WHERE nick_name = '".$nickName."'";
        
        $searchNickUser = mysqli_query($conn, $sqlUserS);

        if(mysqli_num_rows($searchNickUser) != 0){
            echo json_encode(array('status' => 406));
        }else{
            $sqlUserI = "INSERT INTO usuario(id_loja, nick_name, role, password, data_nasc)
            VALUES 
            ('".$idStore."', '".$nickName."', '".$roleInput."', '".$passwordInput."', '".$birthDate."')";
    
            $insertUser = mysqli_query($conn, $sqlUserI);
    
            if(!$insertUser){
                echo json_encode(array('status'=> 500));
            }else{
                echo json_encode(array('status'=> 200));
            }
        }    
    }
?>