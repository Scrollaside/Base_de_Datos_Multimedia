CREATE VIEW VistaReporteUsuarios AS
SELECT 
    u.NombreUsuario AS Usuario, 
    u.NombreCompleto AS Nombre, 
    u.FechaRegistro AS Ingreso, 
    r.CursosTotal AS Cursos, 
    r.Total AS Total,
    r.Tipo AS Tipo
FROM Usuario u
JOIN ReporteUsuario r
ON u.ID = r.UsuarioID;

CREATE VIEW InformacionDeUsuario AS 
SELECT ID, NombreCompleto, NombreUsuario, Genero, FechaNacimiento, Email, Contraseña 
FROM Usuario;