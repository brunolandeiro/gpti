use gpti;
/* Areas */
insert into area (cod_area, nome, descricao) values ('A1','Custo','Custo');
insert into area (cod_area, nome, descricao) values ('A2','Escopo','Escopo');
insert into area (cod_area, nome, descricao) values ('A3','Tempo','Tempo');
insert into area (cod_area, nome, descricao) values ('A4','Risco','Risco');
insert into area (cod_area, nome, descricao) values ('A5','Qualidade','Qualidade');
insert into area (cod_area, nome, descricao) values ('A6','Recursos Humanos e Comunicação','Recursos Humanos e Comunicação');
insert into area (cod_area, nome, descricao) values ('A7','stakholders','stakholders');
/* Processos */
insert into processo (cod_proc, nome, descricao) values ('PC1','Iniciação','iniciação');
insert into processo (cod_proc, nome, descricao) values ('PC2','Planejamento','Planejamento');
insert into processo (cod_proc, nome, descricao) values ('PC3','Execução','Execução');
insert into processo (cod_proc, nome, descricao) values ('PC4','Controle','Controle');
insert into processo (cod_proc, nome, descricao) values ('PC5','Encerramento','Encerramento');
/* ETAPAS */
insert into etapa (cod_etapa, cod_proc, cod_area, nome, descricao)
values ('','','','','');
/* EFS */
insert into efs (cod_efs, nome, descricao) values ('EFS01','Fatores ambientais','Fatores ambientais');
insert into efs (cod_efs, nome, descricao) values ('EFS02','Ativos de processo','Ativos de processo');
/* EFS_ETAPA */
insert into efs_etapa (cod_efs, cod_etapa, tipo) values ('','','');
/* FASES */
insert into fase ()


Cada area tem suas etapas:
As suas etapas sao: 
planejar e controlar, Plenjar qualidade, controlar qualidade...

Quais são os EFS mais usados:
Fatores ambientais e Ativos de processo.

Fases: ideia, termo de abertura, equipe de gerenciamento, declaração de escopo, plano, linha de base, progresso, aceitação, aprovação, entrega.