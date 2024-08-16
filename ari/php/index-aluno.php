<?php
require_once 'db.php';
require_once 'authenticate.php';

$stmt = $pdo->query("SELECT * FROM alunos");
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Alunos</title>
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
        <h2>Lista de Alunos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Matrícula</th>
                    <th>Data de Nascimento</th>
                    <th>Contato</th>
                    <th>Peso</th>
                    <th>Altura</th>
                    <th>IMC</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos as $aluno): ?>
                    <?php
                        $peso = $aluno['peso'];
                        $altura = $aluno['altura'];
                        $imc = null;
                        $classificacao = '';

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
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($aluno['id']) ?></td>
                        <td><?= htmlspecialchars($aluno['nome']) ?></td>
                        <td><?= htmlspecialchars($aluno['matricula']) ?></td>
                        <td><?= htmlspecialchars($aluno['data_nascimento']) ?></td>
                        <td><?= htmlspecialchars($aluno['contato']) ?></td>
                        <td><?= htmlspecialchars($aluno['peso']) ?> kg</td>
                        <td><?= htmlspecialchars($aluno['altura']) ?> cm</td>
                        <td><?= $imc !== null ? number_format($imc, 2) . ' (' . htmlspecialchars($classificacao) . ')' : 'Dados inválidos' ?></td>
                        <td>
                            <a href="read-aluno.php?id=<?= htmlspecialchars($aluno['id']) ?>">Visualizar</a>
                            <a href="update-aluno.php?id=<?= htmlspecialchars($aluno['id']) ?>">Editar</a>
                            <a href="delete-aluno.php?id=<?= htmlspecialchars($aluno['id']) ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2024 - Sistema de Gerenciamento de Alunos</p>
    </footer>
</body>
</html>