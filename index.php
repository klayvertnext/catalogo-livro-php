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

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<main class="container">

<body>

    <div class="page-header">

    <div>
        <h1>Catálogo de Livros</h1>
        <p>Gerencie os livros cadastrados no sistema.</p>
    </div>

    <a href="create.php" class="btn btn-primary">
        + Adicionar Livro
    </a>

</div>

    <?php if (isset($_GET['success']) && $_GET['success'] === 'created'): ?>

       <div class="alert alert-success">
    Livro cadastrado com sucesso!
</div>

    <?php endif; ?>


    <?php if (isset($_GET['success']) && $_GET['success'] === 'updated'): ?>

       <div class="alert alert-success">
    Livro atualizado com sucesso!
</div>

    <?php endif; ?>

    <?php if (isset($_GET['success']) && $_GET['success'] === 'deleted'): ?>

   <div class="alert alert-success">
    Livro excluído com sucesso!
</div>

    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid'): ?>

    <div class="alert alert-error">
    ID do livro inválido.
</div>

    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'notfound'): ?>

   <div class="alert alert-error">
    Livro não encontrado.
</div>

<?php endif; ?>


    <?php if (count($livros) > 0): ?>

        <table>

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

    <?php if ($livro['status'] === 'disponivel'): ?>

        <span class="badge badge-success">
            Disponível
        </span>

    <?php else: ?>

        <span class="badge badge-danger">
            Indisponível
        </span>

    <?php endif; ?>

</td>

<td>

    <div class="actions">

        <a
            href="edit.php?id=<?= $livro['id'] ?>"
            class="btn btn-secondary"
        >
            Editar
        </a>

        <form
            action="delete.php"
            method="POST"
            onsubmit="return confirm('Tem certeza que deseja excluir este livro?');"
        >

            <input
                type="hidden"
                name="id"
                value="<?= $livro['id'] ?>"
            >

            <button
                type="submit"
                class="btn btn-danger"
            >
                Excluir
            </button>

        </form>

    </div>

</td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>
     </div>
</div>

    <?php else: ?>

       <div class="card empty-state">
    Nenhum livro cadastrado.
</div>

    <?php endif; ?>

</main>

</body>

</html>