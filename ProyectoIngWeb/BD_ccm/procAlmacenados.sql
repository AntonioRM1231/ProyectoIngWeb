SHOW DATABASES;
USE ccm;
SHOW TABLES;
DESCRIBE cliente;
DESCRIBE tarjeta;
SELECT * FROM cliente;
SELECT * FROM tarjeta;

/* PROCEDIMIENTOS ALMACENADOS */
DROP PROCEDURE IF EXISTS ingresarClienteST;

/*INGRESAR VALORES EN LA TABLA DE CLIENTE CUANDO AÚN NO REGISTRA TARJETA*/
DELIMITER $$
CREATE PROCEDURE ingresarClienteST(
	IN _CorreoE VARCHAR(70),
	IN _NombreUsuario VARCHAR(50),
    IN _Contrasenia VARCHAR(50),
    IN _Nombre VARCHAR(18),
    IN _ApPaterno VARCHAR(18),
    IN _ApMaterno VARCHAR(18),
    IN _Edad INT,
    IN _NumTelefono VARCHAR(10)
)
BEGIN
	INSERT INTO 
    cliente (CorreoE,NombreUsuario,Contrasenia,Nombre,ApPaterno,ApMaterno,Edad,NumTelefono)
    VALUES (_CorreoE,_NombreUsuario,_Contrasenia,_Nombre,_ApPaterno,_ApMaterno,_Edad,_NumTelefono);
END;
$$
CALL ingresarClienteST('correo2@gmail.com','Ana1610','123456','Ana','S','C',21,'5547677837');
SELECT * FROM cliente;

/*INGRESAR VALORES EN LA TABLA DE CLIENTE CUANDO YA REGISTRÓ TARJETA*/
DELIMITER $$
CREATE PROCEDURE ingresarClienteCT(
	IN _CorreoE VARCHAR(70),
	IN _NombreUsuario VARCHAR(50),
    IN _Contrasenia VARCHAR(50),
    IN _Nombre VARCHAR(18),
    IN _ApPaterno VARCHAR(18),
    IN _ApMaterno VARCHAR(18),
    IN _Edad INT,
    IN _NumTelefono VARCHAR(10),
    IN _NumeroTarjeta VARCHAR(17)
)
BEGIN
	INSERT INTO 
    cliente (CorreoE,NombreUsuario,Contrasenia,Nombre,ApPaterno,ApMaterno,Edad,NumTelefono,NumeroTarjeta)
    VALUES (_CorreoE,_NombreUsuario,_Contrasenia,_Nombre,_ApPaterno,_ApMaterno,_Edad,_NumTelefono);
END;
$$
CALL ingresarClienteCT('correo3@gmail.com','AliSC','12345678','Alina','S','C',26,'4432569814','9876543211234567');
SELECT * FROM cliente;

/*INGRESAR EL VALOR DE LA TARJETA A LA TABLA DE CLIENTE O ACTUALIZAR TARJETA SI ES QUE YA SE REGISTRÓ ALGUNA*/
DELIMITER $$
CREATE PROCEDURE ingActTarjetaEnCliente(
	IN _CorreoE VARCHAR(70),
	IN _NumeroTarjeta VARCHAR(17)
)
BEGIN
	UPDATE cliente SET NumeroTarjeta = _NumeroTarjeta WHERE CorreoE = _CorreoE;
END;
$$
CALL ingActTarjetaEnCliente('nayeli@gmail.com','1236547898529634');
SELECT * FROM cliente;
SELECT * FROM tarjeta;

/*INGRESAR EL VALOR DE ID DEL PEDIDO A LA TABLA DE CLIENTE*/
SELECT * FROM pedido;

/*INGRESAR VALORES EN LA TABLA DE TARJETA*/
DELIMITER $$
CREATE PROCEDURE ingresarTarjeta(
	IN _NumeroTarjeta VARCHAR(17),
	IN _CVC VARCHAR(4),
    IN _FechaVenc VARCHAR(5),
    IN _NombreTarjeta VARCHAR(18),
    IN _ApPatTarjeta VARCHAR(18),
    IN _ApMatTarjeta VARCHAR(18)
)
BEGIN
	INSERT INTO 
    tarjeta (NumeroTarjeta,CVC,FechaVenc,NombreTarjeta,ApPatTarjeta,ApMatTarjeta)
    VALUES (_NumeroTarjeta,_CVC,_FechaVenc,_NombreTarjeta,_ApPatTarjeta,_ApMatTarjeta);
END;
$$
CALL ingresarTarjeta('1236547898529634','123','1230','Anahi','S','C');
SELECT * FROM tarjeta;

/*INGRESAR VALORES EN LA TABLA DE DIRECCION*/



/*INGRESAR VALORES EN LA TABLA DE */

/*INGRESAR VALORES EN LA TABLA DE ZAPATO*/