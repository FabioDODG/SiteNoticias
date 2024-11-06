<?php 
require 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Obtém o ID da notícia a ser visualizada a partir dos parâmetros da URL
$id = $_GET['id'];

// Consulta para selecionar a notícia com o ID especificado
$sql = "SELECT * FROM tb_noticias WHERE id = ?";
$stmt = $conn->prepare($sql); // Prepara a consulta para evitar SQL Injection
$stmt->bind_param("i", $id); // Associa o ID como um inteiro
$stmt->execute(); // Executa a consulta
$news = $stmt->get_result()->fetch_assoc(); // Obtém os dados da notícia como um array associativo
$stmt->close(); // Fecha a instrução preparada

// Inicia o buffer de saída
ob_start();
?>

<!-- Conteúdo para exibir os detalhes da notícia -->
<div class="containernews_details">
    <div class="news-container-details">
        <!-- Exibe o título da notícia -->
        <h2><?php echo $news['title']; ?></h2>

        <!-- Exibe a descrição completa da notícia -->
        <p id="descricao"><?php echo $news['description']; ?></p>

        <!-- Exibe o tipo/categoria da notícia -->
        <h3>Tipo de notícia: <?php echo $news['type']; ?></h3>
    </div>

    <!-- Botões para editar, remover ou retornar à página inicial -->
    <div class="botoes">
        <!-- Botão para editar a notícia, redirecionando para a página de edição com o ID da notícia -->
        <a href="edit_news.php?id=<?php echo $id; ?>" class="btn">Editar</a>

        <!-- Formulário para remover a notícia, com confirmação antes de excluir -->
        <form action="remove-news.php?id=<?php echo $id; ?>" method="post" style="display:inline;">
            <!-- Botão de exclusão com mensagem de confirmação -->
            <button type="submit" class="btn" onclick="return confirm('Você tem certeza que deseja remover esta notícia?');">Remover</button>
        </form>

        <!-- Botão para retornar à página inicial -->
        <div>
            <a href="index.php" class="btn">Início</a>
        </div>
    </div>
</div>

<?php
// Captura e armazena o conteúdo do buffer para ser incluído em 'base.php'
$content = ob_get_clean();
require 'base.php'; // Inclui o layout base para exibir o conteúdo
?>
