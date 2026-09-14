<?php

require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: index.php?error=invalid');
    exit;
}

$stmt = $pdo->prepare('SELECT id FROM livros WHERE id = :id');

$stmt->execute([
    ':id' => $id
]);

$livro = $stmt->fetch();

if (!$livro) {
    header('Location: index.php?error=notfound');
    exit;
}

$stmt = $pdo->prepare('DELETE FROM livros WHERE id = :id');

$stmt->execute([
    ':id' => $id
]);

header('Location: index.php?success=deleted');
exit;