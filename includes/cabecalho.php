<?php
if (!isset($titulo)) {
    $titulo = 'Wellhub';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?> - Wellhub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header class="barra-superior">
    <div class="barra-interna">
        <a class="barra-marca" href="inicio.php">Wellhub</a>
        <nav class="barra-menu">
            <a href="inicio.php">Início</a>
            <a href="academias.php">Treinar</a>
            <a href="meusAgendamentos.php">Minhas aulas</a>
            <details class="menu-suspenso">
                <summary>Cadastros</summary>
                <div class="menu-lista">
                    <a href="verAlunos.php">Alunos</a>
                    <a href="verPlanos.php">Planos</a>
                    <a href="verAcademias.php">Academias</a>
                    <a href="verAulas.php">Aulas</a>
                </div>
            </details>
            <a class="barra-sair" href="../logica/logout.php">Sair</a>
        </nav>
    </div>
</header>
<main class="conteudo">