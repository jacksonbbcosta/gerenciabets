<?php
session_start(); // Inicie a sessão para acessar as variáveis de sessão

// Inclua o arquivo de configuração com as credenciais de conexão com o banco de dados
require 'db.php';

try {
    // Crie uma nova conexão PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Configure o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Prepare a consulta SQL para inserir os dados
        $stmt = $pdo->prepare("
            INSERT INTO apostas (usuario_id, liga, tipo_entrada, partida, valor, status) 
            VALUES (:usuario_id, :liga, :tipo_entrada, :partida, :valor, :status)
        ");

        // Vincule os valores do formulário aos parâmetros da consulta
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':liga', $liga);
        $stmt->bindParam(':tipo_entrada', $tipo_entrada);
        $stmt->bindParam(':partida', $partida);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':status', $status);

        // Defina os valores das variáveis
        $usuario_id = $_SESSION['usuario']; // Supondo que o usuário esteja logado e o ID esteja armazenado na sessão
        $liga = $_POST['liga'];
        $tipo_entrada = $_POST['tipo_entrada'];
        $partida = $_POST['partida'];
        $valor = $_POST['valor'];
        $status = $_POST['status'];

        // Execute a consulta
        $stmt->execute();

        // Exiba a mensagem de sucesso e redirecione de volta ao formulário
        $_SESSION['mensagem_sucesso'] = 'Aposta registrada com sucesso!';
        header('Location: registrar_aposta.php');
        exit();
    }
} catch (PDOException $e) {
    echo 'Erro ao registrar a aposta: ' . $e->getMessage();
}
?>