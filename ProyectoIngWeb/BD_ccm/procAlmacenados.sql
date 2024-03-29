SHOW DATABASES;
USE ccm;
SHOW TABLES;
DESCRIBE cliente;
DESCRIBE administrador;
DESCRIBE tarjeta;
DESCRIBE pedido;
SELECT * FROM cliente;
SELECT * FROM tarjeta;   
SELECT * FROM administrador; 
SELECT * FROM zapato;
SELECT * FROM pedido; 
/* PROCEDIMIENTOS ALMACENADOS */
DROP PROCEDURE IF EXISTS ingresarPedido;
DROP PROCEDURE IF EXISTS ingresarClienteCT;
DROP PROCEDURE IF EXISTS ingresarClienteST;
DROP PROCEDURE IF EXISTS ingresarZapato;
DROP TABLE gerente;
/*INGRESAR VALORES EN LA TABLA DE cliente CUANDO AÚN NO REGISTRA TARJETA*/
DELIMITER $$
CREATE PROCEDURE ingresarClienteST(/*ST->Sin Tarjeta*/
	IN _CorreoE VARCHAR(70),
	IN _NombreUsuario VARCHAR(50),
    IN _Contrasenia VARCHAR(60),
    IN _Nombre VARCHAR(18),
    IN _ApPaterno VARCHAR(18),
    IN _ApMaterno VARCHAR(18),
    IN _Edad INT,
    IN _NumTelefono VARCHAR(10),
    IN _ID_Cliente INT
)
BEGIN
	INSERT INTO 
    cliente (CorreoE,NombreUsuario,Contrasenia,Nombre,ApPaterno,ApMaterno,Edad,NumTelefono,ID_Cliente)
    VALUES (_CorreoE,_NombreUsuario,_Contrasenia,_Nombre,_ApPaterno,_ApMaterno,_Edad,_NumTelefono,_ID_Cliente);
END;
$$
CALL ingresarClienteST('idprueba@gmail.com','Ana1610','123456','Anahi','Salto','Cruz',21,'5547677837',1);
SELECT * FROM cliente;

