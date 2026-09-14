<?php

require_once __DIR__ . '/config/database.php';

$erros = [];

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM livros WHERE id = :id');
$stmt->execute([
    ':id' => $id
]);

$livro = $stmt->fetch();

if (!$livro) {
    header('Location: index.php');
    exit;
}

$titulo = $livro['titulo'];
$autor = $livro['autor'];
$categoria = $livro['categoria'];
$status = $livro['status'];

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

    $statusPermitidos = ['disponivel', 'indisponivel'];

    if (!in_array($status, $statusPermitidos, true)) {
        $erros[] = 'Selecione um status válido.';
    }

    if (empty($erros)) {
        $sql = '
            UPDATE livros
            SET titulo = :titulo,
                autor = :autor,
                categoria = :categoria,
                status = :status
            WHERE id = :id
        ';

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':titulo' => $titulo,
            ':autor' => $autor,
            ':categoria' => $categoria,
            ':status' => $status,
            ':id' => $id
        ]);

        header('Location: index.php?success=updated');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
</head>

<body>

    <h1>Editar Livro</h1>

    <p>
        <a href="index.php">← Voltar para o catálogo</a>
    </p>

    <?php if (!empty($erros)): ?>

        <div>
            <strong>Corrija os seguintes erros:</strong>

            <ul>
                <?php foreach ($erros as $erro): ?>
                    <li><?= htmlspecialchars($erro) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

    <?php endif; ?>

    <form
    method="POST"
    class="book-form"
    novalidate
>

       <div class="form-group">
    <label for="titulo">Título</label>

    <input
        type="text"
        id="titulo"
        name="titulo"
        value="<?= htmlspecialchars($titulo) ?>"
        maxlength="150"
    >

    <small class="error-message"></small>
</div>

        <br>

        <div class="form-group">
    <label for="autor">Autor</label>

    <input
        type="text"
        id="autor"
        name="autor"
        value="<?= htmlspecialchars($autor) ?>"
        maxlength="120"
    >

    <small class="error-message"></small>
</div>

        <br>

        <div class="form-group">
    <label for="categoria">Categoria</label>

    <input
        type="text"
        id="categoria"
        name="categoria"
        value="<?= htmlspecialchars($categoria) ?>"
        maxlength="80"
    >

    <small class="error-message"></small>
</div>

        <br>

        <div class="form-group">
    <label for="status">Status</label>

    <select id="status" name="status" required>

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
</div>

        <br>

        <button type="submit">
            Salvar Alterações
        </button>

    </form>

<script src="assets/js/validation.js"></script>

</body>

</html>

            <input
                type="text"
                id="autor"
                name="autor"
                value="<?= htmlspecialchars($autor) ?>"
                required
            >
        </div>

        <br>

        <div>
            <label for="categoria">Categoria</label><br>

            <input
                type="text"
                id="categoria"
                name="categoria"
                value="<?= htmlspecialchars($categoria) ?>"
                required
            >
        </div>

        <br>

        <div>
            <label for="status">Status</label><br>

            <select id="status" name="status" required>

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
        </div>

        <br>

        <button type="submit">
            Salvar Alterações
        </button>

    </form>
    
<script src="assets/js/validation.js"></script>

</body>

</html>