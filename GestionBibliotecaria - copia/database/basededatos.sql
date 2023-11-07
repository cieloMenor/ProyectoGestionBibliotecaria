-- drop database if exists biblioteca;
-- create database biblioteca;
-- use biblioteca;

-- create table roles(idrol integer auto_increment, rol varchar(50),primary key(idrol));

-- insert into roles(rol) values('admin'),('user');

-- create table users(id bigint auto_increment, name varchar(100),email varchar(100) unique,
-- created_at datetime,updated_at datetime, password varchar(200), 
-- token char(200), idrol integer,primary key(id), foreign key(idrol) references 
-- roles(idrol));

-- INSERT INTO `users` (`id`, `name`, `email`, `created_at`, `updated_at`, `password`, `token`, `idrol`) VALUES
-- (1, 'admin', 'wflatley@example.net', '2023-06-22 18:50:33', '2023-06-22 18:50:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rMsxyri7EJ',1);

-- create table estadolectores(idestadolector integer auto_increment,
-- estadolector varchar(60), primary key(idestadolector));

-- insert into estadolectores(estadolector) values ('SIN_LIBRO'),('DEUDOR_LIBRO'),
-- ('MOROSO'),('SANCIONADO');


-- CREATE TABLE lectores( DNILector char(8),NombresLector varchar(30),ApellidosLector varchar(50),
-- idestadolector integer ,CorreoLector varchar(150),FechaNacLector date,
-- FecharegistroLector datetime,FechaUpdateLector datetime,CelularLector varchar(11),
-- DireccionLector varchar(100),EstadoHabLector tinyint, EstadoEliminadoLector tinyint,primary key(DNILector),
-- foreign key(idestadolector) references estadolectores(idestadolector));

-- INSERT INTO `lectores` (`DNILector`, `NombresLector`, `ApellidosLector`, `idestadolector`, `CorreoLector`, `FechaNacLector`, `FecharegistroLector`, `FechaUpdateLector`, `CelularLector`, `DireccionLector`, `EstadoHabLector`,`EstadoEliminadoLector`) VALUES
-- ('19257821', 'Maria Magdalena', 'Saavedra Chalán', 1, 'maria1@gmail.com', '2002-05-18', '2023-06-24 16:33:20', '2023-06-24 16:33:20', '985687854', 'Las palmeras', 1,1),
-- ('74970694', 'Cielo Yamile', 'Menor Saavedra', 1, 'cmenorsaavedra@gmail.com', '2000-05-18', '2023-06-24 06:18:45', '2023-06-24 06:18:45', '929869004', 'Las Palmeras', 1,1),
-- ('78963653', 'Margot Felicita', 'Sanchez Valdez', 1, 'margot@gmail.com', '1999-06-18', '2023-06-24 17:17:00', '2023-06-24 20:02:04', '963652369', 'Las Palmeras', 0,1);


-- create table autores(idautor integer auto_increment, nombresautor varchar(30),apellidosautor
-- varchar(50),estadoautor tinyint,fecharegistroAutor datetime,fechaupdateAutor datetime,
-- primary key(idautor));

-- INSERT INTO `autores` (`nombresautor`, `apellidosautor`, `estadoautor`, `fecharegistroAutor`, `fechaupdateAutor`) VALUES
-- ('Pablo', 'Villanueva Flores', 1, '2023-06-25 01:02:20', '2023-06-25 01:02:20');


-- create table estadolibros(idestadolibro integer auto_increment, estadolibro varchar(50),
-- primary key(idestadolibro));

-- insert into estadolibros(estadolibro) values('DISPONIBLE'),('NO_DISPONIBLE'),('MANTENIMIENTO');

-- create table libross(idlibro integer auto_increment,nombrelibro varchar(100),nrocopiaslibro integer,
-- idautor integer,idestadolibro integer,estadoHablibro tinyint,fecharegistroLibro datetime,fechaupdateLibro datetime,
-- stocklibro integer,primary key(idlibro), foreign key(idautor) references
-- autores(idautor), foreign key(idestadolibro) references estadolibros(idestadolibro));

-- INSERT INTO `libross` (`nombrelibro`, `nrocopiaslibro`, `idautor`, `idestadolibro`, `estadoHablibro`, `fecharegistroLibro`, `fechaupdateLibro`, `stocklibro`) VALUES
-- ('Ingenieria de Datos', 100, 1, 1, 1, '2023-06-25 01:03:17', '2023-06-25 01:03:17', 100);

