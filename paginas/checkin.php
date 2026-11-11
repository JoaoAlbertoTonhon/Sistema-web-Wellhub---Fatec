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

$alunoId = $_SESSION['alunoId'];
$academiaId = (int)$_GET['academia'];
$academia = buscarAcademia($academiaId);
$liberada = academiaLiberada($alunoId, $academiaId);
$jaFez = jaFezCheckinHoje($alunoId, $academiaId);

$titulo = 'Check-in';
require '../includes/cabecalho.php';
?>

<h2 class="titulo-pagina">Check-in</h2>

<?php
$acoesDepois = '<div class="acoes">'
    . '<a class="botao" href="inicio.php">Voltar ao início</a>'
    . '<a class="botao-secundario" href="aulas.php?academia=' . $academiaId . '">Ver aulas desta academia</a>'
    . '</div>';

if (!$academia) {
    echo '<div class="aviso aviso-erro">Academia não encontrada.</div>';
} elseif (!$liberada) {
    echo '<div class="aviso aviso-erro">Essa academia não está liberada pelo seu plano.</div>';
    echo '<div class="acoes"><a class="botao-secundario" href="academias.php">Voltar às academias</a></div>';
} elseif (isset($_GET['sucesso'])) {
    echo '<div class="aviso aviso-sucesso">Check-in registrado em ' . $academia['nome'] . '. Bom treino!</div>';
    echo $acoesDepois;
} elseif ($jaFez) {
    echo '<div class="aviso aviso-sucesso">Você já fez check-in em ' . $academia['nome'] . ' hoje.</div>';
    echo $acoesDepois;
} else {
    if (isset($_GET['erro']) && $_GET['erro'] == 'ja') {
        echo '<div class="aviso aviso-erro">Você já fez check-in nesta academia hoje.</div>';
    }
    echo '<div class="cartao cartao-estreito">';
    echo '<h3>' . $academia['nome'] . '</h3>';
    echo '<p>' . $academia['endereco'] . ' - ' . $academia['cidade'] . '</p>';
    echo '<p class="texto-suave">Funciona das '
        . substr($academia['horarioAbertura'], 0, 5) . ' às '
        . substr($academia['horarioFechamento'], 0, 5) . '</p>';
    echo '<form method="POST" action="../logica/processaCheckin.php">';
    echo '<input type="hidden" name="academia_id" value="' . $academiaId . '">';
    echo '<button class="botao" type="submit">Confirmar check-in</button>';
    echo '</form>';
    echo '</div>';
}
?>

<?php require '../includes/rodape.php'; ?>