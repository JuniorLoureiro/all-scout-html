<?php
require_once 'Database.php';

class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $nome;
    public $email;
    public $cpf;
    public $senha;
    public $cep;
    public $cidade;
    public $logradouro;
    public $complemento;
    public $username;
    public $celular;
    public $data_nascimento;
    public $estado;
    public $bairro;
    public $numEnd;
    public $tipo_usuario;

    // Construtor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar o usuário
    public function registrar() {
        $query = "INSERT INTO " . $this->table_name . " 
            (nome, email, cpf, senha, cep, cidade, logradouro, complemento, username, celular, data_nascimento, estado, bairro, numEnd)
            VALUES
            (:nome, :email, :cpf, :senha, :cep, :cidade, :logradouro, :complemento, :username, :celular, :data_nascimento, :estado, :bairro, :numEnd)";
        
        $stmt = $this->conn->prepare($query);

        // Ligação dos parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':cep', $this->cep);
        $stmt->bindParam(':cidade', $this->cidade);
        $stmt->bindParam(':logradouro', $this->logradouro);
        $stmt->bindParam(':complemento', $this->complemento);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':celular', $this->celular);
        $stmt->bindParam(':data_nascimento', $this->data_nascimento);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':bairro', $this->bairro);
        $stmt->bindParam(':numEnd', $this->numEnd);

        // Executa a query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
    public function verificarSenha($senha_atual) {
        $query = "SELECT senha FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return password_verify($senha_atual, $row['senha']);
        }

        return false;
    }

    public function atualizarSenha() {
        $query = "UPDATE " . $this->table_name . " SET senha = :senha WHERE username = :username";
        $stmt = $this->conn->prepare($query);

        // bind
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':username', $this->username);

        return $stmt->execute();
    }

    public function buscarPorUsername($username) {
    
   
        // Cria a query para buscar o usuário pelo username
        $query = "SELECT id FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
            
        // Prepara a consulta
        $stmt = $this->conn->prepare($query);
            
        // Liga o parâmetro do username
        $stmt->bindParam(':username', $username);
       
        // Executa a consulta
        $stmt->execute();

        // Verifica se encontrou algum resultado
        if ($stmt->rowCount() > 0) {
                return true; // O username já existe
            }
        else{
            return false; // O username não existe
        }     

    }

    public function obterDadosPorUsername($username) {
        $query = "SELECT nome, email, cpf, cep, cidade, logradouro, complemento, celular, data_nascimento, estado, bairro, numEnd, senha, tipo_usuario 
                  FROM " . $this->table_name . " 
                  WHERE username = :username 
                  LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Armazena os dados na classe
            $this->nome = $row['nome'];
            $this->email = $row['email'];
            $this->cpf = $row['cpf'];
            $this->cep = $row['cep'];
            $this->cidade = $row['cidade'];
            $this->logradouro = $row['logradouro'];
            $this->complemento = $row['complemento'];
            $this->celular = $row['celular'];
            $this->data_nascimento = $row['data_nascimento'];
            $this->estado = $row['estado'];
            $this->bairro = $row['bairro'];
            $this->numEnd = $row['numEnd'];
            $this->senha = $row['senha']; // Armazena a senha para verificação
            $this->tipo_usuario = $row['tipo_usuario']; // Armazena o tipo de usuário
            return true;
        }
        return false; // Retorna falso se não encontrar
    }
    
    public function getTableName() {
        return $this->table_name;
    }
    public function deletar($username) {
        // Query para deletar o usuário
        $query = "DELETE FROM " . $this->table_name . " WHERE username = :username";
        
        // Preparação da consulta
        $stmt = $this->conn->prepare($query);
        
        // Bind do parâmetro
        $stmt->bindParam(':username', $username);
    
        // Executa a query e retorna o resultado
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}
?>