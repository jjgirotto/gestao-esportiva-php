<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/partida.php'; 
    require_once '../funcoes/competicao.php';
    require_once '../funcoes/equipe.php';

    $equipes = buscarEquipes();

    $competicoes = buscarCompeticoes();
    $erro = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $resultado = $_POST['resultado'];
            $sumula = $_POST['sumula'];
            $id_competicao = intval($_POST['id_competicao']);
            $equipes = $_POST['equipes'] ?? [];
            $pontuacoes = $_POST['pontuacao'] ?? [];
            if (empty($resultado)) {
                $erro = "Informe os valores obrigatórios!";
            } else {
                $idPartida = criarPartida($id_competicao, $resultado, $sumula);
                if ($idPartida != 0) {
                    foreach ($equipes as $idEquipe) {
                        $idEquipe = intval($idEquipe);
                        $pontuacao = isset($pontuacoes[$idEquipe]) ? intval($pontuacoes[$idEquipe]) : 0;
                        criarEquipeDaPartida($idEquipe, $idPartida, $pontuacao);
                    }
                    header('Location: partidas.php');
                    exit();
                } else {
                    $erro = "Erro ao inserir partida!";
                }
            }
        } catch (Exception $e) {
            $erro = "Erro: " . $e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Criar Nova Partida</h2>

    <?php if(!empty($erro)): ?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="resultado" class="form-label">Resultado</label>
            <input type="text" name="resultado" id="resultado" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="sumula" class="form-label">Súmula</label>
            <textarea name="sumula" id="sumula" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="id_competicao" class="form-label">Competição</label>
            <select name="id_competicao" id="id_competicao" class="form-select" required>
                <?php foreach($competicoes as $c): ?>
                    <option value="<?= $c['id_competicao'] ?>"><?= $c['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="id_equipe" class="form-label">Equipes</label>
            <?php foreach($equipes as $key => $e): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="equipes[]" value="<?= $e['id_equipe'] ?>" id="equipe_<?= $e['id_equipe'] ?>">
                    <label class="form-check-label" for="equipe_<?= $e['id_equipe'] ?>">
                        <?= $e['nome'] ?>
                    </label>
                    <input type="number" name="pontuacao[<?= $e['id_equipe'] ?>]" class="form-control mt-2" placeholder="Pontuação" min="0">
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-primary">Criar Partida</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
