CREATE DATABASE IF NOT EXISTS torneoFutbol;

USE torneoFutbol;

CREATE TABLE IF NOT EXISTS equipos (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(100),
    pj INT,
    pg INT,
    pe INT,
    pp INT,
    gf INT,
    gc INT
);

CREATE TABLE IF NOT EXISTS jugadores(
    ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre varchar(100),
    apellido VARCHAR(100),
    fechaNacimiento DATE,
    altura FLOAT,
    puesto ENUM('arquero','defensor','delantero','mediocampista'),
    peso float,
    DNI INT(10),
    equipo INT,
    goles INT DEFAULT 0,
    FOREIGN KEY (equipo) REFERENCES equipos(ID)
);

CREATE TABLE IF NOT EXISTS staff(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(100),
    apellido varchar(100),
    fechaNacimiento DATE,
    altura float,
    peso float,
    DNI INT(10),
    puesto ENUM ('tecnico','preparador fisico','medico'),
    equipo INT,
    FOREIGN KEY (equipo) REFERENCES equipos(ID)
);

CREATE TABLE IF NOT EXISTS partidos (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ID_equipoA INT NOT NULL,
    ID_equipoB INT NOT NULL,
    goles_equipoA INT,
    goles_EquipoB INT,
    FOREIGN KEY (ID_equipoA) REFERENCES equipos(ID),
    FOREIGN KEY (ID_equipoB) REFERENCES equipos(ID)
);