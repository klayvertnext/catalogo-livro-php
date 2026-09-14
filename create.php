<?php

require_once __DIR__ . '/config/database.php';

$erros = [];

$titulo = '';
$autor = '';
$categoria = '';
$status = 'disponivel';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $status = $_POST['status'] ?? '';

    if ($titulo === '') {
        $erros[] = 'O título é obrigatório.';
    }

    if ($autor === '') {
        $erros[] = 'O autor é obrigatório.';
    }

    if ($categoria === '') {
        $erros[] = 'A categoria é obrigatória.';
    }

    if (mb_strlen($titulo) > 150) {
        $erros[] = 'O título deve ter no máximo 150 caracteres.';
    }

    if (mb_strlen($autor) > 120) {
        $erros[] = 'O autor deve ter no máximo 120 caracteres.';
    }

    if (mb_strlen($categoria) > 80) {
        $erros[] = 'A categoria deve ter no máximo 80 caracteres.';
    }

    $statusPermitidos = [
        'disponivel',
        'indisponivel'
    ];

    if (!in_array($status, $statusPermitidos, true)) {
        $erros[] = 'Selecione um status válido.';
    }

    if (empty($erros)) {

        $sql = '
            INSERT INTO livros (
                titulo,
                autor,
                categoria,
                status
            )
            VALUES (
                :titulo,
                :autor,
                :categoria,
                :status
            )
        ';

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':titulo' => $titulo,
            ':autor' => $autor,
            ':categoria' => $categoria,
            ':status' => $status
        ]);

        header('Location: index.php?success=created');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Cadastrar Livro</title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>

<body>

    <main class="container">

        <div class="card form-card">

            <div class="form-header">

                <h1>Cadastrar Livro</h1>

                <p>
                    Preencha os dados para adicionar um novo livro.
                </p>

            </div>


            <?php if (!empty($erros)): ?>

                <div class="alert alert-error">

                    <strong>
                        Corrija os seguintes erros:
                    </strong>

                    <ul>

                        <?php foreach ($erros as $erro): ?>

                            <li>
                                <?= htmlspecialchars($erro) ?>
                            </li>

                        <?php endforeach; ?>

                    </ul>

                </div>

            <?php endif; ?>


            <form
                method="POST"
                action="create.php"
                class="book-form"
                novalidate
            >

                <div class="form-group">

                    <label for="titulo">
                        Título
                    </label>

                    <input
                        type="text"
                        id="titulo"
                        name="titulo"
                        value="<?= htmlspecialchars($titulo) ?>"
                        maxlength="150"
                    >

                    <small class="error-message"></small>

                </div>


                <div class="form-group">

                    <label for="autor">
                        Autor
                    </label>

                    <input
                        type="text"
                        id="autor"
                        name="autor"
                        value="<?= htmlspecialchars($autor) ?>"
                        maxlength="120"
                    >

                    <small class="error-message"></small>

                </div>


                <div class="form-group">

                    <label for="categoria">
                        Categoria
                    </label>

                    <input
                        type="text"
                        id="categoria"
                        name="categoria"
                        value="<?= htmlspecialchars($categoria) ?>"
                        maxlength="80"
                    >

                    <small class="error-message"></small>

                </div>


                <div class="form-group">

                    <label for="status">
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                    >

                        <option value="">
                            Selecione
                        </option>

                        <option
                            value="disponivel"
                            <?= $status === 'disponivel' ? 'selected' : '' ?>
                        >
                            Disponível
                        </option>

                        <option
                            value="indisponivel"
                            <?= $status === 'indisponivel' ? 'selected' : '' ?>
                        >
                            Indisponível
                        </option>

                    </select>

                    <small class="error-message"></small>

                </div>


                <div class="form-actions">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Cadastrar Livro
                    </button>

                    <a
                        href="index.php"
                        class="btn btn-secondary"
                    >
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </main>


    <script src="assets/js/validation.js"></script>

</body>

</html>