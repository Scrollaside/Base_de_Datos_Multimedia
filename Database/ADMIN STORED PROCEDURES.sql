DELIMITER //
CREATE PROCEDURE ReporteUsuarios (
    IN p_tipoUsuario INT
)
BEGIN
    SELECT NombreUsuario, NombreCompleto, FechaRegistro, CursosTotal, Total
    FROM Usuario, ReporteUsuario
    WHERE TipoUsuario = p_tipoUsuario AND Usuario.ID = UsuarioID;
END //
DELIMITER ;