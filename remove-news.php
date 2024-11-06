<?php 
require 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Verifica se o parâmetro 'id' está presente na URL (usado para identificar a notícia a ser removida)
if (isset($_GET['id'])) {
    
    // Converte o valor de 'id' para um inteiro para garantir que seja um número válido
    $id = intval($_GET['id']);

    // Prepara a consulta SQL para deletar a notícia com o ID especificado
    $sql = "DELETE FROM tb_noticias WHERE id = ?";
    $stmt = $conn->prepare($sql); // Prepara a consulta para evitar SQL Injection
    $stmt->bind_param("i", $id); // Associa o parâmetro de ID à consulta como um inteiro

    // Executa a consulta e verifica se foi bem-sucedida
    if ($stmt->execute()) {
        // Se a execução for bem-sucedida, armazena uma mensagem de sucesso na sessão
        $_SESSION['mensagem'] = "Notícia removida com sucesso!";
    } else {
        // Caso ocorra um erro, armazena uma mensagem de erro na sessão
        $_SESSION['mensagem'] = "Erro ao remover a notícia: " . $stmt->error;
    }

    // Fecha a instrução preparada após a execução
    $stmt->close();

    // Redireciona para a página principal de notícias
    header("Location: index.php");
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
