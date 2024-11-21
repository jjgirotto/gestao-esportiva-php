<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/equipe.php';
    require_once '../funcoes/competicao.php';

    $idCompeticao = $_GET['id_competicao'];
    $idEquipe = $_GET['id_equipe'];

    if (!$idCompeticao || !$idEquipe) {
        header('Location: equipe_competicao.php?id_competicao=$idCompeticao');
        exit();
    }

    $equipe = buscarEquipeDaCompeticao($idEquipe, $idCompeticao);

    if (!$equipe) {
        header('Location: equipe_competicao.php?id_competicao=$idCompeticao');
        exit();
    }

    $erro = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $colocacao = intval($_POST['colocacao']);
            if (alterarColocacaoEquipeDaCompeticao($idEquipe, $idCompeticao, $colocacao)) {
                header('Location: equipe_competicao.php?id_competicao=$idCompeticao');
                exit();
            } else {
                echo "Erro ao atualizar a colocação.";
            }
        } catch (Exception $e) {
            $erro = "Erro: " . $e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h3 class="mb-4">Editar colocação da equipe: <?= $equipe['nome']; ?></h3>

    <?php if(!empty($erro)): ?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="id" value="<?= $idEquipe ?>" />
        <div class="mb-3">
            <label for="colocacao" class="form-label">Colocação</label>
            <input type="number" name="colocacao" value="<?= $equipe['colocacao'] ?>" id="colocacao" class="form-control" value="" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Colocação</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
