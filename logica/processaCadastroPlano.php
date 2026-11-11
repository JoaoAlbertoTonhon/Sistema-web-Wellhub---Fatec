<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';

if (empty($_POST['nome']) || empty($_POST['valor'])) {
    header('location:../paginas/cadastroPlano.php?erro=1');
    die();
}

cadastrarPlano($_POST);
header('location:../paginas/verPlanos.php?sucesso=1');
die();