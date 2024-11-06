<?php
use PHPUnit\Framework\TestCase;  // Importa a classe TestCase do PHPUnit para usar como base para os testes.

class NewsTest extends TestCase  // A classe NewsTest herda de TestCase, criando um conjunto de testes relacionados às notícias.
{
    private $conn;  // A variável para armazenar a conexão com o banco de dados.
    private $newsId;  // Armazenará o ID da notícia criada para testes posteriores (atualização e remoção).

    // O método setUp() é executado antes de cada teste. Aqui, ele prepara o ambiente, criando uma categoria e uma notícia de teste.
    protected function setUp(): void
    {
        require 'conexao.php';  // Inclui o arquivo de conexão com o banco de dados.
        $this->conn = $conn;  // Atribui a conexão à variável da classe $this->conn.

        // Cria uma categoria "Tipo de teste" para as notícias.
        $type = 'Tipo de teste';
        $stmt = $this->conn->prepare("INSERT INTO tb_tipo_noticias (type) VALUES (?) ON DUPLICATE KEY UPDATE type=type");
        $stmt->bind_param("s", $type);
        $stmt->execute();
        $stmt->close();

        // Cria uma notícia de teste.
        $title = 'Notícia Teste';
        $description = 'Descrição da notícia de teste';
        $stmt = $this->conn->prepare("INSERT INTO tb_noticias (title, description, type) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $description, $type);
        $stmt->execute();
        
        // Armazena o ID da notícia criada para utilizá-lo nos testes de atualização e exclusão.
        $this->newsId = $this->conn->insert_id;  // Captura o ID da última inserção (a notícia criada).
        $stmt->close();
    }

    // Teste para verificar se a notícia foi criada corretamente.
    public function testCreateNews()
    {
        // Verifica se a notícia foi criada, realizando uma consulta para o ID da notícia.
        $result = $this->conn->query("SELECT * FROM tb_noticias WHERE id = {$this->newsId}");
        $this->assertGreaterThan(0, $result->num_rows, 'Falha ao criar a notícia.');
    }

    // Teste para verificar se existem notícias cadastradas no banco de dados.
    public function testReadNews()
    {
        // Realiza uma consulta para verificar se existem notícias na tabela.
        $result = $this->conn->query("SELECT * FROM tb_noticias");
        $this->assertGreaterThan(0, $result->num_rows, 'Nenhuma notícia encontrada.');
    }

    // Teste para verificar se a atualização da notícia funciona corretamente.
    public function testUpdateNews()
    {
        // Define um novo título para a notícia.
        $newTitle = 'Título Atualizado';

        // Atualiza o título da notícia criada no método setUp().
        $stmt = $this->conn->prepare("UPDATE tb_noticias SET title = ? WHERE id = ?");
        $stmt->bind_param("si", $newTitle, $this->newsId);
        $result = $stmt->execute();
        
        $this->assertTrue($result, 'Falha ao atualizar a notícia.');

        // Verifica se a atualização foi bem-sucedida, consultando a notícia novamente.
        $stmt = $this->conn->prepare("SELECT * FROM tb_noticias WHERE id = ?");
        $stmt->bind_param("i", $this->newsId);
        $stmt->execute();
        $result = $stmt->get_result();
        $news = $result->fetch_assoc();
        $this->assertEquals($newTitle, $news['title'], 'O título da notícia não foi atualizado corretamente.');

        // Limpa após o teste
        $stmt->close();
    }

    // Teste para verificar se a exclusão da notícia funciona corretamente.
    public function testDeleteNews()
    {
        // Exclui a notícia criada no método setUp().
        $stmt = $this->conn->prepare("DELETE FROM tb_noticias WHERE id = ?");
        $stmt->bind_param("i", $this->newsId);
        $result = $stmt->execute();

        $this->assertTrue($result, 'Falha ao remover a notícia.');
        
        // Verifica se a notícia foi realmente removida.
        $stmt = $this->conn->prepare("SELECT * FROM tb_noticias WHERE id = ?");
        $stmt->bind_param("i", $this->newsId);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->assertEquals(0, $result->num_rows, 'A notícia não foi removida corretamente.');

        // Limpa após o teste
        $stmt->close();
    }

    // O método tearDown() é executado após cada teste, e aqui ele limpa os dados criados para garantir que o ambiente de teste não seja alterado.
    protected function tearDown(): void
    {
        // Exclui a notícia criada no setUp()
        $this->conn->query("DELETE FROM tb_noticias WHERE id = {$this->newsId}");

        // Exclui a categoria criada no setUp()
        $this->conn->query("DELETE FROM tb_tipo_noticias WHERE type = 'Tipo de teste'");
    }
}
