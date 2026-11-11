<?php
function conectar() {
    $conexao = mysqli_connect('localhost', 'root', '', 'wellhub');
    return $conexao;
}

function buscarAluno($email, $senha) {
    $conexao = conectar();
    $consulta = "SELECT * FROM aluno WHERE email = '$email' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $consulta);
    $aluno = mysqli_fetch_array($resultado);
    return $aluno;
}

function listarAcademias() {
    $conexao = conectar();
    $consulta = "SELECT * FROM academia";
    $resultado = mysqli_query($conexao, $consulta);
    return $resultado;
}