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

function listarAcademiasDoAluno($alunoId) {
    $conexao = conectar();
    $consulta = "SELECT academia.*
                 FROM academia
                 INNER JOIN plano_academia ON plano_academia.academia_id = academia.id
                 INNER JOIN assinatura ON assinatura.plano_id = plano_academia.plano_id
                 WHERE assinatura.aluno_id = $alunoId
                 AND assinatura.dataFim >= CURDATE()";
    $resultado = mysqli_query($conexao, $consulta);
    return $resultado;
}

function buscarAssinatura($alunoId) {
    $conexao = conectar();
    $consulta = "SELECT plano.nome AS nomePlano, assinatura.dataFim
                 FROM assinatura
                 INNER JOIN plano ON plano.id = assinatura.plano_id
                 WHERE assinatura.aluno_id = $alunoId
                 AND assinatura.dataFim >= CURDATE()";
    $resultado = mysqli_query($conexao, $consulta);
    $assinatura = mysqli_fetch_array($resultado);
    return $assinatura;
}

function buscarAcademia($academiaId) {
    $conexao = conectar();
    $consulta = "SELECT * FROM academia WHERE id = $academiaId";
    $resultado = mysqli_query($conexao, $consulta);
    $academia = mysqli_fetch_array($resultado);
    return $academia;
}

function academiaLiberada($alunoId, $academiaId) {
    $conexao = conectar();
    $consulta = "SELECT academia.id
                 FROM academia
                 INNER JOIN plano_academia ON plano_academia.academia_id = academia.id
                 INNER JOIN assinatura ON assinatura.plano_id = plano_academia.plano_id
                 WHERE assinatura.aluno_id = $alunoId
                 AND assinatura.dataFim >= CURDATE()
                 AND academia.id = $academiaId";
    $resultado = mysqli_query($conexao, $consulta);
    return mysqli_num_rows($resultado) > 0;
}

function jaFezCheckinHoje($alunoId, $academiaId) {
    $conexao = conectar();
    $consulta = "SELECT id FROM checkin
                 WHERE aluno_id = $alunoId
                 AND academia_id = $academiaId
                 AND data = CURDATE()";
    $resultado = mysqli_query($conexao, $consulta);
    return mysqli_num_rows($resultado) > 0;
}

function registrarCheckin($alunoId, $academiaId) {
    $conexao = conectar();
    $consulta = "INSERT INTO checkin (aluno_id, academia_id, data, hora)
                 VALUES ($alunoId, $academiaId, CURDATE(), CURTIME())";
    return mysqli_query($conexao, $consulta);
}

function buscarCheckinsHoje($alunoId) {
    $conexao = conectar();
    $consulta = "SELECT academia.nome, checkin.hora
                 FROM checkin
                 INNER JOIN academia ON academia.id = checkin.academia_id
                 WHERE checkin.aluno_id = $alunoId
                 AND checkin.data = CURDATE()
                 ORDER BY checkin.hora DESC";
    $resultado = mysqli_query($conexao, $consulta);
    return $resultado;
}

function listarAulasDaAcademia($academiaId) {
    $conexao = conectar();
    $consulta = "SELECT * FROM aula WHERE academia_id = $academiaId ORDER BY horario";
    $resultado = mysqli_query($conexao, $consulta);
    return $resultado;
}

function buscarAula($aulaId) {
    $conexao = conectar();
    $consulta = "SELECT aula.*, academia.nome AS nomeAcademia, academia.id AS academiaId
                 FROM aula
                 INNER JOIN academia ON academia.id = aula.academia_id
                 WHERE aula.id = $aulaId";
    $resultado = mysqli_query($conexao, $consulta);
    $aula = mysqli_fetch_array($resultado);
    return $aula;
}

function contarAgendamentos($aulaId, $data) {
    $conexao = conectar();
    $consulta = "SELECT id FROM agendamento WHERE aula_id = $aulaId AND data = '$data'";
    $resultado = mysqli_query($conexao, $consulta);
    return mysqli_num_rows($resultado);
}

function alunoJaAgendou($alunoId, $aulaId, $data) {
    $conexao = conectar();
    $consulta = "SELECT id FROM agendamento
                 WHERE aluno_id = $alunoId AND aula_id = $aulaId AND data = '$data'";
    $resultado = mysqli_query($conexao, $consulta);
    return mysqli_num_rows($resultado) > 0;
}

function registrarAgendamento($alunoId, $aulaId, $data) {
    $conexao = conectar();
    $consulta = "INSERT INTO agendamento (aluno_id, aula_id, data)
                 VALUES ($alunoId, $aulaId, '$data')";
    return mysqli_query($conexao, $consulta);
}

