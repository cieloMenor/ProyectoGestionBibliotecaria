drop database if exists biblioteca;
create database biblioteca;
use biblioteca;

create table roles(idrol integer auto_increment, rol varchar(50),primary key(idrol));

insert into roles(rol) values('admin'),('user');

create table users(id bigint auto_increment, name varchar(100),email varchar(100) unique,
created_at datetime,updated_at datetime, password varchar(200), 
token char(200), idrol integer,primary key(id), foreign key(idrol) references 
roles(idrol));

INSERT INTO `users` (`id`, `name`, `email`, `created_at`, `updated_at`, `password`, `token`, `idrol`) VALUES
(1, 'admin', 'wflatley@example.net', '2023-06-22 18:50:33', '2023-06-22 18:50:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rMsxyri7EJ',1);

create table estadolectores(idestadolector integer auto_increment,
estadolector varchar(60), primary key(idestadolector));

insert into estadolectores(estadolector) values ('SIN_LIBRO'),('DEUDOR_LIBRO'),
('MOROSO'),('SANCIONADO');


CREATE TABLE lectores( DNILector char(8),NombresLector varchar(30),ApellidosLector varchar(50),
idestadolector integer ,CorreoLector varchar(150),FechaNacLector date,
FecharegistroLector datetime,FechaUpdateLector datetime,CelularLector varchar(11),
DireccionLector varchar(100),EstadoHabLector tinyint, primary key(DNILector),
foreign key(idestadolector) references estadolectores(idestadolector));

create table autores(idautor integer auto_increment, nombresautor varchar(30),apellidosautor
varchar(50),estadoautor tinyint,fecharegistroAutor datetime,fechaupdateAutor datetime,
primary key(idautor));

create table estadolibros(idestadolibro integer auto_increment, estadolibro varchar(50),
primary key(idestadolibro));

insert into estadolibros(estadolibro) values('DISPONIBLE'),('NO_DISPONIBLE'),('MANTENIMIENTO');

create table libross(idlibro integer auto_increment,nombrelibro varchar(100),nrocopiaslibro integer,
idautor integer,idestadolibro integer,estadoHablibro tinyint,fecharegistroLibro datetime,fechaupdateLibro datetime,
primary key(idlibro), foreign key(idautor) references
autores(idautor), foreign key(idestadolibro) references estadolibros(idestadolibro));

create table tipoprestamos(idtipoprestamo integer auto_increment,tipoprestamo varchar(50),
primary key(idtipoprestamo));

insert into tipoprestamos(tipoprestamo) values('CASA'),('BIBLIOTECA');

create table estadoprestamos(idestadoprestamo integer auto_increment,estadoprestamo varchar(50),
primary key(idestadoprestamo));

insert into estadoprestamos(estadoprestamo) values ('REGISTRADO'),('ENTREGADO'),('ANULADO'),('VENCIDO'),('FINALIZADO');

create table prestamos(idprestamo integer auto_increment, fecharegistroPrestamo datetime,
fechaupdatePrestamo datetime,fechaDevolucionEsperadaP date,horaDevolucionEsperadaP time,DNILector char(8),
observacionesPrestamo varchar(300), idtipoprestamo integer, idestadoprestamo integer,estadoHabprestamo tinyint,
primary key(idprestamo), foreign key(idtipoprestamo) references tipoprestamos(idtipoprestamo),
foreign key(DNILector) references lectores(DNILector),foreign key(idestadoprestamo) references 
estadoprestamos(idestadoprestamo));

create table estadodetalleprestamos(idestadodetalleprestamo integer auto_increment,
estadodetalleprestamo varchar(50),primary key(idestadodetalleprestamo));

insert into estadodetalleprestamos(estadodetalleprestamo) values('PENDIENTE'),('DEVUELTO');

create table detalleprestamos(idprestamo integer,idlibro integer,nrocopiasprestamo integer,
nombrelibro varchar(100), idestadodetalleprestamo integer,
primary key(idprestamo,idlibro),foreign key(idprestamo) references
prestamos(idprestamo), foreign key(idlibro) references libross(idlibro));


