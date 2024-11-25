DELIMITER //
CREATE PROCEDURE RegistrarCategoria (
IN rc_Nombre VARCHAR(255),
IN rc_Desc TEXT,
IN rc_Creador INT
)
BEGIN
INSERT INTO Categoria (Nombre, Descripcion, Creador, Creacion)
VALUES (rc_Nombre, rc_Desc, rc_Creador, NOW());
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE ActualizarCategoria (
IN ac_ID INT,
IN ac_Nombre VARCHAR(255),
IN ac_Desc TEXT
)
BEGIN
UPDATE Categoria 
SET Nombre = ac_Nombre, Descripcion = ac_Desc
WHERE ID = ac_ID;
END //
DELIMITER ;
