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
