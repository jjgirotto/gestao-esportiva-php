<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/jogador.php';
    require_once '../funcoes/equipe.php';

    $id = $_GET['id'];
    if (!$id) {
        header('Location: jogadores.php');
        exit();
    }

    $jogador = buscarJogadorPorId($id);
    if (!$jogador) {
        header('Location: jogadores.php');
        exit();
    }

    $equipes = buscarEquipes();

    $erro = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $id = intval($_POST['id']);
            if (empty($id)) {
                header('Location: jogadores.php');
                exit();
            }
            else {
                if (excluirJogador($id)) {
                    header('Location: jogadores.php');
                    exit();
                } else $erro = "Erro ao excluir o jogador";
            }
        } catch (Exception $e) {
            $erro = "Erro: " . $e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Excluir Jogador</h2>
    
    <p>Tem certeza de que deseja excluir o jogador abaixo?</p>
    <ul>
        <li><strong>Nome:</strong> <?= $jogador['nome'] ?> </li>
        <li><strong>Número da camisa:</strong> <?= $jogador['numero_camisa'] ?></li>
        <li><strong>Equipe:</strong> <?= $jogador['nome_equipe'] ?> </li>
    </ul>
    <form method="post">
        <input type="hidden" name="id" value="<?= $id ?>" />
        <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
        <a href="jogadores.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
