DROP PROCEDURE IF EXISTS RegistrarUsuario;

CALL RegistrarUsuario('Aldo Gonzalez', 'Roger', 'M', '2004-06-07', 'fotoBinaryData', 'algo@hotmail.com', '123a', 1);
CALL RegistrarUsuario('Javier Tristan', 'Memorandum', 'F', '2004-06-04', 'fotoBinaryData', 'memo@gmail.com', '456b', 1);
CALL RegistrarUsuario('Max Leon', 'Max', 'M', '2002-01-18', 'fotoBinaryData', 'max@uanl.com', '789c', 1);


DELIMITER //
CREATE PROCEDURE RegistrarUsuario (
    IN p_nombre VARCHAR(255),
    IN p_nombreUsuario VARCHAR(255), 
    IN p_genero CHAR,
    IN p_fechaNacimiento DATE,
    IN p_foto MEDIUMBLOB,
    IN p_email VARCHAR(255),
    IN p_contraseña VARCHAR(255),
    IN p_tipoUsuario INT
)
BEGIN
    INSERT INTO Usuario (NombreCompleto, NombreUsuario, Genero, FechaNacimiento, Foto, Email, Contraseña, FechaRegistro, FechaActualizacion, TipoUsuario, Estado)
    VALUES (p_nombre, p_nombreUsuario, p_genero, p_fechaNacimiento, p_foto, p_email, p_contraseña, NOW(), NOW(), p_tipoUsuario, true);
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE CambiarEstadoUsuario (
    IN p_usuarioID INT,
    IN p_estado ENUM('Activo', 'Deshabilitado')
)
BEGIN
    UPDATE Usuario
    SET Estado = p_estado
    WHERE ID = p_usuarioID;
END //
DELIMITER ;




DELIMITER //
CREATE PROCEDURE ActualizarUsuario (
    IN p_usuarioID INT,
    IN p_nombre VARCHAR(255),
    IN p_foto VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_contraseña VARCHAR(255)
)
BEGIN
    UPDATE Usuario
    SET NombreCompleto = p_nombre,
        Foto = p_foto,
        Email = p_email,
        Contraseña = p_contraseña,
        FechaActualizacion = NOW()
    WHERE ID = p_usuarioID;
END //
DELIMITER ;
