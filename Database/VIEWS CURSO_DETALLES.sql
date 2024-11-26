USE BDM;
DELIMITER //
CREATE VIEW ObtenerDetalleCurso AS
SELECT
	cu.ID,
	cu.Titulo AS NombreCurso,
    u.NombreUsuario AS Creador,
    cu.Descripcion AS Descripcion,
    cu.Costo AS Precio,
    cu.PromedioCalificacion AS Rating,
    cu.Imagen AS Imagen,
    cu.CantidadNiveles AS ProgramaCurso
FROM Curso cu 
INNER JOIN Usuario u ON cu.UsuarioCreador = u.ID;
DELIMITER ;

DELIMITER //
CREATE VIEW ObtenerComentariosCurso AS
SELECT
	cu.ID AS ID,
	u.NombreUsuario AS NombreComentario,
    co.Texto AS Comentario,
    co.FechaHora AS FechaComentario,
    co.Calificacion AS CalificacionComentario
FROM Comentario co
INNER JOIN Usuario u ON co.UsuarioID = u.ID
INNER JOIN Curso cu ON cu.ID = co.CursoID;
DELIMITER ;

DELIMITER //
CREATE VIEW ObtenerNivelesCurso AS
SELECT
	cu.ID AS ID,
    n.ID AS IdNivel,
    n.Nombre AS Nombre,
    n.Descripcion AS Descripcion,
    n.Video AS Video,
    n.Documento AS Documento,
    n.LinkRef AS Link,
    n.Costo
FROM Nivel n 
INNER JOIN Curso cu ON n.CursoID = cu.ID;
DELIMITER ;

DELIMITER //
CREATE VIEW ObtenerNivelIndividual AS
SELECT
    n.ID AS IdNivel,
    n.Nombre AS Nombre,
    n.Costo AS Costo
FROM Nivel n;
DELIMITER ;

SELECT * FROM ObtenerDetalleCurso WHERE ID = 31;
SELECT * FROM ObtenerComentariosCurso WHERE ID = 31;
SELECT * FROM ObtenerNivelesCurso WHERE ID = 31;
SELECT * FROM ObtenerNivelIndividual WHERE IdNivel = 1;



