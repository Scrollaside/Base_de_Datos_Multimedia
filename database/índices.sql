
-- �ndice en el campo Email (como es �nico, para b�squedas r�pidas)
CREATE UNIQUE INDEX idx_Usuario_Email ON Usuario (Email);

-- �ndice en el campo TipoUsuario (para consultas por tipo de usuario)
CREATE NONCLUSTERED INDEX idx_Usuario_TipoUsuario ON Usuario (TipoUsuario);

-- �ndice en el campo Estado (para consultas por estado del usuario)
CREATE NONCLUSTERED INDEX idx_Usuario_Estado ON Usuario (Estado);


-- �ndice en el campo Nombre (para b�squedas r�pidas por nombre de la categor�a)
CREATE NONCLUSTERED INDEX idx_Categoria_Nombre ON Categoria (Nombre);

-- �ndice en el campo Titulo (para b�squedas r�pidas por t�tulo del curso)
CREATE NONCLUSTERED INDEX idx_Curso_Titulo ON Curso (Titulo);

-- �ndice en el campo Estado (para consultar cursos por estado)
CREATE NONCLUSTERED INDEX idx_Curso_Estado ON Curso (Estado);

-- �ndice en el campo CategoriaID (para consultar cursos por categor�a)
CREATE NONCLUSTERED INDEX idx_Curso_CategoriaID ON Curso (CategoriaID);

-- �ndice en el campo UsuarioID (para consultar registros por usuario)
CREATE NONCLUSTERED INDEX idx_RegistroCurso_UsuarioID ON RegistroCurso (UsuarioID);

-- �ndice en el campo CursoID (para consultar registros por curso)
CREATE NONCLUSTERED INDEX idx_RegistroCurso_CursoID ON RegistroCurso (CursoID);
