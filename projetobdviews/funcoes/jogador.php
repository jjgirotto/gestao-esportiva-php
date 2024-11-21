<?php
    declare(strict_types=1);
    require_once '../config/bancodedados.php';

    function buscarJogadores(): array {
        global $pdo;
        $stmt = $pdo->query("SELECT j.*, e.nome as nome_equipe FROM jogador j
                            LEFT JOIN equipe e ON e.id_equipe = j.id_equipe");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarJogadorPorId(int $id): ?array {
        global $pdo;
        $statement = $pdo->prepare("SELECT j.*, e.nome as nome_equipe FROM jogador j
                                    LEFT JOIN equipe e ON e.id_equipe = j.id_equipe WHERE j.id_jogador = ?");
        $statement->execute([$id]);
        $jogador = $statement->fetch(PDO::FETCH_ASSOC);
        return $jogador ? $jogador : null;
    }

    function criarJogador(string $nome, int $numero_camisa, ?int $id_equipe): bool {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO jogador (nome, numero_camisa, id_equipe) VALUES (?, ?, ?)");
        return $stmt->execute([$nome, $numero_camisa, $id_equipe]);
    }

    function alterarJogador(int $id, string $nome, int $numero_camisa, ?int $id_equipe):bool {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE jogador SET nome = ?, numero_camisa = ?, id_equipe = ? WHERE id_jogador = ?");
        return $stmt->execute([$nome, $numero_camisa, $id_equipe, $id]);
    }

    function excluirJogador(int $id):bool {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM jogador WHERE id_jogador = ?");
        return $stmt->execute([$id]);
    }
?>