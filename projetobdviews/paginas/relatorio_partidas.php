<?php
    require_once 'cabecalho.php'; 
    require_once 'navbar.php'; 
    require_once '../funcoes/partida.php';
    require_once '../funcoes/equipe.php';

    $partidas = buscarPartidas();

    $partidaSelecionada = null;
    if (isset($_GET['id_partida'])) {
        $idPartida = intval($_GET['id_partida']);
        $partidaSelecionada = buscarPartidaPorId($idPartida);
        $equipes = buscarEquipesDaPartidaPorId($idPartida);
        foreach($equipes as $e) {
            $nomeEquipes[] = buscarEquipePorId($e['id_equipe']);
        }
    }
    
?>
<div class="container mt-5">
    <h3 class="mb-4">Selecione o ID da Partida</h3>
    <form method="get">
        <div class="mb-3">
            <select name="id_partida" id="id_partida" class="form-control" onchange="this.form.submit()">
                <option value="">Selecione o ID da partida</option>
                <?php foreach ($partidas as $p): ?>
                    <option value="<?= $p['id_partida']; ?>" 
                        <?= isset($partidaSelecionada) && $p['id_partida'] == $partidaSelecionada['id_partida'] ? 'selected' : ''; ?>>
                        <?= $p['id_partida']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

    <?php if ($partidaSelecionada): ?>
        <h4>Relatório da Partida: <?= $partidaSelecionada['resultado']; ?></h4>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Nome da Equipe</th>
                    <th>Pontuação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipes as $id => $equipe): ?>
                    <tr>
                        <td><?= $nomeEquipes[$id]['nome']; ?></td>
                        <td><?= $equipe['pontuacao']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h5>Súmula:</h5>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Relatório</th>
                </tr>
            </thead>
            <tbody>             
                    <tr>
                        <td><?= $partidaSelecionada['sumula']; ?></td>
                    </tr>              
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once 'rodape.php'; ?>
