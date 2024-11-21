<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/equipe.php';

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
            $nome = $_POST['nome'];
            $tecnico = $_POST['tecnico'];
            $id = intval($_POST['id']);
            if (empty($nome)) $erro = "Preencha os campos obrigatórios!";
            else {
                if (alterarEquipe($id, $nome, $tecnico)) {
                    header('Location: equipes.php');
                    exit();
                } else $erro = "Erro ao alterar a equipe";
            }
        } catch (Exception $e) {
            $erro = "Erro: " . $e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Editar Equipe</h2>

    <?php if(!empty($erro)): ?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="id" value="<?= $id ?>" />
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" value="<?= $equipe['nome'] ?>" id="nome" class="form-control" value="" required>
        </div>
        <div class="mb-3">
            <label for="tecnico" class="form-label">Técnico</label>
            <input type="text" name="tecnico" value="<?= $equipe['tecnico'] ?>" id="tecnico" class="form-control" value="" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Equipe</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
