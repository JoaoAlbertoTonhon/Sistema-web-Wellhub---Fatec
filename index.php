<?php
session_start();
if (isset($_SESSION['alunoId'])) {
    header('location:paginas/inicio.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellhub - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="tela-centro">
    <div class="caixa-login">
        <h1>Wellhub</h1>
        <p class="texto-suave">Acesso do aluno</p>

        <?php
        if (isset($_GET['erro'])) {
            echo '<div class="aviso aviso-erro">E-mail ou senha inválidos.</div>';
        }
        if (isset($_GET['senha'])) {
            echo '<div class="aviso aviso-sucesso">Senha alterada. Faça seu login.</div>';
        }
        if (isset($_GET['cadastrado'])) {
            echo '<div class="aviso aviso-sucesso">Conta criada. Faça seu login.</div>';
        }
        ?>

        <form method="POST" action="logica/processaLogin.php">
            <div class="campo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="campo">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button class="botao botao-largo" type="submit">Entrar</button>
        </form>

        <p class="links-centro"><a href="recuperarSenha.php">Esqueci minha senha</a></p>
        <p class="links-centro">Não tem conta? <a href="cadastroAluno.php">Criar conta</a></p>
    </div>
</div>
</body>
</html>