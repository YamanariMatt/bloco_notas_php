<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input to prevent XSS
    $titulo = htmlspecialchars($_POST['titulo']);
    $conteudo = htmlspecialchars($_POST['conteudo']);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO notas (titulo, conteudo) VALUES (?, ?)");
    $stmt->bind_param("ss", $titulo, $conteudo);  // "ss" means two string parameters

    // Execute the query and check for success
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();  // Important to call exit() after header redirect to stop further script execution
    } else {
        echo "Erro ao salvar a nota.";
    }

    $stmt->close();
}
?>

<form method="POST">
    <input type="text" name="titulo" placeholder="Título" required>
    <textarea name="conteudo" placeholder="Escreva sua nota..." required></textarea>
    <button type="submit">Salvar</button>
</form>
<a href="index.php">Voltar</a>
<head>
    <meta charset="UTF-8">
    <title>Bloco de Notas</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
