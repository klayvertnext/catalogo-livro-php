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

    $statusPermitidos = ['disponivel', 'indisponivel'];

    if (!in_array($status, $statusPermitidos, true)) {
        $erros[] = 'Selecione um status válido.';
    }

    if (empty($erros)) {
        $sql = '
            INSERT INTO livros (titulo, autor, categoria, status)
            VALUES (:titulo, :autor, :categoria, :status)
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro</title>
</head>

<body>

    <h1>Cadastrar Livro</h1>

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
    action="create.php"
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
            Cadastrar Livro
        </button>

    </form>

<script src="assets/js/validation.js"></script>

</body>

</html>