<?php
require '../includes/funcoesBD.php';

if (empty($_POST['email']) || empty($_POST['cpf']) || empty($_POST['novaSenha']) || empty($_POST['confirmaSenha'])) {
    header('location:../recuperarSenha.php?erro=campos');
    die();
}

if ($_POST['novaSenha'] != $_POST['confirmaSenha']) {
    header('location:../recuperarSenha.php?erro=confirmacao');
    die();
}

$aluno = buscarAlunoPorEmailCpf($_POST['email'], $_POST['cpf']);

if ($aluno == null) {
    header('location:../recuperarSenha.php?erro=dados');
    die();
}

atualizarSenha($aluno['id'], $_POST['novaSenha']);
header('location:../index.php?senha=1');
die();