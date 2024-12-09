-- VIEWS --

CREATE OR REPLACE VIEW KardexCursos AS
SELECT 
	u.ID AS usuario_id,
    cg.Nombre AS categoria,
	c.ID AS curso_id, 
    c.Titulo AS nombre_curso, 
	n.ID AS nivel_id,
    n.Nombre AS nombre_nivel,
    c.Estado AS Estado, 
    DATE_FORMAT((MIN(i.FechaInscripcion)), '%d/%m/%Y') AS fecha_inscripcion, 
    DATE_FORMAT((MAX(i.FechaAcceso)), '%d/%m/%Y') AS ultima_fecha_acceso,
    DATE_FORMAT((MAX(d.FechaFin)), '%d/%m/%Y') AS fecha_finalizacion
FROM Inscripcion i
LEFT JOIN Nivel n ON n.ID = i.NivelID
LEFT JOIN Curso c ON c.ID = n.CursoID
LEFT JOIN Usuario u ON u.ID = i.UsuarioID
LEFT JOIN Diploma d ON d.EstudianteID = u.ID
INNER JOIN CursoCategoria cc ON cc.CursoID = c.ID
INNER JOIN Categoria cg ON cg.ID = cc.CategoriaID
GROUP BY u.ID, c.ID, c.Estado, cg.Nombre;
 
SELECT * FROM KardexCursos;

CREATE OR REPLACE VIEW KardexNivel AS
SELECT 
	u.ID AS usuario_id,
    cg.Nombre AS categoria,
	c.ID AS curso_id, 
    c.Titulo AS nombre_curso, 
    c.Estado AS Estado, 
    DATE_FORMAT((MIN(i.FechaInscripcion)), '%d/%m/%Y') AS fecha_inscripcion, 
    DATE_FORMAT((MAX(i.FechaAcceso)), '%d/%m/%Y') AS ultima_fecha_acceso,
    DATE_FORMAT((MAX(d.FechaFin)), '%d/%m/%Y') AS fecha_finalizacion
FROM Inscripcion i
LEFT JOIN Nivel n ON n.ID = i.NivelID
LEFT JOIN Curso c ON c.ID = n.CursoID
LEFT JOIN Usuario u ON u.ID = i.UsuarioID
LEFT JOIN Diploma d ON d.EstudianteID = u.ID
INNER JOIN CursoCategoria cc ON cc.CursoID = c.ID
INNER JOIN Categoria cg ON cg.ID = cc.CategoriaID
GROUP BY u.ID, c.ID, c.Estado, cg.Nombre;

SELECT * FROM KardexNivel;

SELECT * FROM Inscripcion where UsuarioID = '6';


-- STORED PROCEDURES --

DROP PROCEDURE IF EXISTS KardexCursosSP;
DELIMITER //
CREATE PROCEDURE KardexCursosSP(
IN kc_ID INT,
IN kc_desde VARCHAR(255),
IN kc_hasta VARCHAR(255),
IN kc_categoria VARCHAR(255),
IN kc_estado VARCHAR(255)
)
BEGIN
IF kc_categoria = 'Todas' AND kc_estado = 'Todos' THEN -- Sin Filtro
	SELECT curso_id, nombre_curso, Estado, fecha_inscripcion, ultima_fecha_acceso, fecha_finalizacion FROM KardexCursos
    WHERE usuario_id = kc_ID 
		AND STR_TO_DATE(fecha_inscripcion, '%d/%m/%Y') BETWEEN STR_TO_DATE(kc_desde, '%d/%m/%Y') AND STR_TO_DATE(kc_hasta, '%d/%m/%Y')
    GROUP BY curso_id;
ELSEIF kc_categoria = 'Todas' AND kc_estado != 'Todos' THEN -- Filtrar Estado
	SELECT curso_id, nombre_curso, Estado, fecha_inscripcion, ultima_fecha_acceso, fecha_finalizacion FROM KardexCursos
	WHERE usuario_id = kc_ID 
		AND Estado = kc_estado 
		AND STR_TO_DATE(fecha_inscripcion, '%d/%m/%Y') BETWEEN STR_TO_DATE(kc_desde, '%d/%m/%Y') AND STR_TO_DATE(kc_hasta, '%d/%m/%Y')
	GROUP BY curso_id;
ELSEIF kc_categoria != 'Todas' AND kc_estado = 'Todos' THEN -- Filtrar Categoria
	SELECT curso_id, nombre_curso, Estado, fecha_inscripcion, ultima_fecha_acceso, fecha_finalizacion FROM KardexCursos
	WHERE usuario_id = kc_ID 
		AND categoria = kc_categoria 
		AND STR_TO_DATE(fecha_inscripcion, '%d/%m/%Y') BETWEEN STR_TO_DATE(kc_desde, '%d/%m/%Y') AND STR_TO_DATE(kc_hasta, '%d/%m/%Y')
	GROUP BY curso_id;
