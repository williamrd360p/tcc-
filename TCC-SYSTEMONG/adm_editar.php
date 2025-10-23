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
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);

    if (empty($id) || empty($nome) || empty($email)) {
        echo json_encode(["success" => false, "message" => "Preencha todos os campos obrigatórios."]);
        exit;
    }

    // Atualiza nome e email
    $query = "UPDATE tb_usuarios SET nm_usuario = ?, email = ? WHERE cd_usuario = ? AND tipo_usuario = 'administrador'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $nome, $email, $id);
    $stmt->execute();

    // Atualiza senha se informada
    if (!empty($senha)) {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmtSenha = $conn->prepare("UPDATE tb_usuarios SET Senha = ? WHERE cd_usuario = ?");
        $stmtSenha->bind_param("si", $hash, $id);
        $stmtSenha->execute();
    }

    // Atualiza imagem se enviada
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
        $diretorio = "uploads/";
        if (!is_dir($diretorio)) mkdir($diretorio, 0777, true);

        $nomeArquivo = uniqid() . "-" . basename($_FILES["foto"]["name"]);
        $caminho = $diretorio . $nomeArquivo;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminho)) {
            $stmt2 = $conn->prepare("
                INSERT INTO tb_perfis (img_perfil, nm_usuario, fk_cd_usuario)
                VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE img_perfil = VALUES(img_perfil), nm_usuario = VALUES(nm_usuario)
            ");
            $stmt2->bind_param("ssi", $caminho, $nome, $id);
            $stmt2->execute();
        }
    }

    echo json_encode(["success" => true, "message" => "Administrador atualizado com sucesso."]);
}
?>
