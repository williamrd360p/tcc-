<?php



echo 'blabla';

// session_start();
// header('Content-Type: application/json');
// require_once "conexao.php";

// // Bloqueia acesso se não for admin logado
// if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
//     echo json_encode(["success" => false, "message" => "Acesso negado."]);
//     exit;
// }

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $nome = trim($_POST["nome"]);
//     $email = trim($_POST["email"]);
//     $senha = trim($_POST["senha"]);
//     $fk_cd_ong = $_SESSION['fk_cd_ong'] ?? 1; // padrão se não estiver na sessão

//     if (empty($nome) || empty($email) || empty($senha)) {
//         echo json_encode(["success" => false, "message" => "Preencha todos os campos obrigatórios."]);
//         exit;
//     }

//     // Verifica se o email já existe
//     $stmtCheck = $conn->prepare("SELECT cd_usuario FROM tb_usuarios WHERE email = ?");
//     $stmtCheck->bind_param("s", $email);
//     $stmtCheck->execute();
//     $stmtCheck->store_result();
//     if ($stmtCheck->num_rows > 0) {
//         echo json_encode(["success" => false, "message" => "E-mail já cadastrado."]);
//         exit;
//     }

//     $hash = password_hash($senha, PASSWORD_DEFAULT);
//     $stmt = $conn->prepare("INSERT INTO tb_usuarios (nm_usuario, email, Senha, tipo_usuario, fk_cd_ong) VALUES (?, ?, ?, 'administrador', ?)");
//     $stmt->bind_param("sssi", $nome, $email, $hash, $fk_cd_ong);

//     if ($stmt->execute()) {
//         $novoId = $stmt->insert_id;

//         // Se houver foto
//         if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
//             $dir = "uploads/";
//             if (!is_dir($dir)) mkdir($dir, 0777, true);

//             $nomeArquivo = uniqid() . "-" . basename($_FILES["foto"]["name"]);
//             $caminho = $dir . $nomeArquivo;

//             if (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminho)) {
//                 $stmt2 = $conn->prepare("INSERT INTO tb_perfis (img_perfil, nm_usuario, fk_cd_usuario) VALUES (?, ?, ?)");
//                 $stmt2->bind_param("ssi", $caminho, $nome, $novoId);
//                 $stmt2->execute();
//             }
//         }

//         echo json_encode(["success" => true, "message" => "Administrador cadastrado com sucesso!"]);
//     } else {
//         echo json_encode(["success" => false, "message" => "Erro ao cadastrar administrador."]);
//     }
// }
?>