ELSE -- Filtrar Categoria & Estado
	SELECT curso_id, nombre_curso, Estado, fecha_inscripcion, ultima_fecha_acceso, fecha_finalizacion FROM KardexCursos
	WHERE usuario_id = kc_ID 
		AND Estado = kc_estado 
		AND categoria = kc_categoria 
		AND STR_TO_DATE(fecha_inscripcion, '%d/%m/%Y') BETWEEN STR_TO_DATE(kc_desde, '%d/%m/%Y') AND STR_TO_DATE(kc_hasta, '%d/%m/%Y')
    GROUP BY curso_id;
END IF;
END //
DELIMITER ;

CALL KardexCursosSP('6', '01/01/1001', '08/12/2024', 'Todas', 'Todos'); -- Datos para la tabla Cursos Inscritos


DROP PROCEDURE IF EXISTS KardexNivelesSP;
DELIMITER //
CREATE PROCEDURE KardexNivelesSP(
IN kc_ID INT,
IN kc_desde VARCHAR(255),
IN kc_hasta VARCHAR(255),
IN kc_categoria VARCHAR(255),
IN kc_estado VARCHAR(255)
)
BEGIN
IF kc_categoria = 'Todas' AND kc_estado = 'Todos' THEN -- Sin Filtro
	SELECT nivel_id, nombre_curso, nombre_nivel, fecha_inscripcion, ultima_fecha_acceso, fecha_finalizacion FROM KardexCursos
    WHERE usuario_id = kc_ID 
		AND STR_TO_DATE(fecha_inscripcion, '%d/%m/%Y') BETWEEN STR_TO_DATE(kc_desde, '%d/%m/%Y') AND STR_TO_DATE(kc_hasta, '%d/%m/%Y')
    GROUP BY curso_id;
ELSEIF kc_categoria = 'Todas' AND kc_estado != 'Todos' THEN -- Filtrar Estado
	SELECT nivel_id, nombre_curso, nombre_nivel, fecha_inscripcion, ultima_fecha_acceso, fecha_finalizacion FROM KardexCursos
	WHERE usuario_id = kc_ID 
		AND Estado = kc_estado 
		AND STR_TO_DATE(fecha_inscripcion, '%d/%m/%Y') BETWEEN STR_TO_DATE(kc_desde, '%d/%m/%Y') AND STR_TO_DATE(kc_hasta, '%d/%m/%Y')
	GROUP BY curso_id;
ELSEIF kc_categoria != 'Todas' AND kc_estado = 'Todos' THEN -- Filtrar Categoria
	SELECT nivel_id, nombre_curso, nombre_nivel, fecha_inscripcion, ultima_fecha_acceso, fecha_finalizacion FROM KardexCursos
	WHERE usuario_id = kc_ID 
		AND categoria = kc_categoria 
		AND STR_TO_DATE(fecha_inscripcion, '%d/%m/%Y') BETWEEN STR_TO_DATE(kc_desde, '%d/%m/%Y') AND STR_TO_DATE(kc_hasta, '%d/%m/%Y')
	GROUP BY curso_id;
ELSE -- Filtrar Categoria & Estado
	SELECT nivel_id, nombre_curso, nombre_nivel, fecha_inscripcion, ultima_fecha_acceso, fecha_finalizacion FROM KardexCursos
	WHERE usuario_id = kc_ID 
		AND Estado = kc_estado 
		AND categoria = kc_categoria 
		AND STR_TO_DATE(fecha_inscripcion, '%d/%m/%Y') BETWEEN STR_TO_DATE(kc_desde, '%d/%m/%Y') AND STR_TO_DATE(kc_hasta, '%d/%m/%Y')
    GROUP BY curso_id;
END IF;
END //
DELIMITER ;

CALL KardexNivelesSP('6', '01/01/1001', '08/12/2024', 'Todas', 'Todos'); -- Datos para la tabla Niveles Inscritos













-- BACKUP --
SELECT c.ID AS curso_id, c.Titulo AS nombre_curso, c.Estado, 
                       MIN(i.FechaInscripcion) AS fecha_inscripcion, 
                       MAX(i.FechaAcceso) AS ultima_fecha_acceso,
                       MAX(d.FechaFin) AS fecha_finalizacion
                FROM Curso c
                LEFT JOIN Nivel n ON c.ID = n.CursoID
                LEFT JOIN Inscripcion i ON n.ID = i.NivelID AND i.UsuarioID = '6'
                LEFT JOIN Diploma d ON d.EstudianteID = '6' AND d.CursoID = c.ID
                WHERE c.ID IN (
                    SELECT n.CursoID
                    FROM Inscripcion i
                    JOIN Nivel n ON i.NivelID = n.ID
                    WHERE i.UsuarioID = '6'
                )
                GROUP BY c.ID, c.Titulo, c.Estado;
                
SELECT n.ID AS nivel_id, c.Titulo AS nombre_curso, n.Nombre AS nombre_nivel, 
                       i.FechaInscripcion, i.FechaAcceso, i.FechaFinalizacion
                FROM Inscripcion i
                JOIN Nivel n ON i.NivelID = n.ID
                JOIN Curso c ON n.CursoID = c.ID
                WHERE i.UsuarioID = '6'