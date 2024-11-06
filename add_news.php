<?php 
require 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Obter tipos de notícias
// Consulta todos os tipos de notícias na tabela `tb_tipo_noticias` para preencher a lista de categorias no formulário
$sql = "SELECT * FROM tb_tipo_noticias";
$types_result = $conn->query($sql);
$news_types = $types_result->fetch_all(MYSQLI_ASSOC); // Armazena os tipos de notícias como uma matriz associativa

// Verifica se o formulário foi enviado via método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $title = $_POST['title']; // Recebe o título da notícia
    $news_type = $_POST['news_type']; // Recebe o tipo/categoria da notícia
    $description = $_POST['description']; // Recebe a descrição da notícia

    // Prepara a consulta para inserir a notícia no banco de dados
    $stmt = $conn->prepare("INSERT INTO tb_noticias (title, description, type) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $news_type); // Associa os parâmetros para evitar SQL Injection
    $stmt->execute(); // Executa a consulta
    $stmt->close(); // Fecha a instrução

    // Redireciona o usuário para a página inicial após o cadastro da notícia
    header("Location: index.php");
}

// Inicia o buffer de saída
ob_start();
?>

<!-- Formulário de cadastro de notícia -->
<div class="form-container_noticias">
    <!-- Cabeçalho do formulário -->
    <h2>Cadastrar Notícia</h2>
    
    <!-- Formulário para cadastrar notícia, enviando dados via método POST -->
    <form action="add_news.php" method="post" class="formularios">
        <div class="inputs_cadastro">

            <!-- Campo para inserir o título da notícia -->
            <div class="titulo_select">
                <label for="title">Título:</label> <!-- Rótulo para o campo de título -->
                <input type="text" id="title" name="title" required><br><br> <!-- Campo de entrada para o título -->

                <!-- Campo de seleção para escolher a categoria da notícia -->
                <label for="news_type" class="labelSelect">Categoria:</label> <!-- Rótulo para a categoria -->
                <select id="news_type" name="news_type" required> <!-- Dropdown das categorias -->
                    <?php foreach ($news_types as $type): ?> <!-- Laço para exibir todas as categorias de notícias obtidas do banco -->
                        <option value="<?php echo $type['type']; ?>"> <!-- Opção com o valor e nome do tipo de notícia -->
                            <?php echo $type['type']; ?> <!-- Nome do tipo de notícia exibido -->
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br><br>

            <!-- Campo para inserir a descrição da notícia -->
            <label for="description" id="label_descricao">Descrição:</label> <!-- Rótulo para a descrição -->
            <textarea id="description_add" name="description" required></textarea><br><br> <!-- Área de texto para a descrição -->

            <!-- Botão de envio do formulário -->
            <div class="botaoSalvar">
                <button type="submit" class="btn">Salvar</button> <!-- Botão para salvar a notícia -->
            </div>
        </div>
    </form>

    <!-- Botão para retornar à página inicial -->
    <div class="botoes">
        <a href="index.php" class="btn">Início</a> <!-- Link para a página inicial -->
    </div>
</div>

<?php
// Limpa e captura o conteúdo do buffer, enviando-o para `base.php` para layout final
$content = ob_get_clean();
require 'base.php';
?>
