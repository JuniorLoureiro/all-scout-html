<?php
require_once 'Database.php';

class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $id; // ✅ Adicionado para armazenar o ID
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

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrar() {
        $query = "INSERT INTO " . $this->table_name . " 
            (nome, email, cpf, senha, cep, cidade, logradouro, complemento, username, celular, data_nascimento, estado, bairro, numEnd)
            VALUES
            (:nome, :email, :cpf, :senha, :cep, :cidade, :logradouro, :complemento, :username, :celular, :data_nascimento, :estado, :bairro, :numEnd)";
        
        $stmt = $this->conn->prepare($query);

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

        return $stmt->execute();
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
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':username', $this->username);
        return $stmt->execute();
    }

    public function buscarPorUsername($username) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function obterDadosPorUsername($username) {
        $query = "SELECT id, nome, email, cpf, cep, cidade, logradouro, complemento, celular, data_nascimento, estado, bairro, numEnd, senha, tipo_usuario 
                  FROM " . $this->table_name . " 
                  WHERE username = :username 
                  LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id']; // ✅ ESSENCIAL PARA A SESSÃO FUNCIONAR
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
            $this->senha = $row['senha'];
            $this->tipo_usuario = $row['tipo_usuario'];

            return true;
        }
        return false;
    }

    public function deletar($username) {
        $query = "DELETE FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        return $stmt->execute();
    }

    public function getTableName() {
        return $this->table_name;
    }
}
