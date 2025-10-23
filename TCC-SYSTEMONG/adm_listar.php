<?php
session_start();
header('Content-Type: application/json');
require_once "conexao.php";

// Bloqueia acesso se não for admin logado
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    echo json_encode(["success" => false, "message" => "Acesso negado."]);
    exit;
}

$sql = "SELECT u.cd_usuario, u.nm_usuario, u.email, p.img_perfil
        FROM tb_usuarios u
        LEFT JOIN tb_perfis p ON u.cd_usuario = p.fk_cd_usuario
        WHERE u.tipo_usuario = 'administrador'";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $admins = [];
    while ($row = $result->fetch_assoc()) {
        $admins[] = $row;
    }
    echo json_encode($admins);
} else {
    echo json_encode([]);
}
?>
