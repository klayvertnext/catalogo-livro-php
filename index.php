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

    <p>
        <a href="create.php">+ Adicionar Livro</a>
    </p>

    <?php if (isset($_GET['success']) && $_GET['success'] === 'created'): ?>

        <p>
            Livro cadastrado com sucesso!
        </p>

    <?php endif; ?>


    <?php if (isset($_GET['success']) && $_GET['success'] === 'updated'): ?>

        <p>
            Livro atualizado com sucesso!
        </p>

    <?php endif; ?>

    <?php if (isset($_GET['success']) && $_GET['success'] === 'deleted'): ?>

    <p>
        Livro excluído com sucesso!
    </p>

    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid'): ?>

    <p>
        ID do livro inválido.
    </p>

    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'notfound'): ?>

    <p>
        Livro não encontrado.
    </p>

<?php endif; ?>


    <?php if (count($livros) > 0): ?>

        <table border="1" cellpadding="10">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Categoria</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($livros as $livro): ?>

                    <tr>

                        <td>
                            <?= $livro['id'] ?>
                        </td>

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

                        <td>

                            <a href="edit.php?id=<?= $livro['id'] ?>">
                               Editar 
                            </a>

                            <form
                                action="delete.php"
                                method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Tem certeza que deseja excluir este livro?');"
                            >

                            <input
                                type="hidden"
                                name="id"
                                value="<?= $livro['id'] ?>"
                            >

                            <button type="submit">
                               Excluir
                            </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php else: ?>

        <p>
            Nenhum livro cadastrado.
        </p>

    <?php endif; ?>

</body>

</html>