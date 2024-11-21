<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/equipe.php';
    require_once '../funcoes/competicao.php';
    require_once '../funcoes/partida.php';

    $id = $_GET['id'];
    if (!$id) {
        header('Location: equipes.php');
        exit();
    }

    $equipe = buscarEquipePorId($id);
    if (!$equipe) {
        header('Location: equipes.php');
        exit();
    }

    $erro = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $id = intval($_POST['id']);
            if (empty($id)) {
                header('Location: equipes.php');
                exit();
            }
            else {
                excluirEquipeDaCompeticao($id);
                excluirEquipeDaPartida($id);
                if (excluirEquipe($id)) {
                    header('Location: equipes.php');
                    exit();
                } else $erro = "Erro ao excluir a equipe";
            }
        } catch (Exception $e) {
            $erro = "Erro: " . $e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Excluir Equipe</h2>
    
    <p>Tem certeza de que deseja excluir a equipe abaixo?</p>
    <ul>
        <li><strong>Nome:</strong> <?= $equipe['nome'] ?> </li>
        <li><strong>Técnico:</strong> <?= $equipe['tecnico'] ?></li>
    </ul>
    <form method="post">
        <input type="hidden" name="id" value="<?= $id ?>" />
        <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
        <a href="equipes.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
