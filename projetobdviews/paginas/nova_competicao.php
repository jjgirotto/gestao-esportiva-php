<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/competicao.php'; 
    require_once '../funcoes/equipe.php';

    $equipes = buscarEquipes();
    $erro = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $nome = $_POST['nome'];
            $tipo = $_POST['tipo'];
            $premio = floatval($_POST['premio']);
            $equipes = $_POST['equipes'] ?? [];
            if (empty($nome) || empty($tipo)) {
                $erro = "Informe os valores obrigatórios!";
            } else {
                $idCompeticao = criarCompeticao($nome, $tipo, $premio);
                if ($idCompeticao != 0) {
                    foreach ($equipes as $idEquipe) {
                        $idEquipe = intval($idEquipe);
                        criarEquipeDaCompeticao($idEquipe, $idCompeticao, 0);
                    }
                    header('Location: competicoes.php');
                    exit();
                } else {
                    $erro = "Erro ao inserir competição!";
                }
            }
        } catch (Exception $e) {
            $erro = "Erro: " . $e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Criar Nova Competição</h2>

    <?php if(!empty($erro)): ?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" name="tipo" id="tipo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="premio" class="form-label">Prêmio</label>
            <input type="number" name="premio" id="premio" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="id_equipe" class="form-label">Equipes</label>
            <?php foreach($equipes as $e): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="equipes[]" value="<?= $e['id_equipe'] ?>" id="equipe_<?= $e['id_equipe'] ?>">
                    <label class="form-check-label" for="equipe_<?= $e['id_equipe'] ?>">
                        <?= $e['nome'] ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-primary">Criar Competição</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
