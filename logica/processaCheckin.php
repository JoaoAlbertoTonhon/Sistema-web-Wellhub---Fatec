<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';

if (empty($_POST['academia_id'])) {
    header('location:../paginas/academias.php');
    die();
}

$alunoId = $_SESSION['alunoId'];
$academiaId = (int)$_POST['academia_id'];

if (!academiaLiberada($alunoId, $academiaId)) {
    header('location:../paginas/checkin.php?academia=' . $academiaId . '&erro=bloqueada');
    die();
}

if (jaFezCheckinHoje($alunoId, $academiaId)) {
    header('location:../paginas/checkin.php?academia=' . $academiaId . '&erro=ja');
    die();
}

registrarCheckin($alunoId, $academiaId);
header('location:../paginas/checkin.php?academia=' . $academiaId . '&sucesso=1');
die();