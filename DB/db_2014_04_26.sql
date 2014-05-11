/*
SQLyog Ultimate v8.71 
MySQL - 5.6.16 : Database - papeleria_bsc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`papeleria_bsc` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `papeleria_bsc`;

/*Table structure for table `categoria` */

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `id` int(10) unsigned NOT NULL,
  `descripcion` text CHARACTER SET latin1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `categoria` */

insert  into `categoria`(`id`,`descripcion`) values (1,'Papeleria'),(2,'cosmeticos'),(3,'Electronica'),(4,'mantenimiento');

/*Table structure for table `indicador` */

DROP TABLE IF EXISTS `indicador`;

CREATE TABLE `indicador` (
  `id` int(10) unsigned NOT NULL,
  `descripcion` text CHARACTER SET latin1,
  `valor_esperado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `indicador` */

insert  into `indicador`(`id`,`descripcion`,`valor_esperado`) values (1,'numero de llegadas tarde ',3),(2,'calificacion de atencion al usuario',5),(3,'rendimineto del empleado',5),(4,'ventas realizadas',8);

/*Table structure for table `indicadorpersona` */

DROP TABLE IF EXISTS `indicadorpersona`;

CREATE TABLE `indicadorpersona` (
  `id_indicador` int(10) unsigned NOT NULL,
  `id_persona` int(10) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `valor_obtenido` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_indicador`,`id_persona`,`fecha`),
  KEY `FK_indicadorpersona_persona` (`id_persona`),
  CONSTRAINT `FK_indicadorpersona_indicador` FOREIGN KEY (`id_indicador`) REFERENCES `indicador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_indicadorpersona_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `indicadorpersona` */

insert  into `indicadorpersona`(`id_indicador`,`id_persona`,`fecha`,`valor_obtenido`) values (1,10701,'2014-05-01',2),(1,10701,'2014-05-02',8),(1,10702,'2014-05-01',0),(1,10703,'2014-05-01',1),(1,10704,'2014-05-01',2),(1,10706,'2014-05-01',1),(2,10701,'2014-05-01',2),(2,10702,'2014-05-01',2),(2,10702,'2014-05-02',5),(2,10703,'2014-05-01',3),(2,10704,'2014-05-01',4),(3,10702,'2014-05-01',5),(4,10702,'2014-05-01',7),(4,10706,'2014-05-01',3);

/*Table structure for table `persona` */

DROP TABLE IF EXISTS `persona`;

CREATE TABLE `persona` (
  `cedula` int(10) unsigned NOT NULL,
  `nombre` text CHARACTER SET latin1,
  `apellido` text CHARACTER SET latin1,
  `fecha_nac` date DEFAULT NULL,
  `telefono` int(10) unsigned NOT NULL,
  `id_rol` int(10) unsigned NOT NULL,
  `password` text,
  PRIMARY KEY (`cedula`),
  KEY `FK_persona_rol` (`id_rol`),
  CONSTRAINT `FK_persona_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `persona` */

insert  into `persona`(`cedula`,`nombre`,`apellido`,`fecha_nac`,`telefono`,`id_rol`,`password`) values (10701,'zuleima','grande','2000-12-12',32145698,2,'hector123'),(10702,'narguila','matraz','1995-02-04',3258746,2,'hector123'),(10703,'Eriundo','La Paz','1994-05-31',32158695,2,'hector123'),(10704,'Hector','jojoa','1991-09-19',32144568,1,'hector123'),(10706,'Cosme','Fulanito','1996-02-05',2145682,2,NULL),(10707,'Pedro','Jojoa','2013-10-23',2147483647,2,NULL);

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `id` int(10) unsigned NOT NULL,
  `descripcion` text CHARACTER SET latin1,
  `precio` int(11) NOT NULL,
  `id_categoria` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_producto_categoria` (`id_categoria`),
  CONSTRAINT `FK_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `producto` */

insert  into `producto`(`id`,`descripcion`,`precio`,`id_categoria`) values (1,'Cuaderno Grande',3000,1),(2,'Cuaderno Peque',2000,1),(3,'Juguetes Relleno',5000,2),(5,'Resistencia',100,3),(6,'Protoboard',9000,3),(7,'Vestido bebe',16000,4),(8,'Jean levantacola1',29999,4);

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `id` int(10) unsigned NOT NULL,
  `descripcion` text CHARACTER SET latin1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `rol` */

insert  into `rol`(`id`,`descripcion`) values (1,'Administrador'),(2,'Empleado');

