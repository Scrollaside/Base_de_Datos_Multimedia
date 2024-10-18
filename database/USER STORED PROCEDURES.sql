DELIMITER //
CREATE PROCEDURE RegistrarUsuario (
    IN p_nombre VARCHAR(255),
    IN p_genero ENUM('M', 'F'),
    IN p_fechaNacimiento DATE,
    IN p_foto VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_contraseña VARCHAR(255),
    IN p_tipoUsuario ENUM('Instructor', 'Estudiante', 'Administrador')
)
BEGIN
    INSERT INTO Usuario (NombreCompleto, Genero, FechaNacimiento, Foto, Email, Contraseña, FechaRegistro, TipoUsuario, Estado)
    VALUES (p_nombre, p_genero, p_fechaNacimiento, p_foto, p_email, p_contraseña, NOW(), p_tipoUsuario, 'Activo');
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
