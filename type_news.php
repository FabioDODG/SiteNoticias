<?php 
require 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Consulta para obter todos os tipos de notícias cadastrados no banco de dados
$sql = "SELECT * FROM tb_tipo_noticias";
$types_result = $conn->query($sql); // Executa a consulta SQL
$news_types = $types_result->fetch_all(MYSQLI_ASSOC); // Obtém todos os tipos de notícias como um array associativo

// Verifica se o formulário foi enviado via POST (indicando que uma nova categoria está sendo cadastrada)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Obtém o novo tipo de notícia enviado pelo formulário
    $new_type = $_POST['new_type'];

    // Prepara a consulta SQL para inserir o novo tipo de notícia no banco de dados
    $stmt = $conn->prepare("INSERT INTO tb_tipo_noticias (type) VALUES (?)");
    $stmt->bind_param("s", $new_type); // Associa o parâmetro de tipo de notícia à consulta como uma string
    $stmt->execute(); // Executa a consulta para inserir o novo tipo
    $stmt->close(); // Fecha a instrução preparada após a execução

    // Redireciona para a mesma página após a inserção
    header("Location: type_news.php");
}

ob_start(); // Inicia o buffer de saída
?>
<div class="form-container_types">
    <h2>Cadastrar Categoria de Notícia</h2>
    <!-- Formulário para cadastrar uma nova categoria de notícia -->
    <form action="type_news.php" method="post" class="formulario_tipo_noticia">
        <label for="new_type">Digite a nova categoria:</label>
        <input type="text" id="new_type" name="new_type" placeholder="Categoria" required> <!-- Campo de texto para o tipo de notícia -->
        <button type="submit" class="btn">Cadastrar</button> <!-- Botão para enviar o formulário -->
    </form>

    <h2>Tipos de Notícia Existentes</h2>
    <div class="container_existentes">
        <ul>
            <!-- Exibe os tipos de notícias existentes cadastrados no banco -->
            <?php foreach ($news_types as $type): ?>
            <li>
                <?php echo $type['type']; ?> <!-- Exibe o nome do tipo de notícia -->
                <!-- Formulário para remover um tipo de notícia -->
                <form action="remove_news_type.php" method="post" style="display:inline;">
                    <input type="hidden" name="news_type" value="<?php echo $type['type']; ?>"> <!-- Envia o tipo de notícia para ser removido -->
                    <button type="submit" class="btn">Remover</button> <!-- Botão para remover o tipo de notícia -->
                </form>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Botão de navegação para retornar à página principal -->
    <div class="botoes">
        <a href="index.php" class="btn">Início</a>
    </div>
</div>

<?php
$content = ob_get_clean(); // Obtém o conteúdo gerado pelo buffer de saída
require 'base.php'; // Inclui o arquivo base.php, onde o conteúdo será inserido
?>
