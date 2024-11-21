<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';    
    require_once '../funcoes/competicao.php';  
    
    $competicoes = buscarCompeticoes();
?>

<div class="container mt-5">
    <h2>Gerenciamento de Competições</h2>
    <a href="nova_competicao.php" class="btn btn-success mb-3">Nova Competição</a>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Prêmio</th>
            </tr>
        </thead>
        <tbody>
            
            <?php foreach($competicoes as $c) : ?>
            <tr>
                <td><?=$c['id_competicao'] ?></td>
                <td><?=$c['nome'] ?></td>
                <td><?=$c['tipo'] ?></td>
                <td><?=$c['premio'] ?></td>
                <td>
                    <a href="editar_competicao.php?id=<?=$c['id_competicao'] ?>" class="btn btn-warning">Editar</a>
                    <a href="excluir_competicao.php?id=<?=$c['id_competicao'] ?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>           
        </tbody>
    </table>
</div>

<?php require_once 'rodape.php'; ?>
