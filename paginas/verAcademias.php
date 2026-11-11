<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';
$academias = listarAcademias();
$titulo = 'Academias';
require '../includes/cabecalho.php';
?>

<div class="cabecalho-lista">
    <h2 class="titulo-pagina">Academias</h2>
    <a class="botao" href="cadastroAcademia.php">Nova academia</a>
</div>

<?php if (isset($_GET['sucesso'])) { echo '<div class="aviso aviso-sucesso">Cadastro realizado.</div>'; } ?>

<div class="area-tabela">
<table class="tabela">
    <thead>
        <tr><th>Nome</th><th>Endereço</th><th>Cidade</th><th>Horário</th></tr>
    </thead>
    <tbody>
    <?php
    while ($academia = mysqli_fetch_array($academias)) {
        echo '<tr><td>' . $academia['nome'] . '</td><td>' . $academia['endereco'] . '</td>';
        echo '<td>' . $academia['cidade'] . '</td>';
        echo '<td>' . substr($academia['horarioAbertura'], 0, 5) . ' às ' . substr($academia['horarioFechamento'], 0, 5) . '</td></tr>';
    }
    ?>
    </tbody>
</table>
</div>

<?php require '../includes/rodape.php'; ?>