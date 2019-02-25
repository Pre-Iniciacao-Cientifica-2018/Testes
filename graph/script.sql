use master
go
IF EXISTS (SELECT name FROM master.dbo.sysdatabases WHERE name = 'TESTE')
	DROP DATABASE TESTE

CREATE DATABASE TESTE
GO
USE TESTE
GO
CREATE TABLE PESSOA (
	id int identity(1,1),
	usu varchar(40),
	senha varchar(40)
)
GO
CREATE TABLE DADOS (
	id int identity(1,1),
	concentracao decimal,
	data_registro datetime default getdate()
)
go

create table MEDIAS_HORARIAS(
	cod int primary key identity(1,1),
	data_registro smalldatetime default getdate(),
	concentracao decimal
)
GO
INSERT INTO PESSOA VALUES ('user', 'teste')
select * from dados

select * from MEDIAS_HORARIAS

insert into MEDIAS_HORARIAS(concentracao) values(24)