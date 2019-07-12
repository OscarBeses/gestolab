
/* AHORA NO ELIMINO QUE HAY QUE MANTENER LAS MIGRACIONES 
drop database if exists gestolab;
create database gestolab default charset=utf8mb4_unicode_ci;
*/
use gestolab;
 
/*
DROP USER IF EXISTS 'oski_bc'; 
CREATE USER 'oski_bc'@'localhost';
SET PASSWORD FOR 'oski_bc'@'localhost' = PASSWORD('PASWORD_AQUI');
GRANT ALL PRIVILEGES ON gestolab.* TO 'oski_bc'@'localhost';
*/


create table producto (
	prd_id bigint(20) unsigned auto_increment,
    prd_descripcion varchar(100),
    prd_importe double,
    prd_observaciones varchar(100),
	prd_borrado varchar(1) default 'N' comment 'S/N',
    primary key (prd_id)
) COMMENT 'Bienes o servicios disponibles';

create table cliente (
	cli_id bigint(20) unsigned auto_increment,
	cli_nif varchar(9),
    cli_nombre varchar(70),
    cli_nombre_corto varchar(20),
    cli_cod_pos varchar(5),
	cli_ciudad varchar(20),
	cli_municipio varchar(20),
	cli_direccion varchar(75),
	cli_borrado varchar(1) default 'N' comment 'S/N',
    primary key (cli_id)
) COMMENT 'Clinicas, institutos, otros laboratorios, etc';

create table laboratorio (
	lab_id bigint(20) unsigned auto_increment,
	lab_nif varchar(9),
    lab_nombre varchar(50),
    lab_nombre_corto varchar(20),
    lab_cod_pos varchar(5),
	lab_ciudad varchar(20),
	lab_municipio varchar(20),
	lab_direccion varchar(75),
    primary key (lab_id)
) COMMENT 'El laboratorio donde se realizan los trabajos';

create table laboratorio_detalle (
	lad_id bigint(20) unsigned auto_increment,
	lab_id bigint(20) unsigned,
    lad_campo_extra varchar(50),
    primary key (lad_id),
	foreign key (lab_id) references laboratorio(lab_id)
) COMMENT 'Datos extra hojas anexas';

create table usuario_laboratorio (
	usl_id bigint(20) unsigned auto_increment,
	usu_id bigint(20) unsigned NOT NULL,
	lab_id bigint(20) unsigned,
	foreign key (usu_id) references users(id),
	foreign key (lab_id) references laboratorio(lab_id),
    primary key (usl_id)
	
) COMMENT 'Los laboratorios a los que puede acceder cada usuario';

create table factura (
	fac_id bigint(20) unsigned auto_increment,
	fac_numero bigint(20) unsigned,
    fac_fecha_emision date,
    primary key (fac_id)
) COMMENT 'Engloba varios albaranes';

create table albaran (
	alb_id bigint(20) unsigned auto_increment,
	alb_numero bigint(20) unsigned,
    alb_fecha_emision date,
	alb_fecha_entrega date,
	cli_id bigint(20) unsigned,
	lab_id bigint(20) unsigned,
	fac_id bigint(20) unsigned null,
    primary key (alb_id),
	foreign key (cli_id) references cliente(cli_id),
	foreign key (lab_id) references laboratorio(lab_id),
	foreign key (fac_id) references factura(fac_id)
) COMMENT 'Engloba varios trabajos';

create table trabajo (
	tra_id bigint(20) unsigned auto_increment,
    tra_observaciones varchar(75),
	tra_cantidad bigint(20) unsigned,
	tra_precio_unidad double,
	prd_id bigint(20) unsigned,
	alb_id bigint(20) unsigned not null,
    primary key (tra_id),
	foreign key (prd_id) references producto(prd_id),
	foreign key (alb_id) references albaran(alb_id)
) COMMENT 'Cada item de un albarán';

-- hay que borrar esta tabla
-- create table trabajo_detalle (
-- 	trd_id bigint(20) unsigned auto_increment,
-- 	trd_odontologo varchar(50),
-- 	trd_paciente varchar(50),
--     tra_id bigint(20) unsigned,	
--     primary key (trd_id),
-- 	foreign key (tra_id) references trabajo(tra_id)
-- ) COMMENT 'Solo algunos trabajos tienen detalle';

create table tecnico (
	tec_id bigint(20) unsigned auto_increment,
    tec_nombre varchar(40),
	tec_borrado varchar(1) default 'N' comment 'S/N',
	primary key (tec_id)
) COMMENT 'Los que realizan los trabajos';

