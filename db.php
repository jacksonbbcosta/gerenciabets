<?php
// db.php
$host = 'localhost';
$dbname = 'gerencia_bets';
$username = 'root';
$password = 'Jackbb14!';

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Conexão falhou: ' . $e->getMessage());
}
?>