/*Table structure for table `venta` */

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta` (
  `id` int(10) unsigned NOT NULL,
  `id_persona` int(10) unsigned NOT NULL,
  `total` int(10) unsigned NOT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `venta` */

insert  into `venta`(`id`,`id_persona`,`total`,`fecha`) values (1,0,110000,'2014-05-03'),(2,10701,5042,'2014-05-01'),(3,10701,4000,'2014-05-02'),(4,10703,12500,'2014-05-01');

/*Table structure for table `ventaproducto` */

DROP TABLE IF EXISTS `ventaproducto`;

CREATE TABLE `ventaproducto` (
  `id_venta` int(10) unsigned NOT NULL,
  `id_producto` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_venta`,`id_producto`),
  KEY `FK_ventaproducto_producto` (`id_producto`),
  CONSTRAINT `FK_ventaproducto_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ventaproducto_venta` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ventaproducto` */

/* Procedure structure for procedure `SP_AlterIndicador` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_AlterIndicador` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AlterIndicador`(
			IN _opcion INT,
			IN _id INT,
			IN _descripcion TEXT,
			IN _valor_esperado int)
BEGIN
	CASE _opcion
	    WHEN '1' THEN 
		INSERT INTO indicador(id,descripcion,valor_esperado)
			VALUES(_id,_descripcion,_valor_esperado);
		SELECT _id;
	    WHEN '2' THEN 
		UPDATE indicador SET
			id = _id,
			descripcion = _descripcion,
			valor_esperado = _valor_esperado
			
		WHERE id = _id;
		SELECT _id;
	    WHEN '3' THEN 
		DELETE FROM indicador WHERE id = _id;
		SELECT _id;
	    ELSE
		SELECT '0';
	END CASE;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_AlterPersona` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_AlterPersona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AlterPersona`(
			IN _opcion int,
			IN _cedula int,
			IN _nombre TEXT,
			IN _apellido TEXT,
			IN _fecha_nac date,
			IN _telefono int,
			IN _id_rol int)
BEGIN
	CASE _opcion
	    WHEN '1' THEN 
		INSERT INTO persona(cedula,nombre,apellido,fecha_nac,telefono,id_rol)
			VALUES(_cedula,_nombre,_apellido,_fecha_nac,_telefono,_id_rol);
		SELECT _cedula;
	    WHEN '2' THEN 
		UPDATE persona SET
			nombre = _nombre,
			apellido = _apellido,
			fecha_nac = _fecha_nac,
			telefono = _telefono,
			id_rol = _id_rol
		WHERE cedula = _cedula;
		SELECT _cedula;
	    WHEN '3' THEN 
		DELETE FROM persona WHERE cedula = _cedula;
		SELECT _cedula;
	    ELSE
		SELECT '0';
	END CASE;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_AlterProducto` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_AlterProducto` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AlterProducto`(
			IN _opcion int,
			IN _id int,
			IN _descripcion TEXT,
			IN _precio int,
			IN _id_categoria int)
BEGIN
	CASE _opcion
	    WHEN '1' THEN 
		INSERT INTO producto(id,descripcion,precio,id_categoria)
			VALUES(_id,_descripcion,_precio,_id_categoria);
		SELECT _id;
	    WHEN '2' THEN 
		UPDATE producto SET
			id = _id,
			descripcion = _descripcion,
			precio = _precio,
			id_categoria = _id_categoria
			
		WHERE id = _id;
		SELECT _id;
	    WHEN '3' THEN 
		DELETE FROM producto WHERE id = _id;
		SELECT _id;
	    ELSE
		SELECT '0';
	END CASE;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_AlterVenta` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_AlterVenta` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AlterVenta`(
			IN _opcion INT,
			IN _id INT,
			IN _id_persona INT,
			IN _total INT,
			IN _fecha DATE)
BEGIN
	CASE _opcion
	    WHEN '1' THEN 
		INSERT INTO venta(id,id_persona,total,fecha)
			VALUES(_id,_id_persona,_total,_fecha);
		SELECT _id;
	    WHEN '2' THEN 
		UPDATE venta SET
			id = _id,
			id_persona = _id_persona,
			total = _total,
			fecha = _fecha
			
		WHERE id = _id;
		SELECT _id;
	    WHEN '3' THEN 
		DELETE FROM venta WHERE id = _id;
		SELECT _id;
	    ELSE
		SELECT '0';
	END CASE;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_SaveEvaluacion` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_SaveEvaluacion` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_SaveEvaluacion`(
			in _opcion text,
			in _id_indicador text,
			in _cedula text,
			in _fecha text,
			in _valor_obtenido text)
BEGIN
	CASE _opcion
	    WHEN 'i' THEN 
		INSERT INTO indicadorpersona(id_indicador,id_persona,fecha,valor_obtenido)
			values(_id_indicador,_cedula,_fecha,_valor_obtenido);
		SELECT '1';
	    when 'u' then
		update indicadorpersona set valor_obtenido = _valor_obtenido
		where id_indicador = _id_indicador 
		    AND id_persona = _cedula
		    and fecha = _fecha;
		select '1';
	    ELSE
		SELECT '0';
	END CASE;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
