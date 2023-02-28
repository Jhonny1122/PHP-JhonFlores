DROP DATABASE IF EXISTS epatin;
CREATE DATABASE epatin;

USE epatin;

DROP TABLE IF EXISTS eclientes;

create table eclientes (dni varchar(9) not null, nombre varchar(50) not null, apellido varchar(50) not null,
 email varchar(50), saldo float(8), fecha_alta date not null, fecha_baja date) ENGINE=InnoDB DEFAULT CHARSET=latin1;

alter table eclientes add constraint pk_eclientes primary key (dni);

insert into eclientes (dni , nombre , apellido , email , saldo, fecha_alta, fecha_baja ) values
('11111111A','MARY','SMITH','mary.smith@epatin.net',10.00,'2018-01-01',null),
('22222222A','LINDA','WILLIAMS','linda.williams@epatin.net',120.50,'2018-02-01',null),
('33333333A','SUSAN','WILSON','susan.wilson@epatin.net',200.85,'2018-03-01', null),
('44444444A','MARGARET','MOORE','margaret.moore@epatin.net',3.15,'2018-12-31', null),
('99999999A','DOROTHY','TAYLOR','dorothy.taylor@epatin.net',6.00,'2019-01-01','2021-03-02');


DROP TABLE IF EXISTS epatines;

create table epatines (matricula varchar(7), bateria integer(3), preciobase float(5), disponible varchar(1)) ENGINE=InnoDB DEFAULT CHARSET=latin1;

alter table epatines add constraint pk_epatines primary key (matricula);

insert into epatines (matricula ,bateria, preciobase , disponible ) values
('4589HMK',20,0.30, 'S'),
('4001MKT',50,0.50, 'S'),
('3333JTM',60,0.40, 'S'),
('4545BGT',65,0.20, 'N'),
('1283KTS',7,0.20, 'S'),
('1647DES',35,0.30, 'S'),
('1477KLT',22,0.30, 'S'),
('7777KLT',85,0.30, 'S'),
('1234ABC',100,0.20, 'S');


DROP TABLE IF EXISTS ealquileres;
create table ealquileres (dni varchar(9) not null, matricula varchar(7) not null, fecha_alquiler timestamp, fecha_devolucion timestamp, preciototal float(8))
ENGINE=InnoDB DEFAULT CHARSET=latin1;

alter table ealquileres add constraint pk_ealquileres primary key (dni,matricula, fecha_alquiler);
alter table ealquileres add constraint fk_ealquileres_idcliente foreign key (dni) references eclientes(dni);
alter table ealquileres add constraint fk_ealquileres_matricula foreign key (matricula) references epatines(matricula);

insert into ealquileres  (dni , matricula , fecha_alquiler , fecha_devolucion, preciototal) values
('11111111A','1477KLT','2019-01-01 13:00:00','2019-01-01 13:15:00',15*0.30),
('99999999A','1477KLT','2019-02-01 07:00:00','2019-02-01 07:45:20',45*0.30),
('99999999A','4001MKT','2019-03-03 19:02:03','2019-03-03 19:12:03',10*0.50),
('99999999A','4001MKT','2019-03-03 19:22:00','2019-03-03 19:42:00',20*0.50),
('33333333A','4545BGT','2021-03-04 10:00:00',null,null);

commit;	