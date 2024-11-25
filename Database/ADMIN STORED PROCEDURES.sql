DELIMITER //
CREATE PROCEDURE ReporteUsuarios (
    IN p_tipoUsuario INT
)
BEGIN
	IF p_tipoUsuario = 1 THEN
		SELECT Usuario, Nombre, Ingreso, Cursos, CONCAT(Total, '%') AS Total, Tipo FROM VistaReporteUsuarios
		WHERE Tipo = p_tipoUsuario;
    ELSEIF p_tipoUsuario = 2 THEN
		SELECT Usuario, Nombre, Ingreso, Cursos, CONCAT('$', FORMAT(Total, 2)) AS Total, Tipo FROM VistaReporteUsuarios
        WHERE Tipo = p_tipoUsuario;
	END IF;
END //
DELIMITER ;

