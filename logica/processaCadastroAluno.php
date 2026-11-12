<?php
require '../includes/funcoesBD.php';

if (empty($_POST['nome']) || empty($_POST['cpf']) || empty($_POST['dataNascimento']) || empty($_POST['idade']) || empty($_POST['endereco']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['planoId'])) {
    header('location:../cadastroAluno.php?erro=1');
    die();
}

$alunoId = cadastrarAluno($_POST);
cadastrarAssinatura($alunoId, $_POST['planoId']);

header('location:../index.php?cadastrado=1');
die();