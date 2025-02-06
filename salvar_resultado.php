<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $premio = $_POST['premio'];

    $stmt = $conn->prepare("INSERT INTO resultados (usuario, premio) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $premio);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Resultado salvo com sucesso!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro ao salvar resultado."]);
    }

    $stmt->close();
    $conn->close();
}
?>
