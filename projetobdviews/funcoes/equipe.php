<?php
    declare(strict_types=1);
    require_once '../config/bancodedados.php';
    
    function buscarEquipes(): array {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM equipe");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarEquipePorId(int $id): ?array {
        global $pdo;
        $statement = $pdo->prepare("SELECT * FROM equipe WHERE id_equipe = ?");
        $statement->execute([$id]);
        $equipe = $statement->fetch(PDO::FETCH_ASSOC);
        return $equipe ? $equipe : null;
    }

    function criarEquipe(string $nome, string $tecnico) : bool {
        global $pdo;
        $statement = $pdo->prepare("INSERT INTO equipe (nome, tecnico) VALUES (?, ?)");
        return $statement->execute([$nome, $tecnico]);
    }

    function alterarEquipe(int $id, string $nome, string $tecnico):bool {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE equipe SET nome = ?, tecnico = ? WHERE id_equipe = ?");
        return $stmt->execute([$nome, $tecnico, $id]);
    }

    function excluirEquipe(int $id): bool {
        global $pdo;   
        try {    
            $stmtCompeticao = $pdo->prepare("DELETE FROM equipe_da_competicao WHERE id_equipe = ?");
            $stmtCompeticao->execute([$id]);
            $stmtPartida = $pdo->prepare("DELETE FROM equipe_da_partida WHERE id_equipe = ?");
            $stmtPartida->execute([$id]);
            $stmtEquipe = $pdo->prepare("DELETE FROM equipe WHERE id_equipe = ?");
            $stmtEquipe->execute([$id]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
?>