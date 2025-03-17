<?php
include 'config.php';

// Verificar se o ID foi passado e é válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];  // Converte o valor para inteiro para prevenir problemas de segurança

    // Usar prepared statement para evitar injeção de SQL
    $stmt = $conn->prepare("SELECT * FROM notas WHERE id = ?");
    $stmt->bind_param("i", $id);  // "i" significa que o parâmetro é um inteiro
    $stmt->execute();
    $result = $stmt->get_result();
    $nota = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "Nota não encontrada.";
    exit();
}
?>
<head>
    <meta charset="UTF-8">
    <title>Bloco de Notas</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<h2><?= htmlspecialchars($nota['titulo']) ?></h2>
<p><?= nl2br(htmlspecialchars($nota['conteudo'])) ?></p>
<a href="index.php">Voltar</a>
