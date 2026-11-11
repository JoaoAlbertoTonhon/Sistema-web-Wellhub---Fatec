<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';
$academias = listarAcademias();
$titulo = 'Nova aula';
require '../includes/cabecalho.php';
?>

<h2 class="titulo-pagina">Nova aula</h2>

<?php if (isset($_GET['erro'])) { echo '<div class="aviso aviso-erro">Preencha os campos obrigatórios.</div>'; } ?>

<form class="formulario" method="POST" action="../logica/processaCadastroAula.php">
    <div class="campo">
        <label for="academiaId">Academia *</label>
        <select id="academiaId" name="academiaId" required>
            <?php
            while ($academia = mysqli_fetch_array($academias)) {
                echo '<option value="' . $academia['id'] . '">' . $academia['nome'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="campo">
        <label for="modalidade">Modalidade *</label>
        <input type="text" id="modalidade" name="modalidade" required>
    </div>
    <div class="linha">
        <div class="coluna campo">
            <label for="diaSemana">Dia da semana *</label>
            <select id="diaSemana" name="diaSemana" required>
                <option value="segunda">Segunda</option>
                <option value="terca">Terça</option>
                <option value="quarta">Quarta</option>
                <option value="quinta">Quinta</option>
                <option value="sexta">Sexta</option>
                <option value="sabado">Sábado</option>
            </select>
        </div>
        <div class="coluna campo">
            <label for="horario">Horário *</label>
            <input type="time" id="horario" name="horario" required>
        </div>
    </div>
    <div class="campo">
        <label for="vagas">Vagas *</label>
        <input type="number" id="vagas" name="vagas" min="1" required>
    </div>
    <button class="botao" type="submit">Cadastrar</button>
</form>

<?php require '../includes/rodape.php'; ?>