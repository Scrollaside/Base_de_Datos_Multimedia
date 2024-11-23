<?php
session_start();
header('Content-Type: application/json');

// Verificar si hay un inicio de sesión
if (isset($_SESSION['ID'])) {
    echo json_encode([
        'ID' => $_SESSION['ID'],
        'NombreCompleto' => $_SESSION['NombreCompleto'],
        'NombreUsuario' => $_SESSION['NombreUsuario'],
        'Genero' => $_SESSION['Genero'],
        'FechaNacimiento' => $_SESSION['FechaNacimiento'],
        'Email' => $_SESSION['Email'],
        'TipoUsuario' => $_SESSION['TipoUsuario'],
        'Estado' => $_SESSION['Estado']
    ]);
} else {
    echo json_encode(['error' => 'No hay sesión activa']);
}
