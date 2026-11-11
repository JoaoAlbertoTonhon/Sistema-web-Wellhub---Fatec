<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';

if (!isset($_GET['academia'])) {
    header('location:academias.php');
    die();
}

$academiaId = (int)$_GET['academia'];
$academia = buscarAcademia($academiaId);
$aulas = listarAulasDaAcademia($academiaId);
$hoje = date('Y-m-d');

$titulo = 'Aulas';
require '../includes/cabecalho.php';
?>

<h2 class="titulo-pagina">Aulas - <?php echo $academia['nome']; ?></h2>
<p class="texto-suave">Agende uma vaga para hoje.</p>

<?php
if (isset($_GET['erro']) && $_GET['erro'] == 'lotada') {
    echo '<div class="aviso aviso-erro">Essa aula está lotada.</div>';
}
if (isset($_GET['erro']) && $_GET['erro'] == 'ja') {
    echo '<div class="aviso aviso-erro">Você já agendou essa aula hoje.</div>';
}
if (isset($_GET['sucesso'])) {
    echo '<div class="aviso aviso-sucesso">Aula agendada com sucesso!</div>';
}
?>

<div class="grade">
<?php
while ($aula = mysqli_fetch_array($aulas)) {
    $ocupadas = contarAgendamentos($aula['id'], $hoje);
    $restantes = $aula['vagas'] - $ocupadas;

    echo '<div class="cartao">';
    echo '<h3>' . $aula['modalidade'] . '</h3>';
    echo '<p class="texto-suave">' . ucfirst($aula['diaSemana']) . ' às ' . substr($aula['horario'], 0, 5) . '</p>';

    if ($restantes > 0) {
        echo '<span class="selo">' . $restantes . ' vaga(s) restante(s)</span>';
        echo '<form method="POST" action="../logica/processaAgendamento.php">';
        echo '<input type="hidden" name="aula_id" value="' . $aula['id'] . '">';
        echo '<input type="hidden" name="academia_id" value="' . $academiaId . '">';
        echo '<button class="botao" type="submit">Agendar</button>';
        echo '</form>';
    } else {
        echo '<span class="selo selo-cinza">Lotada</span>';
    }

    echo '</div>';
}
?>
</div>

<?php require '../includes/rodape.php'; ?>