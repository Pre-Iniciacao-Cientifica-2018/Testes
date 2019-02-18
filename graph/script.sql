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

create table MEDIAS_DIARIAS(
	cod int primary key identity(1,1),
	concentracao decimal,
	data_dia date default getdate()
)
create table MEDIAS_HORARIAS(
	cod int foreign key references MEDIAS_DIARIAS(cod),
	hora int default datepart(hour,getdate()),
	concentracao decimal
)
GO
INSERT INTO PESSOA VALUES ('user', 'teste')
select * from dados
select * from MEDIAS_HORARIAS
select * from MEDIAS_DIARIAS
