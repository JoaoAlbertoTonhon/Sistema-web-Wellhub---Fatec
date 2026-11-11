<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';

if (empty($_POST['nome']) || empty($_POST['cpf']) || empty($_POST['dataNascimento']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['planoId'])) {
    header('location:../paginas/cadastroAluno.php?erro=1');
    die();
}

$alunoId = cadastrarAluno($_POST);
cadastrarAssinatura($alunoId, $_POST['planoId']);

header('location:../paginas/verAlunos.php?sucesso=1');
die();