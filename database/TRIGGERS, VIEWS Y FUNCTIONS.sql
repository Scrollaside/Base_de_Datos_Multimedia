DROP VIEW IF EXISTS View_MejoresCalificados;
DROP VIEW IF EXISTS View_MasVendidos;
DROP VIEW IF EXISTS View_MasRecientes;

SELECT * FROM View_MejoresCalificados;
SELECT * FROM View_MasVendidos;
SELECT * FROM View_MasRecientes;

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

-- VIEW 4, REPORTE DE USUARIOS
CREATE VIEW VistaReporteUsuarios AS
SELECT 
    u.NombreUsuario AS Usuario, 
    u.NombreCompleto AS Nombre, 
    DATE_FORMAT(u.FechaRegistro, '%M %D, %Y') AS Ingreso, 
    r.CursosTotal AS Cursos, 
    r.Total AS Total,
    r.Tipo AS Tipo
FROM Usuario u
JOIN ReporteUsuario r
ON u.ID = r.UsuarioID; 

-- VIEW 5, Categorias
ALTER VIEW VistaCategorias AS
SELECT ct.ID, ct.Nombre, ct.Descripcion, u.NombreUsuario AS Creador,  DATE_FORMAT(ct.Creacion, '%M %D %Y, %H:%i') AS Creacion
FROM Categoria ct
JOIN Usuario u 
ON ct.Creador = u.ID;

-- VIEW 6
-- VIEW 7
-- VIEW 8

-- FUNCTION 1
-- FUNCTION 2
-- FUNCTION 3
-- FUNCTION 4
-- FUNCTION 5
-- FUNCTION 6
-- FUNCTION 7
-- FUNCTION 8


-- TRIGGER 1, Generar un diploma automáticamente al finalizar un curso
CREATE TRIGGER Generar_Diploma
AFTER UPDATE ON Inscripcion
FOR EACH ROW
BEGIN
    IF NEW.Estado = 1 AND OLD.Estado = 0 THEN
        INSERT INTO Diploma (EstudianteID, CursoID, FechaFin, InstructorID)
        VALUES (
            NEW.UsuarioID,
            NEW.NivelID,
            NOW(),
            (SELECT UsuarioCreador FROM Curso WHERE ID = NEW.NivelID)
        );
    END IF;
END;


-- TRIGGER 2
