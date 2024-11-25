

-- VIEW 1 PARA CURSOS MEJOR CALIFICADOS
CREATE VIEW View_MejoresCalificados AS
SELECT ID, Titulo, Descripcion, Imagen, PromedioCalificacion
FROM Curso
WHERE Estado = 'Activo'
ORDER BY PromedioCalificacion DESC
LIMIT 5;


-- VIEW 2 PARA CURSOS MÁS VENDIDOS
CREATE VIEW View_MasVendidos AS
SELECT ID, Titulo, Descripcion, Imagen, CantidadVendidas
FROM Curso
WHERE Estado = 'Activo'
ORDER BY CantidadVendidas DESC
LIMIT 5;


-- VIEW 3 PARA CURSOS MÁS RECIENTES
CREATE VIEW View_MasRecientes AS
SELECT ID, Titulo, Descripcion, Imagen, FechaCreacion
FROM Curso
WHERE Estado = 'Activo'
ORDER BY FechaCreacion DESC
LIMIT 5;


-- VIEW 4
-- VIEW 5
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


-- TRIGGER 1
-- TRIGGER 2
