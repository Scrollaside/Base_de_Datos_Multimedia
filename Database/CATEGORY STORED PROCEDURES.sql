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
CREATE PROCEDURE ActualizarCategorias (
IN ac_Nombre VARCHAR(255),
IN ac_Desc TEXT,
IN ac_ID INT
)
BEGIN
DECLARE NameExists VARCHAR(255);
SELECT Nombre INTO NameExists FROM Categoria WHERE Nombre = ac_Nombre LIMIT 1;
IF NameExists IS NOT NULL THEN
UPDATE Categoria c
SET c.Descripcion = ac_Desc
WHERE c.Nombre = ac_Nombre;
ELSE
INSERT INTO Categoria (Nombre, Descripcion, Creador, Creacion)
VALUES (ac_Nombre, ac_Desc, ac_ID, NOW()) ;
END IF;
END //
DELIMITER ;

CALL ActualizarCategorias('Test', 'TestDesc	', 1);


SELECT * FROM VistaCategorias;

