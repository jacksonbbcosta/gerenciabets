<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerência Bets - Menu</title>
    <link rel="stylesheet" href="style.css"> <!-- Verifique se o caminho está correto -->
    <style>
        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            text-align: center; /* Centraliza o conteúdo */
        }

        .form-container h2 {
            margin-bottom: 20px;
        }

        .menu {
            list-style-type: none;
            padding: 0;
        }

        .menu li {
            margin-bottom: 15px;
        }

        .menu a {
            display: block;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .menu a:hover {
            background-color: #0056b3;
        }

        .logout-button {
            display: block;
            margin-top: 20px;
            padding: 10px;
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        .title {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Título Fora da Caixa de Login -->
    <h1 class="title">Gerência Bets</h1>

    <div class="form-container">
        <h2>Menu Principal</h2>
        <ul class="menu">
            <li><a href="registrar_aposta.php">Registrar Nova Aposta</a></li>
            <li><a href="historico.php">Histórico de Apostas</a></li>
            <li><a href="projetos.php">Projetos de Alavancagem</a></li>
        </ul>
        <a class="logout-button" href="logout.php">Logout</a>
    </div>
</body>
</html>
