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
            $nome = $_POST['nome'];
            $numero_camisa = intval($_POST['numero_camisa']);
            $id_equipe = !empty($_POST['id_equipe']) ? intval($_POST['id_equipe']) : null;
            $id = intval($_POST['id']);
            if (empty($nome)) $erro = "Preencha os campos obrigatórios!";
            else {
                if (alterarJogador($id, $nome, $numero_camisa, $id_equipe)) {
                    header('Location: jogadores.php');
                    exit();
                } else $erro = "Erro ao alterar o jogador";
            }
        } catch (Exception $e) {
            $erro = "Erro: " . $e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Editar Jogador</h2>

    <?php if(!empty($erro)): ?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="id" value="<?= $id ?>" />
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" value="<?= $jogador['nome'] ?>" id="nome" class="form-control" value="" required>
        </div>
        <div class="mb-3">
            <label for="numero_camisa" class="form-label">Número da camisa</label>
            <input type="number" name="numero_camisa" value="<?= $jogador['numero_camisa'] ?>" id="numero_camisa" class="form-control" value="" required>
        </div>
        <div class="mb-3">
            <label for="id_equipe" class="form-label">Equipe</label>
            <select name="id_equipe" id="id_equipe" class="form-control">
                <option value="">Sem equipe</option>
                <?php foreach($equipes as $e):?>
                    <option value="<?= $e['id_equipe'] ?>"
                        <?= $e['id_equipe'] == $jogador['id_equipe'] ? 'selected' : '' ?> >
                        <?= $e['nome'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Jogador</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
