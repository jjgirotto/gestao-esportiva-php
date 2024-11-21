<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/equipe.php';
    require_once '../funcoes/competicao.php';

    $idCompeticao = $_GET['id_competicao'];
    $idEquipe = $_GET['id_equipe'];
    
    if (!$idCompeticao || !$idEquipe) {
        header("Location: equipe_competicao.php?id_competicao=$idCompeticao");
        exit();
    }

    $equipe = buscarEquipePorId($idEquipe);
    $competicao = buscarCompeticaoPorId($idCompeticao);
    if (!$equipe || !$competicao) {
        header("Location: equipe_competicao.php?id_competicao=$idCompeticao");
        exit();
    }

    $erro = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            if (excluirEquipeDaCompeticao($idEquipe)) {
                header("Location: equipe_competicao.php?id_competicao=$idCompeticao");
                exit();
            } else {
                echo "Erro ao excluir a equipe.";
            }
        } catch (Exception $e) {
            $erro = "Erro: " . $e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Excluir Equipe da Competição</h2>
    
    <p>Tem certeza de que deseja excluir a equipe abaixo da competição?</p>
    <ul>
        <li><strong>Nome:</strong> <?= $equipe['nome'] ?> </li>
        <li><strong>Competição:</strong> <?= $competicao['nome'] ?></li>
    </ul>
    <form method="post">
        <input type="hidden" name="id" value="<?= $idEquipe ?>" />
        <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
        <a href="equipe_competicao.php?id_competicao=<?= $idCompeticao ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
