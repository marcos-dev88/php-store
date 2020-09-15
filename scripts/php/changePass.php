<?php
    require_once('connection.php');

    $_POST = file_get_contents('php://input');
    $jsonData = json_decode($_POST);

    $userName = $jsonData->userNameJ;
    $password = $jsonData->passwordJ;
    $passwordRepeat = $jsonData->repeatPasswordJ;

    if($password != $passwordRepeat){
        echo json_encode(array('status' => 406));
    }else{
        $userq = "UPDATE usuario SET password = '".$password."' WHERE nick_name = '".$userName."'";

        $updatePass = mysqli_query($conn, $userq);

        if(!$updatePass){
            echo json_encode(array('status' => 500));
        }else{
            echo json_encode(array('status' => 200));
        }
    }

?>