-- create table tipoprestamos(idtipoprestamo integer auto_increment,tipoprestamo varchar(50),
-- primary key(idtipoprestamo));

-- insert into tipoprestamos(tipoprestamo) values('CASA'),('BIBLIOTECA');

-- create table estadoprestamos(idestadoprestamo integer auto_increment,estadoprestamo varchar(50),
-- primary key(idestadoprestamo));

-- insert into estadoprestamos(estadoprestamo) values ('REGISTRADO'),('ENTREGADO'),('ANULADO'),('VENCIDO'),('FINALIZADO');

-- create table prestamos(idprestamo integer auto_increment, fecharegistroPrestamo datetime,
-- fechaupdatePrestamo datetime,fechaDevolucionEsperadaP date,horaDevolucionEsperadaP time,DNILector char(8),
-- observacionesPrestamo varchar(300), idtipoprestamo integer, idestadoprestamo integer,estadoHabprestamo tinyint,
-- primary key(idprestamo), foreign key(idtipoprestamo) references tipoprestamos(idtipoprestamo),
-- foreign key(DNILector) references lectores(DNILector),foreign key(idestadoprestamo) references 
-- estadoprestamos(idestadoprestamo));

-- create table estadodetalleprestamos(idestadodetalleprestamo integer auto_increment,
-- estadodetalleprestamo varchar(50),primary key(idestadodetalleprestamo));

-- insert into estadodetalleprestamos(estadodetalleprestamo) values('REGISTRADO','PENDIENTE'),('DEVUELTO');

-- create table detalleprestamos(idprestamo integer,idlibro integer,nrocopiasprestamo integer,
-- nombrelibro varchar(100), idestadodetalleprestamo integer,
-- primary key(idprestamo,idlibro),foreign key(idprestamo) references
-- prestamos(idprestamo), foreign key(idlibro) references libross(idlibro),foreign key(idestadodetalleprestamo)
-- references estadodetalleprestamos(idestadodetalleprestamo));



/* ---------------------------------------------------- */
/*  Generated by Enterprise Architect Version 15.0 		*/
/*  Created On : 13-jul.-2023 23:21:51 				*/
/*  DBMS       : MySql 						*/
/* ---------------------------------------------------- */
create database biblioteca;
use biblioteca;
SET FOREIGN_KEY_CHECKS=0
; 
/* Drop Tables */

DROP TABLE IF EXISTS `Autor` CASCADE
;

DROP TABLE IF EXISTS `Bibliotecario` CASCADE
;

DROP TABLE IF EXISTS `Categoria` CASCADE
;

DROP TABLE IF EXISTS `Comprobante_pago` CASCADE
;

DROP TABLE IF EXISTS `Detalle_pedido` CASCADE
;

DROP TABLE IF EXISTS `Libro` CASCADE
;

DROP TABLE IF EXISTS `Libro_autor` CASCADE
;

DROP TABLE IF EXISTS `Pedido` CASCADE
;

DROP TABLE IF EXISTS `Proveedor` CASCADE
;

/* Create Tables */

CREATE TABLE `Autor`
(
	`Nombre` INT NULL,
	`AutorID` INT NOT NULL,
	CONSTRAINT `PK_Autor` PRIMARY KEY (`AutorID` ASC)
)

;

CREATE TABLE `Bibliotecario`
(
	`Correoelectronico` VARCHAR(50) NULL,
	`Direccion` VARCHAR(50) NULL,
	`Dni` CHAR(8) NULL,
	`Nombre` VARCHAR(50) NULL,
	`Telefono` VARCHAR(50) NULL,
	`BibliotecarioID` INT NOT NULL,
	CONSTRAINT `PK_Bibliotecario` PRIMARY KEY (`BibliotecarioID` ASC)
)

;

CREATE TABLE `Categoria`
(
	`Descripcion` VARCHAR(50) NULL,
	`LibroID` INT NOT NULL,
	`CategoriaID` INT NOT NULL,
	CONSTRAINT `PK_Categoria` PRIMARY KEY (`CategoriaID` ASC)
)

;

