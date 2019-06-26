create database control;

use control;

create table personal(
id_personal int primary key auto_increment,
nombres varchar(50) not null,
ape_pat varchar(50) not null,
ape_mat varchar(50) not null,
dni char(8) not null,
celular char(9),
correo varchar(50),
estado char(1) not null default '1',

CONSTRAINT camposunicos UNIQUE(dni)

);

create table ingreso_salida(
id_entrada int primary key auto_increment,
id_personal int not null,
fecha date not null,
hora_entrada time not null,
hora_salida time,
check (hora_entrada>=hora_salida),

CONSTRAINT camposunicos UNIQUE(id_personal,fecha),

foreign key(id_personal)
references personal(id_personal)
);


INSERT INTO `personal` ( `nombres`, `ape_pat`, `ape_mat`, `dni`, `celular`, `correo`)
VALUES ( 'Jose Carlos', 'Guerrero', 'Ccoya', '73822271', '997861182', 'guerrero_neo_1998@hotmail.com');
