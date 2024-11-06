<?php require 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Metadados do documento HTML -->
    <meta charset="UTF-8"> <!-- Define a codificação de caracteres como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ajusta o layout para dispositivos móveis -->
    <link rel="stylesheet" href="static/css/index.css"> <!-- Link para o arquivo CSS -->
    <title>Notícias</title> <!-- Título da página -->
</head>
<body>

    <!-- Menu hambúrguer para navegação mobile -->
    <div id="menu-hamburger" onclick="toggleMenu()">
        <img src="static/fotos/menu.png" alt="Menu" class="hamburger"/>
    </div>

    <!-- Cabeçalho do site contendo a navegação principal -->
    <header id="header">
        <ul>
            <!-- Logo do site que direciona para a página inicial -->
            <li id="imagem_logo">
                <a href="index.php">
                    <img src="static/fotos/Logo.png" alt="Logo" class="logo">
                </a>
            </li>

            <!-- Link para a página de cadastro de notícias -->
            <li id="cadastrar"><a href="add_news.php" class="btn-cadastrar">CADASTRAR NOTÍCIA</a></li>

            <!-- Link para a página de cadastro de categorias -->
            <li id="tipos"><a href="type_news.php" class="btn-cadastrar">CADASTRAR CATEGORIA</a></li>

            <!-- Barra de pesquisa com campo de entrada e botão de busca -->
            <li id="buscas">
                <form action="index.php" method="GET">
                    <div class="input-container">
                        <input type="text" name="query"> <!-- Campo de entrada para a pesquisa -->
                        <button type="submit" class="btn-busca">
                            <img src="static/fotos/buscar.png" alt="Buscar" class="lupa"> <!-- Ícone de busca -->
                        </button>
                    </div>
                </form>
            </li>
        </ul>
    </header>

    <!-- Conteúdo principal da página -->
    <main class="main-content">
        <?php
        // Exibe o conteúdo da página que foi capturado no buffer de saída
        if (isset($content)) {
            echo $content;
        }
        ?>
    </main>

    <!-- Rodapé do site com informações de autoria -->
    <footer>
        <p>DESENVOLVIDO EM 2024 PELO <a href="https://github.com/FabioDODG" target="_blank">PROGRAMADOR</a></p>
    </footer>

    <!-- Script JavaScript para manipulação do menu hambúrguer -->
    <script>
    // Função para alternar a visibilidade do menu hambúrguer
    function toggleMenu() {
        const header = document.getElementById('header'); // Seleciona o cabeçalho
        if (header.style.display === 'none' || header.style.display === '') {
            header.style.display = 'flex'; // Exibe o cabeçalho
            document.addEventListener('click', closeMenuOnClickOutside); // Adiciona listener para fechar ao clicar fora
        } else {
            header.style.display = 'none'; // Esconde o cabeçalho
            document.removeEventListener('click', closeMenuOnClickOutside); // Remove o listener ao fechar
        }
    }

    // Função para fechar o menu ao clicar fora dele
    function closeMenuOnClickOutside(event) {
        const header = document.getElementById('header'); // Seleciona o cabeçalho
        const menuButton = document.getElementById('menu-hamburger'); // Seleciona o botão do menu

        // Verifica se o clique foi fora do cabeçalho e do botão de menu
        if (!header.contains(event.target) && !menuButton.contains(event.target)) {
            header.style.display = 'none'; // Fecha o menu
            document.removeEventListener('click', closeMenuOnClickOutside); // Remove o listener ao fechar
        }
    }
    </script>
</body>
</html>
