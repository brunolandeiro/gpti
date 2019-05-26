create database gpti;
use gpti;
create table gpti_users (id int auto_increment primary key,name varchar(255),email varchar(255),password varchar(255),updated_at datetime,created_at datetime,remember_token varchar(255),email_verified_at datetime);
CREATE TABLE  cliente (CPF VARCHAR(11), NOME VARCHAR(50), DESCRICAO VARCHAR(255), PRIMARY KEY (CPF));

create table  processo
   (	cod_proc varchar(3), 
	nome varchar(30), 
	descricao varchar(500), 
	 primary key (cod_proc)
   );

create table  area
   (	cod_area varchar(2), 
	nome varchar(30), 
	descricao varchar(500), 
	 primary key (cod_area)
   );

create table  etapa 
   (	cod_etapa varchar(4), 
	cod_proc varchar(3), 
	cod_area varchar(2), 
	nome varchar(30), 
	descricao varchar(500), 
	primary key (cod_etapa),
	foreign key (cod_proc) references processo(cod_proc),
	foreign key (cod_area) references area(cod_area)
   );

create table  projeto 
   (	cod_projeto varchar(4), 
	nome varchar(30), 
	descricao varchar(500), 
	cpf varchar(11), 
	primary key (cod_projeto),
	foreign key (cpf) references cliente(cpf)
   );

create table  fase
   (	cod_fase varchar(4), 
	dt_ini varchar(10), 
	dt_fim varchar(10), 
	descricao varchar(500), 
	cod_projeto varchar(4), 
	cod_proc varchar(3), 
	 primary key (cod_fase),
	foreign key (cod_proc ) references processo(cod_proc),
	foreign key (cod_projeto) references projeto(cod_projeto)
   );

create table efs
(	cod_efs varchar(5),
	nome varchar(100),
	descricao varchar(200),
	primary key (cod_efs)
);

create table efs_etapa
(	cod_efs varchar(5),
	cod_etapa varchar(4),
	tipo varchar(10),
	primary key(cod_efs, cod_etapa),
	foreign key(cod_efs) references efs(cod_efs),
	foreign key(cod_etapa) references etapa(cod_etapa)
);
