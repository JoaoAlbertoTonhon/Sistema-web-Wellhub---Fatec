<?php
session_start();
if (!isset($_SESSION['alunoId'])) {
    header('location:../index.php');
    die();
}
require '../includes/funcoesBD.php';

if (isset($_GET['id'])) {
    cancelarAgendamento((int)$_GET['id'], $_SESSION['alunoId']);
}

header('location:../paginas/meusAgendamentos.php?cancelado=1');
die();