CREATE TABLE `Comprobante_pago`
(
	`Descuento` DECIMAL(10,2) NULL,
	`Fecha` DATE NULL,
	`Monto` DECIMAL(10,2) NULL,
	`Montototal` DECIMAL(10,2) NULL,
	`Tipocomprobante` VARCHAR(50) NULL,
	`Comprobante_pagoID` INT NOT NULL,
	`PedidoID` INT NOT NULL,
	CONSTRAINT `PK_Comprobante_pago` PRIMARY KEY (`Comprobante_pagoID` ASC)
)

;

CREATE TABLE `Detalle_pedido`
(
	`Cantidad` INT NULL,
	`PedidoID` INT NOT NULL,
	`Detalle_pedidoID` INT NOT NULL,
	`LibroID` INT NOT NULL,
	CONSTRAINT `PK_Detalle_pedido` PRIMARY KEY (`Detalle_pedidoID` ASC)
)

;

CREATE TABLE `Libro`
(
	`Añopublicacion` INT NULL,
	`Editorial` VARCHAR(50) NULL,
	`Idioma` VARCHAR(50) NULL,
	`Isbn` VARCHAR(50) NULL,
	`Paginas` INT NULL,
	`Precio` DECIMAL(10,2) NULL,
	`Stock` INT NULL,
	`Titulo` VARCHAR(50) NULL,
	`LibroID` INT NOT NULL,
    `Edicionlibro` INT NULL,
	`Estadohablibro` BIT(1) NULL,
	`Fecharegistrolibro` DATETIME NULL,
	`Fechaupdatelibro` DATETIME NULL,
	`Nrocopiaslibro` INT NULL,
	`Stocklibro` INT NULL,
	`Estado_libroID` INT NOT NULL,
	CONSTRAINT `PK_Libro` PRIMARY KEY (`LibroID` ASC)
)

;

CREATE TABLE `Libro_autor`
(
	`AutorID` INT NOT NULL,
	`Libro_autorID` INT NOT NULL,
	`LibroID` INT NOT NULL,
	CONSTRAINT `PK_Libro_autor` PRIMARY KEY (`Libro_autorID` ASC)
)

;

CREATE TABLE `Pedido`
(
	`Fecha` DATE NULL,
	`BibliotecarioID` INT NOT NULL,
	`PedidoID` INT NOT NULL,
	`ProveedorID` INT NOT NULL,
	CONSTRAINT `PK_Pedido` PRIMARY KEY (`PedidoID` ASC)
)

;

CREATE TABLE `Proveedor`
(
	`Correoelectronico` VARCHAR(30) NULL,
	`Direccion` VARCHAR(50) NULL,
	`Empresa` VARCHAR(50) NULL,
	`ProveedorID` INT NOT  NULL,
	`Telefono` VARCHAR(12)  NULL ,
	CONSTRAINT `PK_Proveedor` PRIMARY KEY (`ProveedorID` ASC)
)

;

/* Create Foreign Key Constraints */

