# Site de Notícias

### https://testenoticias.site/ 

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) ![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white) ![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white) ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=JavaScript&logoColor=white) ![Wordpress](https://img.shields.io/badge/Wordpress-21759B?style=for-the-badge&logo=wordpress&logoColor=white) ![SASS](https://img.shields.io/badge/Sass-CC6699?style=for-the-badge&logo=sass&logoColor=white)  ![VISUAL STUDIO CODE](https://img.shields.io/badge/Visual_Studio_Code-0078D4?style=for-the-badge&logo=visual%20studio%20code&logoColor=white)  ![COMPOSER](https://img.shields.io/badge/Composer-0078D4?style=for-the-badge&logo=visual%20studio%20code&logoColor=white) ![PHP](https://img.shields.io/badge/PHPUnit-777BB4?style=for-the-badge=php&logoColor=white)



Este é um site para cadastro, visualização, edição e busca de notícias. 
Os usuários podem adicionar novas notícias e editá-las, buscar por título e visualizar as informações cadastradas, que são armazenadas no banco de dados MySQL.

Funcionalidades do site:

    Cadastro de novas notícias com título, conteúdo e tipo.
    Busca por notícias através do título.
    Visualização das notícias cadastradas.
    Edição completa das notícias cadastradas.
    Remoção dos tipos de notícias cadastradas.

Tecnologias Utilizadas:

    PHP: Linguagem de backend para manipulação do servidor.
    MySQL: Banco de dados para armazenar as notícias.
    HTML/CSS/SASS: Estrutura e estilo do front-end.
    JavaScript: Para interação e validação do frontend.
    PHPunit e Composer para testes unitários.

Ordem / Lógica de utilização do site:

    Cadastro de novos tipos de notícias no botão --> Cadastrar Categoria <-- Preencher os campos e clicar no botão --> Cadastrar <--
    Voltar para o Menu, clicando ou na --> Logo da Indoor <--  ou no botão --> Início <--
    Adicionar notícias no botão --> Cadastrar Notícia <-- e para salvá-las, clicar no botão --> Salvar <--
    Voltar ao menu e visualizar todas as notícias cadastradas
    Para mais informações sobre cada notícia, clicar no botão --> SAIBA MAIS <--
    Para editar o Título, Corpo e Categoria da notícia, ao visualizar a notícia que deseja excluir, clicar no botão --> SAIBA MAIS <-- e posteriormente no botão  --> Editar <--
    Após editar a notícia, para salvar as alterações, clicar no botão --> Salvar <--
    Para remover a notícia, clicar no botão --> SAIBA MAIS <-- e posteriormente, clicar no botão --> Remover <-- , após isso, aparecerá um Pop-Up com a confirmação de exclusão da notícia, basta clicar em OK para remover / ou em Cancelar para não remover a notícia
    Para pesquisar alguma notícia, deve-se ir no Input de Buscas e filtrar pelo título da notícia para realizar a busca
    Para cancelar o filtro, basta clicar novamente na LUPA da pesquisa

    Para dispositivos menores, a logo e os botões de cadastro [notícias / categorias] ficam escondidos dentro do menu hambúrguer a esquerda, porém o passo a passo é o mesmo!!!


Resultados dos testes Unitários usando o phpunit e composer. ->
    

![resultado_testesUnitarios_siteNoticias](https://github.com/user-attachments/assets/a433ea71-8ca0-48db-ab36-5dcc900d4a10)
