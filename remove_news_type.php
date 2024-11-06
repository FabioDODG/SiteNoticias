<?php 
require 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Verifica se o método de solicitação é POST e se o campo 'news_type' está presente no formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['news_type'])) {

    // Obtém o tipo de notícia a ser removido do formulário
    $news_type = $_POST['news_type'];

    // Prepara a consulta SQL para deletar a categoria do banco de dados, com base no tipo de notícia
    $stmt = $conn->prepare("DELETE FROM tb_tipo_noticias WHERE type = ?");

    // Associa o parâmetro de tipo de notícia à consulta, como uma string
    $stmt->bind_param("s", $news_type);

    // Executa a consulta e verifica se foi bem-sucedida
    if ($stmt->execute()) {
        // Se a execução for bem-sucedida, armazena uma mensagem de sucesso na sessão
        $_SESSION['mensagem'] = "Categoria removida com sucesso!";
    } else {
        // Caso ocorra um erro, armazena uma mensagem de erro na sessão
        $_SESSION['mensagem'] = "Erro ao remover a categoria: " . $stmt->error;
    }

    // Fecha a instrução preparada após a execução
    $stmt->close();

    // Redireciona para a página de gerenciamento de tipos de notícias
    header("Location: type_news.php");
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
