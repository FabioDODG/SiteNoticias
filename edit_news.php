<?php 
require 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Obtém o ID da notícia a ser editada a partir dos parâmetros da URL
$id = $_GET['id'];

// Consulta para selecionar a notícia com o ID especificado
$sql = "SELECT * FROM tb_noticias WHERE id = ?";
$stmt = $conn->prepare($sql); // Prepara a consulta para evitar SQL Injection
$stmt->bind_param("i", $id); // Associa o ID como um inteiro
$stmt->execute(); // Executa a consulta
$news = $stmt->get_result()->fetch_assoc(); // Obtém os dados da notícia como um array associativo
$stmt->close(); // Fecha a instrução preparada

// Consulta para obter todas as categorias de notícias
$sql = "SELECT * FROM tb_tipo_noticias";
$types_result = $conn->query($sql); // Executa a consulta
$news_types = $types_result->fetch_all(MYSQLI_ASSOC); // Armazena os tipos de notícias como uma matriz associativa

// Verifica se o formulário foi enviado via método POST para atualizar a notícia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados atualizados do formulário
    $title = $_POST['title']; // Recebe o título atualizado
    $news_type = $_POST['news_type']; // Recebe o tipo/categoria atualizado
    $description = $_POST['description']; // Recebe a descrição atualizada

    // Prepara a consulta para atualizar a notícia no banco de dados
    $stmt = $conn->prepare("UPDATE tb_noticias SET title = ?, description = ?, type = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $description, $news_type, $id); // Associa os parâmetros para evitar SQL Injection
    $stmt->execute(); // Executa a consulta
    $stmt->close(); // Fecha a instrução

    // Redireciona para a página inicial após a atualização da notícia
    header("Location: index.php");
}

// Inicia o buffer de saída
ob_start();
?>

<!-- Formulário de edição de notícia -->
<div class="editnews">
    <h2>Editar Notícia</h2>

    <!-- Formulário para editar notícia, enviando dados via método POST -->
    <form action="edit_news.php?id=<?php echo $id; ?>" method="post" class="formulario_edicao">
        <!-- Campo para editar o título da notícia -->
        <label for="title" id="titulo_descricao">Título:</label>
        <input type="text" id="title" name="title" value="<?php echo $news['title']; ?>" required><br><br>

        <!-- Campo para editar a descrição da notícia -->
        <label for="description" id="label_descricao">Descrição:</label>
        <textarea id="description_edit" name="description" required><?php echo $news['description']; ?></textarea><br><br>

        <!-- Campo de seleção para editar o tipo de notícia -->
        <label for="news_type" id="titulo_descricao">Tipo de Notícia:</label>
        <select id="news_type" name="news_type" required>
            <?php foreach ($news_types as $type): ?> <!-- Laço para exibir todas as categorias disponíveis -->
            <option value="<?php echo $type['type']; ?>" 
                <?php if ($news['type'] == $type['type']) echo 'selected'; ?>> <!-- Marca como selecionado o tipo atual -->
                <?php echo $type['type']; ?> <!-- Exibe o nome da categoria -->
            </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <!-- Botão de envio para salvar as alterações -->
        <button type="submit" class="btn">Salvar</button>
    </form>

    <!-- Botão para retornar à página inicial -->
    <div class="botoes">
        <a href="index.php" class="btn">Início</a>
    </div>
</div>

<?php
// Limpa e captura o conteúdo do buffer, enviando-o para `base.php` para layout final
$content = ob_get_clean();
require 'base.php'; // Inclui o layout base da página
?>
