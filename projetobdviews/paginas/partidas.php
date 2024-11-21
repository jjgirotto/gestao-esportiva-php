<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';    
    require_once '../funcoes/partida.php';  
    
    $partidas = buscarPartidas();
?>

<div class="container mt-5">
    <h2>Gerenciamento de Partidas</h2>
    <a href="nova_partida.php" class="btn btn-success mb-3">Nova Partida</a>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Competição</th>
                <th>Resultado</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            
            <?php foreach($partidas as $p) : ?>
            <tr>
                <td><?=$p['id_partida'] ?></td>
                <td><?=$p['nome_competicao'] ?></td>
                <td><?=$p['resultado'] ?></td>
                <td>
                    <a href="excluir_partida.php?id=<?=$p['id_partida'] ?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>           
        </tbody>
    </table>
</div>

<?php require_once 'rodape.php'; ?>
