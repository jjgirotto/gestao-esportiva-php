<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/competicao.php';
    require_once '../funcoes/equipe.php';

    $equipes = buscarEquipes();

    $id = $_GET['id'];
    if (!$id) {
        header('Location: competicoes.php');
        exit();
    }

    $competicao = buscarCompeticaoPorId($id);
    if (!$competicao) {
        header('Location: competicoes.php');
        exit();
    }

    $erro = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $nome = $_POST['nome'];
            $tipo = $_POST['tipo'];
            $premio = floatval($_POST['premio']);
            $equipesSelecionadas = $_POST['equipes'] ?? [];
            $id = intval($_POST['id']);
            if (empty($nome)) $erro = "Preencha os campos obrigatórios!";
            else {
                if ($id != 0) {
                    alterarCompeticao($id, $nome, $tipo, $premio);                  
                    $equipesAtuais = array_column(buscarCompeticoesdaEquipePorIdCompeticao($id), 'id_equipe');
                    foreach ($equipesSelecionadas as $idEquipe) {
                        $idEquipe = intval($idEquipe);
                        if (!in_array($idEquipe, $equipesAtuais)) {
                            criarEquipeDaCompeticao($idEquipe, $id, 0);
                        }
                    }                    
                    foreach ($equipesAtuais as $idEquipeAtual) {
                        if (!in_array($idEquipeAtual, $equipesSelecionadas)) {
                            excluirEquipeDaCompeticao($idEquipeAtual);
                        }
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
    <h2>Editar Competição</h2>

    <?php if(!empty($erro)): ?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="id" value="<?= $id ?>" />
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" value="<?= $competicao['nome'] ?>" id="nome" class="form-control" value="" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" name="tipo" value="<?= $competicao['tipo'] ?>" id="tipo" class="form-control" value="" required>
        </div>
        <div class="mb-3">
            <label for="premio" class="form-label">Prêmio</label>
            <input type="number" name="premio" value="<?= $competicao['premio'] ?>" id="premio" step="0.01" class="form-control" value="" required>
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
        <button type="submit" class="btn btn-primary">Atualizar Competição</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
