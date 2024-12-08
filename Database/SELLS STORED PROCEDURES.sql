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
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y')
	GROUP BY Curso;
ELSEIF vg_estado = 'Todos' AND vg_categoria != 'Todas'THEN
	SELECT Curso, Alumnos, Promedio, Ingresos FROM VentasGeneral 
	WHERE Instructor = vg_ID 
		AND Categoria = vg_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y')
	GROUP BY Curso;
ELSEIF vg_categoria = 'Todas' AND vg_estado = 'Todos' THEN
	SELECT Curso, Alumnos, Promedio, Ingresos FROM VentasGeneral 
    WHERE Instructor = vg_ID 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y')
    GROUP BY Curso;
ELSE 
	SELECT Curso, Alumnos, Promedio, Ingresos FROM VentasGeneral 
	WHERE Instructor = vg_ID 
		AND Estado = vg_estado 
		AND Categoria = vg_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y')
    GROUP BY Curso;
END IF;
END //
DELIMITER ;


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





DROP PROCEDURE IF EXISTS GananciasTotalesSP;
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
	SELECT FormaPago, CONCAT('$', FORMAT(SUM(IngresosTotales), 2)) AS IngresosTotales FROM (
	SELECT Curso, FormaPago, IngresosTotales FROM GananciasTotales
	WHERE Instructor = gt_ID 
		AND Estado = gt_estado 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y')
	GROUP BY Curso, FormaPago
    ) AS Subquery
    GROUP BY FormaPago;
ELSEIF gt_categoria != 'Todas' AND gt_estado = 'Todos' THEN
	SELECT FormaPago, CONCAT('$', FORMAT(SUM(IngresosTotales), 2)) AS IngresosTotales FROM GananciasTotales
	WHERE Instructor = gt_ID 
		AND Categoria = gt_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y')
	GROUP BY FormaPago;
ELSEIF gt_categoria = 'Todas' AND gt_estado = 'Todos' THEN
	SELECT FormaPago, CONCAT('$', FORMAT(SUM(IngresosTotales), 2)) AS IngresosTotales FROM (
	SELECT Curso, FormaPago, IngresosTotales FROM GananciasTotales
    WHERE Instructor = gt_ID 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y')
    GROUP BY Curso, FormaPago
    ) AS Subquery
    GROUP BY FormaPago;
ELSE 
	SELECT FormaPago, CONCAT('$', FORMAT(SUM(IngresosTotales), 2)) AS IngresosTotales FROM GananciasTotales
	WHERE Instructor = gt_ID 
		AND Estado = gt_estado 
		AND Categoria = gt_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y')
	GROUP BY FormaPago, Categoria;
END IF;
END //
DELIMITER ;





DROP PROCEDURE IF EXISTS GananciasPorCursoSP;
DELIMITER //
CREATE PROCEDURE GananciasPorCursoSP(
IN gt_ID INT,
IN gt_curso VARCHAR(255),
IN gt_desde VARCHAR(255),
IN gt_hasta VARCHAR(255),
IN gt_categoria VARCHAR(255),
IN gt_estado VARCHAR(255)
)
BEGIN
IF gt_categoria = 'Todas' AND gt_estado != 'Todos' THEN
	SELECT FormaPago, IngresosTotales FROM GananciasPorCurso
	WHERE Instructor = gt_ID AND Curso = gt_curso
		AND Estado = gt_estado 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y');
ELSEIF gt_estado = 'Todos' AND gt_categoria != 'Todas'THEN
	SELECT FormaPago, IngresosTotales FROM GananciasPorCurso
	WHERE Instructor = gt_ID AND Curso = gt_curso
		AND Categoria = gt_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y');
ELSEIF gt_categoria = 'Todas' AND gt_estado = 'Todos' THEN
	SELECT FormaPago, IngresosTotales FROM GananciasPorCurso
    WHERE Instructor = gt_ID AND Curso = gt_curso
    AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y');
ELSE 
	SELECT FormaPago, IngresosTotales FROM GananciasPorCurso
	WHERE Instructor = gt_ID AND Curso = gt_curso
    AND Estado = gt_estado 
    AND Categoria = gt_categoria 
    AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y');
END IF;
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS TotalIngresos1SP;
DELIMITER // 
CREATE PROCEDURE TotalIngresos1SP(
IN ti_ID INT,
IN ti_desde VARCHAR(255),
IN ti_hasta VARCHAR(255),
IN ti_categoria VARCHAR(255),
IN ti_estado VARCHAR(255)
)
BEGIN 
IF ti_categoria = 'Todas' AND ti_estado != 'Todos' THEN
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM (
	SELECT Curso, Ingresos FROM TotalIngresos 
	WHERE Instructor = ti_ID 
		AND Estado = ti_estado 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y')
	GROUP BY Curso
        ) AS Subquery;
ELSEIF ti_categoria != 'Todas' AND ti_estado = 'Todos' THEN
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM TotalIngresos 
	WHERE Instructor = ti_ID 
		AND Categoria = ti_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y');
ELSEIF ti_categoria = 'Todas' AND ti_estado = 'Todos' THEN
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM (
	SELECT Curso, Ingresos FROM TotalIngresos 
    WHERE Instructor = ti_ID 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y')
        GROUP BY Curso
        ) AS Subquery;
ELSE 
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM TotalIngresos 
	WHERE Instructor = ti_ID 
		AND Estado = ti_estado 
		AND Categoria = ti_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y');
END IF;
END //
DELIMITER ;


DELIMITER // 
CREATE PROCEDURE TotalIngresos2SP(
IN ti_ID INT,
IN ti_curso VARCHAR(255),
IN ti_desde VARCHAR(255),
IN ti_hasta VARCHAR(255),
IN ti_categoria VARCHAR(255),
IN ti_estado VARCHAR(255)
)
BEGIN 
IF ti_categoria = 'Todas' AND ti_estado != 'Todos' THEN
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM TotalIngresos 
	WHERE Instructor = ti_ID AND Curso = ti_curso
		AND Estado = ti_estado 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y');
ELSEIF ti_categoria != 'Todas' AND ti_estado = 'Todos' THEN
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM TotalIngresos 
	WHERE Instructor = ti_ID AND Curso = ti_curso
		AND Categoria = ti_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y');
ELSEIF ti_categoria = 'Todas' AND ti_estado = 'Todos' THEN
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM TotalIngresos 
    WHERE Instructor = ti_ID AND Curso = ti_curso
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y');
ELSE 
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM TotalIngresos 
	WHERE Instructor = ti_ID AND Curso = ti_curso
		AND Estado = ti_estado 
		AND Categoria = ti_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y');
END IF;
END //
DELIMITER ;
