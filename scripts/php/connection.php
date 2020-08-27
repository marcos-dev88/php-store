<?php
    $server = "127.0.0.1"; 
    $dbUser = "root";      /* Seu usuário de banco aqui */
    $dbPass = "Info@1234"; /*  Sua senha aqui  */
    $database = "php_store";

    $conn = mysqli_connect($server, $dbUser, $dbPass, $database) or die("Erro em conectar com o banco de dados");
    $conn->set_charset("utf-8");

?>