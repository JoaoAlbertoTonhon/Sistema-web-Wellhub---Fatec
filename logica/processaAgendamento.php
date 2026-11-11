<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';

if (empty($_POST['aula_id']) || empty($_POST['academia_id'])) {
    header('location:../paginas/academias.php');
    die();
}

$alunoId = $_SESSION['alunoId'];
$aulaId = (int)$_POST['aula_id'];
$academiaId = (int)$_POST['academia_id'];
$hoje = date('Y-m-d');

$aula = buscarAula($aulaId);

if (!academiaLiberada($alunoId, $academiaId)) {
    header('location:../paginas/academias.php');
    die();
}

if (contarAgendamentos($aulaId, $hoje) >= $aula['vagas']) {
    header('location:../paginas/aulas.php?academia=' . $academiaId . '&erro=lotada');
    die();
}

if (alunoJaAgendou($alunoId, $aulaId, $hoje)) {
    header('location:../paginas/aulas.php?academia=' . $academiaId . '&erro=ja');
    die();
}

registrarAgendamento($alunoId, $aulaId, $hoje);
header('location:../paginas/aulas.php?academia=' . $academiaId . '&sucesso=1');
die();