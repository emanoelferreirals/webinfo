<?php
    // Prarametros de Conexão
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $bd = 'blog';
    $port = 3306;

    // Usando a classe mysqli pra gerar um objeto de conexão com o banco de dados MySQL
    $conn = new mysqli($server, $user, $password,$bd,$port);

    // Verificação de erro
    if($conn->connect_error){
        die('Erro na Conexão: ' . $conn->connect_error); // Interrompe a execuçã o e exibe o erro
    }

?>