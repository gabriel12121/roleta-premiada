<?php
$host = "localhost"; // Mude se necessário
$user = "root"; // Seu usuário do MySQL
$password = ""; // Sua senha do MySQL
$dbname = "roleta_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
