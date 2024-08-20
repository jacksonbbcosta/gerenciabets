<!-- projetos.php -->
<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}
require 'db.php';

$usuario_id = $_SESSION['usuario_id'];

$stmt = $pdo->prepare('SELECT * FROM projetos WHERE usuario_id = ? ORDER BY criado_em DESC');
$stmt->execute([$usuario_id]);
$projetos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerência Bets - Projetos de Alavancagem</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="projects-container">
        <h2>Projetos de Alavancagem</h2>
        <ul>
            <?php foreach ($projetos as $projeto): ?>
                <li>
                    <strong><?= htmlspecialchars($projeto['nome_projeto']) ?></strong><br>
                    <?= htmlspecialchars($projeto['descricao']) ?><br>
                    Meta: R$ <?= number_format($projeto['valor_meta'], 2, ',', '.') ?><br>
                    Criado em: <?= date('d/m/Y H:i', strtotime($projeto['criado_em'])) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
