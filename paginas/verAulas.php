<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';
$aulas = listarTodasAulas();
$titulo = 'Aulas';
require '../includes/cabecalho.php';
?>

<div class="cabecalho-lista">
    <h2 class="titulo-pagina">Aulas</h2>
    <a class="botao" href="cadastroAula.php">Nova aula</a>
</div>

<?php if (isset($_GET['sucesso'])) { echo '<div class="aviso aviso-sucesso">Cadastro realizado.</div>'; } ?>

<div class="area-tabela">
<table class="tabela">
    <thead>
        <tr><th>Academia</th><th>Modalidade</th><th>Dia</th><th>Horário</th><th>Vagas</th></tr>
    </thead>
    <tbody>
    <?php
    while ($aula = mysqli_fetch_array($aulas)) {
        echo '<tr><td>' . $aula['nomeAcademia'] . '</td><td>' . $aula['modalidade'] . '</td>';
        echo '<td>' . ucfirst($aula['diaSemana']) . '</td>';
        echo '<td>' . substr($aula['horario'], 0, 5) . '</td><td>' . $aula['vagas'] . '</td></tr>';
    }
    ?>
    </tbody>
</table>
</div>

<?php require '../includes/rodape.php'; ?>