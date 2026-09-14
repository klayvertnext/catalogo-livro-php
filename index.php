<?php

require_once __DIR__ . '/config/database.php';

$stmt = $pdo->query('SELECT * FROM livros ORDER BY id DESC');
$livros = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Livros</title>
</head>

<body>

    <h1>Catálogo de Livros</h1>

    <?php if (count($livros) > 0): ?>

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Categoria</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($livros as $livro): ?>

                    <tr>
                        <td><?= $livro['id'] ?></td>

                        <td>
                            <?= htmlspecialchars($livro['titulo']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($livro['autor']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($livro['categoria']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($livro['status']) ?>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>

    <?php else: ?>

        <p>Nenhum livro cadastrado.</p>

    <?php endif; ?>

</body>

</html>