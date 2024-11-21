<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/equipe.php';  
    
    $equipes = buscarEquipes();    
?>

<div class="container mt-5">
    <h2>Gerenciamento de Equipes</h2>
    <a href="nova_equipe.php" class="btn btn-success mb-3">Nova Equipe</a>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Técnico</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($equipes as $e) : ?>
            <tr>
                <td><?=$e['id_equipe'] ?></td>
                <td><?=$e['nome'] ?></td>
                <td><?=$e['tecnico'] ?></td>
                <td>
                    <a href="editar_equipe.php?id=<?=$e['id_equipe'] ?>" class="btn btn-warning">Editar</a>
                    <a href="excluir_equipe.php?id=<?=$e['id_equipe'] ?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?> 
        </tbody>
    </table>
</div>

<?php require_once 'rodape.php'; ?>
