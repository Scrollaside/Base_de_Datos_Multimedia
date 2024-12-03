USE BDM;
-- VIEW 1 PARA CURSOS MEJOR CALIFICADOS
CREATE VIEW View_MejoresCalificados AS
SELECT 
    Curso.ID,
    Curso.Titulo,
    Curso.Descripcion,
    Curso.Imagen,
    GROUP_CONCAT(Categoria.Nombre SEPARATOR ', ') AS Categorias,
    Curso.PromedioCalificacion
FROM 
    Curso
JOIN 
    CursoCategoria ON Curso.ID = CursoCategoria.CursoID
JOIN 
    Categoria ON CursoCategoria.CategoriaID = Categoria.ID
WHERE 
    Curso.Estado = 'Activo'
GROUP BY 
    Curso.ID
ORDER BY 
    Curso.PromedioCalificacion DESC
LIMIT 5;

SELECT * FROM View_MejoresCalificados;

-- VIEW 2 PARA CURSOS MÁS VENDIDOS
CREATE VIEW View_MasVendidos AS
SELECT 
    Curso.ID,
    Curso.Titulo,
    Curso.Descripcion,
    Curso.Imagen,
    GROUP_CONCAT(Categoria.Nombre SEPARATOR ', ') AS Categorias,
    Curso.CantidadVendidas,
    Curso.PromedioCalificacion
FROM 
    Curso
JOIN 
    CursoCategoria ON Curso.ID = CursoCategoria.CursoID
JOIN 
    Categoria ON CursoCategoria.CategoriaID = Categoria.ID
WHERE 
    Curso.Estado = 'Activo'
GROUP BY 
    Curso.ID
ORDER BY 
    Curso.CantidadVendidas DESC
LIMIT 5;

SELECT * FROM  View_MasVendidos;

-- VIEW 3 PARA CURSOS MÁS RECIENTES
CREATE VIEW View_MasRecientes AS
SELECT 
    Curso.ID,
    Curso.Titulo,
    Curso.Descripcion,
    Curso.Imagen,
    GROUP_CONCAT(Categoria.Nombre SEPARATOR ', ') AS Categorias,
    Curso.FechaCreacion,
    Curso.PromedioCalificacion
FROM 
    Curso
JOIN 
    CursoCategoria ON Curso.ID = CursoCategoria.CursoID
JOIN 
    Categoria ON CursoCategoria.CategoriaID = Categoria.ID
WHERE 
    Curso.Estado = 'Activo'
GROUP BY 
    Curso.ID
ORDER BY 
    Curso.FechaCreacion DESC
LIMIT 5;

SELECT * FROM View_MasRecientes;

-- VIEW 4, REPORTE DE USUARIOS
CREATE VIEW VistaReporteUsuarios AS
SELECT 
    u.NombreUsuario AS Usuario, 
    u.NombreCompleto AS Nombre, 
    DATE_FORMAT(u.FechaRegistro, '%d-%b-%Y') AS Ingreso, 
    r.CursosTotal AS Cursos, 
    r.Total AS Total,
    u.TipoUsuario AS Tipo
FROM Usuario u
JOIN ReporteUsuario r
ON u.ID = r.UsuarioID; 

SELECT * FROM VistaReporteUsuarios;

-- VIEW 5, Categorias
CREATE VIEW VistaCategorias AS
SELECT ct.Nombre, ct.Descripcion, u.NombreUsuario AS Creador,  DATE_FORMAT(ct.Creacion, '%d %b %Y, %H:%i') AS Creacion -- , ct.ID
FROM Categoria ct
JOIN Usuario u ON ct.Creador = u.ID;

SELECT * FROM VistaCategorias;

-- VIEW 6
CREATE VIEW VentasGeneral AS
SELECT 
    c.Titulo AS Curso, 
    COUNT(DISTINCT u.ID) AS Alumnos,
    FORMAT (AVG(n.Numero), 0) AS Promedio,
    CONCAT('$', FORMAT(SUM(n.Costo), 2)) AS Ingresos,
    c.UsuarioCreador AS Instructor,
    DATE_FORMAT(c.FechaCreacion, '%d/%m/%Y') AS Creacion,
    cg.Nombre AS Categoria,
    c.Estado AS Estado
FROM Inscripcion i
INNER JOIN Nivel n ON n.ID = i.NivelID
INNER JOIN Curso c ON c.ID = n.CursoID
INNER JOIN Usuario u ON u.ID = i.UsuarioID
INNER JOIN CursoCategoria cc ON cc.CursoID = c.ID
INNER JOIN Categoria cg ON cg.ID = cc.CategoriaID
GROUP BY 
    c.ID;

SELECT * FROM VentasGeneral;

-- VIEW 7
CREATE VIEW MetodoPago AS
SELECT c.Titulo AS Curso, i.MetodoPago, CONCAT('$', FORMAT(SUM(n.Costo), 2)) AS TotalGanancias, c.UsuarioCreador AS Instructor
FROM Inscripcion i
JOIN Nivel n ON i.NivelID = n.ID
JOIN Curso c ON n.CursoID = c.ID
GROUP BY c.Titulo, i.MetodoPago;

SELECT * FROM MetodoPago;

-- VIEW 8
CREATE VIEW VentasPorCurso AS
SELECT 
	u.NombreCompleto AS Alumno, 
	DATE_FORMAT(i.FechaInscripcion, '%d/%m/%Y') AS Inscripcion, 
    MAX(n.Numero) AS Nivel, 
	CONCAT('$', FORMAT(SUM(n.Costo), 2)) AS Pago,
	FORMAT (AVG(i.MetodoPago), 0) AS Forma,
     c.UsuarioCreador AS Instructor
FROM Inscripcion i
INNER JOIN Nivel n ON n.ID = i.NivelID
INNER JOIN Curso c ON c.ID = n.CursoID
INNER JOIN Usuario u ON u.ID = i.UsuarioID
INNER JOIN CursoCategoria cc ON cc.CursoID = c.ID
INNER JOIN Categoria cg ON cg.ID = cc.CategoriaID
GROUP BY 
    c.ID;

SELECT * FROM VentasPorCurso;
