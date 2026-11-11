<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';

if (empty($_POST['nome']) || empty($_POST['endereco']) || empty($_POST['cidade']) || empty($_POST['horarioAbertura']) || empty($_POST['horarioFechamento'])) {
    header('location:../paginas/cadastroAcademia.php?erro=1');
    die();
}

$academiaId = cadastrarAcademia($_POST);

if (isset($_POST['planos'])) {
    foreach ($_POST['planos'] as $planoId) {
        associarPlanoAcademia($planoId, $academiaId);
    }
}

header('location:../paginas/verAcademias.php?sucesso=1');
die();