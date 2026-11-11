<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';
$planos = listarPlanos();
$titulo = 'Nova academia';
require '../includes/cabecalho.php';
?>

<h2 class="titulo-pagina">Nova academia</h2>

<?php if (isset($_GET['erro'])) { echo '<div class="aviso aviso-erro">Preencha os campos obrigatórios.</div>'; } ?>

<form class="formulario" method="POST" action="../logica/processaCadastroAcademia.php">
    <div class="campo">
        <label for="nome">Nome *</label>
        <input type="text" id="nome" name="nome" required>
    </div>
    <div class="campo">
        <label for="endereco">Endereço *</label>
        <input type="text" id="endereco" name="endereco" required>
    </div>
    <div class="campo">
        <label for="cidade">Cidade *</label>
        <input type="text" id="cidade" name="cidade" required>
    </div>
    <div class="linha">
        <div class="coluna campo">
            <label for="horarioAbertura">Abre às *</label>
            <input type="time" id="horarioAbertura" name="horarioAbertura" required>
        </div>
        <div class="coluna campo">
            <label for="horarioFechamento">Fecha às *</label>
            <input type="time" id="horarioFechamento" name="horarioFechamento" required>
        </div>
    </div>
    <div class="campo">
        <label>Planos que liberam esta academia</label>
        <?php
        while ($plano = mysqli_fetch_array($planos)) {
            echo '<label class="marcacao"><input type="checkbox" name="planos[]" value="' . $plano['id'] . '"> ' . $plano['nome'] . '</label>';
        }
        ?>
    </div>
    <button class="botao" type="submit">Cadastrar</button>
</form>

<?php require '../includes/rodape.php'; ?>