USE bdm;
DELIMITER //
CREATE PROCEDURE VentasGeneralSP(
IN vg_ID INT,
IN vg_desde VARCHAR(255),
IN vg_hasta VARCHAR(255),
IN vg_categoria VARCHAR(255),
IN vg_estado VARCHAR(255)
)
BEGIN 
IF vg_categoria = 'Todas' AND vg_estado != 'Todos' THEN
	SELECT Curso, Alumnos, Promedio, Ingresos FROM VentasGeneral 
	WHERE Instructor = vg_ID 
		AND Estado = vg_estado 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y');
ELSEIF vg_estado = 'Todos' AND vg_categoria != 'Todas'THEN
	SELECT Curso, Alumnos, Promedio, Ingresos FROM VentasGeneral 
	WHERE Instructor = vg_ID 
		AND Categoria = vg_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y');
ELSEIF vg_categoria = 'Todas' AND vg_estado = 'Todos' THEN
	SELECT Curso, Alumnos, Promedio, Ingresos FROM VentasGeneral 
    WHERE Instructor = vg_ID 
    AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y');
ELSE 
	SELECT Curso, Alumnos, Promedio, Ingresos FROM VentasGeneral 
	WHERE Instructor = vg_ID 
    AND Estado = vg_estado 
    AND Categoria = vg_categoria 
    AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y');
END IF;
END //
DELIMITER ;

CALL VentasGeneralSP(7,'01/01/2000' , DATE_FORMAT(CURDATE(), '%d/%m/%Y'),'Todas', 'Todos');

DELIMITER //
CREATE PROCEDURE GananciasTotalesSP(
IN gt_ID INT,
IN gt_desde VARCHAR(255),
IN gt_hasta VARCHAR(255),
IN gt_categoria VARCHAR(255),
IN gt_estado VARCHAR(255)
)
BEGIN
IF gt_categoria = 'Todas' AND gt_estado != 'Todos' THEN
	SELECT FormaPago, IngresosTotales FROM GananciasTotales
	WHERE Instructor = gt_ID 
		AND Estado = gt_estado 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y');
ELSEIF gt_estado = 'Todos' AND gt_categoria != 'Todas'THEN
	SELECT FormaPago, IngresosTotales FROM GananciasTotales
	WHERE Instructor = gt_ID 
		AND Categoria = gt_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y');
ELSEIF gt_categoria = 'Todas' AND gt_estado = 'Todos' THEN
	SELECT FormaPago, IngresosTotales FROM GananciasTotales
    WHERE Instructor = gt_ID 
    AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y');
ELSE 
	SELECT FormaPago, IngresosTotales FROM GananciasTotales
	WHERE Instructor = gt_ID 
    AND Estado = gt_estado 
    AND Categoria = gt_categoria 
    AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y');
END IF;
END //
DELIMITER ;

CALL GananciasTotalesSP(7,'01/01/2000' , DATE_FORMAT(CURDATE(), '%d/%m/%Y'),'Todas', 'Todos');

DELIMITER //
CREATE PROCEDURE MetodoPagoPorCurso (
IN mp_Name VARCHAR(255),
IN mp_ID INT
)
BEGIN 
SELECT * FROM MetodoPago WHERE Curso = mp_Name AND Instructor = mp_ID;
END //
DELIMITER ;

CALL MetodoPagoPorCurso('Curso de Java', 7);

DELIMITER //
CREATE PROCEDURE VentasPorCursoSP(
IN vg_ID INT,
IN vg_curso VARCHAR(255),
IN vg_desde VARCHAR(255),
IN vg_hasta VARCHAR(255),
IN vg_categoria VARCHAR(255),
IN vg_estado VARCHAR(255)
)
BEGIN 
IF vg_categoria = 'Todas' AND vg_estado != 'Todos' THEN
	SELECT Alumno, Inscripcion, Nivel, Pago, Forma FROM VentasPorCurso
	WHERE Instructor = vg_ID AND vg_curso = Curso
		AND Estado = vg_estado 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y');
ELSEIF vg_estado = 'Todos' AND vg_categoria != 'Todas'THEN
	SELECT Alumno, Inscripcion, Nivel, Pago, Forma FROM VentasPorCurso
	WHERE Instructor = vg_ID AND vg_curso = Curso
		AND Categoria = vg_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y');
ELSEIF vg_categoria = 'Todas' AND vg_estado = 'Todos' THEN
	SELECT Alumno, Inscripcion, Nivel, Pago, Forma FROM VentasPorCurso
    WHERE Instructor = vg_ID AND vg_curso = Curso
    AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y');
ELSE 
	SELECT Alumno, Inscripcion, Nivel, Pago, Forma FROM VentasPorCurso 
	WHERE Instructor = vg_ID AND vg_curso = Curso
    AND Estado = vg_estado 
    AND Categoria = vg_categoria 
    AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y');
END IF;
END //
DELIMITER ;

CALL VentasPorCursoSP(7, 'Modelado 3D','20/11/2024' ,'02/12/2024','Todas', 'Todos');
