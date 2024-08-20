<?php
require 'db.php';

// Dados do usuário
$usuario = 'JacksonBruno';
$senha = 'JacksonBruno'; // Senha em texto plano
$permissao = 'usuario'; // Deve ser 'admin' ou 'usuario'

// Hash da senha
$senhaHash = password_hash($senha, PASSWORD_BCRYPT);

// Insere o novo usuário na tabela
try {
    $stmt = $pdo->prepare('INSERT INTO usuarios (usuario, senha, permissao) VALUES (?, ?, ?)');
    $stmt->execute([$usuario, $senhaHash, $permissao]);

    echo "Usuário cadastrado com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao cadastrar usuário: " . $e->getMessage();
}
?>
