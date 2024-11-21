<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/competicao.php';
    require_once '../funcoes/equipe.php';
    require_once '../funcoes/partida.php';

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

    $equipes = buscarEquipes();
    $partidas = buscarPartidasPorCompeticao($id);

    $erro = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $id = intval($_POST['id']);
            if (empty($id)) {
                header('Location: competicoes.php');
                exit();
            }
            else {
                foreach ($partidas as $p) {
                    excluirPartidaDaEquipe($p['id_partida']);
                    excluirPartida($p['id_partida']);
                }
                $competicoes = buscarCompeticoesdaEquipePorIdCompeticao($id);
                foreach ($competicoes as $competicao) {
                    excluirCompeticaoDaEquipe($competicao['id_competicao']);
                }
                if (excluirCompeticao($id)) {
                    header('Location: competicoes.php');
                    exit();
                } else $erro = "Erro ao excluir a competição";
            }
        } catch (Exception $e) {
            $erro = "Erro: " . $e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Excluir Competição</h2>
    
    <p>Tem certeza de que deseja excluir a competição abaixo?</p>
    <ul>
        <li><strong>Nome:</strong> <?= $competicao['nome'] ?> </li>
        <li><strong>Tipo:</strong> <?= $competicao['tipo'] ?></li>
        <li><strong>Prêmio:</strong> <?= $competicao['premio'] ?> </li>
    </ul>
    <form method="post">
        <input type="hidden" name="id" value="<?= $id ?>" />
        <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
        <a href="competicoes.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
