/*CREANDO LA BASE DE DATOS ccm*/
/*CUIDADO CON EL MICHI*/
SHOW DATABASES;
CREATE DATABASE ccm;
SHOW DATABASES;
USE ccm;
CREATE TABLE tarjeta(
	NumeroTarjeta VARCHAR(17) NOT NULL,
    CVC VARCHAR(4) NOT NULL,
    FechaVenc VARCHAR(5) NOT NULL,
    NombreTarjeta VARCHAR(18) NOT NULL,
    ApPatTarjeta VARCHAR(18) NOT NULL,
    ApMatTarjeta VARCHAR(18) NOT NULL,
    PRIMARY KEY (NumeroTarjeta)
);

CREATE TABLE zapato(
	ID_Zapato INT NOT NULL AUTO_INCREMENT,
    Color VARCHAR(25) NOT NULL,
    NumeroDisp INT NOT NULL,
    Disponibilidad INT NOT NULL,
    Marca VARCHAR(25) NOT NULL,
    Modelo VARCHAR(25) NOT NULL,
    PrecioCompra DECIMAL(7,2) NOT NULL,
    PrecioVenta DECIMAL(7,2) NOT NULL,
    PRIMARY KEY (ID_Zapato)
);

CREATE TABLE direccion(
	ID_Direccion INT NOT NULL AUTO_INCREMENT,
    Calle VARCHAR(70) NOT NULL,
    NumExt VARCHAR(8) NOT NULL,
    NumInt VARCHAR(5) NOT NULL,
    CP INT NOT NULL,
    COLONIA VARCHAR(60) NOT NULL,
    Municipio VARCHAR(70) NOT NULL,
    Estado VARCHAR(60) NOT NULL,
    PRIMARY KEY (ID_Direccion)
);

CREATE TABLE pedido(
	ID_Pedido INT NOT NULL AUTO_INCREMENT,
    ID_Zapato INT NOT NULL,
    ID_Direccion INT NOT NULL,
    FechaPedido DATE DEFAULT NULL,
    HoraPedido TIME DEFAULT NULL,
    PRIMARY KEY (ID_Pedido),
    KEY ID_Zapato (ID_Zapato),
    CONSTRAINT FK_ID_Zapato
    FOREIGN KEY (ID_Zapato)
    REFERENCES zapato (ID_Zapato),
    KEY ID_Direccion (ID_Direccion),
    CONSTRAINT FK_ID_Direccion
    FOREIGN KEY (ID_Direccion)
    REFERENCES direccion (ID_Direccion)
);

CREATE TABLE cliente(
	CorreoE VARCHAR(70) NOT NULL,
    NombreUsuario VARCHAR(50) NOT NULL,
    Contrasenia VARCHAR(50) NOT NULL,
    Nombre VARCHAR(18) NOT NULL,
    ApPaterno VARCHAR(18) NOT NULL,
    ApMaterno VARCHAR(18) NOT NULL,
    Edad INT NOT NULL,
    NumTelefono VARCHAR(10) NOT NULL,
    ID_Pedido INT,
    NumeroTarjeta VARCHAR(17),
    PRIMARY KEY (CorreoE),
    KEY ID_Pedido (ID_Pedido),
    CONSTRAINT FK_ID_Pedido
    FOREIGN KEY (ID_Pedido)
    REFERENCES pedido (ID_Pedido),
    KEY NumeroTarjeta (NumeroTarjeta),
    CONSTRAINT FK_NumeroTarjeta
    FOREIGN KEY (NumeroTarjeta)
    REFERENCES tarjeta (NumeroTarjeta)
);

CREATE TABLE administrador(
	UsuarioAdmin VARCHAR(50) NOT NULL,
    ContraseniaAdmin VARCHAR(50) NOT NULL,
    PRIMARY KEY (UsuarioAdmin)
);

CREATE TABLE gerente(
	UsuarioGerente VARCHAR(50) NOT NULL,
    ContraseniaGerente VARCHAR(50) NOT NULL,
    PRIMARY KEY (UsuarioGerente)
);

SHOW TABLES;
