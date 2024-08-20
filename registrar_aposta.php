<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerência Bets - Registrar Nova Aposta</title>
    <link rel="stylesheet" href="style.css"> <!-- Verifique se o caminho está correto -->
    <style>
        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
        }

        .button-group button {
            width: 48%;
        }

        .back-button {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        .back-button:hover {
            text-decoration: underline;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registrar Nova Aposta</h2>
        
        <?php
    // Exiba a mensagem de sucesso se estiver definida
    if (isset($_SESSION['mensagem_sucesso'])) {
        echo '<p style="color: green;">' . htmlspecialchars($_SESSION['mensagem_sucesso']) . '</p>';
        // Remova a mensagem da sessão após exibi-la
        unset($_SESSION['mensagem_sucesso']);
    }
    ?>

        <form id="betForm" action="salvar_aposta.php" method="POST">
            <label for="liga">Liga:</label>
            <select id="liga" name="liga" required>
                <option value="Brasileiro série A">Brasileiro série A</option>
                <option value="Brasileiro série B">Brasileiro série B</option>
                <option value="Alemão série A">Alemão série A</option>
                <option value="Alemão série B">Alemão série B</option>
                <option value="Premier League">Premier League</option>
                <option value="Italiano série A">Italiano</option>
                <option value="Frances série A">Frances</option>
                <option value="Espanhol série A">Espanhol</option>
            </select>

            <label for="tipo_entrada">Tipo de Entrada:</label>
            <input type="text" id="tipo_entrada" name="tipo_entrada" required>

            <label for="partida">Partida:</label>
            <input type="text" id="partida" name="partida" required>

            <label for="valor">Valor da Aposta:</label>
            <input type="number" id="valor" name="valor" step="0.01" required>
            
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="ganha">Ganha</option>
                <option value="perdida">Perdida</option>
                <option value="pendente">Pendente</option>
            </select>

            <div class="button-group">
                <button type="submit">Salvar</button>
                <button type="reset">Limpar</button>
            </div>
            <a class="back-button" href="home.php">Voltar</a>
        </form>
    </div>
</body>
</html>