/*INGRESAR VALORES EN LA TABLA DE cliente CUANDO YA REGISTRÓ TARJETA*/
DELIMITER $$
CREATE PROCEDURE ingresarClienteCT(/*CT -> Con Tarjeta*/
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

/*INGRESAR EL VALOR DE LA TARJETA A LA TABLA DE cliente O ACTUALIZAR TARJETA SI ES QUE YA SE REGISTRÓ ALGUNA*/
DELIMITER $$
CREATE PROCEDURE ingActTarjetaEnCliente(
	IN _CorreoE VARCHAR(70),
	IN _NumeroTarjeta VARCHAR(17)
)
BEGIN
	UPDATE cliente SET NumeroTarjeta = _NumeroTarjeta WHERE CorreoE = _CorreoE;
END;
$$ 
CALL ingActTarjetaEnCliente('porfavor@funcionaa.com','1236547898529635');
SELECT * FROM cliente;
SELECT * FROM tarjeta;


/*INGRESAR VALORES EN LA TABLA DE tarjeta*/
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
CALL ingresarTarjeta('1236547898529635','321','0629','Alina','S','C');
SELECT * FROM tarjeta;

DROP PROCEDURE IF EXISTS ingresarDireccion;
/*INGRESAR VALORES EN LA TABLA DE direccion*/
DELIMITER $$
CREATE PROCEDURE ingresarDireccion(
	IN _Calle VARCHAR(70),
	IN _NumExt VARCHAR(8),
    IN _NumInt VARCHAR(5),
    IN _CP INT,
    IN _Colonia VARCHAR(60),
    IN _Municipio VARCHAR(70),
    IN _Estado VARCHAR(60)
)
BEGIN
	INSERT INTO 
    direccion (Calle,NumExt,NumInt,CP,COLONIA,Municipio,Estado)
    VALUES (_Calle,_NumExt,_NumInt,_CP,_Colonia,_Municipio,_Estado);
END;
$$
CALL ingresarDireccion('Manuel A. Camacho','18-A',' ',53770,'El Chamizal','Naucalpan','México');
SELECT * FROM direccion;
SELECT * FROM pedido;

/*INGRESAR VALORES EN LA TABLA DE pedido */
DELIMITER $$
CREATE PROCEDURE ingresarPedido(
	IN _ID_Zapato INT,
	IN _ID_Direccion INT,
    IN _CorreoE VARCHAR(70)
)
BEGIN
	INSERT INTO 
    pedido (ID_Zapato,ID_Direccion,CorreoE)
    VALUES (_ID_Zapato,_ID_Direccion,_CorreoE);
END;
$$
CALL ingresarPedido(1,1,'anahisalto16@gmail.com');
SELECT * FROM pedido;


/*INGRESAR VALORES EN LA TABLA DE zapato*/
DELIMITER $$
CREATE PROCEDURE ingresarZapato(
	IN _Color VARCHAR(25),
	IN _NumeroDisp INT,
    IN _Disponibilidad INT,
    IN _Marca VARCHAR(25),
    IN _Modelo VARCHAR(25),
    IN _PrecioCompra DECIMAL(7,2),
    IN _PrecioVenta DECIMAL(7,2),
    IN _ImagenA VARCHAR(150),
    IN _ImagenB VARCHAR(150),
    IN _ImagenC VARCHAR(150),
    IN _ImagenD VARCHAR(150)
)
BEGIN
	INSERT INTO 
    zapato (Color,NumeroDisp,Disponibilidad,Marca,Modelo,PrecioCompra,PrecioVenta,imagenA,imagenB,imagenC,imagenD)
    VALUES (_Color,_NumeroDisp,_Disponibilidad,_Marca,_Modelo,_PrecioCompra,_PrecioVenta,_ImagenA,_ImagenB,_ImagenC,_ImagenD);
END;
$$
CALL ingresarZapato('Azul',4,30,'Adidas','forum',700.00,800.00,'equipolocal','equipolocal','equipolocal','equipolocal');
SELECT * FROM zapato;

/*INGRESAR VALORES EN LA TABLA DE administrador*/
DROP PROCEDURE IF EXISTS ingresarAdmin;
DELIMITER $$
CREATE PROCEDURE ingresarAdmin(
	IN _UsuarioAdmin VARCHAR(50),
	IN _ContraseniaAdmin VARCHAR(60)
)
BEGIN
	INSERT INTO 
    administrador (UsuarioAdmin,ContraseniaAdmin)
    VALUES (_UsuarioAdmin,_ContraseniaAdmin);
END;
$$
CALL ingresarAdmin('Admin2','1234567891023654789');
SELECT * FROM administrador;

/*ACTUALIZAR Disponibilidad EN LA TABLA DE zapato*/
DELIMITER $$
CREATE PROCEDURE actualizarStock(
    IN _ID_Zapato INT
)  
BEGIN
	UPDATE zapato SET Disponibilidad = (Disponibilidad - 1) WHERE ID_Zapato = _ID_Zapato;
END;
$$
CALL actualizarStock(5);

DROP PROCEDURE IF EXISTS editarCliente;
/*EDITAR TODOS LOS DATOS EN LA TABLA DE cliente*/
DELIMITER $$
CREATE PROCEDURE editarCliente(
    IN _CorreoE VARCHAR(70),
	IN _NombreUsuario VARCHAR(50),
    IN _Nombre VARCHAR(18),
    IN _ApPaterno VARCHAR(18),
    IN _ApMaterno VARCHAR(18),
    IN _Edad INT,
    IN _NumTelefono VARCHAR(10)
)  
BEGIN
	UPDATE cliente   
		SET NombreUsuario = _NombreUsuario,
			Nombre = _Nombre,
			ApPaterno = _ApPaterno,
			ApMaterno = _ApMaterno,
			Edad = _Edad,
			NumTelefono = _NumTelefono
    WHERE CorreoE = _CorreoE;
END;  
$$
CALL editarCliente('0252@gmaiil.com','anahi1234','ANAHI','S','C',21,'1234567890');
SELECT * FROM cliente;


SELECT * FROM pedido;
SELECT * FROM zapato;
DELETE FROM zapato WHERE ID_Zapato = 1;
DELETE FROM pedido WHERE ID_Pedido = 4;