create table tecnico_trabajo (
	tet_id bigint(20) unsigned auto_increment,
	tec_id bigint(20) unsigned,
    tra_id bigint(20) unsigned,
	primary key (tet_id),
	foreign key (tec_id) references tecnico(tec_id),
	foreign key (tra_id) references trabajo(tra_id)
) COMMENT 'Los trabajos de cada tecnico';

/* CREO EL ÚNICO USUARIO QUE TENDÁ LA APLICACIÓN  y lo vinculo al laboratorio*/
INSERT INTO users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(1, 'oscar', 'oscar.beses@gmail.com', NULL, '$2y$10$uXLjfPTSiM/zi4DBVjQiQukGblbFioyhS8OB.t9qoxyirpqpP9zlW', 'PpRYAxk4tmMOrRkFEltW9Gf0UqYZuCGQsFGsmdhl6tw2n5bp0GW3ZYU1aXiH', '2019-04-22 17:34:07', '2019-04-22 17:34:07');
INSERT INTO laboratorio (lab_id, lab_nif, lab_nombre, lab_nombre_corto, lab_cod_pos, lab_ciudad, lab_municipio, lab_direccion) 
	VALUES (2, '19891050Y', 'RAMÓN BESES SORIA', 'RAMÓN BESES', '46024', 'Valencia', NULL, 'Calle del parque de Nazaret 44 Bajo');
INSERT INTO usuario_laboratorio (usu_id, lab_id) 
	VALUES (1, 2);

/* Primer cliente */
INSERT INTO cliente (cli_nif, cli_nombre, cli_nombre_corto, cli_cod_pos, cli_ciudad, cli_municipio, cli_direccion) 
	VALUES ('G28423275', 'Universidad Cardenal Herrera-CEU "Clínica Odontológica"', 'CEU', '46113', 'Valencia', 'Moncada', 'Edificio Seminario S/N');
/* Inserto un producto de ejemplo */
INSERT INTO producto (prd_descripcion, prd_importe, prd_observaciones) 
	VALUES ('Esquelético', '85', 'Prótesis parcial metálica');
INSERT INTO producto (prd_descripcion, prd_importe, prd_observaciones) 
	VALUES ('Compostura simple esquelético', '29', 'Prótesis parcial metálica');
INSERT INTO producto (prd_descripcion, prd_importe, prd_observaciones) 
	VALUES ('Prótesis removible acrílica - Parcial 1/2 pieza ', '29.90', 'ganchos aparte');
/* Creo un par de técnicos - de momento no habrá tecnicos*/ 
-- INSERT INTO tecnico (tec_id, tec_nombre) 
-- 	VALUES (1, 'Lucía Beses');
-- INSERT INTO tecnico (tec_id, tec_nombre) 
-- 	VALUES (2, 'Karla Corrales');	
/* Creo el albarán sin nº de factura y sin fecha de emisión porque aún no se ha facturado 
INSERT INTO albaran (alb_id, alb_numero, cli_id, lab_id, alb_fecha_emision, fac_id) 
	VALUES (44, 4, 33, 22, NULL, NULL);
*/
/* Creo un trabajo que no coincide exactamente con el precio del producto por un supuesto descuento 
INSERT INTO trabajo (tra_id, tra_observaciones, prd_id, tra_cantidad, tra_precio_unidad, alb_id) 
	VALUES (5, null, 3, 1, '45.00', 44);
INSERT INTO trabajo (tra_id, tra_observaciones, prd_id, tra_cantidad, tra_precio_unidad, alb_id) 
	VALUES (51, 'Un comentario sin mas', 3, 2, '1.11', 44);
*/
-- INSERT INTO trabajo_detalle (trd_id, trd_odontologo, trd_paciente, tra_id) 
-- 	VALUES (NULL, 'Beatriz Castillo', 'Mª. Jesús Corral', 5);

/* Le asigno dos técnicos al mismo trabajo
INSERT INTO tecnico_trabajo (tec_id, tra_id) 
	VALUES (1, 5);
INSERT INTO tecnico_trabajo (tec_id, tra_id) 
	VALUES (2, 5);
*/
/* Ahora que ya se ha terminado el albarán se emite 
UPDATE albaran SET alb_fecha_emision = '2019-03-31' WHERE alb_id = 44;
*/
/* Y ahora que ya tengo un albarán para un cliente voy a facturarlo 
INSERT INTO factura (fac_id, fac_numero, fac_fecha_emision) 
	VALUES (66, 6, CURDATE());
UPDATE albaran SET fac_id = 66 WHERE alb_id = 44;
*/

-- NUEVAS MODIFICACIONES
ALTER TABLE albaran
ADD alb_profesor varchar(255),
ADD alb_paciente varchar(255);
