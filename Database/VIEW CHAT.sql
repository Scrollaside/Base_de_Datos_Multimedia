USE BDM;

--
CREATE VIEW obtenerMensajes AS
SELECT
	n.ID AS idNivel,
    m.Texto AS Texto,
    m.FechaHora AS Fecha,
    m.Remitente AS Remitente,
    m.Destinatario AS Destinatario,
    ur.NombreUsuario AS NombreRemitente,
    ud.NombreUsuario AS NombreDestinatario
FROM Mensaje m
INNER JOIN Nivel n ON n.ID = m.NivelID
INNER JOIN Usuario ur ON ur.ID = m.Remitente
INNER JOIN Usuario ud ON ud.ID = m.Destinatario
ORDER BY 
    m.FechaHora ASC;
--

--
CREATE VIEW obtenerMiembrosCurso AS
SELECT
	u.ID AS IdUsuario,
    n.ID AS IdNivel,
	u.NombreUsuario AS Miembro,
    u.Foto AS FotoPerfil
FROM Inscripcion i
INNER JOIN Nivel n ON n.ID = i.NivelID
INNER JOIN Usuario u ON u.ID = i.UsuarioID;
--
SELECT * FROM Inscripcion;
SELECT * FROM Mensaje;
SELECT * FROM obtenerMiembrosCurso WHERE IdNivel = 4;

SELECT * FROM Nivel;
SELECT * FROM Mensaje;
SELECT * FROM obtenerMensajes WHERE (Remitente = 2 OR Remitente = 4) AND (Destinatario = 4 OR Destinatario = 2) AND idNivel = 4;

SELECT * FROM obtenerMensajes WHERE Remitente = 4 AND Destinatario = 2 AND Curso = 2;