CREATE DATABASE IF NOT EXISTS sigep
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE sigep;

-- =========================================================
-- TABELA: USUARIOS
-- =========================================================

CREATE TABLE IF NOT EXISTS usuarios (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nome VARCHAR(150) NOT NULL,

    usuario VARCHAR(100) NOT NULL UNIQUE,

    senha VARCHAR(255) NOT NULL,

    perfil ENUM(
        'Administrador',
        'TI',
        'Usuario'
    ) DEFAULT 'Usuario',

    ativo TINYINT(1) DEFAULT 1,

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP

) ENGINE=InnoDB;


-- =========================================================
-- TABELA: TIPOS
-- =========================================================

CREATE TABLE IF NOT EXISTS tipos (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nome VARCHAR(100) NOT NULL,

    prefixo VARCHAR(5) NOT NULL UNIQUE,

    descricao TEXT,

    ativo TINYINT(1) DEFAULT 1,

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP

) ENGINE=InnoDB;


-- =========================================================
-- TABELA: SETORES
-- =========================================================

CREATE TABLE IF NOT EXISTS setores (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nome VARCHAR(150) NOT NULL,

    descricao TEXT,

    ativo TINYINT(1) DEFAULT 1,

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP

) ENGINE=InnoDB;


-- =========================================================
-- TABELA: SEQUENCIAS
-- Controla o último patrimônio de cada tipo
-- =========================================================

CREATE TABLE IF NOT EXISTS sequencias (

    id INT AUTO_INCREMENT PRIMARY KEY,

    prefixo VARCHAR(5) NOT NULL UNIQUE,

    ultimo_numero INT NOT NULL DEFAULT 0,

    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP

) ENGINE=InnoDB;


-- =========================================================
-- TABELA: EQUIPAMENTOS
-- =========================================================

CREATE TABLE IF NOT EXISTS equipamentos (

    id INT AUTO_INCREMENT PRIMARY KEY,

    patrimonio VARCHAR(20) NOT NULL UNIQUE,

    tipo_id INT NOT NULL,

    setor_id INT NULL,

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

    ativo TINYINT(1) DEFAULT 1,

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_equipamento_tipo
        FOREIGN KEY (tipo_id)
        REFERENCES tipos(id),

    CONSTRAINT fk_equipamento_setor
        FOREIGN KEY (setor_id)
        REFERENCES setores(id)

) ENGINE=InnoDB;


-- =========================================================
-- TABELA: HISTORICO
-- Guarda todas as ações realizadas nos equipamentos
-- =========================================================

CREATE TABLE IF NOT EXISTS historico (

    id INT AUTO_INCREMENT PRIMARY KEY,

    equipamento_id INT NOT NULL,

    acao VARCHAR(100) NOT NULL,

    usuario VARCHAR(100),

    descricao TEXT,

    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_historico_equipamento
        FOREIGN KEY (equipamento_id)
        REFERENCES equipamentos(id)

) ENGINE=InnoDB;


-- =========================================================
-- TABELA: MOVIMENTACOES
-- Estrutura para o Dia 4
-- =========================================================

CREATE TABLE IF NOT EXISTS movimentacoes (

    id INT AUTO_INCREMENT PRIMARY KEY,

    equipamento_id INT NOT NULL,

    setor_origem_id INT NULL,

    setor_destino_id INT NULL,

    usuario_id INT NULL,

    responsavel VARCHAR(150),

    motivo VARCHAR(255),

    observacoes TEXT,

    data_movimentacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_movimentacao_equipamento
        FOREIGN KEY (equipamento_id)
        REFERENCES equipamentos(id),

    CONSTRAINT fk_movimentacao_origem
        FOREIGN KEY (setor_origem_id)
        REFERENCES setores(id),

    CONSTRAINT fk_movimentacao_destino
        FOREIGN KEY (setor_destino_id)
        REFERENCES setores(id),

    CONSTRAINT fk_movimentacao_usuario
        FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)

) ENGINE=InnoDB;


-- =========================================================
-- TABELA: MANUTENCAO
-- Estrutura para etapas futuras
-- =========================================================

CREATE TABLE IF NOT EXISTS manutencao (

    id INT AUTO_INCREMENT PRIMARY KEY,

    equipamento_id INT NOT NULL,

    tipo VARCHAR(100),

    problema TEXT,

    diagnostico TEXT,

    solucao TEXT,

    fornecedor VARCHAR(150),

    custo DECIMAL(10,2) DEFAULT 0.00,

    data_entrada DATETIME,

    data_saida DATETIME,

    status ENUM(
        'Aberta',
        'Em andamento',
        'Concluída',
        'Cancelada'
    ) DEFAULT 'Aberta',

    observacoes TEXT,

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_manutencao_equipamento
        FOREIGN KEY (equipamento_id)
        REFERENCES equipamentos(id)

) ENGINE=InnoDB;


-- =========================================================
-- TABELA: CONFIGURACOES
-- Configurações gerais do SIGEP
-- =========================================================

CREATE TABLE IF NOT EXISTS configuracoes (

    id INT AUTO_INCREMENT PRIMARY KEY,

    chave VARCHAR(100) NOT NULL UNIQUE,

    valor TEXT,

    descricao VARCHAR(255),

    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP

) ENGINE=InnoDB;


-- =========================================================
-- TIPOS PADRAO
-- =========================================================

INSERT INTO tipos
(nome, prefixo, descricao)
VALUES

('Computador', 'CO', 'Computador desktop'),

('Notebook', 'NT', 'Notebook'),

('Monitor', 'MO', 'Monitor'),

('Impressora', 'IM', 'Impressora'),

('Mouse', 'MS', 'Mouse'),

('Teclado', 'TE', 'Teclado'),

('Switch', 'SW', 'Switch de rede'),

('Nobreak', 'NB', 'Nobreak'),

('Roteador', 'RT', 'Roteador')

ON DUPLICATE KEY UPDATE
nome = VALUES(nome);


-- =========================================================
-- SEQUENCIAS PADRAO
-- =========================================================

INSERT INTO sequencias
(prefixo, ultimo_numero)
VALUES

('CO', 0),
('NT', 0),
('MO', 0),
('IM', 0),
('MS', 0),
('TE', 0),
('SW', 0),
('NB', 0),
('RT', 0)

ON DUPLICATE KEY UPDATE
prefixo = VALUES(prefixo);


-- =========================================================
-- SETORES DE TESTE
-- =========================================================

INSERT INTO setores
(nome, descricao)
VALUES

('TI', 'Tecnologia da Informação'),

('Financeiro', 'Setor Financeiro'),

('RH', 'Recursos Humanos'),

('Administrativo', 'Setor Administrativo'),

('Diretoria', 'Diretoria')

ON DUPLICATE KEY UPDATE
nome = VALUES(nome);


-- =========================================================
-- CONFIGURAÇÕES INICIAIS
-- =========================================================

INSERT INTO configuracoes
(chave, valor, descricao)
VALUES

(
    'empresa_nome',
    'Minha Empresa',
    'Nome da empresa'
),

(
    'sistema_nome',
    'SIGEP',
    'Nome do sistema'
),

(
    'patrimonio_digitos',
    '4',
    'Quantidade de dígitos dos patrimônios'
)

ON DUPLICATE KEY UPDATE
valor = VALUES(valor);