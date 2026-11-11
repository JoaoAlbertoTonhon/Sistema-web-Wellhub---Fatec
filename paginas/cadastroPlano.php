<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
$titulo = 'Novo plano';
require '../includes/cabecalho.php';
?>

<h2 class="titulo-pagina">Novo plano</h2>

<?php if (isset($_GET['erro'])) { echo '<div class="aviso aviso-erro">Preencha os campos obrigatórios.</div>'; } ?>

<form class="formulario" method="POST" action="../logica/processaCadastroPlano.php">
    <div class="campo">
        <label for="nome">Nome *</label>
        <input type="text" id="nome" name="nome" required>
    </div>
    <div class="campo">
        <label for="descricao">Descrição</label>
        <input type="text" id="descricao" name="descricao">
    </div>
    <div class="campo">
        <label for="valor">Valor (R$) *</label>
        <input type="number" id="valor" name="valor" step="0.01" min="0" required>
    </div>
    <button class="botao" type="submit">Cadastrar</button>
</form>

<?php require '../includes/rodape.php'; ?>