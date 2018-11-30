CREATE DATABASE TESTE
go
USE TESTE
go
CREATE TABLE PESSOA (
	id int identity(1,1),
	usu varchar(40),
	senha varchar(40)
)
GO
INSERT INTO PESSOA VALUES ('user', 'teste')