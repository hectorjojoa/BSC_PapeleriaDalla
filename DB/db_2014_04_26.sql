/*
SQLyog Ultimate v8.71 
MySQL - 5.5.34 : Database - papeleria_bsc
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

insert  into `categoria`(`id`,`descripcion`) values (1,'Papeleria'),(2,'Pi'),(3,'Electronica'),(4,'Ropa');

/*Table structure for table `indicador` */

DROP TABLE IF EXISTS `indicador`;

CREATE TABLE `indicador` (
  `id` int(10) unsigned NOT NULL,
  `descripcion` text CHARACTER SET latin1,
  `valor_esperado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `indicador` */

insert  into `indicador`(`id`,`descripcion`,`valor_esperado`) values (1,'atenciÃ³n al usuario',10),(2,'Ã±Ã± de tt',5),(3,'prueba de indicador',5);

/*Table structure for table `indicadorpersona` */

DROP TABLE IF EXISTS `indicadorpersona`;

CREATE TABLE `indicadorpersona` (
  `id_indicador` int(10) unsigned NOT NULL,
  `id_persona` int(10) unsigned NOT NULL,
  `valor_obtenido` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_indicador`,`id_persona`),
  KEY `FK_indicadorpersona_persona` (`id_persona`),
  CONSTRAINT `FK_indicadorpersona_indicador` FOREIGN KEY (`id_indicador`) REFERENCES `indicador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_indicadorpersona_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `indicadorpersona` */

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

insert  into `persona`(`cedula`,`nombre`,`apellido`,`fecha_nac`,`telefono`,`id_rol`,`password`) values (10701,'zuleima','grande','2000-12-12',32145698,1,'hector123'),(10702,'narguila','matraz','1995-02-04',3258746,2,'hector123'),(10703,'Eriundo','La Paz','1994-05-31',32158695,2,NULL),(10704,'hector','jojoa','1991-09-19',32144568,1,'hector123'),(10706,'Cosme','Fulanito','1996-02-05',2145682,2,NULL);

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

insert  into `producto`(`id`,`descripcion`,`precio`,`id_categoria`) values (1,'Cuaderno Grande',3000,1),(2,'Cuaderno Peque',2000,1),(3,'Juguetes Relleno',5000,2),(4,'Condon',1500,2),(5,'Resistencia',100,3),(6,'Protoboard',9000,3),(7,'Vestido bebe',16000,4),(8,'Jean levantacola1',29999,4);

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

insert  into `venta`(`id`,`id_persona`,`total`,`fecha`) values (1,2,50000,'2014-04-14'),(2,2,35000,'2014-04-15');

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

insert  into `ventaproducto`(`id_venta`,`id_producto`) values (1,1),(2,1),(1,2),(1,3),(2,4),(2,5);

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

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
