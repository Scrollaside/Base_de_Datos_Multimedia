USE BDM;

DELIMITER //
CREATE PROCEDURE mandarMensaje (
    IN p_texto TEXT,
    IN p_remitenteID INT,
    IN p_destinatarioID INT,
    IN p_nivelID INT
)
BEGIN
    INSERT INTO Mensaje (Texto, FechaHora, Remitente, Destinatario, NivelID)
    VALUES (p_texto, NOW(), p_remitenteID, p_destinatarioID, p_nivelID);
END //
DELIMITER ;

SELECT * FROM Usuario;
SELECT * FROM Curso;
SELECT * FROM Mensaje;

CALL mandarMensaje('Hola!', 2, 4, 4);
CALL mandarMensaje('Hola, k hay?', 4, 2, 4);
CALL mandarMensaje('No mucho, oye', 2, 4, 4);
CALL mandarMensaje('Veo que estamos en el mismo grupo, te interesa si hacemos un grupo por discord?', 2, 4, 4);
CALL mandarMensaje('Claro, te paso mi user, espera', 4, 2, 4);
CALL mandarMensaje('NickoAvocado2000, listo', 4, 2, 4);