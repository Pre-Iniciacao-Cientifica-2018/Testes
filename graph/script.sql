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
insert into MEDIAS_HORARIAS (concentracao,data_registro) values(31,'01-03-2019')
SELECT avg(concentracao),convert(varchar(10),data_registro,103) from MEDIAS_HORARIAS where convert(smalldatetime,data_registro,103) between '12/02/2019' and '13/04/2019' group by data_registro order by data_registro /*esse é o select de um período específico*/
SELECT avg(concentracao),convert(varchar(10),data_registro,103) from MEDIAS_HORARIAS where datepart(week,data_registro) = datepart(week,getdate()) group by data_registro order by data_registro