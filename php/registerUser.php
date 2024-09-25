<?php
// Inclua o arquivo de conexão com o banco de dados
require 'conexao.php'; // Certifique-se de que o caminho está correto


    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $celular = $_POST['celular'];
    $cpf = $_POST['cpf'];
    $dataNasc = $_POST['data-nascimento'];
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $logradouro = $_POST['logradouro'];
    $numEnd = $_POST['numEnd'];
    $complemento = $_POST['complemento'];

    // Cria um novo objeto Database e abre a conexão
    $conexao = $conn;
    $conn = new mysqli($servername, $username, $password, $dbname);
    

    // Prepara a query SQL
    $sql = "INSERT INTO usuarios (nome, username, email, senha, celular, cpf, data_nascimento, cep, estado, cidade, bairro, logradouro, numero_endereco, complemento) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara e executa a query
    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param("ssssssssssssss", $nome, $username, $email, $senha, $celular, $cpf, $dataNasc, $cep, $estado, $cidade, $bairro, $logradouro, $numEnd, $complemento);
        
        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conexao->error;
    }

    // Fecha a conexão
    $conn->close();

?>