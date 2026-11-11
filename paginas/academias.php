<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';
$academias = listarAcademiasDoAluno($_SESSION['alunoId']);
$titulo = 'Academias';
require '../includes/cabecalho.php';
?>

<h2 class="titulo-pagina">Academias liberadas pelo seu plano</h2>
<p class="texto-suave">Escolha a academia onde você vai treinar hoje.</p>

<div class="grade">
<?php
while ($academia = mysqli_fetch_array($academias)) {
    echo '<div class="cartao">';
    echo '<h3>' . $academia['nome'] . '</h3>';
    echo '<p>' . $academia['endereco'] . '</p>';
    echo '<p class="texto-suave">' . $academia['cidade'] . '</p>';
    echo '<span class="selo selo-cinza">'
        . substr($academia['horarioAbertura'], 0, 5) . ' às ' . substr($academia['horarioFechamento'], 0, 5)
        . '</span>';
    echo '<a class="botao" href="checkin.php?academia=' . $academia['id'] . '">Treinar aqui hoje</a>';
    echo '</div>';
}
?>
</div>

<?php require '../includes/rodape.php'; ?>