<?php
include 'config.php';

// Validar se o ID foi passado corretamente e se é um número inteiro
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];  // Converte o valor para inteiro para garantir que é um número

    // Processar o formulário se o método for POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitar as entradas para evitar XSS
        $titulo = htmlspecialchars($_POST['titulo']);
        $conteudo = htmlspecialchars($_POST['conteudo']);

        // Usar prepared statement para evitar injeção de SQL
        $stmt = $conn->prepare("UPDATE notas SET titulo = ?, conteudo = ? WHERE id = ?");
        $stmt->bind_param("ssi", $titulo, $conteudo, $id);  // "ssi" significa string, string, inteiro

        // Executar a consulta e verificar se foi bem-sucedido
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();  // Chama exit() após o redirecionamento
        } else {
            echo "Erro ao atualizar a nota.";
        }

        $stmt->close();
    }

    // Obter os dados da nota para preencher o formulário
    $stmt = $conn->prepare("SELECT * FROM notas WHERE id = ?");
    $stmt->bind_param("i", $id);  // "i" significa inteiro
    $stmt->execute();
    $result = $stmt->get_result();
    $nota = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "ID inválido.";
}
?>
<head>
    <meta charset="UTF-8">
    <title>Bloco de Notas</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>


<form method="POST">
    <input type="text" name="titulo" value="<?= htmlspecialchars($nota['titulo']) ?>" required>
    <textarea name="conteudo" required><?= htmlspecialchars($nota['conteudo']) ?></textarea>
    <button type="submit">Atualizar</button>
</form>
<a href="index.php">Voltar</a>
