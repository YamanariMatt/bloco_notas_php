<?php
include 'config.php';

// Verificar se o ID foi passado na URL e se é um valor válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];  // Converte o valor para inteiro para evitar problemas

    // Usar prepared statement para evitar injeção de SQL
    $stmt = $conn->prepare("DELETE FROM notas WHERE id = ?");
    $stmt->bind_param("i", $id);  // "i" significa que o parâmetro é um inteiro

    // Executar a consulta e verificar se foi bem-sucedido
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();  // Chama exit() após o redirecionamento
    } else {
        echo "Erro ao excluir a nota.";
    }

    $stmt->close();
} else {
    echo "ID inválido.";
}
?>

