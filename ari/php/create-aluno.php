<?php
require_once 'db.php';
require_once 'authenticate.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $dataNascimento = $_POST['dataNascimento'];
    $contato = $_POST['contato'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    
    $stmt = $pdo->prepare("INSERT INTO alunos (nome, matricula, data_nascimento, contato, peso, altura) VALUES (?, ?, ?, ?, ?, ?)");
    
    $stmt->execute([$nome, $matricula, $dataNascimento, $contato, $peso, $altura]);
    
    header('Location: index-aluno.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Aluno</title>
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
        <h2>Adicionar Aluno</h2>
        <form id="teste_aluno" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            
            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required>
            
            <label for="dataNascimento">Data de Nascimento:</label>
            <input type="date" id="dataNascimento" name="dataNascimento" required>
            
            <label for="contato">Contato:</label>
            <input type="tel" id="contato" name="contato" required>

            <label for="peso">Peso:</label>
            <input type="number" id="peso" name="peso" required>

            <label for="altura">Altura:</label>
            <input type="number" id="altura" name="altura" required>

            <small id="pesoMessage" class="error"></small>

            <button type="submit">Adicionar</button>
            
        </form>
    </main>

    <footer>
        <p>&copy; 2024 - Sistema de Gerenciamento de Alunos</p>
    </footer>
</body>
</html>
