<?php
$host = "localhost";
$user = "root"; // Altere se necessário
$pass = "Kamilly2002@"; // Defina a senha se houver
$db = "bloco_notas";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
