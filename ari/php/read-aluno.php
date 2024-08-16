<?php
    require_once 'db.php';
    require_once 'authenticate.php';

    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = ?");
    $stmt->execute([$id]);

    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $imc = null;
    $classificacao = '';

    if ($aluno) {
        $peso = $aluno['peso'];
        $altura = $aluno['altura'];

        if ($altura > 0) {
            $altura_metros = $altura / 100;
            $imc = $peso / ($altura_metros * $altura_metros);

            if ($imc < 18.5) {
                $classificacao = "Abaixo do peso";
            } elseif ($imc < 24.9) {
                $classificacao = "Peso ideal";
            } else {
                $classificacao = "Acima do peso";
            }
        } else {
            $classificacao = "Altura inválida";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Aluno</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Bem-vindo ao Sistema de Gerenciamento de Alunos</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="index-aluno.php">Listar Alunos</a></li>
                <li><a href="create-aluno.php">Adicionar Aluno</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Detalhes do Aluno</h2>
        <?php if ($aluno): ?>
            <p><strong>ID:</strong> <?= htmlspecialchars($aluno['id']) ?></p>
            <p><strong>Nome:</strong> <?= htmlspecialchars($aluno['nome']) ?></p>
            <p><strong>Matrícula:</strong> <?= htmlspecialchars($aluno['matricula']) ?></p>
            <p><strong>Data de Nascimento:</strong> <?= htmlspecialchars($aluno['data_nascimento']) ?></p>
            <p><strong>Contato:</strong> <?= htmlspecialchars($aluno['contato']) ?></p>
            <p><strong>Peso:</strong> <?= htmlspecialchars($aluno['peso']) ?> kg</p>
            <p><strong>Altura:</strong> <?= htmlspecialchars($aluno['altura']) ?> cm</p>
            <?php if ($imc !== null): ?>
                <p><strong>IMC:</strong> <?= number_format($imc, 2) ?></p>
                <p><strong>Classificação:</strong> <?= htmlspecialchars($classificacao) ?></p>
            <?php endif; ?>
            <p>
                <a href="update-aluno.php?id=<?= htmlspecialchars($aluno['id']) ?>">Editar</a>
                <a href="delete-aluno.php?id=<?= htmlspecialchars($aluno['id']) ?>">Excluir</a>
            </p>
        <?php else: ?>

            <p>Aluno não encontrado.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 - Sistema de Gerenciamento de Alunos</p>
    </footer>
</body>
</html>