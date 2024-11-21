<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/jogador.php'; 
    require_once '../funcoes/equipe.php';

    $equipes = buscarEquipes();
    $erro = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $nome = $_POST['nome'];
            $numero_camisa = intval($_POST['numero_camisa']);
            $id_equipe = !empty($_POST['id_equipe']) ? intval($_POST['id_equipe']) : null;
            if (empty($nome) || empty($numero_camisa)) {
                $erro = "Informe os valores obrigatórios!";
            } else {
                if (criarJogador($nome, $numero_camisa, $id_equipe)) {
                    header('Location: jogadores.php');
                    exit();
                } else {
                    $erro = "Erro ao inserir jogador!";
                }
            }
        } catch (Exception $e) {
            $erro = "Erro: " . $e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Criar Novo Jogador</h2>

    <?php if(!empty($erro)): ?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="numero_camisa" class="form-label">Número da camisa</label>
            <input type="number" name="numero_camisa" id="numero_camisa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="id_equipe" class="form-label">Equipe</label>
            <select name="id_equipe" id="id_equipe" class="form-select">
            <option value="">Sem equipe</option>
                <?php foreach($equipes as $e): ?>
                    <option value="<?= $e['id_equipe'] ?>"><?= $e['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Criar Jogador</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
