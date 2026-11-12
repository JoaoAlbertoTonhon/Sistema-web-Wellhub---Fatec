CREATE DATABASE IF NOT EXISTS wellhub;
USE wellhub;

CREATE TABLE aluno (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(50),
  cpf VARCHAR(15),
  dataNascimento DATE,
  idade INT,
  endereco VARCHAR(100),
  telefone VARCHAR(15),
  email VARCHAR(50),
  senha VARCHAR(20),
  objetivo VARCHAR(30),
  nivel VARCHAR(20)
);

CREATE TABLE plano (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(50),
  descricao VARCHAR(150),
  valor FLOAT
);

CREATE TABLE academia (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(50),
  endereco VARCHAR(100),
  cidade VARCHAR(50),
  horarioAbertura TIME,
  horarioFechamento TIME
);

CREATE TABLE assinatura (
  id INT PRIMARY KEY AUTO_INCREMENT,
  aluno_id INT,
  plano_id INT,
  dataInicio DATE,
  dataFim DATE,
  FOREIGN KEY (aluno_id) REFERENCES aluno(id),
  FOREIGN KEY (plano_id) REFERENCES plano(id)
);

CREATE TABLE plano_academia (
  id INT PRIMARY KEY AUTO_INCREMENT,
  plano_id INT,
  academia_id INT,
  FOREIGN KEY (plano_id) REFERENCES plano(id),
  FOREIGN KEY (academia_id) REFERENCES academia(id)
);

CREATE TABLE checkin (
  id INT PRIMARY KEY AUTO_INCREMENT,
  aluno_id INT,
  academia_id INT,
  data DATE,
  hora TIME,
  FOREIGN KEY (aluno_id) REFERENCES aluno(id),
  FOREIGN KEY (academia_id) REFERENCES academia(id)
);

CREATE TABLE aula (
  id INT PRIMARY KEY AUTO_INCREMENT,
  academia_id INT,
  modalidade VARCHAR(50),
  diaSemana VARCHAR(15),
  horario TIME,
  vagas INT,
  FOREIGN KEY (academia_id) REFERENCES academia(id)
);

CREATE TABLE agendamento (
  id INT PRIMARY KEY AUTO_INCREMENT,
  aluno_id INT,
  aula_id INT,
  data DATE,
  FOREIGN KEY (aluno_id) REFERENCES aluno(id),
  FOREIGN KEY (aula_id) REFERENCES aula(id)
);

INSERT INTO plano (nome, descricao, valor) VALUES
('Plano Básico', 'Acesso a academias parceiras básicas', 69.90),
('Plano Premium', 'Acesso a todas as academias parceiras', 149.90);

INSERT INTO academia (nome, endereco, cidade, horarioAbertura, horarioFechamento) VALUES
('Academia Alfa', 'Rua Exemplo, 100', 'Presidente Prudente', '05:00:00', '22:00:00'),
('Academia Beta', 'Av. Teste, 200', 'Presidente Prudente', '06:00:00', '21:00:00');

INSERT INTO plano_academia (plano_id, academia_id) VALUES (1, 1), (2, 1), (2, 2);

INSERT INTO aluno (nome, cpf, dataNascimento, telefone, email, senha, objetivo, nivel) VALUES
('Aluno Teste', '000.000.000-00', '2000-01-01', '18999999999', 'aluno@teste.com', '1234', 'hipertrofia', 'iniciante'),
('Aluno Basico', '111.111.111-11', '2000-02-02', '18988888888', 'basico@teste.com', '1234', 'emagrecimento', 'iniciante');

INSERT INTO assinatura (aluno_id, plano_id, dataInicio, dataFim) VALUES
(1, 2, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY)),
(2, 1, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY));

INSERT INTO aula (academia_id, modalidade, diaSemana, horario, vagas) VALUES
(1, 'Spinning', 'segunda', '07:00:00', 2),
(1, 'Pilates', 'quarta', '18:00:00', 10),
(2, 'Funcional', 'sexta', '19:00:00', 8);

