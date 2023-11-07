-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema bd_biblioteca
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bd_biblioteca
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bd_biblioteca` DEFAULT CHARACTER SET utf8mb4 ;
USE `bd_biblioteca` ;

-- -----------------------------------------------------
-- Table `bd_biblioteca`.`autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`autor` (
  `Nombre` INT(11) NULL DEFAULT NULL,
  `AutorID` INT(11) NOT NULL,
  PRIMARY KEY (`AutorID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`rol` (
  `Descripcionrol` VARCHAR(50) NULL DEFAULT NULL,
  `Estadorol` BIT(1) NULL DEFAULT NULL,
  `fechaRegistroRol` DATETIME NULL DEFAULT NULL,
  `RolID` INT(11) NOT NULL,
  `fechaUpdateRol` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`RolID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`users` (
  `Apellidosusuario` VARCHAR(50) NULL DEFAULT NULL,
  `Celularusuario` CHAR(9) NULL DEFAULT NULL,
  `password` VARCHAR(200) NULL DEFAULT NULL,
  `Correousuario` VARCHAR(100) NULL DEFAULT NULL,
  `Estadousuario` BIT(1) NULL DEFAULT NULL,
  `Nombresusuario` VARCHAR(50) NULL DEFAULT NULL,
  `Usuario` VARCHAR(50) NULL DEFAULT NULL,
  `UsuarioID` INT(11) NOT NULL,
  `RolID` INT(11) NOT NULL,
  `token` CHAR(200) NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `imagenusuario` VARCHAR(191) NULL DEFAULT NULL,
  PRIMARY KEY (`UsuarioID`),
  INDEX `FK_USUARIO_tiene` (`RolID` ASC),
  CONSTRAINT `FK_USUARIO_tiene`
    FOREIGN KEY (`RolID`)
    REFERENCES `bd_biblioteca`.`rol` (`RolID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`bibliotecario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`bibliotecario` (
  `Correoelectronico` VARCHAR(50) NULL DEFAULT NULL,
  `Direccion` VARCHAR(50) NULL DEFAULT NULL,
  `Dni` CHAR(8) NULL DEFAULT NULL,
  `Nombre` VARCHAR(50) NULL DEFAULT NULL,
  `Telefono` VARCHAR(50) NULL DEFAULT NULL,
  `BibliotecarioID` INT(11) NOT NULL,
  `suUsuarioID` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`BibliotecarioID`),
  INDEX `FK__Bibliotecario_user` (`suUsuarioID` ASC),
  CONSTRAINT `FK__Bibliotecario_user`
    FOREIGN KEY (`suUsuarioID`)
    REFERENCES `bd_biblioteca`.`users` (`UsuarioID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`estado_libro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`estado_libro` (
  `Estadolibro` VARCHAR(30) NULL DEFAULT NULL,
  `Estado_libroID` INT(11) NOT NULL,
  PRIMARY KEY (`Estado_libroID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`libro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`libro` (
  `Añopublicacion` INT(11) NULL DEFAULT NULL,
  `Editorial` VARCHAR(50) NULL DEFAULT NULL,
  `Idioma` VARCHAR(50) NULL DEFAULT NULL,
  `Isbn` VARCHAR(50) NULL DEFAULT NULL,
  `Paginas` INT(11) NULL DEFAULT NULL,
  `Precio` DECIMAL(10,2) NULL DEFAULT NULL,
  `Titulo` VARCHAR(50) NULL DEFAULT NULL,
  `LibroID` INT(11) NOT NULL,
  `Edicionlibro` INT(11) NULL DEFAULT NULL,
  `Estadohablibro` BIT(1) NULL DEFAULT NULL,
  `Fecharegistrolibro` DATETIME NULL DEFAULT NULL,
  `Fechaupdatelibro` DATETIME NULL DEFAULT NULL,
  `Nrocopiaslibro` INT(11) NULL DEFAULT NULL,
  `Stocklibro` INT(11) NULL DEFAULT NULL,
  `Estado_libroID` INT(11) NOT NULL,
  PRIMARY KEY (`LibroID`),
  INDEX `FK_LIBROO_tiene` (`Estado_libroID` ASC),
  CONSTRAINT `FK_LIBROO_tiene`
    FOREIGN KEY (`Estado_libroID`)
    REFERENCES `bd_biblioteca`.`estado_libro` (`Estado_libroID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`categoria` (
  `Descripcion` VARCHAR(50) NULL DEFAULT NULL,
  `LibroID` INT(11) NOT NULL,
  `CategoriaID` INT(11) NOT NULL,
  PRIMARY KEY (`CategoriaID`),
  INDEX `FK_Categoria_Libro` (`LibroID` ASC),
  CONSTRAINT `FK_Categoria_Libro`
    FOREIGN KEY (`LibroID`)
    REFERENCES `bd_biblioteca`.`libro` (`LibroID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`tipo_documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`tipo_documento` (
  `Tipodoc_estadoeliminado` BIT(1) NULL DEFAULT NULL,
  `Tipodoc_estadohab` BIT(1) NULL DEFAULT NULL,
  `Tipodoc_formatoimpresion` VARCHAR(15) NULL DEFAULT NULL,
  `Tipodocumento` VARCHAR(50) NULL DEFAULT NULL,
  `Tipo_documentoID` INT(11) NOT NULL,
  PRIMARY KEY (`Tipo_documentoID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`estado_lector`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`estado_lector` (
  `Estadolector` VARCHAR(30) NULL DEFAULT NULL,
  `Estado_lectorID` INT(11) NOT NULL,
  PRIMARY KEY (`Estado_lectorID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`lector`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`lector` (
  `Apellidoslector` VARCHAR(50) NULL DEFAULT NULL,
  `Celularlector` CHAR(9) NULL DEFAULT NULL,
  `Correolector` VARCHAR(100) NULL DEFAULT NULL,
  `Direccionlector` VARCHAR(100) NULL DEFAULT NULL,
  `Dni_lector` CHAR(9) NULL DEFAULT NULL,
  `Estadoeliminadolector` BIT(1) NULL DEFAULT NULL,
  `Estadohablector` BIT(1) NULL DEFAULT NULL,
  `Fechanaclector` DATE NULL DEFAULT NULL,
  `Fecharegistrolector` DATETIME NULL DEFAULT NULL,
  `Fechaupdatelector` DATETIME NULL DEFAULT NULL,
  `Nombreslector` VARCHAR(50) NULL DEFAULT NULL,
  `LectorID` INT(11) NOT NULL,
  `Estado_lectorID` INT(11) NOT NULL,
  `BibliotecarioID` INT(11) NULL DEFAULT NULL,
  `UsuarioID` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`LectorID`),
  INDEX `FK_LECTOR_tiene` (`Estado_lectorID` ASC),
  INDEX `FK_lector_bibliotecario` (`BibliotecarioID` ASC),
  INDEX `FK_lector_usuario` (`UsuarioID` ASC),
  CONSTRAINT `FK_LECTOR_tiene`
    FOREIGN KEY (`Estado_lectorID`)
    REFERENCES `bd_biblioteca`.`estado_lector` (`Estado_lectorID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_lector_bibliotecario`
    FOREIGN KEY (`BibliotecarioID`)
    REFERENCES `bd_biblioteca`.`bibliotecario` (`BibliotecarioID`),
  CONSTRAINT `FK_lector_usuario`
    FOREIGN KEY (`UsuarioID`)
    REFERENCES `bd_biblioteca`.`users` (`UsuarioID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`cdp`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`cdp` (
  `Cdp_fechapago` DATETIME NULL DEFAULT NULL,
  `Cdp_total` DOUBLE(10,2) NULL DEFAULT NULL,
  `CdpID` INT(11) NOT NULL,
  `Tipo_documentoID` INT(11) NOT NULL,
  `LectorID` INT(11) NOT NULL,
  `descuentoCdp` DOUBLE(10,2) NULL DEFAULT NULL,
  PRIMARY KEY (`CdpID`),
  INDEX `FK_CDP_pertenece` (`Tipo_documentoID` ASC),
  INDEX `FK_CDP_tiene` (`LectorID` ASC),
  CONSTRAINT `FK_CDP_pertenece`
    FOREIGN KEY (`Tipo_documentoID`)
    REFERENCES `bd_biblioteca`.`tipo_documento` (`Tipo_documentoID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_CDP_tiene`
    FOREIGN KEY (`LectorID`)
    REFERENCES `bd_biblioteca`.`lector` (`LectorID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`tipo_prestamo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`tipo_prestamo` (
  `Tipoprestamo` VARCHAR(50) NULL DEFAULT NULL,
  `Tipo_prestamoID` INT(11) NOT NULL,
  `estadotipoprestamo` BIT(1) NULL DEFAULT NULL,
  `fechatipoprestamo` DATETIME NULL DEFAULT NULL,
  `updateipoprestamo` DATETIME NULL DEFAULT NULL,
  `UsuarioID` INT(11) NULL DEFAULT NULL,
  `observacionestipoprestamo` VARCHAR(250) NULL DEFAULT NULL,
  PRIMARY KEY (`Tipo_prestamoID`),
  INDEX `FK_tipo_prestamo_lector` (`UsuarioID` ASC),
  CONSTRAINT `FK_tipo_prestamo_lector`
    FOREIGN KEY (`UsuarioID`)
    REFERENCES `bd_biblioteca`.`users` (`UsuarioID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`estado_prestamo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`estado_prestamo` (
  `Estadoprestamo` VARCHAR(30) NULL DEFAULT NULL,
  `Estado_prestamoID` INT(11) NOT NULL,
  PRIMARY KEY (`Estado_prestamoID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`prestamo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`prestamo` (
  `Estadohabprestamo` BIT(1) NULL DEFAULT NULL,
  `Fechadevolucionesperadap` DATE NULL DEFAULT NULL,
  `Fechaentregaprestamo` DATETIME NULL DEFAULT NULL,
  `Fecharegistroprestamo` DATETIME NULL DEFAULT NULL,
  `Fechaupdateprestamo` DATETIME NULL DEFAULT NULL,
  `Horadevolucionesperadap` TIME NULL DEFAULT NULL,
  `Observacionesprestamo` VARCHAR(80) NULL DEFAULT NULL,
  `PrestamoID` INT(11) NOT NULL,
  `Estado_prestamoID` INT(11) NOT NULL,
  `LectorID` INT(11) NOT NULL,
  `Tipo_prestamoID` INT(11) NOT NULL,
  PRIMARY KEY (`PrestamoID`),
  INDEX `IXFK_PRESTAMO_asocia` (`LectorID` ASC),
  INDEX `FK_PRESTAMO_tiene` (`Estado_prestamoID` ASC),
  INDEX `FK_PRESTAMO_pertenece` (`Tipo_prestamoID` ASC),
  CONSTRAINT `FK_PRESTAMO_asocia`
    FOREIGN KEY (`LectorID`)
    REFERENCES `bd_biblioteca`.`lector` (`LectorID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_PRESTAMO_pertenece`
    FOREIGN KEY (`Tipo_prestamoID`)
    REFERENCES `bd_biblioteca`.`tipo_prestamo` (`Tipo_prestamoID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_PRESTAMO_tiene`
    FOREIGN KEY (`Estado_prestamoID`)
    REFERENCES `bd_biblioteca`.`estado_prestamo` (`Estado_prestamoID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`devolucion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`devolucion` (
  `Conmulta` BIT(1) NULL DEFAULT NULL,
  `Dev_observaciones` VARCHAR(50) NULL DEFAULT NULL,
  `Estadohabdevolución` BIT(1) NULL DEFAULT NULL,
  `Fechainiciodevolucion` DATETIME NULL DEFAULT NULL,
  `PrestamoID` INT(11) NULL DEFAULT NULL,
  `DevolucionID` INT(11) NOT NULL,
  `Fecharegistrodevolucion` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`DevolucionID`),
  INDEX `FK_DEVOLUCION_devuelve` (`PrestamoID` ASC),
  CONSTRAINT `FK_DEVOLUCION_devuelve`
    FOREIGN KEY (`PrestamoID`)
    REFERENCES `bd_biblioteca`.`prestamo` (`PrestamoID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`servicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`servicio` (
  `Servicio` VARCHAR(50) NULL DEFAULT NULL,
  `ServicioID` INT(11) NOT NULL,
  PRIMARY KEY (`ServicioID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`multa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`multa` (
  `Descripcionmulta` VARCHAR(50) NULL DEFAULT NULL,
  `Estadomultahab` BIT(1) NULL DEFAULT NULL,
  `Fecharegistromulta` DATETIME NULL DEFAULT NULL,
  `Fechaupdatemulta` DATETIME NULL DEFAULT NULL,
  `Porcentajemulta` DOUBLE(10,2) NULL DEFAULT NULL,
  `MultaID` INT(11) NOT NULL,
  `UsuarioID` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`MultaID`),
  INDEX `FK_multa_usuario` (`UsuarioID` ASC),
  CONSTRAINT `FK_multa_usuario`
    FOREIGN KEY (`UsuarioID`)
    REFERENCES `bd_biblioteca`.`users` (`UsuarioID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`estado_multa_lector`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`estado_multa_lector` (
  `Estadomultalector` VARCHAR(30) NULL DEFAULT NULL,
  `Estado_multa_lectorID` INT(11) NOT NULL,
  PRIMARY KEY (`Estado_multa_lectorID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`multa_lector`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`multa_lector` (
  `Descripcionmultalector` VARCHAR(50) NULL DEFAULT NULL,
  `Estadohabmultalector` VARCHAR(50) NULL DEFAULT NULL,
  `FechamultaLector` DATETIME NULL DEFAULT NULL,
  `MontoMultaLector` DECIMAL(10,2) NULL DEFAULT NULL,
  `Multa_lectorID` INT(11) NOT NULL,
  `DevolucionID` INT(11) NOT NULL,
  `Estado_multa_lectorID` INT(11) NOT NULL,
  `MultaID` INT(11) NOT NULL,
  `ServicioID` INT(11) NOT NULL,
  PRIMARY KEY (`Multa_lectorID`),
  INDEX `FK_MULTA_LECTOR_asocia` (`DevolucionID` ASC),
  INDEX `FK_MULTA_LECTOR_tiene` (`Estado_multa_lectorID` ASC),
  INDEX `FK_MULTA_LECTOR_relaciona` (`MultaID` ASC),
  INDEX `FK_MULTA_LECTOR_pertenece` (`ServicioID` ASC),
  CONSTRAINT `FK_MULTA_LECTOR_asocia`
    FOREIGN KEY (`DevolucionID`)
    REFERENCES `bd_biblioteca`.`devolucion` (`DevolucionID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_MULTA_LECTOR_pertenece`
    FOREIGN KEY (`ServicioID`)
    REFERENCES `bd_biblioteca`.`servicio` (`ServicioID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_MULTA_LECTOR_relaciona`
    FOREIGN KEY (`MultaID`)
    REFERENCES `bd_biblioteca`.`multa` (`MultaID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_MULTA_LECTOR_tiene`
    FOREIGN KEY (`Estado_multa_lectorID`)
    REFERENCES `bd_biblioteca`.`estado_multa_lector` (`Estado_multa_lectorID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`cdp_detalle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`cdp_detalle` (
  `Estadoeliminadodetalle` VARCHAR(25) NULL DEFAULT NULL,
  `Montopagado` DOUBLE(10,2) NULL DEFAULT NULL,
  `Cdp_detalleID` INT(11) NOT NULL,
  `CdpID` INT(11) NOT NULL,
  `Multa_lectorID` INT(11) NOT NULL,
  PRIMARY KEY (`Cdp_detalleID`),
  INDEX `FK_CDP_DETALLE_contiene` (`CdpID` ASC),
  INDEX `FK_CDP_DETALLE_asocia` (`Multa_lectorID` ASC),
  CONSTRAINT `FK_CDP_DETALLE_asocia`
    FOREIGN KEY (`Multa_lectorID`)
    REFERENCES `bd_biblioteca`.`multa_lector` (`Multa_lectorID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_CDP_DETALLE_contiene`
    FOREIGN KEY (`CdpID`)
    REFERENCES `bd_biblioteca`.`cdp` (`CdpID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`proveedor` (
  `Correoelectronico` VARCHAR(30) NULL DEFAULT NULL,
  `Direccion` VARCHAR(50) NULL DEFAULT NULL,
  `Empresa` VARCHAR(50) NULL DEFAULT NULL,
  `Telefono` VARCHAR(12) NULL DEFAULT NULL,
  `ProveedorID` INT(11) NOT NULL,
  PRIMARY KEY (`ProveedorID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`pedido` (
  `Fecha` DATE NULL DEFAULT NULL,
  `BibliotecarioID` INT(11) NOT NULL,
  `PedidoID` INT(11) NOT NULL,
  `ProveedorID` INT(11) NOT NULL,
  PRIMARY KEY (`PedidoID`),
  INDEX `FK_Pedido_Bibliotecario` (`BibliotecarioID` ASC),
  INDEX `FK_Pedido_Proveedor` (`ProveedorID` ASC),
  CONSTRAINT `FK_Pedido_Bibliotecario`
    FOREIGN KEY (`BibliotecarioID`)
    REFERENCES `bd_biblioteca`.`bibliotecario` (`BibliotecarioID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Pedido_Proveedor`
    FOREIGN KEY (`ProveedorID`)
    REFERENCES `bd_biblioteca`.`proveedor` (`ProveedorID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`comprobante_pago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`comprobante_pago` (
  `Descuento` DECIMAL(10,2) NULL DEFAULT NULL,
  `Fecha` DATE NULL DEFAULT NULL,
  `Monto` DECIMAL(10,2) NULL DEFAULT NULL,
  `Montototal` DECIMAL(10,2) NULL DEFAULT NULL,
  `Tipocomprobante` VARCHAR(50) NULL DEFAULT NULL,
  `Comprobante_pagoID` INT(11) NOT NULL,
  `PedidoID` INT(11) NOT NULL,
  PRIMARY KEY (`Comprobante_pagoID`),
  INDEX `FK_Comprobante_pago_Pedido` (`PedidoID` ASC),
  CONSTRAINT `FK_Comprobante_pago_Pedido`
    FOREIGN KEY (`PedidoID`)
    REFERENCES `bd_biblioteca`.`pedido` (`PedidoID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`detalle_pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`detalle_pedido` (
  `Cantidad` INT(11) NULL DEFAULT NULL,
  `PedidoID` INT(11) NOT NULL,
  `Detalle_pedidoID` INT(11) NOT NULL,
  `LibroID` INT(11) NOT NULL,
  PRIMARY KEY (`Detalle_pedidoID`),
  INDEX `FK_Detalle_pedido_Pedido` (`PedidoID` ASC),
  INDEX `FK_Detalle_pedido_Libro` (`LibroID` ASC),
  CONSTRAINT `FK_Detalle_pedido_Libro`
    FOREIGN KEY (`LibroID`)
    REFERENCES `bd_biblioteca`.`libro` (`LibroID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Detalle_pedido_Pedido`
    FOREIGN KEY (`PedidoID`)
    REFERENCES `bd_biblioteca`.`pedido` (`PedidoID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`devolucion_detalle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`devolucion_detalle` (
  `Estadodevolucion` BIT(1) NULL DEFAULT NULL,
  `Fechadevolucionlibro` DATETIME NULL DEFAULT NULL,
  `Nrocopiasdevolucion` INT(11) NULL DEFAULT NULL,
  `Devolucion_detalleID` INT(11) NOT NULL,
  `DevolucionID` INT(11) NOT NULL,
  `LibroID` INT(11) NOT NULL,
  `NroLibrosFaltaDevoD` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Devolucion_detalleID`),
  INDEX `FK_DEVOLUCION_DETALLE_contiene` (`DevolucionID` ASC),
  INDEX `FK_DEVOLUCION_DETALLE_relaciona` (`LibroID` ASC),
  CONSTRAINT `FK_DEVOLUCION_DETALLE_contiene`
    FOREIGN KEY (`DevolucionID`)
    REFERENCES `bd_biblioteca`.`devolucion` (`DevolucionID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_DEVOLUCION_DETALLE_relaciona`
    FOREIGN KEY (`LibroID`)
    REFERENCES `bd_biblioteca`.`libro` (`LibroID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`estado_detalle_prestamo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`estado_detalle_prestamo` (
  `Estadodetalleprestamo` VARCHAR(30) NULL DEFAULT NULL,
  `Estado_detalle_prestamoID` INT(11) NOT NULL,
  PRIMARY KEY (`Estado_detalle_prestamoID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`libro_autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`libro_autor` (
  `AutorID` INT(11) NOT NULL,
  `Libro_autorID` INT(11) NOT NULL,
  `LibroID` INT(11) NOT NULL,
  PRIMARY KEY (`Libro_autorID`),
  INDEX `FK_Libro_autor_Autor` (`AutorID` ASC),
  INDEX `FK_Libro_autor_Libro` (`LibroID` ASC),
  CONSTRAINT `FK_Libro_autor_Autor`
    FOREIGN KEY (`AutorID`)
    REFERENCES `bd_biblioteca`.`autor` (`AutorID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Libro_autor_Libro`
    FOREIGN KEY (`LibroID`)
    REFERENCES `bd_biblioteca`.`libro` (`LibroID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`mantenimiento_libros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`mantenimiento_libros` (
  `Codigolibrounidad` CHAR(15) NULL DEFAULT NULL,
  `Man_estadohab` BIT(1) NULL DEFAULT NULL,
  `Man_fecharegistro` DATETIME NULL DEFAULT NULL,
  `Man_fechaupdate` DATETIME NULL DEFAULT NULL,
  `Man_observaciones` VARCHAR(100) NULL DEFAULT NULL,
  `Man_problemas` VARCHAR(100) NULL DEFAULT NULL,
  `Mantenimiento_librosID` INT(11) NOT NULL,
  `Devolucion_detalleID` INT(11) NOT NULL,
  PRIMARY KEY (`Mantenimiento_librosID`),
  INDEX `FK_MANTENIMIENTO_LIBROS_relaciona` (`Devolucion_detalleID` ASC),
  CONSTRAINT `FK_MANTENIMIENTO_LIBROS_relaciona`
    FOREIGN KEY (`Devolucion_detalleID`)
    REFERENCES `bd_biblioteca`.`devolucion_detalle` (`Devolucion_detalleID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`permiso` (
  `Estadopermiso` BIT(1) NULL DEFAULT NULL,
  `Permiso` VARCHAR(50) NULL DEFAULT NULL,
  `PermisoID` INT(11) NOT NULL,
  PRIMARY KEY (`PermisoID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`prestamo_detalle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`prestamo_detalle` (
  `Estadohabdetalleprestamo` BIT(1) NULL DEFAULT NULL,
  `Nombrelibro` VARCHAR(100) NULL DEFAULT NULL,
  `Nrocopiasprestamo` INT(11) NULL DEFAULT NULL,
  `Prestamo_detalleID` INT(11) NOT NULL,
  `Estado_detalle_prestamoID` INT(11) NOT NULL,
  `LibroID` INT(11) NOT NULL,
  `PrestamoID` INT(11) NOT NULL,
  `StockLibroP` INT(11) NULL DEFAULT NULL,
  `NroLibrosFaltaDevo` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Prestamo_detalleID`),
  INDEX `FK_PRESTAMO_DETALLE_tiene` (`Estado_detalle_prestamoID` ASC),
  INDEX `FK_PRESTAMO_DETALLE_relaciona` (`LibroID` ASC),
  INDEX `FK_PRESTAMO_DETALLE_contiene` (`PrestamoID` ASC),
  CONSTRAINT `FK_PRESTAMO_DETALLE_contiene`
    FOREIGN KEY (`PrestamoID`)
    REFERENCES `bd_biblioteca`.`prestamo` (`PrestamoID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_PRESTAMO_DETALLE_relaciona`
    FOREIGN KEY (`LibroID`)
    REFERENCES `bd_biblioteca`.`libro` (`LibroID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_PRESTAMO_DETALLE_tiene`
    FOREIGN KEY (`Estado_detalle_prestamoID`)
    REFERENCES `bd_biblioteca`.`estado_detalle_prestamo` (`Estado_detalle_prestamoID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `bd_biblioteca`.`rol_permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_biblioteca`.`rol_permiso` (
  `Rol_permisoID` INT(11) NOT NULL,
  `RolID` INT(11) NULL DEFAULT NULL,
  `PermisoID` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Rol_permisoID`),
  INDEX `FK_ROL_PERMISO_ROL` (`RolID` ASC),
  INDEX `FK_ROL_PERMISO_PERMISO` (`PermisoID` ASC),
  CONSTRAINT `FK_ROL_PERMISO_PERMISO`
    FOREIGN KEY (`PermisoID`)
    REFERENCES `bd_biblioteca`.`permiso` (`PermisoID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_ROL_PERMISO_ROL`
    FOREIGN KEY (`RolID`)
    REFERENCES `bd_biblioteca`.`rol` (`RolID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;