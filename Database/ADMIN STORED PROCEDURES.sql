DELIMITER //
CREATE PROCEDURE ReporteUsuarios (
    IN p_tipoUsuario INT
)
BEGIN
    SELECT * FROM VistaReporteUsuarios
    WHERE Tipo = p_tipoUsuario;
END //
DELIMITER ;
