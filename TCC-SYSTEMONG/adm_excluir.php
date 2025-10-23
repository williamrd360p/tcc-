<?php
session_start();
header('Content-Type: application/json');
require_once "conexao.php";

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    echo json_encode(["success" => false, "message" => "Acesso negado."]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST["id"]);

    if (empty($id)) {
        echo json_encode(["success" => false, "message" => "ID inválido."]);
        exit;
    }

    // Deleta primeiro o perfil (se existir)
    $conn->query("DELETE FROM tb_perfis WHERE fk_cd_usuario = $id");

    // Deleta o usuário (somente se for administrador)
    $stmt = $conn->prepare("DELETE FROM tb_usuarios WHERE cd_usuario = ? AND tipo_usuario = 'administrador'");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Administrador excluído com sucesso."]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao excluir administrador."]);
    }
    }
    ?>
