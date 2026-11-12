<?php
require 'includes/funcoesBD.php';
$planos = listarPlanos();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellhub - Criar conta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="tela-centro">
    <form class="formulario" method="POST" action="logica/processaCadastroAluno.php">
        <h1 class="titulo-pagina">Criar conta</h1>
        <p class="texto-suave">Preencha seus dados para começar a treinar.</p>

        <?php if (isset($_GET['erro'])) { echo '<div class="aviso aviso-erro">Preencha todos os campos obrigatórios.</div>'; } ?>

        <div class="campo">
            <label for="nome">Nome completo *</label>
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
                <label for="idade">Idade *</label>
                <input type="number" id="idade" name="idade" min="1" max="120" required>
            </div>
            <div class="coluna campo">
                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone">
            </div>
        </div>

        <div class="campo">
            <label for="endereco">Endereço *</label>
            <input type="text" id="endereco" name="endereco" required>
        </div>

        <div class="campo">
            <label for="email">E-mail *</label>
            <input type="email" id="email" name="email" required>
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

        <button class="botao botao-largo" type="submit">Criar conta</button>
        <p class="links-centro"><a href="index.php">Já tenho conta</a></p>
    </form>
</div>
</body>
</html>