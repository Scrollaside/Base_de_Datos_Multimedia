
-- Índice en el campo Email (como es único, para búsquedas rápidas)
CREATE UNIQUE INDEX idx_Usuario_Email ON Usuario (Email);

-- Índice en el campo TipoUsuario (para consultas por tipo de usuario)
CREATE NONCLUSTERED INDEX idx_Usuario_TipoUsuario ON Usuario (TipoUsuario);

-- Índice en el campo Estado (para consultas por estado del usuario)
CREATE NONCLUSTERED INDEX idx_Usuario_Estado ON Usuario (Estado);


-- Índice en el campo Nombre (para búsquedas rápidas por nombre de la categoría)
CREATE NONCLUSTERED INDEX idx_Categoria_Nombre ON Categoria (Nombre);

-- Índice en el campo Titulo (para búsquedas rápidas por título del curso)
CREATE NONCLUSTERED INDEX idx_Curso_Titulo ON Curso (Titulo);

-- Índice en el campo Estado (para consultar cursos por estado)
CREATE NONCLUSTERED INDEX idx_Curso_Estado ON Curso (Estado);

-- Índice en el campo CategoriaID (para consultar cursos por categoría)
CREATE NONCLUSTERED INDEX idx_Curso_CategoriaID ON Curso (CategoriaID);

-- Índice en el campo UsuarioID (para consultar registros por usuario)
CREATE NONCLUSTERED INDEX idx_RegistroCurso_UsuarioID ON RegistroCurso (UsuarioID);

-- Índice en el campo CursoID (para consultar registros por curso)
CREATE NONCLUSTERED INDEX idx_RegistroCurso_CursoID ON RegistroCurso (CursoID);