ALTER TABLE `Categoria` 
 ADD CONSTRAINT `FK_Categoria_Libro`
	FOREIGN KEY (`LibroID`) REFERENCES `Libro` (`LibroID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Comprobante_pago` 
 ADD CONSTRAINT `FK_Comprobante_pago_Pedido`
	FOREIGN KEY (`PedidoID`) REFERENCES `Pedido` (`PedidoID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Detalle_pedido` 
 ADD CONSTRAINT `FK_Detalle_pedido_Pedido`
	FOREIGN KEY (`PedidoID`) REFERENCES `Pedido` (`PedidoID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Detalle_pedido` 
 ADD CONSTRAINT `FK_Detalle_pedido_Libro`
	FOREIGN KEY (`LibroID`) REFERENCES `Libro` (`LibroID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Libro_autor` 
 ADD CONSTRAINT `FK_Libro_autor_Autor`
	FOREIGN KEY (`AutorID`) REFERENCES `Autor` (`AutorID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Libro_autor` 
 ADD CONSTRAINT `FK_Libro_autor_Libro`
	FOREIGN KEY (`LibroID`) REFERENCES `Libro` (`LibroID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Pedido` 
 ADD CONSTRAINT `FK_Pedido_Bibliotecario`
	FOREIGN KEY (`BibliotecarioID`) REFERENCES `Bibliotecario` (`BibliotecarioID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Pedido` 
 ADD CONSTRAINT `FK_Pedido_Proveedor`
	FOREIGN KEY (`ProveedorID`) REFERENCES `Proveedor` (`ProveedorID`) ON DELETE No Action ON UPDATE No Action
;

/*MI PARTE: CIELO*/

/* Drop Tables */

DROP TABLE IF EXISTS `Cdp` CASCADE
;

DROP TABLE IF EXISTS `Cdp_detalle` CASCADE
;

DROP TABLE IF EXISTS `Devolucion` CASCADE
;

DROP TABLE IF EXISTS `Devolucion_detalle` CASCADE
;

DROP TABLE IF EXISTS `Estado_detalle_prestamo` CASCADE
;

DROP TABLE IF EXISTS `Estado_lector` CASCADE
;

DROP TABLE IF EXISTS `Estado_libro` CASCADE
;

DROP TABLE IF EXISTS `Estado_multa_lector` CASCADE
;

DROP TABLE IF EXISTS `Estado_prestamo` CASCADE
;

DROP TABLE IF EXISTS `Lector` CASCADE
;

DROP TABLE IF EXISTS `Mantenimiento_libros` CASCADE
;

DROP TABLE IF EXISTS `Multa` CASCADE
;

DROP TABLE IF EXISTS `Multa_lector` CASCADE
;

DROP TABLE IF EXISTS `Permiso` CASCADE
;

DROP TABLE IF EXISTS `Prestamo` CASCADE
;

DROP TABLE IF EXISTS `Prestamo_detalle` CASCADE
;

DROP TABLE IF EXISTS `Rol` CASCADE
;

DROP TABLE IF EXISTS `Rol_permiso` CASCADE
;

DROP TABLE IF EXISTS `Servicio` CASCADE
;

DROP TABLE IF EXISTS `Tipo_documento` CASCADE
;

DROP TABLE IF EXISTS `Tipo_prestamo` CASCADE
;

DROP TABLE IF EXISTS `users` CASCADE
;

/* Create Tables */


CREATE TABLE `Cdp`
(
	`Cdp_fechapago` DATETIME NULL,
	`Cdp_total` DOUBLE(10,2) NULL,
	`CdpID` INT NOT NULL,
	`Tipo_documentoID` INT NOT NULL,
	`LectorID` INT NOT NULL,
	`descuentoCdp` DOUBLE(10,2) NULL,
	CONSTRAINT `PK_Cdp` PRIMARY KEY (`CdpID` ASC)
)

;

CREATE TABLE `Cdp_detalle`
(
	`Estadoeliminadodetalle` varchar(25) NULL,
	`Montopagado` DOUBLE(10,2) NULL,
	`Cdp_detalleID` INT NOT NULL,
	`CdpID` INT NOT NULL,
	`Multa_lectorID` INT NOT NULL,
	CONSTRAINT `PK_Cdp_detalle` PRIMARY KEY (`Cdp_detalleID` ASC)
)

;

CREATE TABLE `Devolucion`
(
	`Conmulta` BIT(1) NULL,
	`Dev_observaciones` VARCHAR(50) NULL,
	`Estadohabdevolución` BIT(1) NULL,
	`Fechainiciodevolucion` DATETIME NULL,
	`PrestamoID` INT NULL,
	`Restantetiempodevolución` DATETIME NULL,
	`DevolucionID` INT NOT NULL,
	CONSTRAINT `PK_Devolucion` PRIMARY KEY (`DevolucionID` ASC)
)

;

CREATE TABLE `Devolucion_detalle`
(
	`Estadodevolucion` BIT(1) NULL,
	`Fechadevolucionlibro` DATETIME NULL,
	`Nrocopiasdevolucion` INT NULL,
	`Devolucion_detalleID` INT NOT NULL,
	`DevolucionID` INT NOT NULL,
	`LibroID` INT NOT NULL,
	CONSTRAINT `PK_Devolucion_detalle` PRIMARY KEY (`Devolucion_detalleID` ASC)
)

;

CREATE TABLE `Estado_detalle_prestamo`
(
	`Estadodetalleprestamo` VARCHAR(30) NULL,
	`Estado_detalle_prestamoID` INT NOT NULL,
	CONSTRAINT `PK_Estado_detalle_prestamo` PRIMARY KEY (`Estado_detalle_prestamoID` ASC)
)

;

CREATE TABLE `Estado_lector`
(
	`Estadolector` VARCHAR(30) NULL,
	`Estado_lectorID` INT NOT NULL,
	CONSTRAINT `PK_Estado_lector` PRIMARY KEY (`Estado_lectorID` ASC)
)

;

CREATE TABLE `Estado_libro`
(
	`Estadolibro` VARCHAR(30) NULL,
	`Estado_libroID` INT NOT NULL,
	CONSTRAINT `PK_Estado_libro` PRIMARY KEY (`Estado_libroID` ASC)
)

;

CREATE TABLE `Estado_multa_lector`
(
	`Estadomultalector` VARCHAR(30) NULL,
	`Estado_multa_lectorID` INT NOT NULL,
	CONSTRAINT `PK_Estado_multa_lector` PRIMARY KEY (`Estado_multa_lectorID` ASC)
)

;

CREATE TABLE `Estado_prestamo`
(
	`Estadoprestamo` VARCHAR(30) NULL,
	`Estado_prestamoID` INT NOT NULL,
	CONSTRAINT `PK_Estado_prestamo` PRIMARY KEY (`Estado_prestamoID` ASC)
)

;

CREATE TABLE `Lector`
(
	`Apellidoslector` VARCHAR(50) NULL,
	`Celularlector` CHAR(9) NULL,
	`Correolector` VARCHAR(100) NULL,
	`Direccionlector` varchar(100) NULL,
	`Dni_lector` CHAR(9) NULL,
	`Estadoeliminadolector` BIT(1) NULL,
	`Estadohablector` BIT(1) NULL,
	`Fechanaclector` DATE NULL,
	`Fecharegistrolector` DATETIME NULL,
	`Fechaupdatelector` DATETIME NULL,
	`Nombreslector` VARCHAR(50) NULL,
	`LectorID` INT NOT NULL,
	`Estado_lectorID` INT NOT NULL,
	CONSTRAINT `PK_Lector` PRIMARY KEY (`LectorID` ASC)
)

;


CREATE TABLE `Mantenimiento_libros`
(
	`Codigolibrounidad` CHAR(15) NULL,
	`Man_estadohab` BIT(1) NULL,
	`Man_fecharegistro` DATETIME NULL,
	`Man_fechaupdate` DATETIME NULL,
	`Man_observaciones` VARCHAR(100) NULL,
	`Man_problemas` VARCHAR(100) NULL,
	`Mantenimiento_librosID` INT NOT NULL,
	`Devolucion_detalleID` INT NOT NULL,
	CONSTRAINT `PK_Mantenimiento_libros` PRIMARY KEY (`Mantenimiento_librosID` ASC)
)

;

CREATE TABLE `Multa`
(
	`Descripcionmulta` VARCHAR(50) NULL,
	`Estadomultahab` BIT(1) NULL,
	`Fecharegistromulta` DATETIME NULL,
	`Fechaupdatemulta` DATETIME NULL,
	`Porcentajemulta` DOUBLE(10,2) NULL,
	`MultaID` INT NOT NULL,
	CONSTRAINT `PK_Multa` PRIMARY KEY (`MultaID` ASC)
)

;

CREATE TABLE `Multa_lector`
(
	`Descripcionmultalector` VARCHAR(50) NULL,
	`Estadohabmultalector` varchar(50) NULL,
	`FechamultaLector` DATETIME NULL,
	`MontoMultaLector` DECIMAL(10,2) NULL,
	`Multa_lectorID` INT NOT NULL,
	`DevolucionID` INT NOT NULL,
	`Estado_multa_lectorID` INT NOT NULL,
	`MultaID` INT NOT NULL,
	`ServicioID` INT NOT NULL,
	CONSTRAINT `PK_Multa_lector` PRIMARY KEY (`Multa_lectorID` ASC)
)

;

CREATE TABLE `Permiso`
(
	`Estadopermiso` BIT(1) NULL,
	`Permiso` VARCHAR(50) NULL,
	`PermisoID` INT NOT NULL,
	CONSTRAINT `PK_Permiso` PRIMARY KEY (`PermisoID` ASC)
)

;

CREATE TABLE `Prestamo`
(
	`Estadohabprestamo` BIT(1) NULL,
	`Fechadevolucionesperadap` DATE NULL,
	`Fechaentregaprestamo` DATETIME NULL,
	`Fecharegistroprestamo` DATETIME NULL,
	`Fechaupdateprestamo` DATETIME NULL,
	`Horadevolucionesperadap` TIME NULL,
	`Observacionesprestamo` VARCHAR(80) NULL,
	`PrestamoID` INT NOT NULL,
	`Estado_prestamoID` INT NOT NULL,
	`LectorID` INT NOT NULL,
	`Tipo_prestamoID` INT NOT NULL,
	CONSTRAINT `PK_Prestamo` PRIMARY KEY (`PrestamoID` ASC)
)

;

CREATE TABLE `Prestamo_detalle`
(
	`Estadohabdetalleprestamo` BIT(1) NULL,
	`Nombrelibro` VARCHAR(100) NULL,
	`Nrocopiasprestamo` INT NULL,
	`Prestamo_detalleID` INT NOT NULL,
	`Estado_detalle_prestamoID` INT NOT NULL,
	`LibroID` INT NOT NULL,
	`PrestamoID` INT NOT NULL,
	CONSTRAINT `PK_Prestamo_detalle` PRIMARY KEY (`Prestamo_detalleID` ASC)
)

;

CREATE TABLE `Rol`
(
	`Descripcionrol` VARCHAR(50) NULL,
	`Estadorol` BIT(1) NULL,
	`fechaRegistroRol` DATETIME NULL,
	`RolID` INT NOT NULL,
	`fechaUpdateRol` DATETIME NULL,
	CONSTRAINT `PK_Rol` PRIMARY KEY (`RolID` ASC)
)

;

CREATE TABLE `Rol_permiso`
(
	`Rol_permisoID` INT NOT NULL,
	`RolID` INT NULL,
	`PermisoID` INT NULL,
	CONSTRAINT `PK_Rol_permiso` PRIMARY KEY (`Rol_permisoID` ASC)
)

;

CREATE TABLE `Servicio`
(
	`Servicio` VARCHAR(50) NULL,
	`ServicioID` INT NOT NULL,
	CONSTRAINT `PK_Servicio` PRIMARY KEY (`ServicioID` ASC)
)

;

CREATE TABLE `Tipo_documento`
(
	`Tipodoc_estadoeliminado` BIT(1) NULL,
	`Tipodoc_estadohab` BIT(1) NULL,
	`Tipodoc_formatoimpresion` VARCHAR(15) NULL,
	`Tipodocumento` VARCHAR(50) NULL,
	`Tipo_documentoID` INT NOT NULL,
	CONSTRAINT `PK_Tipo_documento` PRIMARY KEY (`Tipo_documentoID` ASC)
)

;

CREATE TABLE `Tipo_prestamo`
(
	`Tipoprestamo` VARCHAR(50) NULL,
	`Tipo_prestamoID` INT NOT NULL,
	CONSTRAINT `PK_Tipo_prestamo` PRIMARY KEY (`Tipo_prestamoID` ASC)
)

;

CREATE TABLE `users`
(
	`Apellidosusuario` VARCHAR(50) NULL,
	`Celularusuario` CHAR(9) NULL,
	`password` VARCHAR(200) NULL,
	`Correousuario` VARCHAR(100) NULL,
	`Estadousuario` BIT(1) NULL,
	`Nombresusuario` VARCHAR(50) NULL,
	`Usuario` VARCHAR(50) NULL,
	`UsuarioID` INT  NOT NULL,
	`RolID` INT NOT NULL,
	`token` CHAR(200) NULL,
    `created_at` datetime NULL,
    `updated_at` datetime NULL,
	CONSTRAINT `PK_Usuario` PRIMARY KEY (`UsuarioID` ASC)
)

;

/* Create Primary Keys, Indexes, Uniques, Checks */

ALTER TABLE `Prestamo` 
 ADD INDEX `IXFK_PRESTAMO_asocia` (`LectorID` ASC)
;

/* Create Foreign Key Constraints */

ALTER TABLE `Cdp` 
 ADD CONSTRAINT `FK_CDP_pertenece`
	FOREIGN KEY (`Tipo_documentoID`) REFERENCES `Tipo_documento` (`Tipo_documentoID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Cdp` 
 ADD CONSTRAINT `FK_CDP_tiene`
	FOREIGN KEY (`LectorID`) REFERENCES `Lector` (`LectorID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Cdp_detalle` 
 ADD CONSTRAINT `FK_CDP_DETALLE_contiene`
	FOREIGN KEY (`CdpID`) REFERENCES `Cdp` (`CdpID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Cdp_detalle` 
 ADD CONSTRAINT `FK_CDP_DETALLE_asocia`
	FOREIGN KEY (`Multa_lectorID`) REFERENCES `Multa_lector` (`Multa_lectorID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Devolucion_detalle` 
 ADD CONSTRAINT `FK_DEVOLUCION_DETALLE_contiene`
	FOREIGN KEY (`DevolucionID`) REFERENCES `Devolucion` (`DevolucionID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Devolucion_detalle` 
 ADD CONSTRAINT `FK_DEVOLUCION_DETALLE_relaciona`
	FOREIGN KEY (`LibroID`) REFERENCES `Libro` (`LibroID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Lector` 
 ADD CONSTRAINT `FK_LECTOR_tiene`
	FOREIGN KEY (`Estado_lectorID`) REFERENCES `Estado_lector` (`Estado_lectorID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Libro` 
 ADD CONSTRAINT `FK_LIBROO_tiene`
	FOREIGN KEY (`Estado_libroID`) REFERENCES `Estado_libro` (`Estado_libroID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Mantenimiento_libros` 
 ADD CONSTRAINT `FK_MANTENIMIENTO_LIBROS_relaciona`
	FOREIGN KEY (`Devolucion_detalleID`) REFERENCES `Devolucion_detalle` (`Devolucion_detalleID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Multa_lector` 
 ADD CONSTRAINT `FK_MULTA_LECTOR_asocia`
	FOREIGN KEY (`DevolucionID`) REFERENCES `Devolucion` (`DevolucionID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Multa_lector` 
 ADD CONSTRAINT `FK_MULTA_LECTOR_tiene`
	FOREIGN KEY (`Estado_multa_lectorID`) REFERENCES `Estado_multa_lector` (`Estado_multa_lectorID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Multa_lector` 
 ADD CONSTRAINT `FK_MULTA_LECTOR_relaciona`
	FOREIGN KEY (`MultaID`) REFERENCES `Multa` (`MultaID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Multa_lector` 
 ADD CONSTRAINT `FK_MULTA_LECTOR_pertenece`
	FOREIGN KEY (`ServicioID`) REFERENCES `Servicio` (`ServicioID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Devolucion` 
 ADD CONSTRAINT `FK_DEVOLUCION_devuelve`
	FOREIGN KEY (`PrestamoID`) REFERENCES `Prestamo` (`PrestamoID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Prestamo` 
 ADD CONSTRAINT `FK_PRESTAMO_tiene`
	FOREIGN KEY (`Estado_prestamoID`) REFERENCES `Estado_prestamo` (`Estado_prestamoID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Prestamo` 
 ADD CONSTRAINT `FK_PRESTAMO_asocia`
	FOREIGN KEY (`LectorID`) REFERENCES `Lector` (`LectorID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Prestamo` 
 ADD CONSTRAINT `FK_PRESTAMO_pertenece`
	FOREIGN KEY (`Tipo_prestamoID`) REFERENCES `Tipo_prestamo` (`Tipo_prestamoID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Prestamo_detalle` 
 ADD CONSTRAINT `FK_PRESTAMO_DETALLE_tiene`
	FOREIGN KEY (`Estado_detalle_prestamoID`) REFERENCES `Estado_detalle_prestamo` (`Estado_detalle_prestamoID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Prestamo_detalle` 
 ADD CONSTRAINT `FK_PRESTAMO_DETALLE_relaciona`
	FOREIGN KEY (`LibroID`) REFERENCES `Libro` (`LibroID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Prestamo_detalle` 
 ADD CONSTRAINT `FK_PRESTAMO_DETALLE_contiene`
	FOREIGN KEY (`PrestamoID`) REFERENCES `Prestamo` (`PrestamoID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Rol_permiso` 
 ADD CONSTRAINT `FK_ROL_PERMISO_ROL`
	FOREIGN KEY (`RolID`) REFERENCES `Rol` (`RolID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `Rol_permiso` 
 ADD CONSTRAINT `FK_ROL_PERMISO_PERMISO`
	FOREIGN KEY (`PermisoID`) REFERENCES `Permiso` (`PermisoID`) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE `users` 
 ADD CONSTRAINT `FK_USUARIO_tiene`
	FOREIGN KEY (`RolID`) REFERENCES `Rol` (`RolID`) ON DELETE No Action ON UPDATE No Action
;

SET FOREIGN_KEY_CHECKS=1
; 




insert into rol(RolID,Descripcionrol) values(1,'ROLE_ADMIN'),(2,'ROLE_USER');
insert into Estado_libro(Estado_libroID,Estado_libro)values(001,'En stock'),(002,'Fuera de Stock');