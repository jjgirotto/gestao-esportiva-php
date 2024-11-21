<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';    
    require_once '../funcoes/jogador.php';  
    
    $jogadores = buscarJogadores();
?>

<div class="container mt-5">
    <h2>Gerenciamento de Jogadores</h2>
    <a href="novo_jogador.php" class="btn btn-success mb-3">Novo Jogador</a>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Nº</th>
                <th>Equipe</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            
            <?php foreach($jogadores as $j) : ?>
            <tr>
                <td><?=$j['id_jogador'] ?></td>
                <td><?=$j['nome'] ?></td>
                <td><?=$j['numero_camisa'] ?></td>
                <td><?=$j['nome_equipe'] ?></td>
                <td>
                    <a href="editar_jogador.php?id=<?=$j['id_jogador'] ?>" class="btn btn-warning">Editar</a>
                    <a href="excluir_jogador.php?id=<?=$j['id_jogador'] ?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>           
        </tbody>
    </table>
</div>

<?php require_once 'rodape.php'; ?>
