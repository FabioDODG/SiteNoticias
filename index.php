<?php 
require 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Obtém o termo de busca da URL, se existir, caso contrário, define como string vazia
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Declaração inicial da consulta SQL para buscar todas as notícias
$sql = "SELECT * FROM tb_noticias";

// Verifica se um termo de busca foi fornecido
if (!empty($query)) {
    // Adiciona condições à consulta para buscar por título ou descrição que correspondam ao termo de busca
    $sql .= " WHERE title LIKE ? OR description LIKE ?";

    // Prepara a consulta para evitar SQL Injection
    $stmt = $conn->prepare($sql);

    // Define o termo de busca, adicionando '%' antes e depois para busca parcial
    $searchTerm = '%' . $query . '%';

    // Associa o termo de busca como parâmetro para as condições de título e descrição
    $stmt->bind_param("ss", $searchTerm, $searchTerm);

    // Executa a consulta
    $stmt->execute();

    // Obtém os resultados como uma matriz associativa
    $result = $stmt->get_result();
    $news_items = $result->fetch_all(MYSQLI_ASSOC);

    // Fecha a instrução preparada
    $stmt->close();
} else {
    // Caso não haja termo de busca, executa a consulta padrão para buscar todas as notícias
    $result = $conn->query($sql);

    // Obtém todos os resultados como uma matriz associativa
    $news_items = $result->fetch_all(MYSQLI_ASSOC);
}

// Inicia o buffer de saída para capturar o conteúdo a ser exibido
ob_start();
?>

<!-- Geração de uma grade de notícias -->
<div class="news-grid">
    <?php foreach ($news_items as $news_item): ?> <!-- Itera sobre cada notícia obtida do banco -->
    <div class="news-box">
        <!-- Exibe o título da notícia, limitando o texto a 17 caracteres -->
        <h3 id="titulocard"><?php echo mb_substr($news_item['title'], 0, 17); ?></h3>
        
        <!-- Exibe uma prévia da descrição, limitando o texto a 240 caracteres -->
        <div class="descricaonoticia">
            <p><?php echo mb_substr($news_item['description'], 0, 240) . '...'; ?></p>
        </div>

        <!-- Link para a página de detalhes da notícia com o ID da notícia atual -->
        <div class="vermais">
            <a href="news_detail.php?id=<?php echo $news_item['id']; ?>" class="btn">SAIBA MAIS</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php
// Captura e armazena o conteúdo do buffer para ser incluído em 'base.php'
$content = ob_get_clean();
require 'base.php'; // Inclui o layout base para exibir o conteúdo
?>
