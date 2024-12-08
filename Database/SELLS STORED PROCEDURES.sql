DELIMITER //
CREATE PROCEDURE MetodoPagoPorCurso (
IN mp_Name VARCHAR(255)
)
BEGIN 
SELECT * FROM MetodoPago WHERE Curso = mp_Name;
END //
DELIMITER ;
CALL MetodoPagoPorCurso('modelado 3d')
DELIMITER //
CREATE PROCEDURE GananciasTotales()
BEGIN
SELECT i.MetodoPago, CONCAT('$', FORMAT(SUM(i.PrecioPagado), 2)) AS TotalGanancias
FROM Inscripcion i
JOIN Nivel n ON i.NivelID = n.ID
JOIN Curso c ON n.CursoID = c.ID
GROUP BY i.MetodoPago;
END //
DELIMITER ;
CALL GananciasTotales()