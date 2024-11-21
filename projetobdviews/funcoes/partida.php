<?php
    declare(strict_types=1);
    require_once '../config/bancodedados.php';

    function gerarDadosGrafico(): array {
        global $pdo;
        $stmt = $pdo->query("
            SELECT e.nome AS equipe, c.nome AS competicao, COUNT(p.id_partida) AS total_partidas
            FROM equipe AS e
            INNER JOIN equipe_da_competicao AS edc ON e.id_equipe = edc.id_equipe
            INNER JOIN competicao AS c ON edc.id_competicao = c.id_competicao
            LEFT JOIN equipe_da_partida AS edp ON e.id_equipe = edp.id_equipe
            LEFT JOIN partida AS p ON edp.id_partida = p.id_partida AND p.id_competicao = c.id_competicao
            GROUP BY e.id_equipe, c.id_competicao ORDER BY c.nome, e.nome
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function gerarDadosGraficoColocacao(): array {
        global $pdo;
        $stmt = $pdo->query("
            SELECT e.nome AS equipe, c.nome AS competicao, ec.colocacao
            FROM equipe AS e
            INNER JOIN equipe_da_competicao AS ec ON e.id_equipe = ec.id_equipe
            INNER JOIN competicao AS c ON ec.id_competicao = c.id_competicao
            ORDER BY c.nome, ec.colocacao ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
    
    function buscarPartidas(): array {
        global $pdo;
        $stmt = $pdo->query("SELECT p.*, c.nome as nome_competicao FROM partida p LEFT JOIN competicao c
                                ON c.id_competicao = p.id_competicao");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarPartidaPorId(int $id): ?array {
        global $pdo;
        $statement = $pdo->prepare("SELECT * FROM partida WHERE id_partida = ?");
        $statement->execute([$id]);
        $partida = $statement->fetch(PDO::FETCH_ASSOC);
        return $partida ? $partida : null;
    }

    function buscarPartidasPorCompeticao($idCompeticao): array {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM partida WHERE id_competicao = ?");
        $stmt->execute([$idCompeticao]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarEquipesDaPartidaPorId(int $id): array {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM equipe_da_partida WHERE id_partida = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function criarPartida(int $idCompeticao, string $resultado, string $sumula): int {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO partida (id_competicao, resultado, sumula) VALUES (?, ?, ?)");
        if ($stmt->execute([$idCompeticao, $resultado, $sumula])) return (int)$pdo->lastInsertId();
        return 0;
    }

    function criarEquipeDaPartida(int $idEquipe, int $idPartida, int $pontuacao): bool {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO equipe_da_partida (id_equipe, id_partida, pontuacao)
                                VALUES (?, ?, ?)");
        return $stmt->execute([$idEquipe, $idPartida, $pontuacao]);
    }

    function excluirPartida(int $id):bool {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM partida WHERE id_partida = ?");
        return $stmt->execute([$id]);
    }

    function excluirPartidaDaEquipe(int $id):bool {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM equipe_da_partida WHERE id_partida= ?");
        return $stmt->execute([$id]);
    }

    function excluirEquipeDaPartida(int $id):bool {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM equipe_da_partida WHERE id_equipe= ?");
        return $stmt->execute([$id]);
    }
?>