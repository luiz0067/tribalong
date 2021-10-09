insert into USUARIO (USUARIO, SENHA) values('.$usuario.','.$senha.');
update usuario set  senha='.$senha.' where (codigo=.$codigo.);
delete from usuario where (codigo=.$codigo.);
select codigo,usuario,senha from usuario where (usuario='.$usuario.') and (senha='.$senha.');

insert into login (codigo_usuario, hora_inicio, data_inicio) values('.$codigo_usuario.', '.$hora_inicio.', '.$data_inicio.',);
update login set  hora_fim='.$hora_fim.', data_fim='.$data_fim.' where(codigo=.$codigo.);
delete from login where(codigo=.$codigo.);
select codigo,codigo_usuario, hora_inicio, hora_fim, data_inicio, data_fim from login where (codigo_usuario='.$codigo_usuario.') and (hora_inicio='.$hora_inicio.') and (hora_fim='.$hora_fim.') and (data_inicio='.$data_inicio.') and (data_fim='.$data_fim.');

insert into patrocinio (nome, imagem, link) values('.$nome.', '.$imagem.', '.$link.');
update patrocinio set nome='.$nome.','.$imagem.','.$link.' where (codigo='.$codigo.');
delete from patrocinio where (codigo=.$codigo.);
select codigo,nome,imagem,link from patrocinio where (nome='.$nome.') and (imagem='.$imagem.') and (link='.$link.');

create table usuario (
	codigo int auto_increment not null primary key, 
	usuario varchar (50) not null,
	senha varchar (50) not null
);
create table login (
	codigo int auto_increment not null primary key,
	codigo_usuario int not null,
	hora_inicio time not null,
	hora_fim time,
	data_inicio date not null,
	data_fim date not null
);
create table patrocinio (
	codigo int auto_increment not null primary key,
	nome varchar (50) not null,
	imagem varchar (50) not null,
	link varchar (50) not null
);
ALTER TABLE login
ADD CONSTRAINT fk_login_usuario
FOREIGN KEY (codigo_usuario)
REFERENCES usuario(codigo);

create table paginas(
codigo int not null primary key auto_increment,
nome varchar(50) not null,
conteudo blob,
data_inicio DATETIME not null,
data_fim DATETIME
)

create table video (
	codigo int auto_increment not null primary key, 
	titulo varchar (50) not null,
	video blob not null
);