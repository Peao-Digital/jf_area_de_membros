CREATE TABLE api_cliente (
  id int auto_increment,
  documento varchar(30) not null unique,
  tipo_documento varchar(10)  null,
  nome varchar(200)  null,
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
  codigo_plano_vendas int null,
  codigo_plano_vendas_desc varchar(40) null,
  data_transacao date null,
  codigo_transacao varchar(20) not null,
  quantidade numeric null,
  liberado char(1) null,
  primary key(id),
  foreign key (cliente_id) references api_cliente(id),
  foreign key (item_id) references api_item(id)
);

CREATE TABLE api_log (
  id int auto_increment,
  descricao text,
  erro text,
  criado_em timestamp default current_timestamp()
  primary key(id)
);

insert into api_item (codigo_item, nome) values ('36673','MAPA DA RIQUEZA');
insert into api_item (codigo_item, nome) values ('76587','Comunidade da Riqueza (SEMESTRAL)');
insert into api_item (codigo_item, nome) values ('76204','Comunidade da Riqueza (ANUAL)');
insert into api_item (codigo_item, nome) values ('71102','MÉTODO: Ganhe mais dinheiro com as suas finanças');