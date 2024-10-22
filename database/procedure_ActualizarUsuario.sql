


DELIMITER //
CREATE PROCEDURE ActualizarUsuario (
    IN p_usuarioID INT,
    IN p_nombre VARCHAR(255),
    IN p_foto VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_contraseña VARCHAR(255),
    IN p_genero VARCHAR(1),             -- Adding Gender parameter (M/F)
    IN p_fechaNacimiento DATE 
)
BEGIN
    UPDATE Usuario
     SET NombreCompleto = p_nombre,
        Foto = p_foto,
        Email = p_email,
        Contraseña = p_contraseña,
        Genero = p_genero,               -- Update genero
        FechaNacimiento = p_fechaNacimiento, -- Update fecha de nacimiento
        FechaActualizacion = GETDATE()   --  GETDATE() para SQL Server el NOW() me daba errores
    WHERE ID = p_usuarioID;
END //
DELIMITER ;





