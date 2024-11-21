<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/equipe.php'; 

    $erro = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $nome = $_POST['nome'];
            $tecnico = $_POST['tecnico'];
            if (empty($nome) || empty($tecnico)) {
                $erro = "Informe os valores obrigatórios!";
            } else {
                if (criarEquipe($nome, $tecnico)) {
                    header('Location: equipes.php');
                    exit();
                } else {
                    $erro = "Erro ao inserir equipe!";
                }
            }
        } catch (Exception $e) {
            $erro = "Erro: " . $e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Criar Nova Equipe</h2>

    <?php if(!empty($erro)): ?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tecnico" class="form-label">Nome do Técnico</label>
            <input type="text" name="tecnico" id="tecnico" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Criar Equipe</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
