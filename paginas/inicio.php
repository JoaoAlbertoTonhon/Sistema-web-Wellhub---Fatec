<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>Wellhub - Início</title>
</head>
<body>
<div class="topo">
    <h1>Wellhub</h1>
    <nav>
        <a href="academias.php">Academias</a>
        <a href="../logica/logout.php">Sair</a>
    </nav>
</div>
<div class="conteudo">
    <h2>Olá, <?php echo $_SESSION['alunoNome']; ?>!</h2>
    <p>Escolha a academia onde você vai treinar hoje.</p>
    <a href="academias.php" class="botao-link">Ver academias</a>
</div>
</body>
</html>