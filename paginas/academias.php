<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';
$academias = listarAcademias();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>Wellhub - Academias</title>
</head>
<body>
<div class="topo">
    <h1>Wellhub</h1>
    <nav>
        <a href="inicio.php">Início</a>
        <a href="../logica/logout.php">Sair</a>
    </nav>
</div>
<div class="conteudo">
    <h2>Academias disponíveis</h2>
    <table class="tabela">
        <tr>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Cidade</th>
            <th>Horário</th>
        </tr>
        <?php
        while ($academia = mysqli_fetch_array($academias)) {
            echo "<tr>";
            echo "<td>" . $academia['nome'] . "</td>";
            echo "<td>" . $academia['endereco'] . "</td>";
            echo "<td>" . $academia['cidade'] . "</td>";
            echo "<td>" . $academia['horarioAbertura'] . " às " . $academia['horarioFechamento'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
</body>
</html>