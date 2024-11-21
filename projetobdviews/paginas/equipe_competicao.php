<?php
    require_once 'cabecalho.php'; 
    require_once 'navbar.php'; 
    require_once '../funcoes/competicao.php';
    require_once '../funcoes/equipe.php';

    $competicoes = buscarCompeticoes();

    $competicaoSelecionada = null;
    $equipes = [];
    if (isset($_GET['id_competicao'])) {
        $idCompeticao = intval($_GET['id_competicao']);
        $competicaoSelecionada = buscarCompeticaoPorId($idCompeticao);
        $equipes = buscarEquipesComNomePorIdCompeticao($idCompeticao);
    }
?>
<div class="container mt-5">
    <h3 class="mb-4">Selecione uma competição</h3>
    <form method="get">
        <div class="mb-3">
            <select name="id_competicao" id="id_competicao" class="form-control" onchange="this.form.submit()">
                <option value="">Selecione a competição</option>
                <?php foreach ($competicoes as $competicao): ?>
                    <option value="<?= $competicao['id_competicao']; ?>" 
                        <?= isset($competicaoSelecionada) && $competicao['id_competicao'] == $competicaoSelecionada['id_competicao'] ? 'selected' : ''; ?>>
                        <?= $competicao['nome']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

    <?php if ($competicaoSelecionada): ?>
        <h4>Equipes da Competição: <?= $competicaoSelecionada['nome']; ?></h4>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Nome da Equipe</th>
                    <th>Colocação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipes as $equipe): ?>
                    <tr>
                        <td><?= $equipe['nome']; ?></td>
                        <td><?= $equipe['colocacao']; ?></td>
                        <td>
                            <a href="editar_equipe_competicao.php?id_competicao=<?= $idCompeticao; ?>&id_equipe=<?= $equipe['id_equipe']; ?>" class="btn btn-warning">Editar</a>
                            <a href="excluir_equipe_competicao.php?id_competicao=<?= $idCompeticao; ?>&id_equipe=<?= $equipe['id_equipe']; ?>" class="btn btn-danger">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once 'rodape.php'; ?>
