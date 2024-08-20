<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}
require 'db.php';

$usuario_id = $_SESSION['usuario'];

$stmt = $pdo->prepare('SELECT * FROM apostas WHERE usuario_id = ? ORDER BY criado_em DESC');
$stmt->execute([$usuario_id]);
$apostas = $stmt->fetchAll();

// Inicializa as variáveis
$totalApostasValor = 0;
$totalGanhos = 0;
$totalPerdidas = 0;
$totalPendentes = 0;
$totalGanhosValor = 0;
$totalPerdidoValor = 0;
$totalPendentesValor = 0;

foreach ($apostas as $aposta) {
    $totalApostasValor += $aposta['valor'];

    if ($aposta['status'] === 'ganha') {
        $totalGanhos++;
        $totalGanhosValor += $aposta['valor'];
    } elseif ($aposta['status'] === 'perdida') {
        $totalPerdidas++;
        $totalPerdidoValor += $aposta['valor'];
    } elseif ($aposta['status'] === 'em_andamento') {
        $totalPendentes++;
        $totalPendentesValor += $aposta['valor'];
    }
}

// Calcula o percentual de apostas ganhas, perdidas e pendentes
$percentualGanhos = ($totalApostasValor > 0) ? ($totalGanhos / count($apostas)) * 100 : 0;
$percentualPerdidas = ($totalApostasValor > 0) ? ($totalPerdidas / count($apostas)) * 100 : 0;
$percentualPendentes = ($totalApostasValor > 0) ? ($totalPendentes / count($apostas)) * 100 : 0;

// Calcula o valor total ganho
$totalGanhosLiquido = $totalGanhosValor - $totalPerdidoValor;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerência Bets - Histórico</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Ajuste para exibir a tabela e os gráficos lado a lado */
        .history-container {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            max-width: 1200px; /* Limita a largura máxima */
            width: 100%; /* Ajusta a largura para a tela */
        }

        /* Conteúdo de histórico ocupa 55% da largura */
        .history-content {
            flex: 2;
            margin-right: 20px; /* Espaço entre a tabela e os gráficos */
        }

        /* Container de gráficos ocupa 45% da largura */
        .charts-container {
            flex: 1.5;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .chart {
            height: 180px; /* Ajuste a altura conforme necessário */
            margin-bottom: 20px;
        }

        /* Estilos adicionais */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #FFA500, #FFFFFF); /* Degradê de laranja vivo para branco */
            height: 100vh; /* Garante que o gradiente cubra a tela inteira */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .title {
            font-size: 40px;
            color: #000000;
            text-align: center;
            margin-bottom: 20px;
        }

        .history-table-container {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 10px;
        }

        .history-container table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        .history-container th, .history-container td {
            border: 1px solid #ddd;
            padding: 4px;
            text-align: left;
        }

        .history-container th {
            background-color: #f2f2f2;
        }

        /* Estilos dos Status */
        .status-ganha {
            color: green !important;
        }

        .status-perdida {
            color: red !important;
        }

        .status-pendente {
            color: orange !important;
        }

        /* Resumo */
        .summary {
            margin-top: 10px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #e9ecef;
            font-size: 12px;
        }

        /* Botão de Voltar */
        .back-button {
            display: block;
            margin-top: 20px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1 class="title">Histórico de Apostas</h1>

    <div class="history-container">
        <div class="history-content">
            <div class="history-table-container">
                <table>
                    <tr>
                        <th>Liga</th>
                        <th>Tipo de Entrada</th>
                        <th>Partida</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th>Data</th>
                    </tr>
                    <?php foreach ($apostas as $aposta): ?>
                        <tr>
                            <td><?= htmlspecialchars($aposta['liga']) ?></td>
                            <td><?= htmlspecialchars($aposta['tipo_entrada']) ?></td>
                            <td><?= htmlspecialchars($aposta['partida']) ?></td>
                            <td>R$ <?= number_format($aposta['valor'], 2, ',', '.') ?></td>
                            <td class="
                                <?php 
                                if ($aposta['status'] === 'ganha') {
                                    echo 'status-ganha';
                                } elseif ($aposta['status'] === 'perdida') {
                                    echo 'status-perdida';
                                } elseif ($aposta['status'] === 'pendente') {
                                    echo 'status-pendente';
                                }
                                ?>">
                                <?= htmlspecialchars($aposta['status']) ?>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($aposta['criado_em'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="summary">
                <p><strong>Total Apostado:</strong> R$ <?= number_format($totalApostasValor, 2, ',', '.') ?></p>
                <p><strong>Total de Apostas Ganhas:</strong> <?= $totalGanhos ?></p>
                <p><strong>Total de Apostas Perdidas:</strong> <?= $totalPerdidas ?></p>
                <p><strong>Total de Apostas Pendentes:</strong> <?= $totalPendentes ?></p>
                <p><strong>Total de Ganhos:</strong> R$ <?= number_format($totalGanhosLiquido, 2, ',', '.') ?></p>
                <p><strong>Total Pendentes:</strong> R$ <?= number_format($totalPendentesValor, 2, ',', '.') ?></p>
                <p><strong>Percentual de Apostas Ganhas:</strong> <?= number_format($percentualGanhos, 2, ',', '.') ?>%</p>
            </div>
        </div>

        <div class="charts-container">
            <div class="chart">
                <canvas id="ganhosChart"></canvas>
            </div>
            <div class="chart">
                <canvas id="percentuaisChart"></canvas>
            </div>
        </div>
    </div>

    <a class="back-button" href="home.php">Voltar</a>

    <script>
        // Gráfico de Total Ganhos
        var ctxGanhos = document.getElementById('ganhosChart').getContext('2d');
        new Chart(ctxGanhos, {
            type: 'doughnut',
            data: {
                labels: ['Ganhos', 'Perdidas', 'Pendentes'],
                datasets: [{
                    data: [<?= number_format($totalGanhosValor, 2, '.', '') ?>, <?= number_format($totalPerdidoValor, 2, '.', '') ?>, <?= number_format($totalPendentesValor, 2, '.', '') ?>],
                    backgroundColor: ['#4CAF50', '#f44336', '#FFC107']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });

        // Gráfico de Percentuais
        var ctxPercentuais = document.getElementById('percentuaisChart').getContext('2d');
        new Chart(ctxPercentuais, {
            type: 'bar',
            data: {
                labels: ['Apostas Ganhas', 'Apostas Perdidas', 'Apostas Pendentes'],
                datasets: [{
                    label: 'Percentuais',
                    data: [
                        <?= number_format($percentualGanhos, 2, '.', '') ?>, 
                        <?= number_format($percentualPerdidas, 2, '.', '') ?>, 
                        <?= number_format($percentualPendentes, 2, '.', '') ?>
                    ],
                    backgroundColor: ['#4CAF50', '#F44336', '#FFC107'] // Verde, Vermelho e Amarelo
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script>
</body>
</html>
