<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/competicao.php';
    require_once '../funcoes/partida.php';

    $id = $_GET['id'];
    if (!$id) {
        header('Location: partidas.php');
        exit();
    }

    $partida = buscarPartidaPorId($id);
    if (!$partida) {
        header('Location: partidas.php');
        exit();
    }

    $competicao = buscarCompeticaoPorId($partida['id_competicao']);

    if (!$competicao) {
        header('Location: partidas.php');
        exit();
    }

    $erro = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $id = intval($_POST['id']);
            if (empty($id)) {
                header('Location: partidas.php');
                exit();
            }
            else {
                $partidas = buscarEquipesDaPartidaPorId($id);
                foreach ($partidas as $p) {
                    excluirPartidaDaEquipe($p['id_partida']);
                }
                if (excluirPartida($id)) {
                    header('Location: partidas.php');
                    exit();
                } else $erro = "Erro ao excluir a partida";
            }
        } catch (Exception $e) {
            $erro = "Erro: " . $e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Excluir Partida</h2>
    
    <p>Tem certeza de que deseja excluir a partida abaixo?</p>
    <ul>
        <li><strong>Competição:</strong> <?= $competicao['nome'] ?></li>
        <li><strong>Resultado:</strong> <?= $partida['resultado'] ?> </li>
    </ul>
    <form method="post">
        <input type="hidden" name="id" value="<?= $id ?>" />
        <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
        <a href="partidas.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
