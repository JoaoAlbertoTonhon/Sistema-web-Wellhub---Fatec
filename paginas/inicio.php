<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';
$assinatura = buscarAssinatura($_SESSION['alunoId']);
$checkins = buscarCheckinsHoje($_SESSION['alunoId']);
$titulo = 'Início';
require '../includes/cabecalho.php';
?>

<h2 class="titulo-pagina">Olá, <?php echo $_SESSION['alunoNome']; ?>!</h2>

<?php if ($assinatura) { ?>
    <p class="texto-suave">
        Seu plano: <strong><?php echo $assinatura['nomePlano']; ?></strong>
        · válido até <?php echo date('d/m/Y', strtotime($assinatura['dataFim'])); ?>
    </p>
<?php } else { ?>
    <div class="aviso aviso-erro">Você não tem um plano ativo no momento.</div>
<?php } ?>

<div class="grade">
    <div class="cartao">
        <h3>Academias</h3>
        <p class="texto-suave">Veja as academias liberadas pelo seu plano e escolha onde treinar.</p>
        <a class="botao" href="academias.php">Ver academias</a>
    </div>

    <div class="cartao">
        <h3>Treinos de hoje</h3>
        <?php
        if (mysqli_num_rows($checkins) == 0) {
            echo '<p class="texto-suave">Você ainda não fez check-in hoje.</p>';
        } else {
            while ($checkin = mysqli_fetch_array($checkins)) {
                echo '<p>' . $checkin['nome'] . ' às ' . substr($checkin['hora'], 0, 5) . '</p>';
            }
        }
        ?>
    </div>

    <div class="cartao">
        <h3>Minhas aulas</h3>
        <p class="texto-suave">Veja e cancele suas aulas agendadas.</p>
        <a class="botao" href="meusAgendamentos.php">Ver aulas</a>
    </div>
</div>

<?php require '../includes/rodape.php'; ?>