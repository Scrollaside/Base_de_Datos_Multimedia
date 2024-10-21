<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes Privados</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/NavBar.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .chat-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            height: 500px;
            overflow-y: auto;
        }
        .message {
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
        }
        .message .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }
        .message .content {
            background-color: #f1f1f1;
            border-radius: 15px;
            padding: 10px 15px;
            max-width: 70%;
        }
        .message .content p {
            margin: 0;
        }
        .message .meta {
            font-size: 12px;
            color: gray;
        }
        .instructor {
            justify-content: flex-start;
        }
        .student {
            justify-content: flex-end;
        }
        .student .content {
            background-color: #d4edda;
        }
        .message-form {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    
<!-- Contenido Principal - Mensajes Privados -->
<div class="container">
    <h3 class="text-center mb-4">Mensajes Privados - Preguntas del Curso</h3>
    <div class="chat-container">
        <!-- Mensaje del Instructor -->
        <div class="message instructor">
            <img src="https://via.placeholder.com/50" alt="Instructor" class="avatar">
            <div class="content">
                <p>Hola, ¿en qué puedo ayudarte con el curso?</p>
                <div class="meta">Instructor - 14/09/2024 10:00 AM</div>
            </div>
        </div>

        <!-- Mensaje del Estudiante -->
        <div class="message student">
            <div class="content">
                <p>Hola, tengo una duda acerca del proyecto final. ¿Puedes explicarlo?</p>
                <div class="meta">Estudiante - 14/09/2024 10:15 AM</div>
            </div>
            <img src="https://via.placeholder.com/50" alt="Estudiante" class="avatar">
        </div>

        <!-- Mensaje del Instructor -->
        <div class="message instructor">
            <img src="https://via.placeholder.com/50" alt="Instructor" class="avatar">
            <div class="content">
                <p>Claro, el proyecto final consiste en aplicar todo lo aprendido en el curso para desarrollar una aplicación web.</p>
                <div class="meta">Instructor - 14/09/2024 10:20 AM</div>
            </div>
        </div>

        <!-- Más mensajes aquí -->
    </div>

    <!-- Formulario para enviar mensajes -->
    <div class="message-form">
        <form>
            <div class="mb-3">
                <textarea class="form-control" id="messageInput" rows="3" placeholder="Escribe tu mensaje..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS y dependencias de Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="js/loadNavBar.js"></script>

</body>
</html>
