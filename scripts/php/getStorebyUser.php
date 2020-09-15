<?php
    require_once('connection.php');

    $_POST = file_get_contents('php://input');
    $jsonData = json_decode($_POST);
    $userName = $jsonData->nameUserJ;

    $userq = "SELECT id_loja, role from usuario WHERE nick_name = '".$userName."'";

    $searchUser = mysqli_query($conn, $userq);

    while($row = mysqli_fetch_assoc($searchUser)){
        $idStore = $row["id_loja"];
        $roleUser = $row["role"];
    }

    $userInnerq = "SELECT COUNT(*) AS count_user FROM usuario INNER JOIN loja ON usuario.id_loja = loja.id WHERE usuario.id_loja = '".$idStore."'";

    $searchMates = mysqli_query($conn, $userInnerq);

    while($row2 = mysqli_fetch_assoc($searchMates)){
        $teamMates[] = $row2;
    }

    $storeq = "SELECT loja.nome FROM loja WHERE loja.id = '".$idStore."'";

    $searchStore = mysqli_query($conn, $storeq);

    while($row3 = mysqli_fetch_assoc($searchStore)){
        $storeName[] = $row3;
    }

    if(!$searchMates || !$searchStore){
        echo json_encode(array('status' => 404));
    }else{
        echo json_encode(array(
            'sName' => $storeName, 
            'roleUser' => $roleUser, 
            'teamMate' => $teamMates, 
            'status' => 200)
        );
    }
    
?>