<?php
session_start(); // Inicia a sessão

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'db.php'; // Inclui o arquivo de conexão com o banco de dados

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Prepara a consulta para verificar se o usuário existe
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE usuario = ?');
    $stmt->execute([$usuario]);
    $user = $stmt->fetch();

    // Verifica se o usuário foi encontrado e se a senha está correta
    if ($user && password_verify($senha, $user['senha'])) {
        // Define o ID do usuário e o tipo de permissão na sessão
        $_SESSION['usuario'] = $user['id']; // Armazena o ID do usuário na sessão
        $_SESSION['permissao'] = $user['permissao']; // Armazena a permissão do usuário na sessão

        // Redireciona para a página inicial com base na permissão
        if ($user['permissao'] === 'admin') {
            header('Location: admin_home.php'); // Página específica para administradores
        } else {
            header('Location: home.php'); // Página padrão para usuários normais
        }
        exit;
    } else {
        // Exibe uma mensagem de erro se as credenciais forem inválidas
        $_SESSION['login_error'] = "Credenciais inválidas!";
        header('Location: index.php'); // Redireciona de volta para a página de login
        exit;
    }
} else {
    // Se o método de requisição não for POST, redireciona para a página de login
    header('Location: index.php');
    exit;
}
?>
