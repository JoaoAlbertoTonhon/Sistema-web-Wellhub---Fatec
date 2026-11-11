<?php
session_start();
require '../includes/funcoesBD.php';

// Recebe os dados do formulário via POST
if (empty($_POST['email']) || empty($_POST['senha'])) {
    header('location:../index.php?erro=1');
    die();
}

$aluno = buscarAluno($_POST['email'], $_POST['senha']);

if ($aluno != null) {
    $_SESSION['alunoId'] = $aluno['id'];
    $_SESSION['alunoNome'] = $aluno['nome'];
    header('location:../paginas/inicio.php');
    die();
}

header('location:../index.php?erro=1');
die();