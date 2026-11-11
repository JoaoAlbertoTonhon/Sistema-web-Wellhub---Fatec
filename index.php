<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Wellhub - Login</title>
</head>
<body class="login">
<div class="caixa-login">
    <h1>Wellhub</h1>
    <p>Acesso da recepção</p>

    <form method="POST" action="logica/processaLogin.php">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <input type="submit" value="Entrar" class="botao">
    </form>
</div>
</body>
</html>