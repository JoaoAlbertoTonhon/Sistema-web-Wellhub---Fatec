<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';
$planos = listarPlanos();
$titulo = 'Planos';
require '../includes/cabecalho.php';
?>

<div class="cabecalho-lista">
    <h2 class="titulo-pagina">Planos</h2>
    <a class="botao" href="cadastroPlano.php">Novo plano</a>
</div>

<?php if (isset($_GET['sucesso'])) { echo '<div class="aviso aviso-sucesso">Cadastro realizado.</div>'; } ?>

<div class="area-tabela">
<table class="tabela">
    <thead>
        <tr><th>Nome</th><th>Descrição</th><th>Valor</th></tr>
    </thead>
    <tbody>
    <?php
    while ($plano = mysqli_fetch_array($planos)) {
        echo '<tr><td>' . $plano['nome'] . '</td><td>' . $plano['descricao'] . '</td>';
        echo '<td>R$ ' . number_format($plano['valor'], 2, ',', '.') . '</td></tr>';
    }
    ?>
    </tbody>
</table>
</div>

<?php require '../includes/rodape.php'; ?>