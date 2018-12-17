use master
go
IF EXISTS (SELECT name FROM master.dbo.sysdatabases WHERE name = 'TESTE')
	DROP DATABASE TESTE

CREATE DATABASE TESTE
GO
USE TESTE
CREATE TABLE PESSOA (
	id int identity(1,1),
	usu varchar(40),
	senha varchar(40)
)
GO
CREATE TABLE DADOS (
	concentracao decimal
)
GO
INSERT INTO PESSOA VALUES ('user', 'teste')
GO
INSERT INTO DADOS VALUES (12.0),(20.0),(25.0),(17.0),(22.0),(11.0)
