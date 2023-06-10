CREATE TABLE api_cliente (
  id int auto_increment,
  documento varchar(30) not null unique,
  tipo_documento varchar(10) not null,
  nome varchar(200) not null,
  telefone varchar(30) null,
  cep varchar(20) null,
  endereco varchar(300) null,
  endereco_numero int null,
  bairro varchar(200) null,
  cidade varchar(200) null,
  estado char(2) null,
  primary key(id)
);

CREATE TABLE api_item (
  id int auto_increment,
  codigo_item int unique,
  nome varchar(200) null,
  descricao varchar(200) null,
  imagem varchar(300) null,
  tipo int null,
  tipo_descricao varchar(100) null,
  primary key(id)
);

CREATE TABLE api_transacao_item (
  id int auto_increment,
  item_id int not null,
  cliente_id int not null,
  data_transacao date null,
  codigo_transacao varchar(20) not null,
  quantidade numeric null,
  primary key(id),
  foreign key (cliente_id) references api_cliente(id),
  foreign key (item_id) references api_item(id)
);