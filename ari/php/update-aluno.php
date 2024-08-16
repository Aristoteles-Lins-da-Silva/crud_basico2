<?php

require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = ?");

$stmt->execute([$id]);

$aluno = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $dataNascimento = $_POST['dataNascimento'];
    $contato = $_POST['contato'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $imc = $_POST['imc'];
    
    $stmt = $pdo->prepare("UPDATE alunos SET nome = ?, matricula = ?, data_nascimento = ?, contato = ?, peso = ?, altura = ? WHERE id = ?");
    
    $stmt->execute([$nome, $matricula, $dataNascimento, $contato, $peso, $altura, $imc, $id]);
    
    header('Location: index-aluno.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
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
        <h2>Editar Aluno</h2>

        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= $aluno['nome'] ?>" required>
            
            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" value="<?= $aluno['matricula'] ?>" required>
            
            <label for="dataNascimento">Data de Nascimento:</label>
            <input type="date" id="dataNascimento" name="dataNascimento" value="<?= $aluno['data_nascimento'] ?>" required>
            
            <label for="contato">Contato:</label>
            <input type="tel" id="contato" name="contato" value="<?= $aluno['contato'] ?>" required>

            <label for="peso">Peso:</label>
            <input type="number" id="peso" name="peso" value="<?= $aluno['peso'] ?>" required>

            <label for="altura">Altura:</label>
            <input type="number" id="altura" name="altura" value="<?= $aluno['altura'] ?>" required>

            <button type="submit">Atualizar</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 - Sistema de Gerenciamento de Alunos</p>
    </footer>
</body>
</html>
