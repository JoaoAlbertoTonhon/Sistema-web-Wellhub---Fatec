<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';
$planos = listarPlanos();
$titulo = 'Novo aluno';
require '../includes/cabecalho.php';
?>

<h2 class="titulo-pagina">Novo aluno</h2>

<?php if (isset($_GET['erro'])) { echo '<div class="aviso aviso-erro">Preencha os campos obrigatórios.</div>'; } ?>

<form class="formulario" method="POST" action="../logica/processaCadastroAluno.php">
    <div class="campo">
        <label for="nome">Nome *</label>
        <input type="text" id="nome" name="nome" required>
    </div>
    <div class="linha">
        <div class="coluna campo">
            <label for="cpf">CPF *</label>
            <input type="text" id="cpf" name="cpf" required>
        </div>
        <div class="coluna campo">
            <label for="dataNascimento">Data de nascimento *</label>
            <input type="date" id="dataNascimento" name="dataNascimento" required>
        </div>
    </div>
    <div class="linha">
        <div class="coluna campo">
            <label for="telefone">Telefone</label>
            <input type="text" id="telefone" name="telefone">
        </div>
        <div class="coluna campo">
            <label for="email">E-mail *</label>
            <input type="email" id="email" name="email" required>
        </div>
    </div>
    <div class="campo">
        <label for="senha">Senha *</label>
        <input type="password" id="senha" name="senha" required>
    </div>
    <div class="linha">
        <div class="coluna campo">
            <label for="objetivo">Objetivo</label>
            <select id="objetivo" name="objetivo">
                <option value="hipertrofia">Hipertrofia</option>
                <option value="emagrecimento">Emagrecimento</option>
                <option value="condicionamento">Condicionamento</option>
                <option value="saude">Saúde</option>
            </select>
        </div>
        <div class="coluna campo">
            <label for="nivel">Nível</label>
            <select id="nivel" name="nivel">
                <option value="iniciante">Iniciante</option>
                <option value="intermediario">Intermediário</option>
                <option value="avancado">Avançado</option>
            </select>
        </div>
    </div>
    <div class="campo">
        <label for="planoId">Plano *</label>
        <select id="planoId" name="planoId" required>
            <?php
            while ($plano = mysqli_fetch_array($planos)) {
                echo '<option value="' . $plano['id'] . '">' . $plano['nome'] . '</option>';
            }
            ?>
        </select>
    </div>
    <button class="botao" type="submit">Cadastrar</button>
</form>

<?php require '../includes/rodape.php'; ?>