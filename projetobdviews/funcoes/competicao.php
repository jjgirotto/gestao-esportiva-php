<?php
    declare(strict_types=1);
    require_once '../config/bancodedados.php';

    function buscarCompeticoes(): array {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM competicao");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarCompeticaoPorId(int $id): ?array {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM competicao WHERE id_competicao = ?");
        $stmt->execute([$id]);
        $competicao = $stmt->fetch(PDO::FETCH_ASSOC);
        return $competicao ? $competicao : null;
    }

    function buscarCompeticoesdaEquipePorIdCompeticao(int $id): array {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM equipe_da_competicao WHERE id_competicao = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarEquipesComNomePorIdCompeticao(int $id): array {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT equipe.nome, equipe_da_competicao.colocacao, equipe_da_competicao.id_equipe 
            FROM equipe_da_competicao
            JOIN equipe ON equipe_da_competicao.id_equipe = equipe.id_equipe
            WHERE equipe_da_competicao.id_competicao = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarEquipeDaCompeticao(int $idEquipe, int $idCompeticao): array {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT * FROM equipe_da_competicao e
            JOIN equipe ON e.id_equipe = equipe.id_equipe
            WHERE e.id_equipe = ? AND e.id_competicao = ?
        ");
        $stmt->execute([$idEquipe, $idCompeticao]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }   

    function criarCompeticao(string $nome, string $tipo, float $premio): int {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO competicao (nome, tipo, premio) VALUES (?, ?, ?)");
        if ($stmt->execute([$nome, $tipo, $premio])) return (int)$pdo->lastInsertId();
        return 0;
    }   

    function criarEquipeDaCompeticao(int $idEquipe, int $idCompeticao, int $colocacao): bool {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO equipe_da_competicao (id_equipe, id_competicao, colocacao)
                                VALUES (?, ?, ?)");
        return $stmt->execute([$idEquipe, $idCompeticao, $colocacao]);
    }

    function alterarCompeticao(int $id, string $nome, string $tipo, float $premio):bool {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE competicao SET nome = ?, tipo = ?, premio = ? WHERE id_competicao = ?");
        return $stmt->execute([$nome, $tipo, $premio, $id]);
    }

    function alterarColocacaoEquipeDaCompeticao(int $idEquipe, int $idCompeticao, int $colocacao):bool {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE equipe_da_competicao SET colocacao = ? WHERE id_equipe = ? AND id_competicao = ?");
        return $stmt->execute([$colocacao, $idEquipe, $idCompeticao]);
    }    

    function excluirCompeticao(int $id):bool {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM competicao WHERE id_competicao = ?");
        return $stmt->execute([$id]);
    }

    function excluirEquipeDaCompeticao(int $id):bool {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM equipe_da_competicao WHERE id_equipe= ?");
        return $stmt->execute([$id]);
    }

    function excluirCompeticaoDaEquipe(int $id):bool {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM equipe_da_competicao WHERE id_competicao= ?");
        return $stmt->execute([$id]);
    }
?>