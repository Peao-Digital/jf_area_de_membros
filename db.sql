CREATE TABLE ticto_ordem (
  id int NOT NULL AUTO_INCREMENT,
  data_ordem date null,
  data_horario timestamp null,
  hash_ordem varchar(300),
  valor numeric,
  parcelas numeric,
  metodo_pagamento varchar(30),
  metodo_pagamento_desc varchar(40),
  tipo_comissao varchar(30),
  tipo_comissao_desc varchar(40),
  coletado_em timestamp default current_timestamp(),
  status varchar(30) null,
  status_desc varchar(30) null,
  PRIMARY KEY(id)
);

CREATE TABLE ticto_cliente (
  id int NOT NULL AUTO_INCREMENT,
  cpf varchar(20) null,
  cnpj varchar(20) null,
  nome varchar(255) null,
  tipo varchar(20) null,
  email varchar(255) null,
  estrangeiro char(1) null,
  ddd varchar(20) null,
  ddi varchar(20) null,
  telefone varchar(20) null,
  endereco varchar(255) null,
  endereco_numero varchar(20) null,
  endereco_complemento varchar(255) null,
  bairro varchar(255) null,
  cidade varchar(255) null,
  estado varchar(30) null,
  cep varchar(20) null,
  PRIMARY KEY(id)
);

CREATE TABLE ticto_cliente_ordem (
  cliente_id int not null,
  ordem_id int not null,
  PRIMARY KEY(cliente_id, ordem_id),
  FOREIGN KEY(cliente_id) REFERENCES ticto_cliente(id),
  FOREIGN KEY(ordem_id) REFERENCES ticto_ordem(id)
);

CREATE TABLE ticto_item (
  id int NOT NULL AUTO_INCREMENT,
  ordem_id int not null,
  nome_produto varchar(255) null,
  produto_id int null,
  nome_produto_adquirido varchar(255) null,
  oferta_id varchar(255) null,
  prazo_reembolso int null,
  cupom_id varchar(255) null,
  quantidade int null,
  preco_unidade_oferta int null,
  membro_id int null,
  membro_classe_id int null,
  dias_acesso_membros int null,
  PRIMARY KEY(id),
  FOREIGN KEY(ordem_id) REFERENCES ticto_ordem(ID)
);

CREATE TABLE ticto_logs (
  id int NOT NULL AUTO_INCREMENT,
  descricao varchar(255) not null,
  erro text null,
  horario timestamp default current_timestamp(),
  PRIMARY KEY(id)
);