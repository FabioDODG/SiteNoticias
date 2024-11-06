<?php
// Definição dos parâmetros de conexão com o banco de dados
$host = 'localhost';                  // Endereço do servidor onde o banco de dados está hospedado
$usuario = 'u243211427_FabioAdmin';   // Nome de usuário utilizado para conectar ao banco
$senha = 'Rbtf2@04Admin*';            // Senha do usuário para acesso ao banco
$banco = 'u243211427_noticias_db';    // Nome do banco de dados que será acessado

// Criando uma nova conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verificação da conexão
// Se houver algum erro ao tentar conectar, exibe uma mensagem e encerra o script
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error); // Mostra a mensagem de erro
} else {
    echo ""; // Conexão bem-sucedida, porém, nenhuma mensagem é exibida
}
?>