function listarAgendamentosDoAluno($alunoId) {
    $conexao = conectar();
    $consulta = "SELECT agendamento.id, agendamento.data, aula.modalidade,
                        aula.horario, academia.nome AS nomeAcademia
                 FROM agendamento
                 INNER JOIN aula ON aula.id = agendamento.aula_id
                 INNER JOIN academia ON academia.id = aula.academia_id
                 WHERE agendamento.aluno_id = $alunoId
                 AND agendamento.data >= CURDATE()
                 ORDER BY agendamento.data, aula.horario";
    $resultado = mysqli_query($conexao, $consulta);
    return $resultado;
}

function cancelarAgendamento($agendamentoId, $alunoId) {
    $conexao = conectar();
    $consulta = "DELETE FROM agendamento WHERE id = $agendamentoId AND aluno_id = $alunoId";
    return mysqli_query($conexao, $consulta);
}

function buscarAlunoPorEmailCpf($email, $cpf) {
    $conexao = conectar();
    $consulta = "SELECT * FROM aluno WHERE email = '$email' AND cpf = '$cpf'";
    $resultado = mysqli_query($conexao, $consulta);
    return mysqli_fetch_array($resultado);
}

function atualizarSenha($id, $novaSenha) {
    $conexao = conectar();
    $consulta = "UPDATE aluno SET senha = '$novaSenha' WHERE id = $id";
    mysqli_query($conexao, $consulta);
}

function listarAlunos() {
    $conexao = conectar();
    $consulta = "SELECT * FROM aluno ORDER BY nome";
    return mysqli_query($conexao, $consulta);
}

function cadastrarAluno($dados) {
    $conexao = conectar();
    $consulta = "INSERT INTO aluno (nome, cpf, dataNascimento, idade, endereco, telefone, email, senha, objetivo, nivel)
                 VALUES ('{$dados['nome']}', '{$dados['cpf']}', '{$dados['dataNascimento']}', {$dados['idade']},
                         '{$dados['endereco']}', '{$dados['telefone']}', '{$dados['email']}', '{$dados['senha']}',
                         '{$dados['objetivo']}', '{$dados['nivel']}')";
    mysqli_query($conexao, $consulta);
    return mysqli_insert_id($conexao);
}

function cadastrarAssinatura($alunoId, $planoId) {
    $conexao = conectar();
    $consulta = "INSERT INTO assinatura (aluno_id, plano_id, dataInicio, dataFim)
                 VALUES ($alunoId, $planoId, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 1 MONTH))";
    return mysqli_query($conexao, $consulta);
}

function listarPlanos() {
    $conexao = conectar();
    $consulta = "SELECT * FROM plano ORDER BY id";
    return mysqli_query($conexao, $consulta);
}

function cadastrarPlano($dados) {
    $conexao = conectar();
    $consulta = "INSERT INTO plano (nome, descricao, valor)
                 VALUES ('{$dados['nome']}', '{$dados['descricao']}', {$dados['valor']})";
    return mysqli_query($conexao, $consulta);
}

function cadastrarAcademia($dados) {
    $conexao = conectar();
    $consulta = "INSERT INTO academia (nome, endereco, cidade, horarioAbertura, horarioFechamento)
                 VALUES ('{$dados['nome']}', '{$dados['endereco']}', '{$dados['cidade']}',
                         '{$dados['horarioAbertura']}', '{$dados['horarioFechamento']}')";
    mysqli_query($conexao, $consulta);
    return mysqli_insert_id($conexao);
}

function associarPlanoAcademia($planoId, $academiaId) {
    $conexao = conectar();
    $consulta = "INSERT INTO plano_academia (plano_id, academia_id) VALUES ($planoId, $academiaId)";
    return mysqli_query($conexao, $consulta);
}

function listarTodasAulas() {
    $conexao = conectar();
    $consulta = "SELECT aula.*, academia.nome AS nomeAcademia
                 FROM aula
                 INNER JOIN academia ON academia.id = aula.academia_id
                 ORDER BY academia.nome, aula.horario";
    return mysqli_query($conexao, $consulta);
}

function cadastrarAula($dados) {
    $conexao = conectar();
    $consulta = "INSERT INTO aula (academia_id, modalidade, diaSemana, horario, vagas)
                 VALUES ({$dados['academiaId']}, '{$dados['modalidade']}', '{$dados['diaSemana']}',
                         '{$dados['horario']}', {$dados['vagas']})";
    return mysqli_query($conexao, $consulta);
}