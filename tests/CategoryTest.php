<?php
use PHPUnit\Framework\TestCase;  // Importa a classe TestCase do PHPUnit, que permite criar testes unitários.

class CategoryTest extends TestCase  // A classe CategoryTest herda de TestCase, tornando-se um conjunto de testes.
{
    private $conn;  // Declara a variável de conexão com o banco de dados.

    // Método chamado antes de cada teste ser executado.
    // Aqui, ele é usado para estabelecer a conexão com o banco de dados.
    protected function setUp(): void
    {
        require 'conexao.php';  // Inclui o arquivo de conexão, estabelecendo a conexão com o banco.
        $this->conn = $conn;  // Atribui a conexão à variável $conn.
    }

    // Teste para a criação de uma nova categoria.
    public function testCreateCategory()
    {
        $type = 'Categoria Teste';  // Define o nome da categoria para o teste.

        // Prepara a consulta SQL para inserir a categoria no banco de dados.
        $stmt = $this->conn->prepare("INSERT INTO tb_tipo_noticias (type) VALUES (?)");
        $stmt->bind_param("s", $type);  // Vincula o parâmetro de categoria ao valor $type.
        $result = $stmt->execute();  // Executa a consulta no banco.

        // Verifica se o resultado foi verdadeiro (categoria foi criada com sucesso).
        $this->assertTrue($result, 'Falha ao criar a categoria.');
        
        // Fecha a consulta após o teste.
        $stmt->close();
    }

    // Teste para ler as categorias existentes.
    public function testReadCategory()
    {
        // Executa uma consulta para selecionar todas as categorias.
        $result = $this->conn->query("SELECT * FROM tb_tipo_noticias");
        
        // Verifica se o número de linhas retornadas é maior que 0 (ou seja, existem categorias).
        $this->assertGreaterThan(0, $result->num_rows, 'Nenhuma categoria encontrada.');
    }

    // Teste para deletar uma categoria.
    public function testDeleteCategory()
    {
        $type = 'Categoria Teste';  // Define a categoria a ser removida.

        // Prepara a consulta SQL para deletar a categoria do banco.
        $stmt = $this->conn->prepare("DELETE FROM tb_tipo_noticias WHERE type = ?");
        $stmt->bind_param("s", $type);  // Vincula o parâmetro de categoria ao valor $type.
        $result = $stmt->execute();  // Executa a consulta para deletar a categoria.

        // Verifica se a operação foi bem-sucedida (categoria removida com sucesso).
        $this->assertTrue($result, 'Falha ao remover a categoria.');
        
        // Fecha a consulta após o teste.
        $stmt->close();
    }
}
