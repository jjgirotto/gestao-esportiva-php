<?php
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/partida.php';

    $dados = gerarDadosGrafico();
    $dadosColocacao = gerarDadosGraficoColocacao();
?>

<main class="container">
    <div class="container mt-5">
        <h2>Dashboard</h2>

        <!-- Div onde o primeiro gráfico será renderizado -->
        <div id="chart_div_1" style="width: 100%; height: 500px;"></div>

        <!-- Div onde o segundo gráfico será renderizado -->
        <div id="chart_div_2" style="width: 100%; height: 500px;"></div>
    </div>

    <!-- Inclusão da biblioteca Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        
        google.charts.setOnLoadCallback(function() {
            drawChart();  // Chama a função para desenhar o primeiro gráfico
            drawChart2(); // Chama a função para desenhar o segundo gráfico
        });

        function drawChart() {
            // Converte os dados PHP para o formato adequado
            var data = google.visualization.arrayToDataTable([
                ['Equipe - Competição', 'Total de Partidas'],
                <?php foreach($dados as $d): ?>
                    ['<?= $d['equipe'] ?> - <?= $d['competicao'] ?>', <?= (int) $d['total_partidas'] ?>],
                <?php endforeach; ?>
            ]);

            var options = {
                title: 'Número de Partidas por Equipe e Competição',
                hAxis: {title: 'Total de Partidas', minValue: 0},
                vAxis: {
                    title: 'Equipe - Competição',
                    format: 'decimal',
                    gridlines: {count: 10},
                    viewWindow: {min: 0},
                },
                chartArea: {width: '70%', height: '70%'},
                legend: {position: 'none'},
                colors: ['#98FB98']
            };

            // Renderiza o gráfico na div com id 'chart_div_1'
            var chart = new google.visualization.BarChart(document.getElementById('chart_div_1'));
            chart.draw(data, options);
        }

        function drawChart2() {
            // Converte os dados PHP para o formato adequado
            var data = google.visualization.arrayToDataTable([
                ['Colocação', 'Equipe - Competição'],
                <?php foreach($dadosColocacao as $d): ?>
                    ['<?= $d['equipe'] ?> - <?= $d['competicao'] ?>', <?= (int) $d['colocacao'] ?>],
                <?php endforeach; ?>
            ]);

            var options = {
                title: 'Colocação dos Times nas Competições',
                hAxis: {
                    title: 'Colocação',
                    slantedText: true, // Gira o texto para evitar sobreposição
                    slantedTextAngle: 45
                },
                vAxis: {
                    title: 'Equipe - Competição',
                    format: 'decimal',
                    gridlines: {count: 5},
                    viewWindow: {
                        min: 0, // O valor mínimo é 1º lugar
                    },
                },
                chartArea: {width: '70%', height: '70%'},
                legend: {position: 'none'},
                colors: ['#98FB98']
            };

            // Renderiza o gráfico na div com id 'chart_div_2'
            var chart = new google.visualization.BarChart(document.getElementById('chart_div_2'));
            chart.draw(data, options);
        }
    </script>
</main>

<?php require_once 'rodape.php'; ?>