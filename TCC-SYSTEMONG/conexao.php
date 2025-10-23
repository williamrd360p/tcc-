<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_ong";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Erro na conexão com o banco de dados."]));
}

$conn->set_charset("utf8mb4");
?>
