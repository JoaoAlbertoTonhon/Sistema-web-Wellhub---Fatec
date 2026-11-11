<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellhub - Recuperar senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="tela-centro">
    <div class="caixa-login">
        <h1>Recuperar senha</h1>
        <p class="texto-suave">Confirme seu e-mail e CPF e escolha uma nova senha.</p>

        <?php
        if (isset($_GET['erro'])) {
            if ($_GET['erro'] == 'campos') {
                echo '<div class="aviso aviso-erro">Preencha todos os campos.</div>';
            }
            if ($_GET['erro'] == 'confirmacao') {
                echo '<div class="aviso aviso-erro">As senhas não coincidem.</div>';
            }
            if ($_GET['erro'] == 'dados') {
                echo '<div class="aviso aviso-erro">E-mail ou CPF não encontrados.</div>';
            }
        }
        ?>

        <form method="POST" action="logica/processaRecuperacao.php">
            <div class="campo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="campo">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" required>
            </div>
            <div class="campo">
                <label for="novaSenha">Nova senha</label>
                <input type="password" id="novaSenha" name="novaSenha" required>
            </div>
            <div class="campo">
                <label for="confirmaSenha">Confirmar nova senha</label>
                <input type="password" id="confirmaSenha" name="confirmaSenha" required>
            </div>
            <button class="botao botao-largo" type="submit">Trocar senha</button>
        </form>

        <p class="links-centro"><a href="index.php">Voltar ao login</a></p>
    </div>
</div>
</body>
</html>