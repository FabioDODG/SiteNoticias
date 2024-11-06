<?php
use PHPUnit\Framework\TestCase;  // Importa a classe TestCase do PHPUnit, permitindo a criação de testes unitários.

class DatabaseTest extends TestCase  // A classe DatabaseTest herda de TestCase, criando um conjunto de testes relacionados à conexão com o banco de dados.
{
    private $conn;  // Declara a variável para armazenar a conexão com o banco de dados.

    // O método setUp() é executado antes de cada teste. Aqui, ele é usado para configurar o ambiente de teste.
    protected function setUp(): void
    {
        require 'conexao.php';  // Inclui o arquivo de conexão com o banco de dados, estabelecendo a conexão.
        $this->conn = $conn;  // Atribui a conexão à variável $conn para que ela possa ser usada nos testes.
    }

    // Teste para verificar se a conexão com o banco de dados foi estabelecida corretamente.
    public function testDatabaseConnection()
    {
        // Verifica se a variável $conn não é nula, ou seja, se a conexão foi estabelecida.
        $this->assertNotNull($this->conn, 'A conexão com o banco de dados falhou.');
        
        // Verifica se a conexão é uma instância válida da classe mysqli, o que indica que a conexão foi bem-sucedida.
        $this->assertInstanceOf(mysqli::class, $this->conn, 'A conexão não é uma instância válida do mysqli.');
    }
}
