<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';
$agendamentos = listarAgendamentosDoAluno($_SESSION['alunoId']);
$titulo = 'Minhas aulas';
require '../includes/cabecalho.php';
?>

<h2 class="titulo-pagina">Minhas aulas agendadas</h2>

<?php
if (isset($_GET['cancelado'])) {
    echo '<div class="aviso aviso-sucesso">Agendamento cancelado.</div>';
}

if (mysqli_num_rows($agendamentos) == 0) {
    echo '<div class="cartao"><p class="texto-suave">Você não tem aulas agendadas.</p></div>';
} else {
    mysqli_data_seek($agendamentos, 0);
    echo '<div class="grade">';
    while ($item = mysqli_fetch_array($agendamentos)) {
        echo '<div class="cartao">';
        echo '<h3>' . $item['modalidade'] . '</h3>';
        echo '<p>' . $item['nomeAcademia'] . '</p>';
        echo '<p class="texto-suave">' . date('d/m/Y', strtotime($item['data'])) . ' às ' . substr($item['horario'], 0, 5) . '</p>';
        echo '<a class="botao-pequeno" href="../logica/processaCancelamento.php?id=' . $item['id'] . '" onclick="return confirm(\'Cancelar esta aula?\');">Cancelar</a>';
        echo '</div>';
    }
    echo '</div>';
}
?>

<?php require '../includes/rodape.php'; ?>