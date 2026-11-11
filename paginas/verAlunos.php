<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';
$alunos = listarAlunos();
$titulo = 'Alunos';
require '../includes/cabecalho.php';
?>

<div class="cabecalho-lista">
    <h2 class="titulo-pagina">Alunos</h2>
    <a class="botao" href="cadastroAluno.php">Novo aluno</a>
</div>

<?php if (isset($_GET['sucesso'])) { echo '<div class="aviso aviso-sucesso">Cadastro realizado.</div>'; } ?>

<div class="area-tabela">
<table class="tabela">
    <thead>
        <tr><th>Nome</th><th>CPF</th><th>E-mail</th><th>Telefone</th></tr>
    </thead>
    <tbody>
    <?php
    while ($aluno = mysqli_fetch_array($alunos)) {
        echo '<tr><td>' . $aluno['nome'] . '</td><td>' . $aluno['cpf'] . '</td>';
        echo '<td>' . $aluno['email'] . '</td><td>' . $aluno['telefone'] . '</td></tr>';
    }
    ?>
    </tbody>
</table>
</div>

<?php require '../includes/rodape.php'; ?>