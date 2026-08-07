CREATE DATABASE sigep;

USE sigep;

CREATE TABLE usuarios (

id INT AUTO_INCREMENT PRIMARY KEY,

nome VARCHAR(150) NOT NULL,

email VARCHAR(150) UNIQUE,

senha VARCHAR(255),

nivel ENUM('Administrador','TI','Consulta') DEFAULT 'Consulta',

ativo BOOLEAN DEFAULT TRUE,

criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);



CREATE TABLE tipos (

id INT AUTO_INCREMENT PRIMARY KEY,

nome VARCHAR(80),

prefixo VARCHAR(5),

descricao TEXT

);



CREATE TABLE setores (

id INT AUTO_INCREMENT PRIMARY KEY,

nome VARCHAR(100),

responsavel VARCHAR(100),

localizacao VARCHAR(100)

);



DROP TABLE IF EXISTS equipamentos;

CREATE TABLE equipamentos (

    id INT AUTO_INCREMENT PRIMARY KEY,

    patrimonio VARCHAR(20) UNIQUE NOT NULL,

    tipo_id INT NOT NULL,

    setor_id INT,

    marca VARCHAR(100),

    modelo VARCHAR(100),

    numero_serie VARCHAR(100),

    processador VARCHAR(150),

    memoria VARCHAR(50),

    armazenamento VARCHAR(100),

    sistema_operacional VARCHAR(100),

    patrimonio_antigo VARCHAR(30),

    observacoes TEXT,

    status ENUM(
        'Estoque',
        'Em Uso',
        'Manutenção',
        'Baixado'
    ) DEFAULT 'Estoque',

    ativo TINYINT DEFAULT 1,

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (tipo_id) REFERENCES tipos(id),
    FOREIGN KEY (setor_id) REFERENCES setores(id)

);


CREATE TABLE movimentacoes(

id INT AUTO_INCREMENT PRIMARY KEY,

equipamento_id INT,

origem INT,

destino INT,

responsavel VARCHAR(150),

motivo TEXT,

data_movimentacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY(equipamento_id) REFERENCES equipamentos(id)

);


CREATE TABLE manutencao(

id INT AUTO_INCREMENT PRIMARY KEY,

equipamento_id INT,

problema TEXT,

empresa VARCHAR(150),

valor DECIMAL(10,2),

status VARCHAR(50),

data_envio DATE,

data_retorno DATE,

FOREIGN KEY(equipamento_id) REFERENCES equipamentos(id)

);


CREATE TABLE historico(

id INT AUTO_INCREMENT PRIMARY KEY,

equipamento_id INT,

usuario VARCHAR(100),

acao VARCHAR(200),

descricao TEXT,

data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY(equipamento_id) REFERENCES equipamentos(id)

);


CREATE TABLE sequencias (

    id INT AUTO_INCREMENT PRIMARY KEY,

    prefixo VARCHAR(5) NOT NULL UNIQUE,

    ultimo_numero INT NOT NULL DEFAULT 0,

    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP

);

INSERT INTO sequencias (prefixo, ultimo_numero) VALUES

('CO',0),
('NT',0),
('MO',0),
('IM',0),
('MS',0),
('TE',0),
('SW',0),
('NB',0),
('RT',0);

CREATE TABLE historico (

    id INT AUTO_INCREMENT PRIMARY KEY,

    equipamento_id INT NOT NULL,

    acao VARCHAR(100),

    usuario VARCHAR(100),

    descricao TEXT,

    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (equipamento_id)
    REFERENCES equipamentos(id)

);