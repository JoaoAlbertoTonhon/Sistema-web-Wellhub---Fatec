<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';

if (empty($_POST['academiaId']) || empty($_POST['modalidade']) || empty($_POST['horario']) || empty($_POST['vagas'])) {
    header('location:../paginas/cadastroAula.php?erro=1');
    die();
}

cadastrarAula($_POST);
header('location:../paginas/verAulas.php?sucesso=1');
die();