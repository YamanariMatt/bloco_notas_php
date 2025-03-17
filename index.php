<?php
include 'config.php';

// Realizar a consulta para buscar todas as notas
$sql = "SELECT * FROM notas ORDER BY data_criacao DESC";
$result = $conn->query($sql);

// Verificar se a consulta foi bem-sucedida
if (!$result) {
    die("Erro na consulta: " . $conn->error);  // Exibir erro se houver falha na consulta
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bloco de Notas</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Bloco de Notas</h1>
        <a href="criar.php">Nova Nota</a>
        <ul>
            <?php 
            // Verificar se há resultados e exibir as notas
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li>
                            <a href='ver.php?id=" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['titulo']) . "</a>
                            <a href='editar.php?id=" . htmlspecialchars($row['id']) . "'>✏️</a>
                            <a href='deletar.php?id=" . htmlspecialchars($row['id']) . "' onclick='return confirm(\"Deletar Nota?\")'>🗑️</a>
                          </li>";
                }
            } else {
                echo "<li>Nenhuma nota encontrada.</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
