<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerência Bets - Login</title>
    <link rel="stylesheet" href="style.css"> <!-- Verifique o caminho do CSS -->
    <style>
        .title {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .login-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container label {
            display: block;
            margin-bottom: 8px;
        }

        .login-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1 class="title">Gerência Bets</h1> <!-- Título centralizado -->
    
    <div class="login-container"> <!-- Container de login -->
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
